@extends('layouts.admin')

@section('content')
<style>
.orders-page {
    padding: 24px;
}

@media (max-width: 768px) {
    .orders-page {
        padding: 16px !important;
    }

    .orders-header {
        flex-direction: column !important;
        gap: 12px !important;
        align-items: stretch !important;
    }

    .orders-header h2 {
        font-size: 20px !important;
    }

    .pending-alert {
        width: 100% !important;
        justify-content: center !important;
    }

    .filter-form {
        flex-direction: column !important;
        gap: 12px !important;
    }

    .filter-form > div {
        width: 100% !important;
        min-width: auto !important;
        flex: none !important;
    }

    .filter-form input,
    .filter-form select {
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .filter-buttons {
        width: 100% !important;
        justify-content: stretch !important;
    }

    .filter-buttons button,
    .filter-buttons a {
        flex: 1 !important;
        justify-content: center !important;
    }

    .table-wrapper {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .orders-table {
        min-width: 800px !important;
    }

    .orders-card {
        border-radius: 12px !important;
    }
}

@media (max-width: 375px) {
    .orders-page {
        padding: 12px !important;
    }

    .orders-header h2 {
        font-size: 18px !important;
    }

    .filter-form label {
        font-size: 10px !important;
    }

    .filter-form input,
    .filter-form select {
        font-size: 13px !important;
        padding: 8px 12px !important;
    }
}
</style>

<div class="orders-page" style="padding: 24px;">
    <div class="orders-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <h2 style="font-weight: 800; color: #1e293b;">🛒 Order Management</h2>
        @if($pendingCount > 0)
            <div class="pending-alert" style="background: #fef3c7; color: #d97706; padding: 8px 16px; border-radius: 8px; font-weight: 700; display: flex; align-items: center; gap: 8px; white-space: nowrap;">
                <span>⚠️</span> {{ $pendingCount }} New Pending Orders!
            </div>
        @endif
    </div>

    {{-- Filter Bar --}}
    <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; border: 1px solid #f1f5f9; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <form class="filter-form" action="{{ route('admin.orders.index') }}" method="GET" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">

            <div style="flex: 1; min-width: 120px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Order ID</label>
                <input type="text" name="order_id" value="{{ request('order_id') }}" placeholder="e.g. 5" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; box-sizing: border-box;">
            </div>

            <div style="flex: 2; min-width: 200px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Customer Name</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; box-sizing: border-box;">
            </div>

            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Order Date</label>
                <input type="date" name="date" value="{{ request('date') }}" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; color: #1e293b; box-sizing: border-box;">
            </div>

            <div style="flex: 1; min-width: 160px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #64748b; margin-bottom: 6px; text-transform: uppercase;">Status</label>
                <select name="status" style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 14px; background: white; cursor: pointer; box-sizing: border-box;">
                    <option value="all">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                    <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>🟣 Preparing</option>
                    <option value="ready_for_pickup" {{ request('status') == 'ready_for_pickup' ? 'selected' : '' }}>✅ Ready for Pickup</option>
                    <option value="out_for_delivery" {{ request('status') == 'out_for_delivery' ? 'selected' : '' }}>🚚 Out for Delivery</option>
                    <option value="arrived" {{ request('status') == 'arrived' ? 'selected' : '' }}>📍 Arrived</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>🟢 Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled</option>
                </select>
            </div>

            <div class="filter-buttons" style="display: flex; gap: 8px;">
                <button type="submit" style="background: #1e293b; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 14px; transition: 0.2s; white-space: nowrap;" onmouseover="this.style.background='#0f172a'" onmouseout="this.style.background='#1e293b'">
                    🔍 Filter
                </button>
                <a href="{{ route('admin.orders.index') }}" style="background: white; color: #475569; text-decoration: none; padding: 10px 16px; border-radius: 8px; font-weight: 700; font-size: 14px; transition: 0.2s; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; white-space: nowrap;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
                    ✕ Clear
                </a>
            </div>

        </form>
    </div>

    <div class="orders-card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #f1f5f9;">
        <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="orders-table" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead style="background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                <tr>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700;">ORDER ID</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700;">CUSTOMER</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700;">DATE</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700;">TOTAL</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700;">STATUS</th>
                    <th style="padding: 16px 24px; font-size: 12px; color: #64748b; font-weight: 700; text-align: right;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                    <td style="padding: 16px 24px; font-weight: 800; color: #0f172a;">#{{ $order->id }}</td>
                    <td style="padding: 16px 24px;">
                        <p style="margin: 0; font-weight: 600; color: #1e293b;">{{ $order->customer->name ?? 'Guest' }}</p>
                    </td>
                    <td style="padding: 16px 24px; color: #64748b; font-size: 14px;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    <td style="padding: 16px 24px; font-weight: 700; color: #10b981;">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 16px 24px;">
                        @php
                            $bg = '#f1f5f9'; $text = '#64748b'; // Default (e.g., cancelled)
                            if($order->status == 'pending') { $bg = '#fffbeb'; $text = '#d97706'; }
                            elseif($order->status == 'preparing') { $bg = '#faf5ff'; $text = '#9333ea'; }
                            elseif($order->status == 'ready_for_pickup') { $bg = '#dcfce7'; $text = '#166534'; }
                            elseif($order->status == 'out_for_delivery') { $bg = '#e0e7ff'; $text = '#4f46e5'; }
                            elseif($order->status == 'arrived') { $bg = '#cffafe'; $text = '#0e7490'; }
                            elseif($order->status == 'delivered') { $bg = '#ecfdf5'; $text = '#059669'; }
                        @endphp
                        <span style="background: {{ $bg }}; color: {{ $text }}; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 800; text-transform: uppercase;">
                            {{ str_replace('_', ' ', $order->status) }}
                        </span>
                    </td>
                    <td style="padding: 16px 24px; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" style="background: #1e293b; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#0f172a'" onmouseout="this.style.background='#1e293b'">
                                Manage
                            </a>
                            <button onclick="confirmDelete({{ $order->id }})" style="background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                                🗑️ Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: #94a3b8;">No orders have been placed yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete(orderId) {
        if (confirm('⚠️ Are you sure you want to delete Order #' + orderId + '?\n\nThis action cannot be undone and will permanently remove the order from the system.')) {
            // Create a form and submit DELETE request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/orders/' + orderId;
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            
            // Add DELETE method spoof
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection
