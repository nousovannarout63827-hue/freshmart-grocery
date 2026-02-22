@extends('layouts.driver')

@section('page-title', 'Driver Dashboard')
@section('page-subtitle', 'Manage your deliveries and track your performance')

@push('scripts')
@endpush

@section('content')

<!-- Stats Overview -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
    
    <!-- Available Orders -->
    <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #10b981;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 28px;">📦</span>
            <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Ready</span>
        </div>
        <div style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">{{ $stats['available'] }}</div>
        <div style="font-size: 13px; color: #64748b;">Orders ready for pickup</div>
    </div>

    <!-- To Pickup Orders -->
    <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 28px;">🎯</span>
            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">To Pickup</span>
        </div>
        <div style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">{{ $stats['to_pickup'] }}</div>
        <div style="font-size: 13px; color: #64748b;">Assigned to you</div>
    </div>

    <!-- Out for Delivery -->
    <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 28px;">🚚</span>
            <span style="background: #ede9fe; color: #6d28d9; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Active</span>
        </div>
        <div style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">{{ $stats['active'] }}</div>
        <div style="font-size: 13px; color: #64748b;">Out for delivery</div>
    </div>

    <!-- Completed Today -->
    <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #16a34a;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 28px;">✅</span>
            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Today</span>
        </div>
        <div style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 4px;">{{ $stats['completed_today'] }}</div>
        <div style="font-size: 13px; color: #64748b;">Deliveries completed</div>
    </div>

</div>

