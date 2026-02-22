@extends('layouts.driver')

@section('page-title', 'Order Details')
@section('page-subtitle', 'Order #' . str_pad($order->id, 8, '0', STR_PAD_LEFT))

@section('content')

<div style="display: grid; grid-template-columns: 1fr 380px; gap: 24px;">

    <!-- Main Order Information -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

        <!-- Order Status Card -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <h2 style="margin: 0 0 8px 0; font-size: 20px; font-weight: 800; color: #1e293b;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</h2>
                    <p style="margin: 0; color: #64748b; font-size: 14px;">Placed {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                @php
                    $statusConfig = [
                        'ready_for_pickup' => ['label' => 'Ready for Pickup', 'color' => '#f59e0b', 'bg' => '#fef3c7'],
                        'assigned' => ['label' => 'Assigned to You', 'color' => '#f59e0b', 'bg' => '#fef3c7'],
                        'picked_up' => ['label' => 'Picked Up', 'color' => '#8b5cf6', 'bg' => '#ede9fe'],
                        'in_transit' => ['label' => 'In Transit', 'color' => '#06b6d4', 'bg' => '#ecfdf5'],
                        'delivered' => ['label' => 'Delivered', 'color' => '#16a34a', 'bg' => '#dcfce7'],
                    ];
                    $config = $statusConfig[$order->status] ?? ['label' => ucfirst($order->status), 'color' => '#64748b', 'bg' => '#f1f5f9'];
                @endphp
                <span style="background: {{ $config['bg'] }}; color: {{ $config['color'] }}; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 800; text-transform: uppercase;">
                    {{ $config['label'] }}
                </span>
            </div>

            <!-- Progress Steps -->
            <div style="display: flex; align-items: center; gap: 8px; margin-top: 24px;">
                @php
                    $steps = [
                        ['key' => 'ready_for_pickup', 'label' => 'Ready', 'icon' => '📦'],
                        ['key' => 'assigned', 'label' => 'Assigned', 'icon' => '🎯'],
                        ['key' => 'picked_up', 'label' => 'Picked Up', 'icon' => '🛍️'],
                        ['key' => 'in_transit', 'label' => 'In Transit', 'icon' => '🚚'],
                        ['key' => 'delivered', 'label' => 'Delivered', 'icon' => '✅'],
                    ];
                    $statusOrder = ['ready_for_pickup', 'assigned', 'picked_up', 'in_transit', 'delivered'];
                    $currentStepIndex = array_search($order->status, $statusOrder);
                    if ($currentStepIndex === false) $currentStepIndex = 0;
                @endphp

                @foreach($steps as $index => $step)
                    @if($index > 0)
                        <div style="flex: 1; height: 3px; background: {{ $index <= $currentStepIndex ? '#16a34a' : '#e2e8f0' }}; border-radius: 2px;"></div>
                    @endif
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 6px; min-width: 80px;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $index <= $currentStepIndex ? '#16a34a' : '#e2e8f0' }}; display: flex; align-items: center; justify-content: center; font-size: 18px; transition: all 0.3s;">
                            {{ $step['icon'] }}
                        </div>
                        <span style="font-size: 11px; font-weight: 700; color: {{ $index <= $currentStepIndex ? '#16a34a' : '#94a3b8' }}; text-transform: uppercase;">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Items -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 20px;">📦</span>
                Order Items ({{ $order->orderItems->count() }})
            </h3>

            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($order->orderItems as $item)
                    <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <div style="width: 80px; height: 80px; background: white; border-radius: 10px; overflow: hidden; flex-shrink: 0; border: 1px solid #e2e8f0;">
                            @php
                                $hasImage = $item->product && $item->product->images && $item->product->images->isNotEmpty();
                            @endphp
                            @if($hasImage)
                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8; font-size: 24px;">📦</div>
                            @endif
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 15px; margin-bottom: 4px;">{{ $item->product->name ?? 'Product Unavailable' }}</div>
                            <div style="color: #64748b; font-size: 13px; margin-bottom: 6px;">{{ $item->product->category->name ?? 'No Category' }}</div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="background: white; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; color: #1e293b; border: 1px solid #e2e8f0;">Qty: {{ $item->quantity }}</span>
                                <span style="font-weight: 700; color: #16a34a;">${{ number_format($item->price, 2) }} each</span>
                            </div>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700;">Total</div>
                            <div style="font-size: 20px; font-weight: 800; color: #16a34a;">${{ number_format($item->total, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px dashed #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; background: #f8fafc; border-radius: 12px; margin-bottom: 8px;">
                    <span style="color: #64748b; font-weight: 600;">Subtotal</span>
                    <span style="font-weight: 700; color: #1e293b;">${{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; background: #dcfce7; border-radius: 12px;">
                    <span style="color: #15803d; font-weight: 700;">Total Amount</span>
                    <span style="font-size: 24px; font-weight: 800; color: #16a34a;">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery Address -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 20px;">📍</span>
                Delivery Address
            </h3>
            <div style="display: flex; align-items: flex-start; gap: 16px; padding: 16px; background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 12px; border: 1px solid #bae6fd;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #60a5fa, #3b82f6); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 700; color: #0369a1; font-size: 15px; margin-bottom: 6px;">Customer Address</div>
                    <div style="color: #0284c7; font-size: 14px; line-height: 1.6;">{{ $order->delivery_address ?? $order->address ?? 'No address provided' }}</div>
                </div>
                <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" style="display: flex; align-items: center; gap: 6px; padding: 10px 16px; background: #0284c7; color: white; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px; white-space: nowrap; transition: all 0.2s;" onmouseover="this.style.background='#0369a1'" onmouseout="this.style.background='#0284c7'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                    </svg>
                    Get Directions
                </a>
            </div>
        </div>

    </div>

    <!-- Sidebar - Customer Info & Actions -->
    <div style="display: flex; flex-direction: column; gap: 24px;">

        <!-- Customer Card -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 20px;">👤</span>
                Customer Information
            </h3>

            <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 12px; border: 1px solid #fcd34d; margin-bottom: 16px;">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 22px; flex-shrink: 0;">
                    {{ strtoupper(substr($order->customer->name ?? 'C', 0, 1)) }}
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="font-weight: 800; color: #92400e; font-size: 16px; margin-bottom: 4px;">{{ $order->customer->name ?? 'Customer' }}</div>
                    <div style="color: #78350f; font-size: 13px;">📞 {{ $order->phone ?? $order->customer->phone_number ?? 'No phone' }}</div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <a href="tel:{{ $order->phone ?? $order->customer->phone_number }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #0284c7; color: white; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#0369a1'" onmouseout="this.style.background='#0284c7'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Call Customer
                </a>
                <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #0ea5e9; color: white; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#0284c7'" onmouseout="this.style.background='#0ea5e9'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                    </svg>
                    Navigate
                </a>
            </div>
        </div>

        <!-- Payment Info -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 20px;">💳</span>
                Payment Information
            </h3>

            @php
                $isCOD = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery']);
            @endphp

            <div style="padding: 16px; background: {{ $isCOD ? '#fef3c7' : '#dcfce7' }}; border-radius: 12px; border: 1px solid {{ $isCOD ? '#fcd34d' : '#6ee7b7' }}; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <span style="font-size: 24px;">{{ $isCOD ? '💵' : '💳' }}</span>
                    <div>
                        <div style="font-weight: 800; color: {{ $isCOD ? '#92400e' : '#047857' }}; font-size: 14px;">
                            {{ $isCOD ? 'Cash on Delivery' : 'Paid Online' }}
                        </div>
                        <div style="font-size: 12px; color: {{ $isCOD ? '#78350f' : '#059669' }};">
                            {{ $order->payment_status === 'paid' ? '✓ Payment Completed' : '⏳ Payment Pending' }}
                        </div>
                    </div>
                </div>
                <div style="font-size: 24px; font-weight: 800; color: {{ $isCOD ? '#b45309' : '#15803d' }};">
                    ${{ number_format($order->total_amount, 2) }}
                </div>
            </div>

            @if($isCOD)
                <div style="padding: 12px; background: #fef3c7; border-radius: 10px; border-left: 4px solid #f59e0b;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <span style="font-size: 16px;">⚠️</span>
                        <span style="font-weight: 700; color: #92400e; font-size: 13px;">Collect Cash on Delivery</span>
                    </div>
                    <p style="margin: 0; color: #78350f; font-size: 12px;">Remember to collect ${{ number_format($order->total_amount, 2) }} from the customer.</p>
                </div>
            @else
                <div style="padding: 12px; background: #dcfce7; border-radius: 10px; border-left: 4px solid #16a34a;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <span style="font-size: 16px;">✅</span>
                        <span style="font-weight: 700; color: #047857; font-size: 13px;">No Payment Required</span>
                    </div>
                    <p style="margin: 0; color: #059669; font-size: 12px;">Customer has already paid online. Just deliver the order.</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 20px;">⚡</span>
                Quick Actions
            </h3>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                @if($order->status === 'ready_for_pickup' && $order->driver_id === auth()->id())
                    <form action="{{ route('driver.confirm-pickup', $order->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(245, 158, 11, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            Confirm Pickup
                        </button>
                    </form>
                @endif

                @if($order->status === 'picked_up')
                    <form action="{{ route('driver.start-delivery', $order->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(139, 92, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.3)'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="5" y="5" width="14" height="14" rx="2" ry="2"></rect>
                                <polyline points="9 9 15 9 15 15 9 15"></polyline>
                            </svg>
                            Start Delivery
                        </button>
                    </form>
                @endif

                @if(in_array($order->status, ['picked_up', 'in_transit']))
                    <button onclick="confirmAction('Confirm Delivery', 'Have you successfully delivered this order to the customer?', '{{ route('driver.confirm-delivery', $order->id) }}')" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 14px; background: linear-gradient(135deg, #16a34a, #059669); color: white; border: none; border-radius: 10px; font-weight: 800; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(22, 163, 74, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(22, 163, 74, 0.3)'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Confirm Delivery
                    </button>
                @endif

                <a href="{{ route('driver.dashboard') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #f1f5f9; color: #475569; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; text-align: center; transition: all 0.2s; border: 1px solid #e2e8f0;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#1e293b'" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

    </div>

</div>

@endsection
