<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        // Start the product query with eager loading to prevent N+1 query problem
        // Eager load both 'category' and 'productImages' for optimal performance
        $query = Product::with(['category', 'productImages'])->latest();

        // 1. Text Search Filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. Set a default title
        $pageTitle = 'All Products';

        // 4. Out of Stock Filter (EXACTLY 0 stock)
        if ($request->filled('out_of_stock')) {
            $query->where('stock', 0);
            $pageTitle = 'Out of Stock Products';
        }

        // 5. Low Stock Filter (10 or fewer items)
        if ($request->filled('low_stock') && !$request->filled('out_of_stock')) {
            $query->where('stock', '>', 0)
                  ->where('stock', '<=', 10);
            $pageTitle = 'Low Stock Products';
        }

        $products = $query->paginate(10)->appends($request->all());

        // Return Partial HTML for AJAX
        if ($request->ajax()) {
            return view('admin.products.partials.table-rows', compact('products'))->render();
        }

        $categories = Category::all();

        // Count low stock and out of stock items for badges
        $outOfStockCount = Product::where('stock', 0)->count();
        $lowStockCount = Product::where('stock', '>', 0)
            ->where('stock', '<=', 10) // Warns us if 10 or fewer items are left
            ->count();

        return view('admin.products.index', compact('products', 'categories', 'pageTitle', 'outOfStockCount', 'lowStockCount'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request with custom error messages
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'name_zh' => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_km' => 'nullable|string|max:1000',
            'description_zh' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'discount_start' => 'nullable|date',
            'discount_end' => 'nullable|date|after:discount_start',
            'is_on_sale' => 'boolean',
            'sale_label' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Custom error messages for better UX
            'name_en.required' => 'The English name is required.',
            'name_km.required' => 'សូមបញ្ចូលឈ្មោះផលិតផលជាភាសាខ្មែរ (The Khmer name is required).',
            'name_zh.required' => 'The Chinese name is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'price.required' => 'Please enter a price.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',
            'discount_percent.numeric' => 'Discount must be a number.',
            'discount_percent.min' => 'Discount cannot be negative.',
            'discount_percent.max' => 'Discount cannot exceed 100%.',
            'stock.required' => 'Please enter stock quantity.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
            'unit.required' => 'Please select a unit.',
            'sku.unique' => 'This SKU/Barcode is already in use.',
            'images.max' => 'You can only upload up to 4 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.max' => 'Each image must be less than 2MB.',
        ]);

        // SMART SKU LOGIC: If blank, generate one. If not, use what they scanned.
        $finalSku = $validated['sku'] ?? null;
        if (empty($finalSku)) {
            // Generates something like "PRD-A8F39K21"
            $finalSku = 'PRD-' . strtoupper(\Illuminate\Support\Str::random(8));
        }

        // Pack multi-language name and description into JSON arrays
        $productName = [
            'en' => $validated['name_en'],
            'km' => $validated['name_km'],
            'zh' => $validated['name_zh'],
        ];

        $productDescription = [];
        if (!empty($validated['description_en'])) $productDescription['en'] = $validated['description_en'];
        if (!empty($validated['description_km'])) $productDescription['km'] = $validated['description_km'];
        if (!empty($validated['description_zh'])) $productDescription['zh'] = $validated['description_zh'];

        // Calculate discount price if discount percent is provided
        $discountPrice = null;
        if (!empty($validated['discount_percent']) && $validated['discount_percent'] > 0) {
            $discountPrice = $validated['price'] * (1 - $validated['discount_percent'] / 100);
        }

        // Create the product first
        $product = Product::create([
            'name' => $productName,
            'description' => !empty($productDescription) ? $productDescription : null,
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'discount_price' => $discountPrice,
            'discount_start' => $validated['discount_start'] ?? null,
            'discount_end' => $validated['discount_end'] ?? null,
            'is_on_sale' => $request->has('is_on_sale'),
            'sale_label' => $validated['sale_label'] ?? null,
            'stock' => $validated['stock'],
            'unit' => $validated['unit'],
            'sku' => $finalSku,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $index,
                ]);
            }
        }

        // Log the activity
        ActivityLog::log('Created', 'Inventory', "Added a new product: {$productName['en']} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully in 3 languages!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'required|string|max:255',
            'name_zh' => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_km' => 'nullable|string|max:1000',
            'description_zh' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'discount_start' => 'nullable|date',
            'discount_end' => 'nullable|date|after:discount_start',
            'is_on_sale' => 'boolean',
            'sale_label' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // SMART SKU LOGIC: If blank, generate one. If not, use what they scanned.
        $finalSku = $validated['sku'] ?? null;
        if (empty($finalSku)) {
            $finalSku = 'PRD-' . strtoupper(\Illuminate\Support\Str::random(8));
        }

        // Pack multi-language name and description into JSON arrays
        $productName = [
            'en' => $validated['name_en'],
            'km' => $validated['name_km'],
            'zh' => $validated['name_zh'],
        ];

        $productDescription = [];
        if (!empty($validated['description_en'])) $productDescription['en'] = $validated['description_en'];
        if (!empty($validated['description_km'])) $productDescription['km'] = $validated['description_km'];
        if (!empty($validated['description_zh'])) $productDescription['zh'] = $validated['description_zh'];

        // Calculate discount price if discount percent is provided
        $discountPrice = null;
        if (!empty($validated['discount_percent']) && $validated['discount_percent'] > 0) {
            $discountPrice = $validated['price'] * (1 - $validated['discount_percent'] / 100);
        }

        // Check if adding new images would exceed the 4-image limit
        if ($request->hasFile('images')) {
            $currentImageCount = $product->productImages()->count();
            $newImageCount = count($request->file('images'));

            if (($currentImageCount + $newImageCount) > 4) {
                return back()->withErrors([
                    'images' => 'You can only have a maximum of 4 images per product. You currently have ' . $currentImageCount . ' and are trying to add ' . $newImageCount . '. Please delete some images first.'
                ])->withInput();
            }

            // Upload new images
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'sort_order' => $product->productImages()->count() + $index,
                ]);
            }
        }

        $product->update([
            'name' => $productName,
            'description' => !empty($productDescription) ? $productDescription : null,
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'discount_price' => $discountPrice,
            'discount_start' => $validated['discount_start'] ?? null,
            'discount_end' => $validated['discount_end'] ?? null,
            'is_on_sale' => $request->has('is_on_sale'),
            'sale_label' => $validated['sale_label'] ?? null,
            'stock' => $validated['stock'],
            'unit' => $validated['unit'],
            'sku' => $finalSku,
        ]);

        // Log the activity
        ActivityLog::log('Updated', 'Inventory', "Updated product: {$productName['en']} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Soft delete the specified product (move to trash).
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $productName = is_array($product->name) ? ($product->name['en'] ?? 'Product') : $product->name;
        $product->delete();

        // Log the activity
        ActivityLog::log('Deleted', 'Inventory', "Deleted product: {$productName} (ID: {$id})");

        return redirect()->route('admin.products.index')->with('success', 'Product moved to trash!');
    }

    /**
     * Delete a specific product image.
     */
    public function destroyImage($id)
    {
        try {
            // 1. Find the image in the database
            $image = ProductImage::findOrFail($id);

            // 2. Get the product to verify ownership
            $product = $image->product;

            // 3. Delete the actual file from storage
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            // 4. Delete the row from the database
            $image->delete();

            // 5. Always return JSON for this method
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display trashed products.
     */
    public function trash()
    {
        $trashedProducts = Product::onlyTrashed()->with(['category', 'productImages'])->latest()->paginate(10);
        return view('admin.products.trash', compact('trashedProducts'));
    }

    /**
     * Restore a trashed product.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        // Log the restore action
        $productName = is_array($product->name) ? ($product->name['en'] ?? 'Product') : $product->name;
        ActivityLog::log(
            'RESTORED',
            'Inventory',
            "Restored product: {$productName} (ID: {$product->id})"
        );

        return redirect()->route('admin.products.index')->with('success', 'Product restored!');
    }

    /**
     * Permanently delete a product.
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->forceDelete();

        return redirect()->route('admin.products.trash')->with('success', 'Product permanently deleted!');
    }

    /**
     * Bulk delete products.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id'
        ]);

        $products = Product::whereIn('id', $request->ids)->get();

        foreach ($products as $product) {
            $product->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Products moved to trash successfully.'
        ]);
    }

    /**
     * Bulk restore products.
     */
    public function bulkRestore(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || count($ids) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Please select at least one product to restore.'
            ], 400);
        }

        $restored = Product::onlyTrashed()->whereIn('id', $ids)->restore();

        // Log the restore action
        ActivityLog::log(
            'RESTORED',
            'Inventory',
            "Bulk restored " . count($ids) . " products"
        );

        return response()->json([
            'success' => true,
            'message' => 'Selected products have been restored!'
        ]);
    }

    /**
     * Bulk force delete products (permanently delete from trash).
     */
    public function bulkForceDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id'
        ]);

        $products = Product::onlyTrashed()->whereIn('id', $request->ids)->get();

        foreach ($products as $product) {
            // Delete associated images
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Delete product images from product_images table
            if ($product->productImages) {
                foreach ($product->productImages as $productImage) {
                    if ($productImage->image_path) {
                        Storage::disk('public')->delete($productImage->image_path);
                    }
                }
                $product->productImages()->delete();
            }

            $product->forceDelete();
        }

        // Log the delete action
        ActivityLog::log(
            'DELETED',
            'Inventory',
            "Bulk force deleted " . count($request->ids) . " products"
        );

        return response()->json([
            'success' => true,
            'message' => 'Selected products have been permanently deleted!'
        ]);
    }

    /**
     * Export products as PDF.
     */
    public function exportPDF()
    {
        $products = Product::with('category')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.inventory', compact('products'));
        return $pdf->download('inventory-report.pdf');
    }

    /**
     * Export products as Excel.
     */
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ProductsExport, 'products.xlsx');
    }
}
