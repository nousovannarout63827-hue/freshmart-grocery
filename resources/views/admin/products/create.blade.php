@extends('layouts.admin')

@section('content')
<div style="padding: 30px 30px 30px 300px; box-sizing: border-box; max-width: 1400px; margin: 0 auto;">

    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0; font-size: 28px; font-weight: 900; color: #1e293b;">Add New Product</h1>
        <a href="{{ route('admin.products.index') }}" style="background: #f1f5f9; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; transition: background 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Back to Inventory</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
                
                <!-- Left Column: Image Upload -->
                <div>
                    <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 16px;">Product Images</h3>

                        <div class="image-upload-zone" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 30px; text-align: center; position: relative; background: #f8fafc; transition: all 0.3s ease; cursor: pointer;"
                             ondragover="this.style.borderColor='#10b981'; this.style.background='#f0fdf4'; return false;"
                             ondragleave="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'; return false;"
                             ondrop="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'; return false;">

                            <div style="pointer-events: none;">
                                <div style="font-size: 48px; margin-bottom: 10px; line-height: 1;">📷</div>
                                <p style="margin: 10px 0 5px; color: #475569; font-weight: 600; font-size: 14px;">Click or drag images here</p>
                                <p style="margin: 0; color: #94a3b8; font-size: 12px;">(Up to 4 images, max 2MB each)</p>
                            </div>

                            <input type="file" name="images[]" id="image-input" multiple accept="image/*" max="4"
                                   style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                        </div>

                        <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; min-height: 10px;"></div>
                    </div>
                </div>

                <!-- Right Column: Product Details -->
                <div>
                    <div style="background: white; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        
                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Product Name *</label>
                            <input type="text" name="name" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="e.g. Organic Carrots" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>

                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Category *</label>
                            <select name="category_id" id="category-select" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="0.00" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Stock Quantity *</label>
                                <input type="number" name="stock" min="0" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="0" required onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
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
                            <input type="text" name="sku" value="{{ old('sku') }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="Scan barcode or leave blank to auto-generate">
                            <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">💡 Leave blank to auto-generate a unique code (e.g., PRD-X7B92M)</small>
                        </div>

                        <div style="display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" style="background: #10b981; color: white; border: none; padding: 14px 32px; border-radius: 12px; font-weight: 800; font-size: 15px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.boxShadow='0 6px 15px rgba(5, 150, 105, 0.3)'" onmouseout="this.style.background='#10b981'; this.style.boxShadow='0 4px 10px rgba(16, 185, 129, 0.2)'">
                                Save Product
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
    // Multiple Image Preview Functions
    const imageInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('image-preview-container');
    let selectedFiles = [];

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            
            // Check total count (existing + new)
            if (selectedFiles.length + newFiles.length > 4) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Too many images!',
                    text: 'You can only upload a maximum of 4 images per product.',
                    confirmButtonColor: '#4f46e5'
                });
                // Clear the input but keep existing files
                imageInput.value = '';
                return;
            }
            
            // Add new files to our array
            selectedFiles = [...selectedFiles, ...newFiles];
            
            // Clear and rebuild previews
            renderPreviews();
        });
    }
    
    function renderPreviews() {
        previewContainer.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Create wrapper with remove button
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.width = '100px';
                imgWrapper.style.height = '100px';
                imgWrapper.style.borderRadius = '8px';
                imgWrapper.style.overflow = 'hidden';
                imgWrapper.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
                imgWrapper.style.border = '2px solid #e2e8f0';
                
                // Create the image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                
                // Create remove button
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '×';
                removeBtn.style.position = 'absolute';
                removeBtn.style.top = '2px';
                removeBtn.style.right = '2px';
                removeBtn.style.background = '#ef4444';
                removeBtn.style.color = 'white';
                removeBtn.style.border = 'none';
                removeBtn.style.borderRadius = '50%';
                removeBtn.style.width = '24px';
                removeBtn.style.height = '24px';
                removeBtn.style.cursor = 'pointer';
                removeBtn.style.fontSize = '16px';
                removeBtn.style.lineHeight = '1';
                removeBtn.style.display = 'flex';
                removeBtn.style.alignItems = 'center';
                removeBtn.style.justifyContent = 'center';
                removeBtn.onclick = function() { removeImage(index); };
                
                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                previewContainer.appendChild(imgWrapper);
            };
            
            reader.readAsDataURL(file);
        });
    }
    
    function removeImage(index) {
        selectedFiles.splice(index, 1);
        renderPreviews();
        
        // If all images removed, also clear the input
        if (selectedFiles.length === 0) {
            imageInput.value = '';
        }
    }

    // Unit Selection Logic
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category-select');
        const unitSelect = document.getElementById('unit-select');

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
                unitSelect.appendChild(option);
            });
        }

        // 3. Run the function whenever the category changes
        categorySelect.addEventListener('change', updateUnits);

        // 4. Run it once on page load just in case a category is already selected
        updateUnits();
    });
</script>
@endsection
