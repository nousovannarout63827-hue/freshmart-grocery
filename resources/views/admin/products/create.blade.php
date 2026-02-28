@extends('layouts.admin')

@section('content')
<style>
.product-create-page {
    padding: 30px;
    box-sizing: border-box;
    max-width: 1400px;
    margin: 0 auto;
}

@media (max-width: 1024px) {
    .product-create-page {
        padding: 16px !important;
        max-width: 100% !important;
    }

    .product-create-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 12px !important;
    }

    .product-create-layout {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }

    .product-create-details-card,
    .product-create-image-card {
        padding: 20px !important;
    }
}

@media (max-width: 768px) {
    .product-create-page {
        padding: 12px !important;
    }

    .product-create-header {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 12px !important;
        flex-wrap: nowrap !important;
        order: -1 !important;
    }

    .product-create-header h1 {
        font-size: 20px !important;
        line-height: 1.3 !important;
        width: 100% !important;
        min-width: auto !important;
        flex: none !important;
        order: 1 !important;
    }

    .product-create-back {
        width: 100%;
        box-sizing: border-box;
        justify-content: center;
        text-align: center;
        padding: 10px 16px !important;
        font-size: 13px !important;
        order: 2 !important;
    }

    .product-create-spec-grid {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }

    .product-create-actions {
        flex-direction: column !important;
        gap: 10px !important;
    }

    .product-create-actions button,
    .product-create-actions a {
        width: 100% !important;
        box-sizing: border-box;
        justify-content: center !important;
    }

    .image-upload-zone {
        padding: 16px !important;
    }

    #image-preview-container {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
    }

    .preview-image-wrapper {
        aspect-ratio: 1 !important;
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

    .page-header {
        margin-bottom: 20px !important;
    }
}

