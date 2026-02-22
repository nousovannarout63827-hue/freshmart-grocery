@extends('layouts.admin')

@section('content')
<div style="padding: 30px 30px 30px 300px; box-sizing: border-box; max-width: 1400px; margin: 0 auto;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; font-size: 28px; font-weight: 900; color: #1e293b;">Edit Product: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" style="background: #f1f5f9; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; transition: background 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Cancel</a>
    </div>

    @if ($errors->any())
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
            <strong style="display: block; margin-bottom: 8px; font-weight: 700;">⚠️ Please fix these errors:</strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom: 4px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
                
                <!-- Left Column: Image Upload -->
                <div>
                    <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 16px;">Product Images</h3>

                        @if($product->productImages && $product->productImages->count() > 0)
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 16px;">
                                @foreach($product->productImages as $image)
                                    <div style="position: relative; width: 80px; height: 80px; border-radius: 10px; border: 2px solid #e2e8f0; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Product Image">
                                        <button type="button" onclick="deleteImage({{ $image->id }})" style="position: absolute; top: 4px; right: 4px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 14px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.3);" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">×</button>
                                    </div>
                                @endforeach
                            </div>
                            <p style="font-size: 12px; color: #64748b; margin-bottom: 12px;">💡 Click <strong style="color: #ef4444;">×</strong> to delete. Add {{ 4 - $product->productImages->count() }} more images.</p>
                        @endif

                        <div style="margin-bottom: 16px; padding: 20px; border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; text-align: center;">
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #475569; margin-bottom: 8px;">📸 Upload New Images</label>
                            <input type="file" id="image-upload-input" name="images[]" multiple accept="image/*" style="width: 100%; padding: 8px; background: white; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing: border-box;">
                            <div id="new-image-previews" style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; margin-top: 12px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Details -->
                <div>
                    <div style="background: white; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        
                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Product Name *</label>
                            <input type="text" name="name" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('name', $product->name) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>

                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Category *</label>
                            <select name="category_id" id="category-select" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('price', $product->price) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Stock Quantity *</label>
                                <input type="number" name="stock" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('stock', $product->stock) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Unit (Sold By) *</label>
                                <select name="unit" id="unit-select" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                    <option value="">Select Category First</option>
                                </select>
                            </div>
                        </div>

                        <div style="margin-bottom: 32px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">SKU / Barcode</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="Scan barcode or leave blank to auto-generate">
                            <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">💡 Leave blank to auto-generate a unique code (e.g., PRD-X7B92M)</small>
                        </div>

                        <div style="display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" style="background: #10b981; color: white; border: none; padding: 14px 32px; border-radius: 12px; font-weight: 800; font-size: 15px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.boxShadow='0 6px 15px rgba(5, 150, 105, 0.3)'" onmouseout="this.style.background='#10b981'; this.style.boxShadow='0 4px 10px rgba(16, 185, 129, 0.2)'">
                                Update Product
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // Delete image using AJAX (avoids nested form issue)
    function deleteImage(imageId) {
        Swal.fire({
            title: 'Delete this image?',
            text: "It will be permanently removed from this product.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/products/images/' + imageId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your image has been removed.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to delete image'
                        });
                    }
                })
                .catch(error => {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete image. Check console for details.'
                    });
                });
            }
        });
    }

    // Image Preview Script - Lightweight and bug-free!
    document.getElementById('image-upload-input').addEventListener('change', function(event) {
        // 1. Find the preview zone and clear it out if they pick new files
        const previewZone = document.getElementById('new-image-previews');
        previewZone.innerHTML = ''; 

        // 2. Get the files the user just selected
        const files = event.target.files;

        // 3. Loop through each file
        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Safety check: Only process image files!
            if (!file.type.match('image.*')) {
                continue;
            }

            // 4. Use FileReader to draw the image on the screen
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Create a beautiful little image tag
                const img = document.createElement('img');
                img.src = e.target.result;
                
                // Style it to look like a premium thumbnail
                img.style.width = '70px';
                img.style.height = '70px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '8px';
                img.style.border = '2px solid #4f46e5';
                img.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                
                // Drop it into the preview zone!
                previewZone.appendChild(img);
            }
            
            // Execute the read command
            reader.readAsDataURL(file);
        }
    });

    // Unit Selection Logic
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category-select');
        const unitSelect = document.getElementById('unit-select');

        // Get the current unit value from the database (if editing)
        const currentUnit = '{{ old('unit', $product->unit ?? '') }}';

        // 1. Define our dynamic mapping based on your store categories
        const unitMap = {
            'Vegetables': ['Kg', 'g', 'piece', 'bunch', 'bag'],
            'Fruits': ['Kg', 'g', 'piece', 'box', 'pack'],
            'Meat & Fish': ['Kg', 'g', 'piece', 'whole'],
            'Dairy & Eggs': ['piece', 'dozen', 'box', 'Liter', 'ml'],
            'Beverages': ['can', 'bottle', 'case', 'pack', 'Liter', 'ml'],
            'Frozen Food': ['box', 'pack', 'Kg', 'g'],
            'Bakery': ['piece', 'loaf', 'box', 'pack'],
            'Snacks': ['piece', 'pack', 'box', 'bag'],

            // A fallback for any new categories you create later
            'Default': ['piece', 'box', 'pack', 'case', 'Kg', 'Liter']
        };

        // 2. The function that updates the units
        function updateUnits() {
            // Get the text of the selected category (e.g., "Beverages")
            let selectedCategory = categorySelect.options[categorySelect.selectedIndex].text;

            // Check if we have a specific list for this category, otherwise use Default
            let availableUnits = unitMap[selectedCategory] || unitMap['Default'];

            // Clear out the old options
            unitSelect.innerHTML = '';

            // If no category is selected yet
            if (categorySelect.value === "") {
                unitSelect.innerHTML = '<option value="">Select Category First</option>';
                return;
            }

            // Populate the new options
            availableUnits.forEach(unit => {
                let option = document.createElement('option');
                option.value = unit;
                option.text = unit;
                // Pre-select the current unit if it matches
                if (unit === currentUnit) {
                    option.selected = true;
                }
                unitSelect.appendChild(option);
            });
        }

        // 3. Run the function whenever the category changes
        categorySelect.addEventListener('change', updateUnits);

        // 4. Run it once on page load to populate units and select current value
        updateUnits();
    });
</script>
@endsection
