@extends('layouts.admin')

@section('content')
<style>
.product-edit-page {
    padding: 24px;
    max-width: 1400px;
    margin: 0 auto;
}

.product-edit-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 24px;
    align-items: start;
}

@media (max-width: 1200px) {
    .product-edit-grid {
        grid-template-columns: 280px 1fr;
        gap: 20px;
    }
}

@media (max-width: 1024px) {
    .product-edit-grid {
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
    .product-edit-page {
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

<div class="product-edit-page">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #1e293b;">
                ✏️ Edit Product
            </h1>
            <p style="margin: 4px 0 0; font-size: 14px; color: #64748b;">Update product information and settings</p>
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

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="product-edit-grid">
            <!-- Left Column: Image Upload (Sticky) -->
            <div class="image-card" style="position: sticky; top: 20px;">
                <div style="background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <h3 style="margin: 0 0 16px; font-weight: 700; color: #1e293b; font-size: 16px;">📷 Product Images</h3>
                    
                    <!-- Existing Images -->
                    @if($product->productImages && $product->productImages->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-bottom: 16px;">
                            @foreach($product->productImages as $image)
                                <div style="position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; border: 2px solid #e2e8f0;">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    <button type="button" onclick="deleteImage({{ $image->id }})" style="position: absolute; top: 4px; right: 4px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; font-size: 14px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">×</button>
                                </div>
                            @endforeach
                        </div>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 12px; text-align: center;">
                            💡 Click <strong style="color: #ef4444;">×</strong> to delete. Add {{ 4 - $product->productImages->count() }} more images.
                        </p>
                    @endif
                    
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
                        @php
                            $nameArray = is_array($product->name) ? $product->name : json_decode($product->name, true);
                            $englishName = $nameArray['en'] ?? ($nameArray ?? $product->name);
                            $khmerName = is_array($product->name) ? ($product->name['km'] ?? '') : '';
                            $chineseName = is_array($product->name) ? ($product->name['zh'] ?? '') : '';
                        @endphp
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇬🇧 English *</label>
                                <input type="text" name="name_en" value="{{ old('name_en', $englishName) }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="e.g., Fresh Salmon">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇰🇭 Khmer *</label>
                                <input type="text" name="name_km" value="{{ old('name_km', $khmerName) }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="ឧទាហរណ៍៖ ត្រីសាម៉ុងស្រស់">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇨🇳 Chinese *</label>
                                <input type="text" name="name_zh" value="{{ old('name_zh', $chineseName) }}" required
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
                        @php
                            $descArray = is_array($product->description) ? $product->description : json_decode($product->description, true);
                            $enDesc = $descArray['en'] ?? '';
                            $kmDesc = $descArray['km'] ?? '';
                            $zhDesc = $descArray['zh'] ?? '';
                        @endphp
                        <div class="form-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇬🇧 English</label>
                                <textarea name="description_en" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="Describe in English...">{{ old('description_en', $enDesc) }}</textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇰🇭 Khmer</label>
                                <textarea name="description_km" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="ពិពណ៌នាជាភាសាខ្មែរ...">{{ old('description_km', $kmDesc) }}</textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">🇨🇳 Chinese</label>
                                <textarea name="description_zh" rows="3"
                                          style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; resize: vertical; box-sizing: border-box;"
                                          onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                          onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                          placeholder="用中文描述...">{{ old('description_zh', $zhDesc) }}</textarea>
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
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required
                                       style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s; box-sizing: border-box;"
                                       onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"
                                       placeholder="0.00">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">Stock Quantity *</label>
                                <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required
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
                                    <option value="piece" {{ old('unit', $product->unit) == 'piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                                    <option value="g" {{ old('unit', $product->unit) == 'g' ? 'selected' : '' }}>Gram (g)</option>
                                    <option value="lb" {{ old('unit', $product->unit) == 'lb' ? 'selected' : '' }}>Pound (lb)</option>
                                    <option value="box" {{ old('unit', $product->unit) == 'box' ? 'selected' : '' }}>Box</option>
                                    <option value="pack" {{ old('unit', $product->unit) == 'pack' ? 'selected' : '' }}>Pack</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 13px;">SKU / Barcode</label>
                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
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
                                <input type="number" name="discount_percent" step="0.01" min="0" max="100" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;"
                                       placeholder="0">
                            </div>
                            <div>
                                <label style="display: flex; align-items: center; gap: 6px; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px; cursor: pointer;">
                                    <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale ?? false) ? 'checked' : '' }}
                                           style="width: 16px; height: 16px; cursor: pointer;">
                                    Enable Sale
                                </label>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">Sale Label</label>
                                <input type="text" name="sale_label" value="{{ old('sale_label', $product->sale_label ?? '') }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;"
                                       placeholder="e.g., Flash Sale">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">Start Date</label>
                                <input type="datetime-local" name="discount_start" value="{{ old('discount_start', $product->discount_start ? $product->discount_start->format('Y-m-d\TH:i') : '') }}"
                                       style="width: 100%; padding: 8px 10px; border: 1px solid #fcd34d; border-radius: 6px; font-size: 13px; outline: none; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; color: #78350f; margin-bottom: 6px; font-size: 12px;">End Date</label>
                                <input type="datetime-local" name="discount_end" value="{{ old('discount_end', $product->discount_end ? $product->discount_end->format('Y-m-d\TH:i') : '') }}"
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
                            ✅ Update Product
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

// Delete existing image via AJAX
function deleteImage(imageId) {
    if (!confirm('Delete this image?')) return;
    
    fetch(`/admin/products/images/${imageId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Failed to delete image: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error deleting image: ' + error);
    });
}
</script>
@endsection
