@extends('layouts.admin')

@section('title', 'Coupon Management - Admin')

@section('content')
<div style="padding: 24px;">
    
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-weight: 800; color: #1e293b; margin: 0; font-size: 24px;">🎟️ Coupon Management</h2>
            <p style="color: #64748b; margin: 4px 0 0 0; font-size: 14px;">Create and manage discount codes for marketing campaigns.</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" style="background: #10b981; color: white; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-weight: 700; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3); display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#059669'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#10b981'; this.style.transform='translateY(0)';">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Coupon
        </a>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;">
            <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Coupons</div>
            <div style="font-size: 28px; font-weight: 800; color: #1e293b;">{{ $stats['total'] }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;">
            <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Active</div>
            <div style="font-size: 28px; font-weight: 800; color: #10b981;">{{ $stats['active'] }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;">
            <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Expired</div>
            <div style="font-size: 28px; font-weight: 800; color: #f59e0b;">{{ $stats['expired'] }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #f1f5f9;">
            <div style="color: #64748b; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Disabled</div>
            <div style="font-size: 28px; font-weight: 800; color: #ef4444;">{{ $stats['disabled'] }}</div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 16px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #991b1b; padding: 16px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Coupons Table -->
    <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f1f5f9;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                <tr>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">PROMO CODE</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">DISCOUNT TYPE</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">VALUE</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">MIN PURCHASE</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">EXPIRES</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">STATUS</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; text-align: right;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 16px 24px;">
                        <span style="background: #f1f5f9; padding: 6px 12px; border-radius: 6px; border: 1px dashed #cbd5e1; font-weight: 800; color: #0f172a; font-family: monospace; font-size: 14px; letter-spacing: 1px;">
                            {{ $coupon->code }}
                        </span>
                    </td>
                    <td style="padding: 16px 24px; color: #475569; text-transform: capitalize; font-weight: 600; font-size: 14px;">
                        @if($coupon->type === 'percent')
                            <span style="background: #dbeafe; color: #1d4ed8; padding: 4px 10px; border-radius: 20px; font-size: 12px;">Percentage (%)</span>
                        @else
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 12px;">Fixed Amount ($)</span>
                        @endif
                    </td>
                    <td style="padding: 16px 24px; font-weight: 800; color: #10b981; font-size: 15px;">
                        @if($coupon->type === 'percent')
                            {{ number_format($coupon->value, 0) }}%
                        @else
                            ${{ number_format($coupon->value, 2) }}
                        @endif
                    </td>
                    <td style="padding: 16px 24px; color: #64748b; font-size: 14px;">
                        @if($coupon->min_purchase > 0)
                            ${{ number_format($coupon->min_purchase, 2) }}
                        @else
                            <span style="color: #cbd5e1;">No minimum</span>
                        @endif
                    </td>
                    <td style="padding: 16px 24px; color: #64748b; font-size: 14px;">
                        @if($coupon->expires_at)
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <svg style="width: 14px; height: 14px; color: {{ $coupon->expires_at->isPast() ? '#ef4444' : '#64748b' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span style="{{ $coupon->expires_at->isPast() ? 'color: #ef4444; font-weight: 600;' : '' }}">
                                    {{ $coupon->expires_at->format('M d, Y') }}
                                </span>
                            </div>
                        @else
                            <span style="color: #cbd5e1;">Never</span>
                        @endif
                    </td>
                    <td style="padding: 16px 24px;">
                        @if($coupon->status)
                            @if($coupon->expires_at && $coupon->expires_at->isPast())
                                <span style="background: #fef3c7; color: #d97706; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Expired</span>
                            @else
                                <span style="background: #ecfdf5; color: #059669; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Active</span>
                            @endif
                        @else
                            <span style="background: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Disabled</span>
                        @endif
                    </td>
                    <td style="padding: 16px 24px; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" style="background: #dbeafe; color: #1d4ed8; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#1d4ed8'; this.style.color='white';" onmouseout="this.style.background='#dbeafe'; this.style.color='#1d4ed8';">
                                Edit
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete coupon {{ $coupon->code }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #fee2e2; color: #dc2626; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#dc2626'; this.style.color='white';" onmouseout="this.style.background='#fee2e2'; this.style.color='#dc2626';">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 60px 24px; text-align: center; color: #94a3b8;">
                        <svg style="width: 48px; height: 48px; margin: 0 auto 16px; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <div style="font-weight: 600; font-size: 16px; margin-bottom: 8px;">No coupons created yet</div>
                        <div style="font-size: 14px; margin-bottom: 20px;">Create your first discount code to start marketing campaigns.</div>
                        <a href="{{ route('admin.coupons.create') }}" style="background: #10b981; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">Create Coupon</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($coupons->hasPages())
        <div style="margin-top: 24px; display: flex; justify-content: center;">
            {{ $coupons->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
@endsection
