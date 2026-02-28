@extends('layouts.admin')

@section('content')
<div class="promotions-page" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div class="promotions-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; font-size: 28px; margin-bottom: 8px;">🎉 Promotions & Discounts</h2>
            <p style="color: #64748b; font-size: 14px;">Manage coupons, flash sales, and customer discounts</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.promotions.create') }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                ➕ Create Promotion
            </a>
            <button onclick="document.getElementById('flashSaleModal').style.display='flex'" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 12px 24px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(245, 158, 11, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)'">
                ⚡ Flash Sale
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Total Coupons</div>
            <div style="font-size: 28px; font-weight: 800;">{{ $stats['total'] }}</div>
        </div>
        <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Active</div>
            <div style="font-size: 28px; font-weight: 800;">{{ $stats['active'] }}</div>
        </div>
        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Expired/Inactive</div>
            <div style="font-size: 28px; font-weight: 800;">{{ $stats['expired'] }}</div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #059669; padding: 16px; border-radius: 12px; margin-bottom: 20px;">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #dc2626; padding: 16px; border-radius: 12px; margin-bottom: 20px;">⚠️ {{ session('error') }}</div>
    @endif

    <!-- Promotions Table -->
    <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #f1f5f9; background: #f8fafc;">
            <form action="{{ route('admin.promotions.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <input type="text" name="search" placeholder="Search code or name..." value="{{ request('search') }}" style="flex: 1; min-width: 200px; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                <select name="type" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: white;">
                    <option value="">All Types</option>
                    <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                    <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    <option value="free_delivery" {{ request('type') == 'free_delivery' ? 'selected' : '' }}>Free Delivery</option>
                </select>
                <select name="status" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: white;">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" style="background: #1e293b; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 700; border: none; cursor: pointer;">🔍 Search</button>
                <a href="{{ route('admin.promotions.index') }}" style="background: white; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; border: 1px solid #cbd5e1;">✕ Clear</a>
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                    <tr>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Code</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Name</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Type</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Value</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Min Purchase</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Expires</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                    <tr style="border-bottom: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 16px 24px;">
                            <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 700; font-size: 13px;">{{ $coupon->code }}</span>
                        </td>
                        <td style="padding: 16px 24px; font-weight: 600; color: #1e293b;">{{ $coupon->name }}</td>
                        <td style="padding: 16px 24px;">
                            <span style="font-size: 12px; color: #64748b;">{{ ucfirst($coupon->type) }}</span>
                        </td>
                        <td style="padding: 16px 24px; font-weight: 700; color: #10b981;">
                            @if($coupon->type === 'percentage')
                                {{ $coupon->value }}% OFF
                            @elseif($coupon->type === 'fixed')
                                ${{ $coupon->value }} OFF
                            @else
                                Free Delivery
                            @endif
                        </td>
                        <td style="padding: 16px 24px; font-size: 13px; color: #64748b;">
                            ${{ number_format($coupon->min_purchase ?? 0, 2) }}
                        </td>
                        <td style="padding: 16px 24px; font-size: 13px; color: #64748b;">
                            {{ $coupon->expires_at ? $coupon->expires_at->format('M d, Y') : 'No expiry' }}
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($coupon->status)
                                <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700;">ACTIVE</span>
                            @else
                                <span style="background: #f1f5f9; color: #64748b; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700;">INACTIVE</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <a href="{{ route('admin.promotions.edit', $coupon->id) }}" style="color: #3b82f6; text-decoration: none; font-weight: 600; font-size: 13px;">Edit</a>
                                <form action="{{ route('admin.promotions.destroy', $coupon->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this promotion?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600; font-size: 13px;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="padding: 40px; text-align: center; color: #64748b;">No promotions found. Create your first promotion!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($coupons->hasPages())
        <div style="padding: 20px; border-top: 1px solid #f1f5f9;">
            {{ $coupons->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Flash Sale Modal -->
<div id="flashSaleModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 16px; padding: 32px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 24px;">
            <h3 style="margin: 0; font-weight: 800; color: #1e293b; font-size: 20px;">⚡ Create Flash Sale</h3>
            <button onclick="document.getElementById('flashSaleModal').style.display='none'" style="background: none; border: none; font-size: 24px; color: #64748b; cursor: pointer;">✕</button>
        </div>

        <form action="{{ route('admin.promotions.flash-sale') }}" method="POST">
            @csrf
            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Sale Name</label>
                    <input type="text" name="name" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Discount Percentage (%)</label>
                    <input type="number" name="discount_percent" required min="1" max="100" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Duration (hours)</label>
                    <input type="number" name="duration_hours" required min="1" max="168" value="24" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Apply To</label>
                    <select name="scope" id="flashScope" onchange="toggleFlashScope()" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <option value="all_products">All Products</option>
                        <option value="specific_products">Specific Products</option>
                        <option value="specific_categories">Specific Categories</option>
                    </select>
                </div>
                <div id="flashProducts" style="display: none;">
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Select Products</label>
                    <select name="product_ids[]" multiple style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; min-height: 150px;">
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->translated_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="flashCategories" style="display: none;">
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Select Categories</label>
                    <select name="category_ids[]" multiple style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; min-height: 150px;">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px;">
                <button type="button" onclick="document.getElementById('flashSaleModal').style.display='none'" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 8px; font-weight: 700; border: none; cursor: pointer;">Cancel</button>
                <button type="submit" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 12px 24px; border-radius: 8px; font-weight: 700; border: none; cursor: pointer;">🚀 Launch Flash Sale</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFlashScope() {
    const scope = document.getElementById('flashScope').value;
    document.getElementById('flashProducts').style.display = scope === 'specific_products' ? 'block' : 'none';
    document.getElementById('flashCategories').style.display = scope === 'specific_categories' ? 'block' : 'none';
}
</script>
@endsection