<!-- Main Content Grid -->
<div style="display: grid; grid-template-columns: 1fr; gap: 32px;">

    <!-- Available Orders Section -->
    @if($filter === 'all' || $filter === 'available')
    <div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 24px;">📦</span>
                Ready for Pickup (Approved by Staff)
            </h2>
            <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">{{ $availableOrders->count() }} orders</span>
        </div>

        <div style="background: #f0fdf4; border: 1px solid #6ee7b7; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 18px;">ℹ️</span>
                <span style="font-weight: 600; color: #166534; font-size: 13px;">These orders have been prepared and approved by staff. Click "Accept Order" to start delivery.</span>
            </div>
        </div>

        @forelse($availableOrders as $order)
            <div class="order-card" style="background: white; border-radius: 16px; padding: 24px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                <div style="display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: start;">
                    
                    <!-- Order Info -->
                    <div>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="background: #3b82f6; color: white; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Available</span>
                            <span style="font-weight: 700; color: #64748b; font-size: 13px;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                            <span style="color: #94a3b8; font-size: 13px;">•</span>
                            <span style="color: #64748b; font-size: 13px;">{{ $order->created_at->diffForHumans() }}</span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 16px;">
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Customer</div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $order->customer->name ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Delivery Address</div>
                                <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $order->delivery_address ?? $order->address ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Payment Method</div>
                                <div style="font-weight: 600; color: #1e293b;">
                                    @php
                                        $isCOD = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery']);
                                    @endphp
                                    @if($isCOD)
                                        <span style="color: #d97706;">💵 Cash on Delivery</span>
                                    @else
                                        <span style="color: #16a34a;">💳 Paid Online</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Total Amount</div>
                                <div style="font-weight: 800; color: #16a34a; font-size: 18px;">${{ number_format($order->total_amount, 2) }}</div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div style="background: #f8fafc; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px;">
                            <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 700; margin-bottom: 8px;">📦 Items ({{ $order->orderItems->count() }})</div>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($order->orderItems->take(5) as $item)
                                    <span style="background: white; padding: 4px 10px; border-radius: 6px; font-size: 12px; color: #475569; border: 1px solid #e2e8f0;">
                                        {{ $item->quantity }}x {{ $item->product->name ?? 'Item' }}
                                    </span>
                                @endforeach
                                @if($order->orderItems->count() > 5)
                                    <span style="background: #e2e8f0; padding: 4px 10px; border-radius: 6px; font-size: 12px; color: #64748b;">
                                        +{{ $order->orderItems->count() - 5 }} more
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Current Status -->
                        <div style="background: #f1f5f9; border-radius: 12px; padding: 12px 16px; border: 1px solid #e2e8f0;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 16px;">📋</span>
                                <span style="font-weight: 700; color: #475569; font-size: 13px;">Current Status: </span>
                                <span style="font-weight: 800; color: #3b82f6; text-transform: uppercase;">{{ str_replace('_', ' ', $order->status) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 10px; min-width: 180px;">
                        <a href="{{ route('driver.order.details', $order->id) }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; background: #f1f5f9; color: #475569; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; transition: all 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#1e293b'" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            View Details
                        </a>
                        <form action="{{ route('driver.accept-order', $order->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 20px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Accept Order
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div style="background: white; border-radius: 16px; padding: 48px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <span style="font-size: 64px; display: block; margin-bottom: 16px;">🎉</span>
                <h3 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 800; color: #1e293b;">No Available Orders</h3>
                <p style="margin: 0; color: #64748b; font-size: 14px;">All orders are currently being processed. Check back soon!</p>
            </div>
        @endforelse
    </div>
    @endif

    <!-- My To Pickup Orders Section -->
    @if($filter === 'all' || $filter === 'assigned')
    <div style="margin-top: 32px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 24px;">🎯</span>
                My Orders to Pickup
            </h2>
            <span style="background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">{{ $myToPickupOrders->count() }} orders</span>
        </div>

        @forelse($myToPickupOrders as $order)
            <div class="order-card" style="background: white; border-radius: 16px; padding: 24px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #fcd34d;">
                <div style="display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: start;">
                    
                    <!-- Order Info -->
                    <div>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Assigned to You</span>
                            <span style="font-weight: 700; color: #64748b; font-size: 13px;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                            <span style="color: #94a3b8; font-size: 13px;">•</span>
                            <span style="color: #64748b; font-size: 13px;">{{ $order->created_at->diffForHumans() }}</span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 16px;">
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Customer</div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $order->customer->name ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Phone</div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $order->phone ?? $order->customer->phone_number ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Delivery Address</div>
                                <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $order->delivery_address ?? $order->address ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Total Amount</div>
                                <div style="font-weight: 800; color: #16a34a; font-size: 18px;">${{ number_format($order->total_amount, 2) }}</div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div style="background: #fffbeb; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px; border: 1px solid #fde68a;">
                            <div style="font-size: 11px; color: #92400e; text-transform: uppercase; font-weight: 700; margin-bottom: 8px;">📦 Items to Pick ({{ $order->orderItems->count() }})</div>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($order->orderItems->take(5) as $item)
                                    <span style="background: white; padding: 4px 10px; border-radius: 6px; font-size: 12px; color: #475569; border: 1px solid #fde68a;">
                                        {{ $item->quantity }}x {{ $item->product->name ?? 'Item' }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pickup Instructions -->
                        <div style="background: #fef3c7; border-radius: 12px; padding: 12px 16px; border: 1px solid #fcd34d;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                <span style="font-size: 18px;">📍</span>
                                <span style="font-weight: 700; color: #92400e; font-size: 13px;">Next Step: Pickup at Store</span>
                            </div>
                            <p style="margin: 0; color: #78350f; font-size: 13px;">Proceed to the store warehouse to collect the packaged items.</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 10px; min-width: 180px;">
                        <a href="{{ route('driver.order.details', $order->id) }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; background: #f1f5f9; color: #475569; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; transition: all 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#1e293b'" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            View Details
                        </a>
                        <form action="{{ route('driver.confirm-pickup', $order->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 20px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(245, 158, 11, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                Confirm Pickup
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div style="background: white; border-radius: 16px; padding: 48px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <span style="font-size: 64px; display: block; margin-bottom: 16px;">📋</span>
                <h3 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 800; color: #1e293b;">No Orders to Pickup</h3>
                <p style="margin: 0; color: #64748b; font-size: 14px;">Accept orders from the "Ready for Pickup" list above.</p>
            </div>
        @endforelse
    </div>
    @endif

    <!-- In Progress / Active Deliveries Section -->
    @if($filter === 'all' || $filter === 'active')
    <div style="margin-top: 32px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 24px;">🚚</span>
                Active Deliveries
            </h2>
            <span style="background: #ede9fe; color: #6d28d9; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">{{ $myActiveOrders->count() }} orders</span>
        </div>

        @forelse($myActiveOrders as $order)
            <div class="order-card" style="background: white; border-radius: 16px; padding: 24px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #c4b5fd;">
                <div style="display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: start;">
                    
                    <!-- Order Info -->
                    <div>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            @if($order->status === 'picked_up')
                                <span style="background: #8b5cf6; color: white; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Picked Up</span>
                            @else
                                <span style="background: #06b6d4; color: white; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase;">In Transit</span>
                            @endif
                            <span style="font-weight: 700; color: #64748b; font-size: 13px;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                            <span style="color: #94a3b8; font-size: 13px;">•</span>
                            <span style="color: #64748b; font-size: 13px;">{{ $order->created_at->diffForHumans() }}</span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 16px;">
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Customer</div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $order->customer->name ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Phone</div>
                                <div style="font-weight: 600; color: #1e293b;">{{ $order->phone ?? $order->customer->phone_number ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Delivery Address</div>
                                <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $order->delivery_address ?? $order->address ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Payment</div>
                                <div style="font-weight: 600; color: #1e293b;">
                                    @php
                                        $isCOD = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery']);
                                    @endphp
                                    @if($isCOD)
                                        <span style="color: #d97706; font-weight: 800;">💵 COD - ${{ number_format($order->total_amount, 2) }}</span>
                                    @else
                                        <span style="color: #16a34a;">✅ Paid</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Customer Contact Card -->
                        <div style="background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 12px; padding: 16px; margin-bottom: 16px; border: 1px solid #bae6fd;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #60a5fa, #3b82f6); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 18px;">
                                        {{ strtoupper(substr($order->customer->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #0369a1; font-size: 15px;">{{ $order->customer->name ?? 'Customer' }}</div>
                                        <div style="color: #0284c7; font-size: 13px;">📞 {{ $order->phone ?? $order->customer->phone_number ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="tel:{{ $order->phone ?? $order->customer->phone_number }}" style="display: flex; align-items: center; gap: 6px; padding: 10px 16px; background: #0284c7; color: white; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#0369a1'" onmouseout="this.style.background='#0284c7'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        Call
                                    </a>
                                    <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" style="display: flex; align-items: center; gap: 6px; padding: 10px 16px; background: #0ea5e9; color: white; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#0284c7'" onmouseout="this.style.background='#0ea5e9'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                        </svg>
                                        Navigate
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Instructions -->
                        @if($order->status === 'picked_up')
                            <div style="background: #ede9fe; border-radius: 12px; padding: 12px 16px; border: 1px solid #c4b5fd;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    <span style="font-size: 18px;">🚚</span>
                                    <span style="font-weight: 700; color: #5b21b6; font-size: 13px;">Ready to Start Delivery</span>
                                </div>
                                <p style="margin: 0; color: #6d28d9; font-size: 13px;">Items are picked. Start the delivery journey to the customer.</p>
                            </div>
                        @else
                            <div style="background: #ecfdf5; border-radius: 12px; padding: 12px 16px; border: 1px solid #6ee7b7;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                    <span style="font-size: 18px;">📍</span>
                                    <span style="font-weight: 700; color: #047857; font-size: 13px;">On the Way to Customer</span>
                                </div>
                                <p style="margin: 0; color: #059669; font-size: 13px;">Proceed to the delivery address and complete the handover.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 10px; min-width: 180px;">
                        <a href="{{ route('driver.order.details', $order->id) }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; background: #f1f5f9; color: #475569; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; transition: all 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#1e293b'" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            View Details
                        </a>
                        
                        @if($order->status === 'picked_up')
                            <form action="{{ route('driver.start-delivery', $order->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 20px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.3)'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="5" y="5" width="14" height="14" rx="2" ry="2"></rect>
                                        <polyline points="9 9 15 9 15 15 9 15"></polyline>
                                    </svg>
                                    Start Delivery
                                </button>
                            </form>
                        @endif

                        <button onclick="confirmAction('Confirm Delivery', 'Have you successfully delivered this order to the customer?', '{{ route('driver.confirm-delivery', $order->id) }}')" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px 20px; background: linear-gradient(135deg, #16a34a, #059669); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(22, 163, 74, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(22, 163, 74, 0.3)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Confirm Delivery
                        </button>
                    </div>

                </div>
            </div>
        @empty
            <div style="background: white; border-radius: 16px; padding: 48px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <span style="font-size: 64px; display: block; margin-bottom: 16px;">🎯</span>
                <h3 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 800; color: #1e293b;">No Active Deliveries</h3>
                <p style="margin: 0; color: #64748b; font-size: 14px;">Accept and pick up orders to start delivering.</p>
            </div>
        @endforelse
    </div>
    @endif

    <!-- Delivery History Section -->
    <div style="margin-top: 32px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h2 style="margin: 0; font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 24px;">📜</span>
                Recent Delivery History
            </h2>
            <span style="background: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">{{ $deliveryHistory->count() }} orders</span>
        </div>

        @forelse($deliveryHistory as $order)
            <div style="background: white; border-radius: 12px; padding: 16px 20px; margin-bottom: 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 44px; height: 44px; background: #dcfce7; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #1e293b; font-size: 14px; margin-bottom: 2px;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</div>
                        <div style="font-size: 12px; color: #64748b;">{{ $order->customer->name ?? 'Customer' }} • Delivered {{ $order->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: 800; color: #16a34a; font-size: 16px;">${{ number_format($order->total_amount, 2) }}</div>
                    <div style="font-size: 11px; color: #94a3b8;">
                        @php
                            $isCOD = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery']);
                        @endphp
                        @if($isCOD)
                            💵 COD
                        @else
                            💳 Online
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="background: white; border-radius: 16px; padding: 48px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <span style="font-size: 64px; display: block; margin-bottom: 16px;">📋</span>
                <h3 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 800; color: #1e293b;">No Delivery History</h3>
                <p style="margin: 0; color: #64748b; font-size: 14px;">Complete deliveries to see your history here.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
