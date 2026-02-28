@extends('layouts.admin')

@section('content')
<style>
@media (max-width: 768px) {
    .promotions-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 16px !important;
    }
    
    .promotions-header > div:last-child {
        width: 100% !important;
        flex-wrap: wrap !important;
    }
    
    .promotions-header > div:last-child a {
        flex: 1 !important;
        min-width: 150px !important;
        justify-content: center !important;
    }
}
</style>

<div class="customer-promotions-page" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header -->
    <div class="promotions-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: nowrap; gap: 16px;">
        <div style="flex: 1;">
            <h2 style="font-weight: 800; color: #1e293b; font-size: 28px; margin-bottom: 8px;">👥 Customer Promotions</h2>
            <p style="color: #64748b; font-size: 14px; margin: 0;">Manage promotions sent to individual customers</p>
        </div>
        <div style="display: flex; gap: 12px; flex-shrink: 0;">
            <a href="{{ route('admin.promotions.index') }}" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                🎉 General Promotions
            </a>
            <a href="{{ route('admin.customers.index') }}" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                🎁 Give Promotion
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Total Promotions</div>
            <div style="font-size: 28px; font-weight: 800;">{{ $stats['total'] }}</div>
        </div>
        <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Active</div>
            <div style="font-size: 28px; font-weight: 800;">{{ $stats['active'] }}</div>
        </div>
        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
            <div style="font-size: 12px; opacity: 0.9;">Expired</div>
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
            <form action="{{ route('admin.customer-promotions.index') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <input type="text" name="search" placeholder="Search customer..." value="{{ request('search') }}" style="flex: 1; min-width: 200px; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1;">
                <select name="customer_id" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: white;">
                    <option value="">All Customers</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
                <select name="status" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: white;">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
                <button type="submit" style="background: #1e293b; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 700; border: none; cursor: pointer;">🔍 Search</button>
                <a href="{{ route('admin.customer-promotions.index') }}" style="background: white; color: #475569; padding: 10px 20px; border-radius: 8px; font-weight: 700; text-decoration: none; border: 1px solid #cbd5e1;">✕ Clear</a>
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;text-align: justify;">
                    <tr>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Customer</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Promotion</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Coupon Code</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Discount</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Expires</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Sent</th>
                        <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promotions as $promo)
                    @php
                        $data = json_decode($promo->data, true);
                        $expiresAt = $data['expires_at'] ?? null;
                        $isExpired = $expiresAt && \Carbon\Carbon::parse($expiresAt)->isPast();
                        $isRead = $promo->read_at !== null;
                    @endphp
                    <tr style="border-bottom: 1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 16px 24px;">
                            <div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $promo->customer_name }}</div>
                                <div style="font-size: 12px; color: #64748b;">{{ $promo->customer_email }}</div>
                            </div>
                        </td>
                        <td style="padding: 16px 24px;">
                            <div style="font-weight: 600; color: #1e293b;">{{ $data['title'] ?? 'Promotion' }}</div>
                            @if(isset($data['message']))
                                <div style="font-size: 12px; color: #64748b; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $data['message'] }}</div>
                            @endif
                        </td>
                        <td style="padding: 16px 24px;">
                            <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 12px;">{{ $data['coupon_code'] ?? 'N/A' }}</span>
                        </td>
                        <td style="padding: 16px 24px;">
                            @if(isset($data['discount_type']) && $data['discount_type'] === 'percentage')
                                <span style="font-weight: 700; color: #10b981;">{{ $data['discount_value'] }}% OFF</span>
                            @elseif(isset($data['discount_type']) && $data['discount_type'] === 'fixed')
                                <span style="font-weight: 700; color: #10b981;">${{ $data['discount_value'] }} OFF</span>
                            @else
                                <span style="color: #64748b;">{{ $data['discount_type'] ?? 'N/A' }}</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($expiresAt)
                                <div style="font-size: 13px; color: {{ $isExpired ? '#dc2626' : '#475569' }};">
                                    {{ \Carbon\Carbon::parse($expiresAt)->format('M d, Y') }}
                                </div>
                                <div style="font-size: 11px; color: #94a3b8;">
                                    {{ \Carbon\Carbon::parse($expiresAt)->format('g:i A') }}
                                </div>
                            @else
                                <span style="font-size: 12px; color: #64748b;">No expiry</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($isExpired)
                                <span style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700;">EXPIRED</span>
                            @elseif($isRead)
                                <span style="background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700;">VIEWED</span>
                            @else
                                <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700;">ACTIVE</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; font-size: 13px; color: #64748b;">
                            {{ \Carbon\Carbon::parse($promo->created_at)->format('M d, Y') }}
                        </td>
                        <td style="padding: 16px 24px; text-align: right;">
                            <form action="{{ route('admin.customer-promotions.revoke', $promo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Revoke this promotion from the customer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600; font-size: 13px;" title="Revoke promotion">
                                    🗑️ Revoke
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 40px; text-align: center; color: #64748b;">No customer promotions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($promotions->hasPages())
        <div style="padding: 20px; border-top: 1px solid #f1f5f9;">
            {{ $promotions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
