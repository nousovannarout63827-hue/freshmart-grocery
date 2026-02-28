@extends('layouts.admin')

@section('content')
<style>
.product-create-page {
    padding: 24px;
    max-width: 1400px;
    margin: 0 auto;
}

.product-create-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 24px;
    align-items: start;
}

@media (max-width: 1200px) {
    .product-create-grid {
        grid-template-columns: 280px 1fr;
        gap: 20px;
    }
}

@media (max-width: 1024px) {
    .product-create-grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
    
    .image-card {
        position: sticky !important;
        top: 20px !important;
        z-index: 10;
    }
}

@media (max-width: 768px) {
    .product-create-page {
        padding: 16px !important;
    }
    
    .page-header {
        flex-direction: column !important;
        gap: 12px !important;
        align-items: stretch !important;
    }
    
    .page-header h1 {
        font-size: 20px !important;
    }
    
    .back-btn {
        width: 100% !important;
        justify-content: center !important;
    }
    
    .form-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
    
    .action-buttons {
        flex-direction: column !important;
        gap: 10px !important;
    }
    
    .action-buttons button,
    .action-buttons a {
        width: 100% !important;
    }
}
</style>

<div class="product-create-page">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #1e293b;">
                ➕ Add New Product
            </h1>
            <p style="margin: 4px 0 0; font-size: 14px; color: #64748b;">Create a new product with multi-language support</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="back-btn" style="background: #f1f5f9; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.2s; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#e2e8f0'; this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#f1f5f9'; this.style.transform='translateY(0)'">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Inventory
        </a>
    </div>

    @if ($errors->any())
        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <svg style="width: 20px; height: 20px; color: #ef4444; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div style="flex: 1;">
                    <h3 style="margin: 0 0 8px; font-size: 14px; font-weight: 700; color: #dc2626;">Please correct the following errors:</h3>
                    <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #dc2626;">
                        @foreach ($errors->all() as $error)
                            <li style="margin-bottom: 4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="product-create-grid">
            <!-- Left Column: Image Upload (Sticky) -->
            <div class="image-card" style="position: sticky; top: 20px;">
                <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <h3 style="margin: 0 0 16px; font-weight: 700; color: #1e293b; font-size: 16px;">📷 Product Images</h3>
                    
                    <!-- Upload Zone -->
                    <div style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; background: #f8fafc; transition: all 0.3s; cursor: pointer; position: relative;"
                         ondragover="this.style.borderColor='#10b981'; this.style.background='#f0fdf4'"
                         ondragleave="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'"
                         ondrop="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'">
                        
                        <div style="pointer-events: none;">
                            <div style="font-size: 40px; margin-bottom: 8px;">📷</div>
                            <p style="margin: 0 0 4px; color: #475569; font-weight: 600; font-size: 13px;">Click or drag images here</p>
                            <p style="margin: 0; color: #94a3b8; font-size: 11px;">Up to 4 images, max 2MB each</p>
                        </div>
                        
                        <input type="file" name="images[]" id="image-input" multiple accept="image/*" max="4"
                               style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                    </div>
                    
                    <!-- Preview Container -->
                    <div id="image-preview-container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 16px;"></div>
                </div>
            </div>

            <!-- Right Column: Product Details -->
            <div>
                <div style="background: white; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    
                    <!-- Multi-Language Names -->
                    <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                        <h3 style="margin: 0 0 16px; font-weight: 700; color: #1e293b; font-size: 16px;">🌐 Product Name Translations</h3>
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇬🇧 English *</label>
                                <input type="text" name="name_en" value="{{ old('name_en') }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="e.g., Fresh Salmon">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇰🇭 Khmer *</label>
                                <input type="text" name="name_km" value="{{ old('name_km') }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="ឧទាហរណ៍៖ ត្រីសាម៉ុងស្រស់">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇨🇳 Chinese *</label>
                                <input type="text" name="name_zh" value="{{ old('name_zh') }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="例如：新鲜三文鱼">
                            </div>
                        </div>
                    </div>

                    <!-- Multi-Language Descriptions -->
                    <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                        <h3 style="margin: 0 0 16px; font-weight: 700; color: #1e293b; font-size: 16px;">📝 Product Descriptions (Optional)</h3>
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇬🇧 English</label>
                                <textarea name="description_en" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="Describe in English...">{{ old('description_en') }}</textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇰🇭 Khmer</label>
                                <textarea name="description_km" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="ពិពណ៌នាជាភាសាខ្មែរ...">{{ old('description_km') }}</textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇨🇳 Chinese</label>
                                <textarea name="description_zh" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="用中文描述...">{{ old('description_zh') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Category & Basic Info -->
                    <div style="margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid #f1f5f9;">
                        <h3 style="margin: 0 0 16px; font-weight: 700; color: #1e293b; font-size: 16px;">📋 Basic Information</h3>
                        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div style="grid-column: 1 / -1;">
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Category *</label>
                                <select name="category_id" required
                                        style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; transition: all 0.2s; box-sizing: border-box;"
                                        onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                        onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="0.00">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Stock Quantity *</label>
                                <input type="number" name="stock" min="0" value="{{ old('stock') }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="0">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Unit *</label>
                                <select name="unit" required
                                        style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; transition: all 0.2s; box-sizing: border-box;"
                                        onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                        onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                                    <option value="">Select Unit</option>
                                    <option value="piece" {{ old('unit') == 'piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="g" {{ old('unit') == 'g' ? 'selected' : '' }}>Gram (g)</option>
                                    <option value="lb" {{ old('unit') == 'lb' ? 'selected' : '' }}>Pound (lb)</option>
                                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="pack" {{ old('unit') == 'pack' ? 'selected' : '' }}>Pack</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">SKU / Barcode</label>
                                <input type="text" name="sku" value="{{ old('sku') }}"
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="Leave blank to auto-generate">
                            </div>
                        </div>
                    </div>

                    <!-- Discount Settings -->
                    <div style="margin-bottom: 24px; padding: 16px; background: linear-gradient(to right, #fef3c7, #fde68a); border-radius: 10px; border: 1px solid #fcd34d;">
                        <h3 style="margin: 0 0 16px; font-weight: 700; color: #78350f; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                            🏷️ Discount & Sale Settings
                        </h3>
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">Discount Percent (%)</label>
                                <input type="number" name="discount_percent" step="0.01" min="0" max="100" value="{{ old('discount_percent', 0) }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;"
                                       placeholder="0">
                            </div>
                            <div>
                                <label style="display: flex; align-items: center; gap: 6px; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px; cursor: pointer;">
                                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale') ? 'checked' : '' }}
                                           style="width: 16px; height: 16px; cursor: pointer;">
                                    Enable Sale
                                </label>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">Sale Label</label>
                                <input type="text" name="sale_label" value="{{ old('sale_label') }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;"
                                       placeholder="e.g., Flash Sale">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">Start Date</label>
                                <input type="datetime-local" name="discount_start" value="{{ old('discount_start') }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">End Date</label>
                                <input type="datetime-local" name="discount_end" value="{{ old('discount_end') }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;">
                            </div>
                            <div style="display: flex; align-items: center; font-size: 11px; color: #92400e;">
                                💡 Leave dates empty for immediate start
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons" style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                        <a href="{{ route('admin.products.index') }}" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.2s; border: 1px solid #e2e8f0;"
                           onmouseover="this.style.background='#e2e8f0'; this.style.transform='translateY(-1px)'"
                           onmouseout="this.style.background='#f1f5f9'; this.style.transform='translateY(0)'">
                            Cancel
                        </a>
                        <button type="submit" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 12px 32px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.4)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                            ✅ Save Product
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Image preview functionality
const imageInput = document.getElementById('image-input');
const previewContainer = document.getElementById('image-preview-container');
let selectedFiles = [];

if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files);
        
        if (selectedFiles.length + newFiles.length > 4) {
            alert('You can only upload a maximum of 4 images.');
            return;
        }
        
        selectedFiles = [...selectedFiles, ...newFiles];
        updatePreview();
    });
}

function updatePreview() {
    previewContainer.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.style.cssText = 'position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0;';
            div.innerHTML = `
                <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                <button type="button" onclick="removeImage(${index})" style="position: absolute; top: 4px; right: 4px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-size: 14px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">×</button>
            `;
            previewContainer.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeImage(index) {
    selectedFiles.splice(index, 1);
    updatePreview();
}
</script>
@endsection
