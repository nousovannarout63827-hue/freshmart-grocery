<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'emoji' => 'nullable|string|max:10',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => true,
        ]);

        // Handle the icon upload (image takes priority)
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('category-icons', 'public');
            $category->icon = $path;
            $category->save();
        } elseif ($request->filled('emoji')) {
            // Only save emoji if no image was uploaded
            $category->emoji = $request->emoji;
            $category->save();
        }

        ActivityLog::log('Created', 'Inventory', "Created new category: {$category->name}");

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'emoji' => 'nullable|string|max:10',
            'is_active' => 'boolean',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->is_active = $request->has('is_active');

        // Handle image removal (if checkbox is checked)
        if ($request->has('remove_image') && $category->icon) {
            // Delete old image from storage
            if (Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            $category->icon = null;
        }

        // Handle the icon update (image takes priority)
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            // Save the new image
            $path = $request->file('icon')->store('category-icons', 'public');
            $category->icon = $path;
            $category->emoji = null; // Clear emoji if image is uploaded
        } elseif ($request->filled('emoji')) {
            // Update emoji if provided and no new image
            $category->emoji = $request->emoji;
        }

        $category->save();

        ActivityLog::log('Updated', 'Inventory', "Updated category: {$category->name}");

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category. It has associated products.');
        }

        $categoryName = $category->name;
        $category->delete();

        ActivityLog::log('Deleted', 'Inventory', "Deleted category: {$categoryName}");

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
