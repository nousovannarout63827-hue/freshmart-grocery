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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // SMART SKU LOGIC: If blank, generate one. If not, use what they scanned.
        $finalSku = $data['sku'] ?? null;
        if (empty($finalSku)) {
            // Generates something like "PRD-A8F39K21"
            $finalSku = 'PRD-' . strtoupper(\Illuminate\Support\Str::random(8));
        }

        // Create the product first
        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'unit' => $data['unit'],
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
        ActivityLog::log('Created', 'Inventory', "Added a new product: {$product->name} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
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
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'unit' => $validated['unit'],
            'sku' => $finalSku,
        ]);

        // Log the activity
        ActivityLog::log('Updated', 'Inventory', "Updated product: {$product->name} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Soft delete the specified product (move to trash).
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;
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
        ActivityLog::log(
            'RESTORED',
            'Inventory',
            "Restored product: {$product->name} (ID: {$product->id})"
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
            return redirect()->back()->with('error', 'Please select at least one product to restore.');
        }

        Product::onlyTrashed()->whereIn('id', $ids)->restore();

        return redirect()->route('admin.products.index')->with('success', 'Selected products have been restored!');
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
