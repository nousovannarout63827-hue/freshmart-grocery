@extends('layouts.admin')

@section('content')
<style>
.product-edit-page {
    padding: 30px;
    box-sizing: border-box;
    max-width: 1400px;
    margin: 0 auto;
}

@media (max-width: 1024px) {
    .product-edit-page {
        padding: 16px !important;
        max-width: 100% !important;
    }

    .product-edit-layout {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }

    .product-edit-card {
        padding: 20px !important;
    }
}

@media (max-width: 768px) {
    .product-edit-page {
        padding: 12px !important;
    }

    .page-header {
        flex-direction: column !important;
        gap: 12px !important;
        align-items: stretch !important;
    }

    .page-header h1 {
        font-size: 20px !important;
        line-height: 1.3 !important;
    }

    .cancel-btn {
        width: 100% !important;
        justify-content: center !important;
        text-align: center !important;
    }

    .product-edit-spec-grid {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }

    .product-edit-actions {
        flex-direction: column !important;
        gap: 10px !important;
    }

    .product-edit-actions button {
        width: 100% !important;
        justify-content: center !important;
    }

    .image-preview-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
    }

    .form-group label {
        font-size: 12px !important;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        font-size: 14px !important;
        padding: 10px !important;
    }
}

@media (max-width: 375px) {
    .product-edit-page {
        padding: 10px !important;
    }

    .page-header h1 {
        font-size: 18px !important;
    }

    .product-edit-card {
        padding: 16px !important;
    }
}
</style>

<div class="product-edit-page" style="padding: 30px; box-sizing: border-box; max-width: 1400px; margin: 0 auto;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 12px;">
        <h1 style="margin: 0; font-size: 28px; font-weight: 900; color: #1e293b;">Edit Product: {{ $product->translated_name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="cancel-btn" style="background: #f1f5f9; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; transition: background 0.2s; border: 1px solid #e2e8f0; white-space: nowrap;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Cancel</a>
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

            <div class="product-edit-layout" style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">

                <!-- Left Column: Image Upload -->
                <div>
                    <div class="product-edit-card" style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
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
                    <div class="product-edit-card" style="background: white; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">

                        <!-- Multi-Language Product Name -->
                        <div style="margin-bottom: 24px;">
                            <h4 style="font-weight: 800; color: #1e293b; font-size: 16px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                🌐 Product Name Translations
                            </h4>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇬🇧 English *</label>
                                    @php
                                        $nameArray = is_array($product->name) ? $product->name : json_decode($product->name, true);
                                        $englishName = $nameArray['en'] ?? ($nameArray ?? $product->name);
                                        $khmerName = is_array($product->name) ? ($product->name['km'] ?? '') : '';
                                        $chineseName = is_array($product->name) ? ($product->name['zh'] ?? '') : '';
                                    @endphp
                                    <input type="text" name="name_en" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('name_en', $englishName) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇰🇭 Khmer *</label>
                                    <input type="text" name="name_km" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('name_km', $khmerName) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇨🇳 Chinese *</label>
                                    <input type="text" name="name_zh" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('name_zh', $chineseName) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                </div>
                            </div>
                        </div>

                        <!-- Multi-Language Description -->
                        <div style="margin-bottom: 24px;">
                            <h4 style="font-weight: 800; color: #1e293b; font-size: 16px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                📝 Product Description (Optional)
                            </h4>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇬🇧 English</label>
                                    @php
                                        $descArray = $product->description;
                                        if (is_string($descArray)) {
                                            $decoded = json_decode($descArray, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                $descArray = $decoded;
                                            } else {
                                                $descArray = ['en' => $descArray, 'km' => '', 'zh' => ''];
                                            }
                                        }
                                        if (!is_array($descArray)) {
                                            $descArray = ['en' => '', 'km' => '', 'zh' => ''];
                                        }
                                        $enDesc = $descArray['en'] ?? '';
                                        $kmDesc = $descArray['km'] ?? '';
                                        $zhDesc = $descArray['zh'] ?? '';
                                    @endphp
                                    <textarea name="description_en" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box; resize: vertical;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description_en', $enDesc) }}</textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇰🇭 Khmer</label>
                                    <textarea name="description_km" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box; resize: vertical;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description_km', $kmDesc) }}</textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">🇨🇳 Chinese</label>
                                    <textarea name="description_zh" rows="4" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box; resize: vertical;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description_zh', $zhDesc) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Category *</label>
                            <select name="category_id" id="category-select" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="product-edit-spec-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('price', $product->price) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Discount %</label>
                                <input type="number" name="discount_percent" step="0.01" min="0" max="100" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Stock *</label>
                                <input type="number" name="stock" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" value="{{ old('stock', $product->stock) }}" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Unit *</label>
                                <select name="unit" id="unit-select" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                    <option value="">Select Category First</option>
                                </select>
                            </div>
                        </div>

                        <!-- Discount Settings -->
                        <div style="margin-bottom: 24px; padding: 16px; background: linear-gradient(to right, #fef3c7, #fde68a); border-radius: 12px; border: 1px solid #fcd34d;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                                <span style="font-size: 20px;">🏷️</span>
                                <h4 style="margin: 0; font-weight: 800; color: #78350f; font-size: 15px;">Discount & Sale Settings</h4>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                                <div>
                                    <label style="display: block; font-weight: 700; color: #78350f; margin-bottom: 6px; font-size: 13px;">Enable Sale</label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale ?? false) ? 'checked' : '' }} style="width: 16px; height: 16px; cursor: pointer;">
                                        <span style="color: #78350f; font-size: 13px;">Mark as on sale</span>
                                    </label>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #78350f; margin-bottom: 6px; font-size: 13px;">Sale Label</label>
                                    <input type="text" name="sale_label" value="{{ old('sale_label', $product->sale_label ?? '') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #fcd34d; border-radius: 8px; font-size: 13px; box-sizing: border-box;" placeholder="e.g., Flash Sale">
                                </div>
                                <div></div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #78350f; margin-bottom: 6px; font-size: 13px;">Discount Start</label>
                                    <input type="datetime-local" name="discount_start" value="{{ old('discount_start', $product->discount_start ? $product->discount_start->format('Y-m-d\TH:i') : '') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #fcd34d; border-radius: 8px; font-size: 13px; box-sizing: border-box;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 700; color: #78350f; margin-bottom: 6px; font-size: 13px;">Discount End</label>
                                    <input type="datetime-local" name="discount_end" value="{{ old('discount_end', $product->discount_end ? $product->discount_end->format('Y-m-d\TH:i') : '') }}" style="width: 100%; padding: 8px 12px; border: 1px solid #fcd34d; border-radius: 8px; font-size: 13px; box-sizing: border-box;">
                                </div>
                                <div style="display: flex; align-items: center;">
                                    <small style="color: #92400e; font-size: 11px;">💡 Leave empty for immediate start. Discount price auto-calculates.</small>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 32px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">SKU / Barcode</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="Scan barcode or leave blank to auto-generate">
                            <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">💡 Leave blank to auto-generate a unique code (e.g., PRD-X7B92M)</small>
                        </div>

                        <div class="product-edit-actions" style="display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 12px;">
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
