@extends('layouts.admin')

@section('content')
<div class="promotion-edit-page" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; font-size: 28px; margin-bottom: 8px;">✏️ Edit Promotion</h2>
            <p style="color: #64748b; font-size: 14px;">Update coupon or discount settings</p>
        </div>
        <a href="{{ route('admin.promotions.index') }}" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Back to Promotions</a>
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

    <form action="{{ route('admin.promotions.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">

            <!-- Main Settings -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    📋 Basic Information
                </h3>

                <div style="display: grid; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Coupon Code *</label>
                        <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="e.g., SUMMER20, WELCOME10" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">💡 Use uppercase letters and numbers for easy recall</small>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Promotion Name *</label>
                        <input type="text" name="name" value="{{ old('name', $coupon->name) }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="e.g., Summer Sale 2024, Welcome Discount" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Description</label>
                        <textarea name="description" rows="3" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box; resize: vertical;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description', $coupon->description) }}</textarea>
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Optional: Describe what this promotion is for</small>
                    </div>
                </div>
            </div>

            <!-- Type & Value -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    💰 Discount Type & Value
                </h3>

                <div style="display: grid; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Discount Type *</label>
                        <select name="type" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" onchange="updateTypeLabel()" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }} {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                            <option value="free_delivery" {{ old('type', $coupon->type) == 'free_delivery' ? 'selected' : '' }}>Free Delivery</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Discount Value *</label>
                        <input type="number" name="value" step="0.01" min="0" value="{{ old('value', $coupon->value) }}" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="20" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        <small id="value-label" style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Enter percentage (e.g., 20 for 20%)</small>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
            <!-- Target Audience -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    🎯 Target Audience
                </h3>

                <div style="display: grid; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Available To *</label>
                        <select name="target_type" id="target-type" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" onchange="toggleCustomerSelect()" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            <option value="all_customers" {{ old('target_type', $coupon->target_type) == 'all_customers' ? 'selected' : '' }}>All Customers</option>
                            <option value="specific_customers" {{ old('target_type', $coupon->target_type) == 'specific_customers' ? 'selected' : '' }}>Specific Customers</option>
                        </select>
                    </div>

                    <div id="customer-select-div" style="display: {{ old('target_type', $coupon->target_type) == 'specific_customers' ? 'block' : 'none' }};">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Select Customers</label>
                        <select name="customer_ids[]" multiple style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 13px; outline: none; background: white; box-sizing: border-box; min-height: 200px;">
                            @foreach(\App\Models\User::where('role', 'customer')->get() as $customer)
                                <option value="{{ $customer->id }}" {{ in_array($customer->id, old('customer_ids', $coupon->customer_ids ?? [])) ? 'selected' : '' }}>{{ $customer->name }} ({{ $customer->email }})</option>
                            @endforeach
                        </select>
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Hold Ctrl/Cmd to select multiple</small>
                    </div>
                </div>
            </div>

            <!-- Product Scope -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    🛍️ Applicable Products
                </h3>

                <div style="display: grid; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Apply To *</label>
                        <select name="scope" id="scope" required style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; background: white; cursor: pointer; box-sizing: border-box;" onchange="toggleScopeSelect()" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                            <option value="all_products" {{ old('scope', $coupon->scope) == 'all_products' ? 'selected' : '' }}>All Products</option>
                            <option value="specific_products" {{ old('scope', $coupon->scope) == 'specific_products' ? 'selected' : '' }}>Specific Products</option>
                            <option value="specific_categories" {{ old('scope', $coupon->scope) == 'specific_categories' ? 'selected' : '' }}>Specific Categories</option>
                        </select>
                    </div>

                    <div id="product-select-div" style="display: {{ old('scope', $coupon->scope) == 'specific_products' ? 'block' : 'none' }};">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Select Products</label>
                        <select name="product_ids[]" multiple style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 13px; outline: none; background: white; box-sizing: border-box; min-height: 200px;">
                            @foreach(\App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}" {{ in_array($product->id, old('product_ids', $coupon->product_ids ?? [])) ? 'selected' : '' }}>{{ $product->translated_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="category-select-div" style="display: {{ old('scope', $coupon->scope) == 'specific_categories' ? 'block' : 'none' }};">
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Select Categories</label>
                        <select name="category_ids[]" multiple style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 13px; outline: none; background: white; box-sizing: border-box; min-height: 200px;">
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('category_ids', $coupon->category_ids ?? [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
            <!-- Validity Period -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    📅 Validity Period
                </h3>

                <div style="display: grid; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Valid From</label>
                        <input type="datetime-local" name="valid_from" value="{{ old('valid_from', $coupon->valid_from ? $coupon->valid_from->format('Y-m-d\TH:i') : '') }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Leave empty for immediate start</small>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Valid Until</label>
                        <input type="datetime-local" name="valid_until" value="{{ old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d\TH:i') : ($coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '')) }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Leave empty for no expiry</small>
                    </div>
                </div>
            </div>

            <!-- Conditions -->
            <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    ⚖️ Conditions
                </h3>

                <div style="display: grid; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 14px;">Minimum Purchase Amount ($)</label>
                        <input type="number" name="min_purchase_amount" step="0.01" min="0" value="{{ old('min_purchase_amount', $coupon->min_purchase ?? 0) }}" style="width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.2s; box-sizing: border-box;" placeholder="0.00" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#e2e8f0'">
                        <small style="color: #64748b; font-size: 12px; margin-top: 6px; display: block;">Minimum order total to use this coupon</small>
                    </div>

                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 10px;">
                        <input type="checkbox" name="status" id="status" value="1" {{ old('status', $coupon->status) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                        <label for="status" style="font-weight: 700; color: #475569; font-size: 14px; cursor: pointer;">Active (Enable immediately)</label>
                    </div>

                    <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8fafc; border-radius: 10px;">
                        <input type="checkbox" name="auto_apply" id="auto_apply" value="1" {{ old('auto_apply', $coupon->auto_apply) ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                        <label for="auto_apply" style="font-weight: 700; color: #475569; font-size: 14px; cursor: pointer;">Auto-apply for eligible customers</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px; padding-top: 24px; border-top: 1px solid #e2e8f0;">
            <a href="{{ route('admin.promotions.index') }}" style="background: #f1f5f9; color: #475569; padding: 14px 32px; border-radius: 12px; font-weight: 700; font-size: 15px; text-decoration: none; border: 1px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Cancel</a>
            <button type="submit" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 14px 32px; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                💾 Save Changes
            </button>
        </div>
    </form>
</div>

<script>
function updateTypeLabel() {
    const type = document.querySelector('select[name="type"]').value;
    const label = document.getElementById('value-label');
    if (type === 'percentage') {
        label.textContent = 'Enter percentage (e.g., 20 for 20%)';
    } else if (type === 'fixed') {
        label.textContent = 'Enter amount in dollars (e.g., 10 for $10 off)';
    } else {
        label.textContent = 'Free delivery discount';
    }
}

function toggleCustomerSelect() {
    const targetType = document.getElementById('target-type').value;
    document.getElementById('customer-select-div').style.display = targetType === 'specific_customers' ? 'block' : 'none';
}

function toggleScopeSelect() {
    const scope = document.getElementById('scope').value;
    document.getElementById('product-select-div').style.display = scope === 'specific_products' ? 'block' : 'none';
    document.getElementById('category-select-div').style.display = scope === 'specific_categories' ? 'block' : 'none';
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateTypeLabel();
    toggleCustomerSelect();
    toggleScopeSelect();
});
</script>
@endsection
