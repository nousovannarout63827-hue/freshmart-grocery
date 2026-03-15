@extends('layouts.admin')

@section('content')
<div class="promotion-show-page" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; font-size: 28px; margin-bottom: 8px;">🎫 Promotion Details</h2>
            <p style="color: #64748b; font-size: 14px;">View coupon information and settings</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.promotions.index') }}" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">← Back to Promotions</a>
            <a href="{{ route('admin.promotions.edit', $coupon->id) }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">✏️ Edit</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        <!-- Main Info -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                📋 Basic Information
            </h3>

            <div style="display: grid; gap: 20px;">
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Coupon Code</label>
                    <div style="background: #dbeafe; color: #1e40af; padding: 14px 18px; border-radius: 10px; font-weight: 800; font-size: 18px; letter-spacing: 2px; font-family: monospace;">{{ $coupon->code }}</div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Promotion Name</label>
                    <div style="color: #1e293b; font-size: 16px; font-weight: 600;">{{ $coupon->name ?? 'N/A' }}</div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Description</label>
                    <div style="color: #475569; font-size: 14px; line-height: 1.6;">{{ $coupon->description ?? 'No description provided' }}</div>
                </div>
            </div>
        </div>

        <!-- Discount Info -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                💰 Discount Details
            </h3>

            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Type</label>
                    <div style="color: #1e293b; font-size: 15px; font-weight: 600;">{{ ucfirst(str_replace('percent', 'percentage', $coupon->type)) }}</div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Value</label>
                    <div style="color: #10b981; font-size: 24px; font-weight: 800;">
                        @if($coupon->type === 'percentage')
                            {{ $coupon->value }}% OFF
                        @elseif($coupon->type === 'fixed')
                            ${{ number_format($coupon->value, 2) }} OFF
                        @else
                            FREE DELIVERY
                        @endif
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Minimum Purchase</label>
                    <div style="color: #475569; font-size: 15px;">${{ number_format($coupon->min_purchase ?? 0, 2) }}</div>
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
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Available To</label>
                    <div style="color: #1e293b; font-size: 15px; font-weight: 600;">
                        {{ ucfirst(str_replace('_', ' ', $coupon->target_type ?? 'all_customers')) }}
                    </div>
                </div>

                @if($coupon->target_type === 'specific_customers' && !empty($coupon->customer_ids))
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Selected Customers</label>
                    <div style="color: #475569; font-size: 14px;">
                        {{ is_array($coupon->customer_ids) ? count($coupon->customer_ids) : count(json_decode($coupon->customer_ids, true) ?? []) }} customers
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Product Scope -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                🛍️ Applicable Products
            </h3>

            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Scope</label>
                    <div style="color: #1e293b; font-size: 15px; font-weight: 600;">
                        {{ ucfirst(str_replace('_', ' ', $coupon->scope ?? 'all_products')) }}
                    </div>
                </div>

                @if($coupon->scope === 'specific_products' && !empty($coupon->product_ids))
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Selected Products</label>
                    <div style="color: #475569; font-size: 14px;">
                        {{ is_array($coupon->product_ids) ? count($coupon->product_ids) : count(json_decode($coupon->product_ids, true) ?? []) }} products
                    </div>
                </div>
                @endif

                @if($coupon->scope === 'specific_categories' && !empty($coupon->category_ids))
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Selected Categories</label>
                    <div style="color: #475569; font-size: 14px;">
                        {{ is_array($coupon->category_ids) ? count($coupon->category_ids) : count(json_decode($coupon->category_ids, true) ?? []) }} categories
                    </div>
                </div>
                @endif
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
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Valid From</label>
                    <div style="color: #475569; font-size: 15px;">
                        {{ $coupon->valid_from ? $coupon->valid_from->format('M d, Y g:i A') : 'Immediate' }}
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Valid Until</label>
                    <div style="color: #475569; font-size: 15px;">
                        {{ $coupon->valid_until ? $coupon->valid_until->format('M d, Y g:i A') : ($coupon->expires_at ? $coupon->expires_at->format('M d, Y g:i A') : 'No expiry') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Settings -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                ⚙️ Status & Settings
            </h3>

            <div style="display: grid; gap: 16px;">
                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Status</label>
                    <div style="display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 700; {{ $coupon->status ? 'background: #d1fae5; color: #059669;' : 'background: #fee2e2; color: #dc2626;' }}">
                        {{ $coupon->status ? '✓ Active' : '✗ Inactive' }}
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Auto-apply</label>
                    <div style="color: #475569; font-size: 15px;">
                        {{ $coupon->auto_apply ? '✓ Enabled' : '✗ Disabled' }}
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Usage Limit</label>
                    <div style="color: #475569; font-size: 15px;">
                        {{ $coupon->usage_limit > 0 ? $coupon->usage_count . ' / ' . $coupon->usage_limit . ' uses' : 'Unlimited' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Meta Info -->
    <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 24px;">
        <h3 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
            📝 Additional Information
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Created By</label>
                <div style="color: #475569; font-size: 14px;">{{ $coupon->creator ? $coupon->creator->name : 'System' }}</div>
            </div>

            <div>
                <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Created At</label>
                <div style="color: #475569; font-size: 14px;">{{ $coupon->created_at->format('M d, Y g:i A') }}</div>
            </div>

            <div>
                <label style="display: block; font-weight: 700; color: #64748b; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Last Updated</label>
                <div style="color: #475569; font-size: 14px;">{{ $coupon->updated_at->format('M d, Y g:i A') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
