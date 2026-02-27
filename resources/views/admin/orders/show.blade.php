@extends('layouts.admin')

@section('content')
<style>
.order-show-page {
    padding: 24px;
}

@media (max-width: 768px) {
    .order-show-page {
        padding: 16px !important;
    }

    .order-header {
        flex-direction: column !important;
        gap: 12px !important;
    }

    .order-header h2 {
        font-size: 20px !important;
    }

    .back-link {
        font-size: 13px !important;
    }

    .action-buttons {
        flex-direction: column !important;
        gap: 8px !important;
        width: 100% !important;
    }

    .action-buttons a,
    .action-buttons button {
        width: 100% !important;
        justify-content: center !important;
    }

    .control-grid {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }

    .control-card {
        padding: 16px !important;
    }

    .info-grid {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }

    .table-wrapper {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
    }

    .items-table {
        min-width: 600px !important;
    }
}

@media (max-width: 375px) {
    .order-show-page {
        padding: 12px !important;
    }

    .order-header h2 {
        font-size: 18px !important;
    }
}
</style>

<div class="order-show-page" style="padding: 24px;">
    <div class="order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="back-link" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px;">← Back to Orders</a>
            <h2 style="font-weight: 800; color: #1e293b; margin-top: 8px;">📦 Manage Order #{{ $order->id }}</h2>
        </div>

        <div class="action-buttons" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" style="background: white; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 16px; border-radius: 8px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: background 0.2s; white-space: nowrap;">
                🖨️ Print Invoice
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #059669; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($order->status === 'cancelled' && $order->cancellation_reason)
        <div style="background: #fef2f2; border: 1px solid #ef4444; border-left: 4px solid #ef4444; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px;">
            <div style="display: flex; align-items: flex-start; gap: 12px;">
                <span style="font-size: 24px;">🔴</span>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-weight: 700; color: #b91c1c;">Order Cancelled</h4>
                    <p style="margin: 0; color: #7f1d1d; font-size: 14px; line-height: 1.5;"><strong>Reason:</strong> {{ $order->cancellation_reason }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- 🎛️ Admin Order Control Panel -->
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 20px 0; font-weight: 800; color: #1e293b; font-size: 18px; display: flex; align-items: center; gap: 8px;">
            🎛️ Admin Order Control
        </h3>

        <div class="control-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            
            <!-- Change Order Status -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                    📋 Change Order Status
                </h4>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Select Status:</label>
                        <select name="status" id="admin-status-select" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; background: white; cursor: pointer;" onchange="checkStatusChange()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                            <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>🟣 Preparing</option>
                            <option value="ready_for_pickup" {{ $order->status == 'ready_for_pickup' ? 'selected' : '' }}>✅ Ready for Pickup</option>
                            <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>🚚 Out for Delivery</option>
                            <option value="arrived" {{ $order->status == 'arrived' ? 'selected' : '' }}>📍 Arrived</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>🟢 Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled</option>
                        </select>
                    </div>

                    <div id="cancellation-reason-field" style="display: none;">
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Cancellation Reason:</label>
                        <textarea name="cancellation_reason" rows="3" placeholder="Please provide a reason for cancellation..." style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; resize: vertical; box-sizing: border-box;">{{ $order->cancellation_reason ?? '' }}</textarea>
                    </div>

                    <button type="submit" id="update-status-btn" style="background: #1e293b; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#0f172a'" onmouseout="this.style.background='#1e293b'">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Assign Driver -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                    🚚 Assign Driver to Order
                </h4>
                
                @php
                    $drivers = \App\Models\User::where('role', 'driver')->where('status', 'active')->get();
                @endphp

                @if($drivers->count() > 0)
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Select Driver:</label>
                            <select name="driver_id" style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; background: white; cursor: pointer;">
                                <option value="">-- Select Driver --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ $order->driver_id == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }} - {{ $driver->phone_number ?? 'No phone' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="background: #dbeafe; border-radius: 8px; padding: 12px; border: 1px solid #93c5fd;">
                            <p style="margin: 0; font-size: 12px; color: #1e40af; font-weight: 600;">💡 Pro Tip:</p>
                            <p style="margin: 4px 0 0 0; font-size: 11px; color: #3b82f6;">Assigning a driver will automatically change status to "Out for Delivery"</p>
                        </div>

                        <button type="submit" name="assign_driver" value="1" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'">
                            {{ $order->driver_id ? '🔄 Reassign Driver' : '📋 Assign Driver' }}
                        </button>
                    </form>

                    @if($order->driver_id)
                        <div style="margin-top: 12px; padding: 12px; background: #dcfce7; border-radius: 8px; border: 1px solid #6ee7b7;">
                            <p style="margin: 0 0 4px 0; font-size: 12px; color: #166534; font-weight: 700;">✅ Currently Assigned:</p>
                            <p style="margin: 0; font-size: 13px; color: #15803d; font-weight: 600;">
                                {{ $order->driver->name ?? 'Driver' }}
                                @if($order->driver->phone_number)
                                    <span style="color: #166534; font-weight: 400;">📞 {{ $order->driver->phone_number }}</span>
                                @endif
                            </p>
                        </div>
                    @endif
                @else
                    <div style="background: #fef3c7; border-radius: 8px; padding: 12px; border: 1px solid #fcd34d;">
                        <p style="margin: 0; font-size: 13px; color: #92400e; font-weight: 600;">⚠️ No Active Drivers</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #78350f;">There are no active drivers in the system.</p>
                    </div>
                @endif
            </div>

            <!-- Cancel Order -->
            <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                    🚫 Cancel Order
                </h4>
                
                @if($order->status !== 'cancelled')
                    <p style="margin: 0 0 12px 0; font-size: 13px; color: #64748b;">Permanently cancel this order and notify the customer.</p>
                    
                    <button onclick="openCancelModal()" style="width: 100%; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(239, 68, 68, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.3)'">
                        🚫 Cancel Order
                    </button>
                @else
                    <div style="background: #fee2e2; border-radius: 8px; padding: 12px; border: 1px solid #fca5a5;">
                        <p style="margin: 0; font-size: 13px; color: #991b1b; font-weight: 700;">✅ Order Already Cancelled</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #7f1d1d;">This order has been cancelled.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Quick Action Buttons for Staff -->
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 16px 0; font-weight: 800; color: #1e293b; font-size: 16px; display: flex; align-items: center; gap: 8px;">
            ⚡ Quick Actions for Staff
        </h3>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            @if($order->status === 'pending')
                <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'">
                        ✅ Confirm Order
                    </button>
                </form>
            @endif

            @if(in_array($order->status, ['pending', 'preparing']))
                <form action="{{ route('admin.orders.ready-for-pickup', $order->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)'">
                        📦 Mark Ready for Pickup
                    </button>
                </form>
            @endif

            @if($order->status === 'preparing')
                <span style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: #fef3c7; color: #92400e; border-radius: 10px; font-weight: 700; font-size: 14px; border: 1px solid #fcd34d;">
                    🍳 Staff is preparing items...
                </span>
            @endif

            @if($order->status === 'ready_for_pickup')
                <span style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: #dcfce7; color: #166534; border-radius: 10px; font-weight: 700; font-size: 14px; border: 1px solid #6ee7b7;">
                    ✅ Ready for driver pickup
                </span>
            @endif

            @if($order->driver_id && in_array($order->status, ['out_for_delivery', 'arrived']))
                <span style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: #dbeafe; color: #1e40af; border-radius: 10px; font-weight: 700; font-size: 14px; border: 1px solid #93c5fd;">
                    🚚 Out for delivery by {{ $order->driver->name ?? 'Driver' }}
                </span>
            @endif

            @if($order->status === 'delivered')
                <span style="display: flex; align-items: center; gap: 8px; padding: 12px 20px; background: #dcfce7; color: #166534; border-radius: 10px; font-weight: 700; font-size: 14px; border: 1px solid #6ee7b7;">
                    ✅ Order Delivered Successfully
                </span>
            @endif
        </div>
    </div>

    <!-- 📊 ORDER STATUS TIMELINE - Horizontal Progress Bar Design -->
    @php
        // 1. Determine the current level
        $status = strtolower($order->status);
        $level = 1;
        if($status == 'pending') $level = 1;
        if($status == 'preparing') $level = 2;
        if($status == 'ready_for_pickup') $level = 3;
        if($status == 'out_for_delivery' || $status == 'out for delivery') $level = 4;
        if($status == 'arrived') $level = 5;
        if($status == 'delivered') $level = 6;
        if($status == 'cancelled') $level = 0;

        // 2. Calculate pure percentage (0%, 20%, 40%, 60%, 80%, or 100%)
        $progressPercentage = max(0, ($level - 1) * 20);
    @endphp

    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 20px; padding: 32px; margin-bottom: 24px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        
        <h3 style="margin: 0 0 48px 0; font-weight: 800; color: #1e293b; font-size: 18px; display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 20px;">📍</span> Order Tracking Timeline
        </h3>

        <!-- Timeline Container -->
        <div style="position: relative; width: 100%; margin: 0 auto 56px;">
            
            <!-- Gray Line Container (holds the green progress line) -->
            <div style="position: absolute; top: 26px; left: 48px; right: 48px; height: 4px; background: #e2e8f0; border-radius: 2px; z-index: 0; overflow: hidden;">
                <!-- Green Progress Line (pure percentage, no calc needed!) -->
                <div style="position: absolute; top: 0; left: 0; height: 100%; background: linear-gradient(90deg, #10b981, #059669); border-radius: 2px; z-index: 1; transition: width 0.7s ease-in-out; width: {{ $progressPercentage }}%;"></div>
            </div>

            <!-- Timeline Steps -->
            <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; width: 100%;">

                <!-- Step 1: Pending -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 1 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        📋
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 12px; {{ $level >= 1 ? 'color: #10b981;' : 'color: #64748b;' }}">Order<br>Received</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 1 ? 'color: #475569;' : 'color: #cbd5e1;' }}">Awaiting review</p>
                </div>

                <!-- Step 2: Preparing -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 2 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        🍳
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 12px; {{ $level >= 2 ? 'color: #10b981;' : 'color: #64748b;' }}">Pre-<br>paring</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 2 ? 'color: #475569;' : 'color: #cbd5e1;' }}">Being packed</p>
                </div>

                <!-- Step 3: Ready for Pickup -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 3 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        ✅
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 12px; {{ $level >= 3 ? 'color: #10b981;' : 'color: #64748b;' }}">Ready<br>Pickup</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 3 ? 'color: #475569;' : 'color: #cbd5e1;' }}">Driver can accept</p>
                </div>

                <!-- Step 4: Out for Delivery -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 4 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        🚚
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 11px; {{ $level >= 4 ? 'color: #10b981;' : 'color: #64748b;' }}">Out for<br>Delivery</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 4 ? 'color: #475569;' : 'color: #cbd5e1;' }}">On the way</p>
                </div>

                <!-- Step 5: Arrived -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 5 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        📍
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 12px; {{ $level >= 5 ? 'color: #10b981;' : 'color: #64748b;' }}">Ar-<br>rived</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 5 ? 'color: #475569;' : 'color: #cbd5e1;' }}">At customer</p>
                </div>

                <!-- Step 6: Delivered -->
                <div style="display: flex; flex-direction: column; align-items: center; width: 80px; text-align: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 12px; transition: all 0.3s; {{ $level >= 6 ? 'background: #10b981; color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);' : 'background: #e2e8f0; color: #94a3b8;' }}">
                        🏡
                    </div>
                    <h4 style="margin: 0; font-weight: 700; font-size: 12px; {{ $level >= 6 ? 'color: #10b981;' : 'color: #64748b;' }}">De-<br>livered</h4>
                    <p style="margin: 4px 0 0 0; font-size: 10px; {{ $level >= 6 ? 'color: #475569;' : 'color: #cbd5e1;' }}">Completed</p>
                </div>

            </div>
        </div>

        <!-- Footer: Current Status & Timestamp -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 16px; gap: 16px;">
            <div>
                <p style="margin: 0 0 8px 0; font-size: 13px; color: #64748b;">Current Status:</p>
                <p style="margin: 0; font-weight: 900; color: #1e293b; font-size: 16px; text-transform: uppercase; display: flex; align-items: center; gap: 10px;">
                    <span style="width: 14px; height: 14px; border-radius: 50%; {{ $level >= 6 ? 'background: #10b981;' : 'background: #fbbf24; animation: pulse 2s infinite;' }}"></span>
                    {{ str_replace('_', ' ', $order->status) }}
                </p>
            </div>
            
            <div style="text-align: left;">
                <p style="margin: 0 0 8px 0; font-size: 13px; color: #64748b;">Order Placed:</p>
                <p style="margin: 0; font-weight: 700; color: #1e293b;">{{ $order->created_at->format('M d, Y - h:i A') }}</p>
                <p style="margin: 8px 0 0 0; font-size: 14px; font-weight: 700; color: #10b981;">{{ $order->created_at->diffForHumans() }}</p>
            </div>
        </div>

    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        
        <div style="background: white; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="padding: 20px; border-bottom: 1px solid #f1f5f9; background: #f8fafc;">
                <h3 style="margin: 0; font-weight: 800; color: #1e293b;">🛒 Items to Pack</h3>
            </div>
            <div style="padding: 20px;">
                <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="items-table" style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 16px 0; display: flex; align-items: center; gap: 16px;">
                                @php
                                    $productImage = $item->product && $item->product->image ? $item->product->image : null;
                                @endphp
                                @if($productImage)
                                    <img src="{{ asset('storage/' . $productImage) }}" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 1px solid #e2e8f0;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 20px; border: 1px solid #e2e8f0; display: none;">
                                        📦
                                    </div>
                                @else
                                    <div style="width: 50px; height: 50px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 20px; border: 1px solid #e2e8f0;">
                                        📦
                                    </div>
                                @endif
                                <div>
                                    <p style="margin: 0; font-weight: 700; color: #1e293b;">{{ $item->product->translated_name ?? 'Product' }}</p>
                                    <p style="margin: 0; font-size: 13px; color: #64748b;">${{ number_format($item->price, 2) }} each</p>
                                </div>
                            </td>
                            <td style="padding: 16px 0; text-align: center; font-weight: 800; color: #475569;">x{{ $item->quantity }}</td>
                            <td style="padding: 16px 0; text-align: right; font-weight: 800; color: #10b981;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 24px;">

            <!-- 🚚 Delivery Tracking & Driver Info -->
            @if($order->driver_id)
            <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 16px 0; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                    🚚 Delivery Tracking & Driver Info
                </h3>

                <!-- Driver Info Card -->
                <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); border-radius: 12px; margin-bottom: 20px; border: 1px solid #93c5fd;">
                    <div style="width: 64px; height: 64px; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 3px solid #2563eb; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        @if($order->driver && ($order->driver->avatar ?? $order->driver->profile_photo_path))
                            <img src="{{ asset('storage/' . ($order->driver->avatar ?? $order->driver->profile_photo_path)) }}" alt="{{ $order->driver->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 24px;">
                                {{ strtoupper(substr($order->driver->name ?? 'D', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 800; color: #1e40af; font-size: 16px;">{{ $order->driver->name ?? 'Driver' }}</div>
                        <div style="color: #3b82f6; font-size: 13px;">📞 {{ $order->driver->phone_number ?? 'N/A' }}</div>
                        <div style="color: #64748b; font-size: 12px;">✉️ {{ $order->driver->email ?? 'N/A' }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="background: #16a34a; color: white; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Assigned Driver</div>
                    </div>
                </div>

                <!-- Delivery Timeline -->
                <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 12px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase;">📋 Delivery Timeline</h4>
                    
                    @php
                        // Calculate delivery duration if delivered
                        $deliveryDuration = null;
                        if ($order->status === 'delivered' && $order->updated_at && $order->created_at) {
                            $duration = $order->created_at->diff($order->updated_at);
                            $hours = $duration->h;
                            $minutes = $duration->i;
                            $days = $duration->days;
                            
                            if ($days > 0) {
                                $deliveryDuration = $days . ' day(s), ' . $hours . 'h ' . $minutes . 'm';
                            } elseif ($hours > 0) {
                                $deliveryDuration = $hours . 'h ' . $minutes . 'm';
                            } else {
                                $deliveryDuration = $minutes . ' minutes';
                            }
                        }
                    @endphp

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <!-- Order Placed -->
                        <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #10b981;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">📦 Order Placed</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">{{ $order->created_at->format('M d, Y') }}</div>
                            <div style="color: #64748b; font-size: 12px;">{{ $order->created_at->format('h:i A') }}</div>
                        </div>

                        <!-- Staff Confirmed -->
                        <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #3b82f6;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">✅ Staff Confirmed</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                @if(in_array($order->status, ['preparing', 'ready_for_pickup', 'out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('M d, Y') }}
                                @else
                                    <span style="color: #cbd5e1;">Pending</span>
                                @endif
                            </div>
                            <div style="color: #64748b; font-size: 12px;">
                                @if(in_array($order->status, ['preparing', 'ready_for_pickup', 'out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('h:i A') }}
                                @endif
                            </div>
                        </div>

                        <!-- Driver Accepted -->
                        <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #f59e0b;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">🎯 Driver Accepted</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                @if(in_array($order->status, ['out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('M d, Y') }}
                                @else
                                    <span style="color: #cbd5e1;">Pending</span>
                                @endif
                            </div>
                            <div style="color: #64748b; font-size: 12px;">
                                @if(in_array($order->status, ['out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('h:i A') }}
                                @endif
                            </div>
                        </div>

                        <!-- Out for Delivery -->
                        <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #8b5cf6;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">🚚 Out for Delivery</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                @if(in_array($order->status, ['out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('M d, Y') }}
                                @else
                                    <span style="color: #cbd5e1;">Pending</span>
                                @endif
                            </div>
                            <div style="color: #64748b; font-size: 12px;">
                                @if(in_array($order->status, ['out_for_delivery', 'arrived', 'delivered']))
                                    {{ $order->updated_at->format('h:i A') }}
                                @endif
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #16a34a;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">🏡 Delivered</div>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                @if($order->status === 'delivered')
                                    {{ $order->updated_at->format('M d, Y') }}
                                @else
                                    <span style="color: #cbd5e1;">Pending</span>
                                @endif
                            </div>
                            <div style="color: #64748b; font-size: 12px;">
                                @if($order->status === 'delivered')
                                    {{ $order->updated_at->format('h:i A') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Duration -->
                    @if($order->status === 'delivered' && $deliveryDuration)
                    <div style="margin-top: 16px; padding: 12px; background: linear-gradient(135deg, #dcfce7, #bbf7d0); border-radius: 8px; border: 1px solid #6ee7b7; display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 20px;">⏱️</span>
                            <div>
                                <div style="font-weight: 700; color: #166534; font-size: 13px;">Total Delivery Time</div>
                                <div style="color: #15803d; font-size: 12px;">From order placed to delivered</div>
                            </div>
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #16a34a;">{{ $deliveryDuration }}</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 16px 0; font-weight: 800; color: #1e293b;">👤 Customer Details</h3>
                <p style="margin: 0 0 8px 0; font-weight: 700; color: #475569;">{{ $order->customer->name ?? 'Guest' }}</p>
                <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px;">📧 {{ $order->customer->email ?? 'N/A' }}</p>
                <p style="margin: 0 0 8px 0; color: #64748b; font-size: 14px;">📞 {{ $order->phone ?? $order->customer->phone ?? 'No phone provided' }}</p>

                <hr style="border: none; border-top: 1px solid #f1f5f9; margin: 16px 0;">

                <h4 style="margin: 0 0 8px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase;">📍 Delivery Address</h4>
                <p style="margin: 0 0 12px 0; color: #64748b; font-size: 14px; line-height: 1.5; font-weight: 600;">
                    {{ $order->delivery_address ?? $order->customer->current_address ?? 'Address not found' }}
                </p>
                
                @if($order->delivery_notes)
                    <div style="background: #dbeafe; border: 1px solid #93c5fd; border-radius: 8px; padding: 12px; margin-bottom: 12px;">
                        <div style="display: flex; align-items: flex-start; gap: 8px;">
                            <svg style="width: 16px; height: 16px; color: #2563eb; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>
                                <div style="font-weight: 700; color: #1e40af; font-size: 12px; margin-bottom: 4px;">Delivery Instructions:</div>
                                <div style="color: #1e3a8a; font-size: 13px; line-height: 1.4;">{{ $order->delivery_notes }}</div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($order->latitude && $order->longitude)
                    <div style="margin-top: 12px;">
                        <h4 style="margin: 0 0 8px 0; font-weight: 700; color: #475569; font-size: 13px; text-transform: uppercase;">🗺️ Delivery Location Map</h4>
                        <div style="background: #f1f5f9; border-radius: 12px; overflow: hidden; border: 2px solid #e2e8f0;" id="order-map-container">
                            <div id="order-map" style="height: 300px; width: 100%;"></div>
                        </div>
                        <p style="margin: 8px 0 0 0; font-size: 12px; color: #64748b; text-align: center;">
                            📍 Coordinates: {{ number_format($order->latitude, 6) }}, {{ number_format($order->longitude, 6) }}
                        </p>
                    </div>
                @else
                    <div style="margin-top: 12px; padding: 12px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; text-align: center;">
                        <p style="margin: 0; font-size: 13px; color: #64748b;">📍 Map location not available for this order</p>
                    </div>
                @endif
            </div>

            <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 16px 0; font-weight: 800; color: #1e293b;">👤 Customer Profile</h3>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    @if($order->customer && ($order->customer->avatar ?? $order->customer->profile_photo_path))
                        <img src="{{ asset('storage/' . ($order->customer->avatar ?? $order->customer->profile_photo_path)) }}" alt="{{ $order->customer->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #10b981;">
                    @else
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 24px;">
                            {{ strtoupper(substr($order->customer->name ?? '?', 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p style="margin: 0; font-weight: 700; color: #1e293b;">{{ $order->customer->name ?? 'Guest' }}</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b; text-transform: uppercase;">{{ ucfirst($order->customer->role ?? 'customer') }}</p>
                    </div>
                </div>
            </div>

            <div style="background: white; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 16px 0; font-weight: 800; color: #1e293b;">💰 Payment Summary</h3>

                <!-- Payment Status Badge -->
                <div style="margin-bottom: 16px;">
                    <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase;">Payment Status:</span>
                    @if(strtolower($order->status) == 'delivered' || strtolower($order->payment_status ?? '') == 'paid')
                        <span style="display: inline-block; background: #dcfce7; color: #166534; font-weight: 700; padding: 6px 12px; border-radius: 20px; font-size: 12px; text-transform: uppercase; margin-left: 8px;">
                            ✓ Paid
                        </span>
                    @else
                        <span style="display: inline-block; background: #fef3c7; color: #92400e; font-weight: 700; padding: 6px 12px; border-radius: 20px; font-size: 12px; text-transform: uppercase; margin-left: 8px;">
                            ⏳ Unpaid
                        </span>
                    @endif
                </div>

                <!-- Delivery Method Badge -->
                <div style="margin-bottom: 16px;">
                    <span style="font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase;">Delivery Method:</span>
                    @php
                        $shippingMethod = $order->shipping_method ?? 'Standard Delivery';
                        $shippingColor = '#3b82f6'; // Default blue
                        $shippingIcon = '🚚';
                        
                        if (str_contains(strtolower($shippingMethod), 'fast')) {
                            $shippingColor = '#ef4444'; // Red for fast
                            $shippingIcon = '⚡';
                        } elseif (str_contains(strtolower($shippingMethod), 'express')) {
                            $shippingColor = '#f59e0b'; // Amber for express
                            $shippingIcon = '🚀';
                        }
                    @endphp
                    <span style="display: inline-block; background: {{ $shippingColor }}1a; color: {{ $shippingColor }}; font-weight: 700; padding: 6px 12px; border-radius: 20px; font-size: 12px; text-transform: uppercase; margin-left: 8px; border: 1px solid {{ $shippingColor }}4d;">
                        {{ $shippingIcon }} {{ $shippingMethod }}
                    </span>
                </div>

                @php
                    // Calculate the exact subtotal of the food items
                    $calculatedSubtotal = 0;
                    foreach($order->orderItems as $item) {
                        $calculatedSubtotal += ($item->price * $item->quantity);
                    }

                    // Figure out the delivery fee (total - subtotal)
                    $calculatedDelivery = $order->total_amount - $calculatedSubtotal;
                @endphp

                <div style="display: flex; justify-content: space-between; margin-bottom: 12px; color: #64748b;">
                    <span>Subtotal</span>
                    <span style="font-weight: 600;">${{ number_format($calculatedSubtotal, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px; color: #64748b;">
                    <span>Delivery Fee</span>
                    @if($calculatedDelivery > 0)
                        <span style="font-weight: 600; color: #1e293b;">${{ number_format($calculatedDelivery, 2) }}</span>
                    @else
                        <span style="font-weight: 600; color: #10b981;">FREE</span>
                    @endif
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 16px; border-top: 2px dashed #e2e8f0; font-size: 18px; font-weight: 800; color: #1e293b;">
                    <span>Total Paid</span>
                    <span style="color: #10b981;">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Cancellation Reason Modal/Field -->
<div id="cancellation-reason-container" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 16px; padding: 24px; max-width: 500px; width: 90%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <span style="font-size: 24px;">⚠️</span>
            <h3 style="margin: 0; font-weight: 800; color: #1e293b;">Cancel Order #{{ $order->id }}</h3>
        </div>
        
        <p style="color: #64748b; margin-bottom: 16px; font-size: 14px;">Please provide a reason for cancellation. This will be visible to the customer.</p>
        
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="cancel-form">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="cancelled">
            
            <label style="display: block; font-weight: 700; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">Cancellation Reason <span style="color: #ef4444;">*</span></label>
            <textarea name="cancellation_reason" rows="4" placeholder="e.g. Out of stock, customer requested cancellation, delivery unavailable, etc." required style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; resize: vertical; font-size: 14px; font-family: inherit;"></textarea>
            
            <div style="display: flex; gap: 12px; margin-top: 20px; justify-content: flex-end;">
                <button type="button" onclick="closeCancellationModal()" style="background: #f1f5f9; color: #64748b; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">Cancel</button>
                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 14px;">🔴 Confirm Cancellation</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Check status change and show cancellation reason field
    function checkStatusChange() {
        const statusSelect = document.getElementById('admin-status-select');
        const reasonField = document.getElementById('cancellation-reason-field');
        
        if (statusSelect.value === 'cancelled') {
            reasonField.style.display = 'block';
        } else {
            reasonField.style.display = 'none';
        }
    }

    // Open cancel order modal
    function openCancelModal() {
        const modal = document.getElementById('cancellation-reason-container');
        modal.style.display = 'flex';
    }

    // Close cancel order modal
    function closeCancellationModal() {
        const modal = document.getElementById('cancellation-reason-container');
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('cancellation-reason-container');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

@if($order->latitude && $order->longitude)
<!-- Leaflet.js CSS - Push to head -->
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    #order-map {
        height: 300px;
        width: 100%;
        z-index: 1;
    }
</style>
@endpush

<!-- Leaflet.js JS - Push to scripts -->
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

<script>
    // Leaflet.js Map for Order Location (OpenStreetMap - Free, no API key needed)
    document.addEventListener('DOMContentLoaded', function() {
        const orderLat = {{ $order->latitude }};
        const orderLng = {{ $order->longitude }};

        // Check if Leaflet is loaded
        if (typeof L === 'undefined') {
            console.error('Leaflet.js not loaded!');
            return;
        }

        // Create map centered on delivery location
        const map = L.map('order-map', {
            zoomControl: true,
            zoomControlOptions: {
                position: 'bottomright'
            },
            attributionControl: true
        }).setView([orderLat, orderLng], 15);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Create custom marker icon
        const markerIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Add marker at delivery location
        const marker = L.marker([orderLat, orderLng], { icon: markerIcon }).addTo(map);

        // Add popup
        marker.bindPopup('<div style="text-align: center; font-weight: 600;">📍 Delivery Location<br><span style="font-size: 12px; color: #666;">Order #{{ $order->id }}</span></div>').openPopup();

        // Fix map rendering issue - invalidate size after a short delay
        setTimeout(function() {
            map.invalidateSize();
        }, 100);
    });
</script>
@endif
@endsection