@media (max-width: 375px) {
    .product-create-page {
        padding: 10px !important;
    }

    .product-create-details-card,
    .product-create-image-card {
        padding: 16px !important;
    }

    .product-create-header h1 {
        font-size: 18px !important;
    }

    #image-preview-container {
        grid-template-columns: 1fr !important;
    }
}
</style>
<div class="product-create-page">

    <div class="page-header product-create-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 12px;">
        <h1 style="margin: 0; font-size: 28px; font-weight: 900; color: #1e293b; flex: 1; min-width: 200px;">Add New Product</h1>
        <a href="{{ route('admin.products.index') }}" class="product-create-back" style="background: #f1f5f9; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; transition: background 0.2s; border: 1px solid #e2e8f0; white-space: nowrap;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Back to Inventory</a>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="product-create-layout" style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
                
                <!-- Left Column: Image Upload -->
                <div>
                    <div class="product-create-image-card" style="background: white; padding: 24px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
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

                        <div id="image-preview-container" class="image-preview-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 10px; margin-top: 20px; min-height: 10px;"></div>
                    </div>
                </div>

                <!-- Right Column: Product Details -->
                <div>
                    <div class="product-create-details-card" style="background: white; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                        
                        <!-- Multi-Language Product Name Grid -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                            <div class="mb-5 border-b border-slate-100 pb-4">
                                <h3 class="text-lg font-bold text-slate-800">Product Name Translations</h3>
                                <p class="text-sm text-slate-500">Enter the product name in all supported languages.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇬🇧 English <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name_en" 
                                        value="{{ old('name_en') }}"
                                        placeholder="e.g., Fresh Salmon" 
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name_en') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" 
                                        required
                                    >
                                    @error('name_en')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇰🇭 Khmer <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name_km" 
                                        value="{{ old('name_km') }}"
                                        placeholder="ឧទាហរណ៍៖ ត្រីសាម៉ុងស្រស់" 
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name_km') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-khmer" 
                                        required
                                    >
                                    @error('name_km')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇨🇳 Chinese <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name_zh" 
                                        value="{{ old('name_zh') }}"
                                        placeholder="例如：新鲜三文鱼" 
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name_zh') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" 
                                        required
                                    >
                                    @error('name_zh')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Multi-Language Description Grid -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                            <div class="mb-5 border-b border-slate-100 pb-4">
                                <h3 class="text-lg font-bold text-slate-800">Product Description Translations</h3>
                                <p class="text-sm text-slate-500">Optional: Add descriptions in each language for better SEO.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇬🇧 English
                                    </label>
                                    <textarea
                                        name="description_en"
                                        rows="4"
                                        placeholder="Describe the product in English..."
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description_en') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans resize-y"
                                    >{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇰🇭 Khmer
                                    </label>
                                    <textarea
                                        name="description_km"
                                        rows="4"
                                        placeholder="ពិពណ៌នាអំពីផលិតផលជាភាសាខ្មែរ..."
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description_km') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-khmer resize-y"
                                    >{{ old('description_km') }}</textarea>
                                    @error('description_km')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2 flex items-center gap-2">
                                        🇨🇳 Chinese
                                    </label>
                                    <textarea
                                        name="description_zh"
                                        rows="4"
                                        placeholder="用中文描述产品..."
                                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('description_zh') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans resize-y"
                                    >{{ old('description_zh') }}</textarea>
                                    @error('description_zh')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                            <div class="mb-5 border-b border-slate-100 pb-4">
                                <h3 class="text-lg font-bold text-slate-800">Product Details</h3>
                                <p class="text-sm text-slate-500">Essential product information for inventory management.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Category *</label>
                                    <select name="category_id" id="category-select" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('category_id') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" required>
                                        <option value="">Select a Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Unit (Sold By) *</label>
                                    <select name="unit" id="unit-select" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('unit') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" required>
                                        <option value="">Select Category First</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                            <div class="mb-5 border-b border-slate-100 pb-4">
                                <h3 class="text-lg font-bold text-slate-800">Pricing & Inventory</h3>
                                <p class="text-sm text-slate-500">Set your product price and stock levels.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Price ($) *</label>
                                    <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('price') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" placeholder="0.00" required>
                                    @error('price')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Discount Percent (%)</label>
                                    <input type="number" name="discount_percent" step="0.01" min="0" max="100" value="{{ old('discount_percent', 0) }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('discount_percent') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" placeholder="0">
                                    <small class="text-slate-500 text-xs mt-1 block">Enter 0 for no discount</small>
                                    @error('discount_percent')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Stock Quantity *</label>
                                    <input type="number" name="stock" min="0" value="{{ old('stock') }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('stock') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" placeholder="0" required>
                                    @error('stock')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Discount Settings -->
                            <div class="mt-6 p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl border border-amber-200">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="text-xl">🏷️</span>
                                    <h4 class="font-bold text-slate-800">Discount & Sale Settings</h4>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Enable Sale</label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale') ? 'checked' : '' }} class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            <span class="text-sm text-slate-700">Mark as on sale</span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Sale Label</label>
                                        <input type="text" name="sale_label" value="{{ old('sale_label') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm" placeholder="e.g., Flash Sale, 50% OFF">
                                    </div>
                                    <div></div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Discount Start Date</label>
                                        <input type="datetime-local" name="discount_start" value="{{ old('discount_start') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Discount End Date</label>
                                        <input type="datetime-local" name="discount_end" value="{{ old('discount_end') }}" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                    </div>
                                    <div class="flex items-end">
                                        <div class="text-xs text-slate-600">
                                            <p>💡 Leave dates empty for immediate start</p>
                                            <p>Discount price auto-calculates</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
                            <div class="mb-5 border-b border-slate-100 pb-4">
                                <h3 class="text-lg font-bold text-slate-800">Product Identification</h3>
                                <p class="text-sm text-slate-500">SKU and barcode for inventory tracking.</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">SKU / Barcode</label>
                                <input type="text" name="sku" value="{{ old('sku') }}" class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('sku') ? 'border-red-500 bg-red-50 ring-2 ring-red-200' : 'border-slate-200 bg-slate-50' }} focus:ring-purple-500 focus:border-purple-500 transition-colors font-sans" placeholder="Scan barcode or leave blank to auto-generate">
                                @error('sku')
                                    <p class="text-red-500 text-xs mt-1.5 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <small class="text-slate-500 text-xs mt-2 block">💡 Leave blank to auto-generate a unique code (e.g., PRD-X7B92M)</small>
                            </div>
                        </div>

                        <div class="product-create-actions" style="display: flex; justify-content: flex-end; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="submit" class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
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

