@extends('layouts.driver')

@section('page-title', 'Order Details')
@section('page-subtitle', 'Order #' . str_pad($order->id, 8, '0', STR_PAD_LEFT))

@php
    $statusMeta = [
        'ready_for_pickup' => ['label' => 'Ready for Pickup', 'chip' => 'od-chip od-chip--pickup'],
        'assigned' => ['label' => 'Ready for Pickup', 'chip' => 'od-chip od-chip--pickup'],
        'picked_up' => ['label' => 'Out for Delivery', 'chip' => 'od-chip od-chip--delivery'],
        'in_transit' => ['label' => 'Out for Delivery', 'chip' => 'od-chip od-chip--delivery'],
        'out_for_delivery' => ['label' => 'Out for Delivery', 'chip' => 'od-chip od-chip--delivery'],
        'arrived' => ['label' => 'Arrived', 'chip' => 'od-chip od-chip--arrived'],
        'delivered' => ['label' => 'Delivered', 'chip' => 'od-chip od-chip--done'],
    ];

    $statusInfo = $statusMeta[$order->status] ?? ['label' => ucfirst(str_replace('_', ' ', $order->status)), 'chip' => 'od-chip'];

    $paymentMethod = strtolower((string) ($order->payment_method ?? ''));
    $isCod = in_array($paymentMethod, ['cod', 'cash', 'cash on delivery'], true);

    $customerName = $order->customer->name ?? 'Customer';
    $customerPhone = $order->phone ?? optional($order->customer)->phone_number;
    $address = $order->delivery_address ?? $order->address ?? 'No delivery address provided';
    $itemCount = $order->orderItems->sum('quantity');

    $normalizedStatus = $order->status;
    if (in_array($normalizedStatus, ['assigned'], true)) {
        $normalizedStatus = 'ready_for_pickup';
    }
    if (in_array($normalizedStatus, ['picked_up', 'in_transit'], true)) {
        $normalizedStatus = 'out_for_delivery';
    }

    $progressSteps = [
        ['key' => 'ready_for_pickup', 'label' => 'Pickup'],
        ['key' => 'out_for_delivery', 'label' => 'On Route'],
        ['key' => 'arrived', 'label' => 'Arrived'],
        ['key' => 'delivered', 'label' => 'Done'],
    ];

    $progressIndex = array_search($normalizedStatus, array_column($progressSteps, 'key'), true);
    if ($progressIndex === false) {
        $progressIndex = 0;
    }

    $isAssignedToMe = $order->driver_id === auth()->id();
    $canAccept = is_null($order->driver_id) && $order->status === 'ready_for_pickup';
    $canPickup = $isAssignedToMe && $order->status === 'ready_for_pickup';
    $canArrive = $isAssignedToMe && $order->status === 'out_for_delivery';
    $canDeliver = $isAssignedToMe && in_array($order->status, ['out_for_delivery', 'arrived', 'picked_up', 'in_transit'], true);

    $primaryAction = null;
    if ($canAccept) {
        $primaryAction = ['type' => 'form', 'action' => route('driver.accept-order', $order->id), 'label' => 'Accept Order', 'class' => 'od-btn od-btn--success'];
    } elseif ($canPickup) {
        $primaryAction = ['type' => 'form', 'action' => route('driver.confirm-pickup', $order->id), 'label' => 'Confirm Pickup', 'class' => 'od-btn od-btn--primary'];
    } elseif ($canArrive) {
        $primaryAction = ['type' => 'form', 'action' => route('driver.confirm-arrival', $order->id), 'label' => 'Mark Arrived', 'class' => 'od-btn od-btn--primary'];
    } elseif ($canDeliver) {
        $primaryAction = ['type' => 'confirm', 'action' => route('driver.confirm-delivery', $order->id), 'label' => 'Confirm Delivery', 'class' => 'od-btn od-btn--success'];
    }
@endphp

@push('styles')
<style>
    .od-page {
        display: grid;
        gap: 14px;
        padding-bottom: 120px;
    }

    .od-card {
        background: #ffffff;
        border: 1px solid #dbe6f7;
        border-radius: 16px;
        box-shadow: 0 18px 34px -28px rgba(15, 42, 95, 0.6);
    }

    .od-hero {
        overflow: hidden;
        border-radius: 18px;
        border: 1px solid #bed2f2;
        background:
            radial-gradient(80% 120% at 100% -20%, rgba(249, 115, 22, 0.35), transparent 60%),
            linear-gradient(160deg, #1848a1 0%, #2563eb 85%);
        color: #ffffff;
    }

    .od-hero-content {
        padding: 14px;
        display: grid;
        gap: 12px;
    }

    .od-hero-top {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
    }

    .od-back-link {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .od-order-no {
        margin: 0;
        font-size: 23px;
        line-height: 1.2;
        font-weight: 800;
    }

    .od-order-meta {
        margin: 6px 0 0;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.88);
        font-weight: 600;
    }

    .od-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 6px 11px;
        font-size: 11px;
        font-weight: 800;
        line-height: 1.25;
        text-transform: uppercase;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .od-chip--pickup {
        background: #ffedd5;
        border-color: #fed7aa;
        color: #9a3412;
    }

    .od-chip--delivery {
        background: #dbeafe;
        border-color: #bfdbfe;
        color: #1d4ed8;
    }

    .od-chip--arrived {
        background: #ede9fe;
        border-color: #ddd6fe;
        color: #6d28d9;
    }

    .od-chip--done {
        background: #dcfce7;
        border-color: #bbf7d0;
        color: #166534;
    }

    .od-progress {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 7px;
    }

    .od-progress-step {
        display: grid;
        gap: 5px;
        justify-items: center;
    }

    .od-progress-dot {
        width: 12px;
        height: 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.35);
        border: 2px solid rgba(255, 255, 255, 0.42);
    }

    .od-progress-step.is-active .od-progress-dot,
    .od-progress-step.is-complete .od-progress-dot {
        background: #ffffff;
        border-color: #ffffff;
    }

    .od-progress-label {
        font-size: 10px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.86);
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .od-layout {
        display: grid;
        gap: 14px;
    }

    .od-main,
    .od-side {
        display: grid;
        gap: 14px;
    }

    .od-block {
        padding: 14px;
        display: grid;
        gap: 11px;
    }

    .od-title {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #12315f;
        letter-spacing: -0.1px;
    }

    .od-list-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .od-meta {
        border-radius: 10px;
        border: 1px solid #dce7f7;
        background: #f9fbff;
        padding: 9px;
    }

    .od-meta-label {
        margin: 0;
        color: #5a7094;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.45px;
    }

    .od-meta-value {
        margin: 3px 0 0;
        font-size: 14px;
        font-weight: 800;
        color: #12315f;
        line-height: 1.3;
        word-break: break-word;
    }

    .od-address {
        margin: 0;
        border-radius: 12px;
        border: 1px solid #d2e0f5;
        background: #f3f8ff;
        color: #1f4277;
        padding: 10px 11px;
        font-size: 13px;
        line-height: 1.45;
    }

    .od-customer {
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 12px;
        border: 1px solid #dce7f7;
        background: #f8fbff;
        padding: 10px;
    }

    .od-avatar {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: linear-gradient(140deg, #2563eb, #3b82f6);
        color: #ffffff;
        font-size: 16px;
        font-weight: 800;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .od-customer-name {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        color: #0f2a55;
        line-height: 1.3;
    }

    .od-customer-sub {
        margin: 2px 0 0;
        font-size: 12px;
        color: #4f678f;
        font-weight: 600;
        line-height: 1.35;
        word-break: break-word;
    }

    .od-items {
        display: grid;
        gap: 9px;
    }

    .od-item {
        display: grid;
        grid-template-columns: 56px minmax(0, 1fr) auto;
        gap: 9px;
        align-items: center;
        border-radius: 12px;
        border: 1px solid #dce7f7;
        background: #fbfdff;
        padding: 9px;
    }

    .od-item-thumb {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        border: 1px solid #d7e2f5;
        overflow: hidden;
        background: #f3f7ff;
        display: grid;
        place-items: center;
        color: #5a7094;
        font-size: 11px;
        font-weight: 700;
    }

    .od-item-thumb-link {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        overflow: hidden;
        display: block;
        transition: transform 0.18s ease;
    }

    .od-item-thumb-link:hover {
        transform: scale(1.04);
    }

    .od-item-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .od-item-name {
        margin: 0;
        font-size: 13px;
        font-weight: 800;
        color: #14315e;
        line-height: 1.35;
    }

    .od-item-sub {
        margin: 2px 0 0;
        font-size: 11px;
        color: #5a7194;
        font-weight: 600;
    }

    .od-item-total {
        text-align: right;
    }

    .od-item-total p {
        margin: 0;
    }

    .od-item-total .od-item-amount {
        color: #0f7a40;
        font-size: 14px;
        font-weight: 800;
    }

    .od-item-total .od-item-qty {
        color: #52698e;
        font-size: 11px;
        font-weight: 700;
        margin-top: 2px;
    }

    .od-actions {
        display: grid;
        gap: 8px;
    }

    .od-action-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .od-btn {
        width: 100%;
        border: 1px solid transparent;
        border-radius: 11px;
        padding: 11px;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.25;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .od-btn:focus-visible {
        outline: 2px solid #93c5fd;
        outline-offset: 1px;
    }

    .od-btn--primary {
        color: #ffffff;
        background: linear-gradient(135deg, #1f5ec6, #3b82f6);
        box-shadow: 0 14px 24px -20px rgba(31, 94, 198, 0.9);
    }

    .od-btn--success {
        color: #ffffff;
        background: linear-gradient(135deg, #0f9f4a, #16a34a);
        box-shadow: 0 14px 24px -20px rgba(15, 159, 74, 0.9);
    }

    .od-btn--soft {
        color: #1f4a8f;
        background: #ebf3ff;
        border-color: #c7daf8;
    }

    .od-btn--ghost {
        color: #4f6588;
        background: #ffffff;
        border-color: #d4dfef;
    }

    .od-btn--warn {
        color: #9a3412;
        background: #ffedd5;
        border-color: #fed7aa;
    }

    .od-mobile-cta {
        position: fixed;
        left: 12px;
        right: 12px;
        bottom: calc(80px + env(safe-area-inset-bottom));
        z-index: 65;
        display: none;
    }

    .od-mobile-cta .od-btn {
        border-radius: 14px;
        padding: 13px;
        font-size: 14px;
        box-shadow: 0 18px 34px -24px rgba(15, 42, 95, 0.9);
    }

    @media (min-width: 900px) {
        .od-page {
            padding-bottom: 16px;
        }

        .od-layout {
            grid-template-columns: minmax(0, 1fr) 340px;
            align-items: start;
        }

        .od-side {
            position: sticky;
            top: 92px;
        }
    }

    @media (max-width: 1024px) {
        .od-mobile-cta {
            display: block;
        }

        .od-desktop-actions {
            display: none;
        }
    }

    @media (min-width: 1025px) {
        .od-mobile-cta {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="od-page">
    <section class="od-hero">
        <div class="od-hero-content">
            <div class="od-hero-top">
                <div>
                    <a href="{{ route('driver.dashboard') }}" class="od-back-link">Back to dashboard</a>
                    <h2 class="od-order-no">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</h2>
                    <p class="od-order-meta">Placed {{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <span class="{{ $statusInfo['chip'] }}">{{ $statusInfo['label'] }}</span>
            </div>

            <div class="od-progress">
                @foreach($progressSteps as $index => $step)
                    @php
                        $stepClass = '';
                        if ($index < $progressIndex) {
                            $stepClass = 'is-complete';
                        } elseif ($index === $progressIndex) {
                            $stepClass = 'is-active';
                        }
                    @endphp
                    <div class="od-progress-step {{ $stepClass }}">
                        <span class="od-progress-dot"></span>
                        <span class="od-progress-label">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="od-layout">
        <div class="od-main">
            <section class="od-card od-block">
                <h3 class="od-title">Delivery Summary</h3>

                <div class="od-customer">
                    <div class="od-avatar">{{ strtoupper(substr($customerName, 0, 1)) }}</div>
                    <div>
                        <p class="od-customer-name">{{ $customerName }}</p>
                        <p class="od-customer-sub">{{ $customerPhone ?: 'No phone available' }}</p>
                    </div>
                </div>

                <p class="od-address">{{ $address }}</p>

                @if($order->delivery_notes)
                    <div style="margin-top: 16px; padding: 16px; background: linear-gradient(135deg, #fef3c7, #fde68a); border: 2px solid #f59e0b; border-radius: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 10px;">
                            <span style="font-size: 24px;">📝</span>
                            <div>
                                <p style="margin: 0; font-size: 13px; font-weight: 800; color: #b45309; text-transform: uppercase;">Delivery Instructions</p>
                                <p style="margin: 6px 0 0 0; font-size: 14px; color: #92400e; line-height: 1.6; font-weight: 600;">
                                    {{ $order->delivery_notes }}
                                </p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px; padding-top: 10px; border-top: 1px dashed #fcd34d;">
                            <span style="font-size: 16px;">💡</span>
                            <p style="margin: 0; font-size: 12px; color: #b45309; font-style: italic; font-weight: 600;">
                                Please follow these delivery instructions carefully
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Leaflet Map for Delivery Destination -->
                @if($order->latitude && $order->longitude)
                <div class="od-card od-block" style="margin-top: 16px; overflow: hidden;">
                    <h3 class="od-title" style="margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; color: #7c3aed;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Delivery Destination
                    </h3>

                    <div class="map-container-wrapper">
                        <div id="delivery-map"></div>
                        
                        <!-- Fullscreen Controls -->
                        <div class="fullscreen-controls" id="fullscreen-controls" style="display: none;">
                            <div class="fullscreen-actions">
                                @if(in_array($order->status, ['out_for_delivery', 'arrived']))
                                <button class="fs-btn fs-btn-deliver" onclick="confirmDeliveryFromFullscreen()" title="Confirm Delivery">
                                    <span>✅</span>
                                    Confirm Delivery
                                </button>
                                @endif
                                
                                @if(in_array($order->status, ['out_for_delivery']))
                                <button class="fs-btn fs-btn-arrived" onclick="markArrivedFromFullscreen()" title="Mark Arrived">
                                    <span>📍</span>
                                    Mark Arrived
                                </button>
                                @endif
                            </div>
                            
                            <button class="fs-btn fs-btn-close" onclick="exitFullscreen()" title="Close Fullscreen">
                                <span>❌</span>
                                Close
                            </button>
                        </div>
                    </div>

                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
                        <button type="button" onclick="startNavigationWithGPS()"
                           style="flex: 1; min-width: 200px; display: flex; align-items: center; justify-content: center; gap: 8px; background: #16a34a; color: white; font-weight: 700; padding: 12px 20px; border-radius: 12px; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 6px rgba(22, 163, 74, 0.2); cursor: pointer;"
                           onmouseover="this.style.background='#15803d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(22, 163, 74, 0.3)'"
                           onmouseout="this.style.background='#16a34a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(22, 163, 74, 0.2)'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                            Start Navigation
                        </button>

                        @if($order->phone)
                        <a href="tel:{{ $order->phone }}"
                           style="display: flex; align-items: center; gap: 8px; background: #f1f5f9; color: #1e293b; font-weight: 700; padding: 12px 20px; border-radius: 12px; text-decoration: none; transition: all 0.2s; border: 2px solid #e2e8f0;"
                           onmouseover="this.style.background='#e2e8f9'; this.style.borderColor='#cbd5e1'"
                           onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f9'">
                            <span style="font-size: 18px;">📞</span>
                            Call Customer
                        </a>
                        @endif
                    </div>

                    <script>
                    function startNavigationWithGPS() {
                        const customerLat = {{ $order->latitude ?? 'null' }};
                        const customerLng = {{ $order->longitude ?? 'null' }};
                        
                        if (!customerLat || !customerLng) {
                            Swal.fire({
                                icon: 'error',
                                title: 'No Destination',
                                text: 'Customer location is not available',
                                confirmButtonColor: '#10b981'
                            });
                            return;
                        }
                        
                        // Try to get real-time GPS location
                        if (navigator.geolocation) {
                            const btn = event.currentTarget;
                            const originalText = btn.innerHTML;
                            btn.disabled = true;
                            btn.innerHTML = '<span>⏳</span> Getting GPS...';
                            
                            navigator.geolocation.getCurrentPosition(
                                (position) => {
                                    const driverLat = position.coords.latitude;
                                    const driverLng = position.coords.longitude;
                                    
                                    // Open Google Maps with BOTH start and end points
                                    const googleMapsUrl = `https://www.google.com/maps/dir/${driverLat},${driverLng}/${customerLat},${customerLng}`;
                                    window.open(googleMapsUrl, '_blank');
                                    
                                    btn.disabled = false;
                                    btn.innerHTML = originalText;
                                },
                                (error) => {
                                    // Fallback to saved location if GPS fails
                                    const driverLat = {{ auth()->user()->latitude ?? 'null' }};
                                    const driverLng = {{ auth()->user()->longitude ?? 'null' }};
                                    
                                    if (driverLat && driverLng) {
                                        const googleMapsUrl = `https://www.google.com/maps/dir/${driverLat},${driverLng}/${customerLat},${customerLng}`;
                                        window.open(googleMapsUrl, '_blank');
                                    } else {
                                        // Just open destination if no driver location
                                        const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${customerLat},${customerLng}`;
                                        window.open(googleMapsUrl, '_blank');
                                    }
                                    
                                    btn.disabled = false;
                                    btn.innerHTML = originalText;
                                    
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'GPS Unavailable',
                                        text: 'Using saved location. Enable GPS for accurate navigation.',
                                        confirmButtonColor: '#f59e0b',
                                        timer: 3000,
                                        timerProgressBar: true
                                    });
                                },
                                {
                                    enableHighAccuracy: true,
                                    timeout: 10000,
                                    maximumAge: 0
                                }
                            );
                        } else {
                            // Browser doesn't support geolocation
                            Swal.fire({
                                icon: 'error',
                                title: 'GPS Not Supported',
                                text: 'Your browser does not support geolocation',
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    }
                    </script>
                </div>
                @endif

                <!-- Status Update Workflow -->
                <div class="od-card od-block" style="margin-top: 16px;">
                    <h3 class="od-title" style="margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                        🚚 Update Delivery Status
                    </h3>
                    
                    <form action="{{ route('driver.order.update-status', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 12px;">
                        @csrf
                        @method('PATCH')
                        
                        @if(in_array($order->status, ['pending', 'preparing', 'ready_for_pickup', 'assigned']))
                            <button type="submit" name="status" value="picked_up" 
                                    style="width: 100%; background: #2563eb; color: white; font-weight: 700; padding: 14px 20px; border-radius: 12px; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);"
                                    onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(37, 99, 235, 0.3)'"
                                    onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(37, 99, 235, 0.2)'">
                                📦 Mark as Picked Up
                            </button>
                        @else
                            <button type="button" disabled 
                                    style="width: 100%; background: #f1f5f9; color: #94a3b8; font-weight: 700; padding: 14px 20px; border-radius: 12px; border: 2px solid #e2e8f0; cursor: not-allowed; text-align: center;">
                                ✓ Picked Up
                            </button>
                        @endif

                        @if($order->status == 'picked_up')
                            <button type="submit" name="status" value="out_for_delivery" 
                                    style="width: 100%; background: #f97316; color: white; font-weight: 700; padding: 14px 20px; border-radius: 12px; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.2);"
                                    onmouseover="this.style.background='#ea580c'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(249, 115, 22, 0.3)'"
                                    onmouseout="this.style.background='#f97316'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(249, 115, 22, 0.2)'">
                                🛵 Out for Delivery
                            </button>
                        @elseif(in_array($order->status, ['out_for_delivery', 'arrived', 'delivered', 'completed']))
                            <button type="button" disabled 
                                    style="width: 100%; background: #f1f5f9; color: #94a3b8; font-weight: 700; padding: 14px 20px; border-radius: 12px; border: 2px solid #e2e8f0; cursor: not-allowed; text-align: center;">
                                ✓ Out for Delivery
                            </button>
                        @endif

                        @if(in_array($order->status, ['out_for_delivery', 'arrived']))
                            <button type="submit" name="status" value="completed" 
                                    style="width: 100%; background: #16a34a; color: white; font-weight: 700; padding: 14px 20px; border-radius: 12px; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(22, 163, 74, 0.2);"
                                    onmouseover="this.style.background='#15803d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px rgba(22, 163, 74, 0.3)'"
                                    onmouseout="this.style.background='#16a34a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(22, 163, 74, 0.2)'">
                                ✅ Mark as Completed
                            </button>
                        @elseif($order->status == 'completed')
                            <div style="width: 100%; background: #f0fdf4; border: 2px solid #bbf7d0; color: #16a34a; text-align: center; font-weight: 700; padding: 14px 20px; border-radius: 12px;">
                                🎉 Delivery Completed Successfully!
                            </div>
                        @endif

                    </form>
                </div>

                <div class="od-list-grid">
                    <div class="od-meta">
                        <p class="od-meta-label">Items</p>
                        <p class="od-meta-value">{{ $itemCount }}</p>
                    </div>
                    <div class="od-meta">
                        <p class="od-meta-label">Order Total</p>
                        <p class="od-meta-value">${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    <div class="od-meta">
                        <p class="od-meta-label">Payment</p>
                        <p class="od-meta-value">{{ $isCod ? 'Cash on Delivery' : 'Paid Online' }}</p>
                    </div>
                    <div class="od-meta">
                        <p class="od-meta-label">Payment Status</p>
                        <p class="od-meta-value">{{ ucfirst($order->payment_status ?? 'unknown') }}</p>
                    </div>
                </div>
            </section>

            <section class="od-card od-block">
                <h3 class="od-title">Order Items</h3>
                <div class="od-items">
                    @foreach($order->orderItems as $item)
                        @php
                            $product = $item->product;
                            $productImagePath = null;

                            if ($product && $product->productImages && $product->productImages->isNotEmpty()) {
                                $productImagePath = $product->productImages->first()->image_path;
                            } elseif ($product && !empty($product->image)) {
                                $productImagePath = $product->image;
                            }

                            $imageUrl = null;
                            if (!empty($productImagePath)) {
                                if (\Illuminate\Support\Str::startsWith($productImagePath, ['http://', 'https://'])) {
                                    $imageUrl = $productImagePath;
                                } elseif (\Illuminate\Support\Str::startsWith($productImagePath, 'storage/')) {
                                    $imageUrl = asset($productImagePath);
                                } else {
                                    $imageUrl = asset('storage/' . $productImagePath);
                                }
                            }

                            $hasImage = !empty($imageUrl);
                        @endphp
                        <div class="od-item">
                            <div class="od-item-thumb">
                                @if($hasImage)
                                    <a href="{{ $imageUrl }}" target="_blank" rel="noopener" class="od-item-thumb-link" title="Open product image">
                                        <img src="{{ $imageUrl }}" alt="{{ $item->product->translated_name }}">
                                    </a>
                                @else
                                    <span>No image</span>
                                @endif
                            </div>
                            <div>
                                <p class="od-item-name">{{ $item->product->translated_name ?? 'Product unavailable' }}</p>
                                <p class="od-item-sub">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <div class="od-item-total">
                                <p class="od-item-amount">${{ number_format($item->total, 2) }}</p>
                                <p class="od-item-qty">Qty {{ $item->quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <aside class="od-side">
            <section class="od-card od-block">
                <h3 class="od-title">Quick Tools</h3>
                <div class="od-actions">
                    <div class="od-action-row">
                        <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" rel="noopener" class="od-btn od-btn--soft">🗺️ Directions</a>
                        <a href="{{ route('driver.contact-customer', $order->id) }}" class="od-btn od-btn--soft">📞 Contact</a>
                    </div>

                    @if($order->latitude && $order->longitude)
                        <div style="margin-top: 8px; padding: 10px; background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 10px;">
                            <p style="margin: 0 0 6px 0; font-size: 11px; font-weight: 700; color: #0369a1; text-transform: uppercase;">📍 GPS Coordinates</p>
                            <p style="margin: 0; font-size: 12px; color: #0c4a6e; font-weight: 600;">
                                Lat: {{ number_format($order->latitude, 6) }}, Lng: {{ number_format($order->longitude, 6) }}
                            </p>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{$order->latitude}},{{$order->longitude}}"
                               target="_blank"
                               rel="noopener"
                               style="display: inline-block; margin-top: 6px; font-size: 11px; color: #0284c7; text-decoration: none; font-weight: 700;">
                                Open in Google Maps →
                            </a>
                        </div>
                    @endif

                    @if($order->delivery_notes)
                        <div style="margin-top: 12px; padding: 14px; background: linear-gradient(135deg, #fef3c7, #fde68a); border: 2px solid #f59e0b; border-radius: 12px;">
                            <div style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 8px;">
                                <span style="font-size: 20px;">📝</span>
                                <div>
                                    <p style="margin: 0; font-size: 12px; font-weight: 800; color: #b45309; text-transform: uppercase;">Delivery Instructions</p>
                                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #92400e; line-height: 1.5; font-weight: 600;">
                                        {{ $order->delivery_notes }}
                                    </p>
                                </div>
                            </div>
                            <p style="margin: 8px 0 0 0; font-size: 11px; color: #b45309; font-style: italic;">
                                💡 Please follow these delivery instructions carefully
                            </p>
                        </div>
                    @endif

                    <a href="{{ route('driver.dashboard') }}" class="od-btn od-btn--ghost">Back to Dashboard</a>
                </div>
            </section>

            <section class="od-card od-block od-desktop-actions">
                <h3 class="od-title">Actions</h3>
                <div class="od-actions">
                    @if($canAccept)
                        <form action="{{ route('driver.accept-order', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="od-btn od-btn--success">Accept Order</button>
                        </form>
                    @endif

                    @if($canPickup)
                        <form action="{{ route('driver.confirm-pickup', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="od-btn od-btn--primary">Confirm Pickup</button>
                        </form>
                    @endif

                    @if($canArrive)
                        <form action="{{ route('driver.confirm-arrival', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="od-btn od-btn--primary">Mark Arrived</button>
                        </form>
                    @endif

                    @if($canDeliver)
                        <button type="button" class="od-btn od-btn--success" onclick="confirmAction('Confirm Delivery', 'Mark this order as delivered?', '{{ route('driver.confirm-delivery', $order->id) }}')">Confirm Delivery</button>
                    @endif

                    @if(!$canAccept && !$canPickup && !$canArrive && !$canDeliver)
                        <span class="od-btn od-btn--warn">No pending action for this status</span>
                    @endif
                </div>
            </section>
        </aside>
    </div>
</div>

@if($primaryAction)
    <div class="od-mobile-cta">
        @if($primaryAction['type'] === 'form')
            <form action="{{ $primaryAction['action'] }}" method="POST">
                @csrf
                <button type="submit" class="{{ $primaryAction['class'] }}">{{ $primaryAction['label'] }}</button>
            </form>
        @else
            <button type="button" class="{{ $primaryAction['class'] }}" onclick="confirmAction('Confirm Delivery', 'Mark this order as delivered?', '{{ $primaryAction['action'] }}')">{{ $primaryAction['label'] }}</button>
        @endif
    </div>
@endif

@push('scripts')
<!-- Leaflet.js for Driver Map -->
@if($order->latitude && $order->longitude)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .map-controls {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .map-control-btn {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.2s;
    }

    .map-control-btn:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    .map-control-btn:active {
        transform: translateY(0);
    }

    .map-container-wrapper {
        position: relative;
        margin-top: 16px;
    }

    #delivery-map {
        width: 100%;
        height: 400px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
    }

    /* Fullscreen styles */
    #delivery-map:fullscreen {
        border-radius: 0;
        border: none;
    }

    .fullscreen-controls {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 20px;
        z-index: 10000;
        display: none;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        pointer-events: none;
    }

    #delivery-map:fullscreen ~ .fullscreen-controls,
    #delivery-map:fullscreen .fullscreen-controls {
        display: flex;
    }

    .fullscreen-actions {
        display: flex;
        gap: 12px;
        pointer-events: auto;
    }

    .fs-btn {
        background: white;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transition: all 0.2s;
    }

    .fs-btn-close {
        background: #ef4444;
        color: white;
    }

    .fs-btn-close:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .fs-btn-arrived {
        background: #f59e0b;
        color: white;
    }

    .fs-btn-arrived:hover {
        background: #d97706;
        transform: translateY(-2px);
    }

    .fs-btn-deliver {
        background: #10b981;
        color: white;
    }

    .fs-btn-deliver:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .live-tracking-indicator {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background: white;
        padding: 8px 12px;
        border-radius: 8px;
        border: 2px solid #10b981;
        display: none;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .live-tracking-indicator.active {
        display: flex;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.3); opacity: 0.7; }
    }

    .leaflet-routing-container {
        display: none !important;
    }

    .driver-marker-popup, .customer-marker-popup {
        text-align: center;
        min-width: 180px;
    }

    .route-distance-label {
        z-index: 1000 !important;
    }

    /* Fullscreen detection for controls */
    #delivery-map:-webkit-full-screen .fullscreen-controls {
        display: flex !important;
    }

    #delivery-map:-moz-full-screen .fullscreen-controls {
        display: flex !important;
    }

    #delivery-map:-ms-fullscreen .fullscreen-controls {
        display: flex !important;
    }

    #delivery-map:fullscreen .fullscreen-controls {
        display: flex !important;
    }
</style>

<script>
    let map;
    let driverMarker;
    let customerMarker;
    let routeControl;
    let liveTrackingInterval;
    let isLiveTracking = false;

    // Listen for fullscreen changes (ESC key)
    document.addEventListener('fullscreenchange', () => {
        const fullscreenControls = document.getElementById('fullscreen-controls');
        if (fullscreenControls) {
            if (document.fullscreenElement) {
                fullscreenControls.style.display = 'flex';
            } else {
                fullscreenControls.style.display = 'none';
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Coordinates
        const customerLat = {{ $order->latitude ?? 11.5564 }};
        const customerLng = {{ $order->longitude ?? 104.9282 }};
        let driverLat = {{ auth()->user()->latitude ?? 'null' }};
        let driverLng = {{ auth()->user()->longitude ?? 'null' }};

        // Initialize map
        map = L.map('delivery-map', {
            zoomControl: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add zoom control to bottom right
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // Add map control buttons
        const mapControls = document.createElement('div');
        mapControls.className = 'map-controls';
        mapControls.innerHTML = `
            <button class="map-control-btn" onclick="showMyLocation()" title="Show My Current Location">
                <span>📍</span>
                My Location
            </button>
            <button class="map-control-btn" onclick="toggleFullScreen()" title="Toggle Full Screen">
                <span>📺</span>
                Full Screen
            </button>
            <button class="map-control-btn" onclick="toggleLiveTracking()" title="Toggle Live Tracking">
                <span>🔄</span>
                Live Tracking
            </button>
            <button class="map-control-btn" onclick="showRoute()" title="Show Route">
                <span>🗺️</span>
                Show Route
            </button>
        `;
        document.querySelector('.map-container-wrapper').appendChild(mapControls);

        // Add live tracking indicator
        const trackingIndicator = document.createElement('div');
        trackingIndicator.className = 'live-tracking-indicator';
        trackingIndicator.id = 'tracking-indicator';
        trackingIndicator.innerHTML = `
            <span class="pulse-dot"></span>
            <span style="font-size: 11px; font-weight: 700; color: #10b981;">LIVE TRACKING</span>
        `;
        document.querySelector('.map-container-wrapper').appendChild(trackingIndicator);

        // Set initial view
        if (driverLat !== null && driverLng !== null) {
            map.setView([driverLat, driverLng], 13);
        } else {
            map.setView([customerLat, customerLng], 14);
        }

        // Add customer marker
        const customerIcon = L.divIcon({
            html: '<div style="background: #7c3aed; border: 3px solid white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 12px rgba(124,58,237,0.4);">🏠</div>',
            className: 'customer-marker',
            iconSize: [36, 36],
            iconAnchor: [18, 18]
        });

        customerMarker = L.marker([customerLat, customerLng], { icon: customerIcon }).addTo(map);
        customerMarker.bindPopup(`
            <div class="customer-marker-popup">
                <div style="background: linear-gradient(135deg, #7c3aed, #6d28d9); color: white; padding: 8px; border-radius: 8px 8px 0 0; margin: -12px -12px 10px -12px;">
                    <strong style="font-size: 14px;">📍 Delivery Destination</strong>
                </div>
                <span style="font-size: 12px; color: #64748b; display: block; margin-bottom: 4px;">{{ $order->customer->name ?? "Customer" }}</span>
                <span style="font-size: 11px; color: #94a3b8;">{{ $address }}</span>
                <a href="https://www.google.com/maps/dir/?api=1&destination=${customerLat},${customerLng}" 
                   target="_blank" 
                   style="display: inline-block; margin-top: 8px; font-size: 11px; color: #3b82f6; text-decoration: none; font-weight: 700;">
                    Navigate Here →
                </a>
            </div>
        `);

        // Add driver marker if location available
        if (driverLat !== null && driverLng !== null) {
            updateDriverMarker(driverLat, driverLng);
            showRoute();
        }

        // Add circle around customer location
        L.circle([customerLat, customerLng], {
            color: '#7c3aed',
            fillColor: '#a855f7',
            fillOpacity: 0.15,
            radius: 100
        }).addTo(map);
    });

    // Update driver marker position
    function updateDriverMarker(lat, lng) {
        const driverIcon = L.divIcon({
            html: '<div style="background: #10b981; border: 3px solid white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 12px rgba(16,185,129,0.4);">🚚</div>',
            className: 'driver-marker',
            iconSize: [36, 36],
            iconAnchor: [18, 18]
        });

        if (driverMarker) {
            driverMarker.setLatLng([lat, lng]);
        } else {
            driverMarker = L.marker([lat, lng], { icon: driverIcon }).addTo(map);
        }

        driverMarker.bindPopup(`
            <div class="driver-marker-popup">
                <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 8px; border-radius: 8px 8px 0 0; margin: -12px -12px 10px -12px;">
                    <strong style="font-size: 14px;">🚚 Your Location</strong>
                </div>
                <span style="font-size: 11px; color: #94a3b8;">{{ auth()->user()->name }}</span>
                <span style="font-size: 10px; color: #cbd5e1; display: block; margin-top: 4px;">{{ auth()->user()->location_updated_at?->diffForHumans() ?? "Just now" }}</span>
            </div>
        `);
    }

    // Show my current location
    function showMyLocation() {
        if (!navigator.geolocation) {
            Swal.fire({
                icon: 'error',
                title: 'Not Supported',
                text: 'Geolocation is not supported by your browser',
                confirmButtonColor: '#10b981'
            });
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                updateDriverMarker(lat, lng);
                Swal.fire({
                    icon: 'success',
                    title: 'Location Found! ✅',
                    text: 'Your current location is now displayed on the map.',
                    confirmButtonColor: '#10b981',
                    timer: 2500,
                    timerProgressBar: true
                });
            },
            (error) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Location Error',
                    text: 'Unable to get your location. Please enable location services.',
                    confirmButtonColor: '#f59e0b'
                });
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    // Toggle full screen
    function toggleFullScreen() {
        const mapContainer = document.getElementById('delivery-map');
        const fullscreenControls = document.getElementById('fullscreen-controls');
        
        if (!document.fullscreenElement) {
            mapContainer.requestFullscreen().then(() => {
                map.invalidateSize();
                if (fullscreenControls) {
                    fullscreenControls.style.display = 'flex';
                }
            }).catch(err => {
                console.error('Error attempting to enable fullscreen:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Fullscreen Error',
                    text: 'Unable to enter fullscreen mode',
                    confirmButtonColor: '#10b981'
                });
            });
        } else {
            exitFullscreen();
        }
    }

    // Exit fullscreen
    function exitFullscreen() {
        if (document.fullscreenElement) {
            document.exitFullscreen().then(() => {
                const fullscreenControls = document.getElementById('fullscreen-controls');
                if (fullscreenControls) {
                    fullscreenControls.style.display = 'none';
                }
                map.invalidateSize();
            }).catch(err => {
                console.error('Error attempting to exit fullscreen:', err);
            });
        }
    }

    // Mark arrived from fullscreen
    function markArrivedFromFullscreen() {
        Swal.fire({
            icon: 'question',
            title: 'Mark Arrived?',
            text: 'Confirm that you have arrived at the customer location?',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Mark Arrived',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form to mark arrived
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("driver.confirm-arrival", $order->id) }}';
                form.innerHTML = '@csrf @method("POST")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Confirm delivery from fullscreen
    function confirmDeliveryFromFullscreen() {
        Swal.fire({
            icon: 'question',
            title: 'Confirm Delivery?',
            text: 'Mark this order as delivered?',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Confirm Delivery',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form to confirm delivery
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("driver.confirm-delivery", $order->id) }}';
                form.innerHTML = '@csrf @method("POST")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Toggle live tracking
    function toggleLiveTracking() {
        const indicator = document.getElementById('tracking-indicator');
        
        if (isLiveTracking) {
            // Stop tracking
            clearInterval(liveTrackingInterval);
            isLiveTracking = false;
            indicator.classList.remove('active');
            
            Swal.fire({
                icon: 'info',
                title: 'Live Tracking Paused ⏸️',
                text: 'Automatic location updates have been stopped.',
                confirmButtonColor: '#3b82f6',
                timer: 2000,
                timerProgressBar: true
            });
        } else {
            // Start tracking
            isLiveTracking = true;
            indicator.classList.add('active');
            
            // Update location immediately
            updateLiveLocation();
            
            // Then update every 10 seconds
            liveTrackingInterval = setInterval(updateLiveLocation, 10000);
            
            Swal.fire({
                icon: 'success',
                title: 'Live Tracking Started! 🔄',
                html: '<p>Your location will update every 10 seconds.</p><p style="font-size: 11px; color: #64748b; margin-top: 8px;">Keep this page open for continuous tracking.</p>',
                confirmButtonColor: '#10b981',
                timer: 3000,
                timerProgressBar: true
            });
        }
    }

    // Update live location
    function updateLiveLocation() {
        if (!navigator.geolocation) return;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                // Update marker
                updateDriverMarker(lat, lng);
                
                // Update route
                showRoute();
                
                // Center map on driver
                map.setView([lat, lng], 14);
                
                console.log('📍 Location updated:', new Date().toLocaleTimeString());
            },
            (error) => {
                console.error('❌ Location error:', error.message);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    // Show route with real roads
    function showRoute() {
        if (!driverMarker || !customerMarker) return;

        const driverLatLng = driverMarker.getLatLng();
        const customerLatLng = customerMarker.getLatLng();

        // Remove existing route
        if (routeControl) {
            map.removeControl(routeControl);
        }

        // Create new route
        routeControl = L.Routing.control({
            waypoints: [
                driverLatLng,
                customerLatLng
            ],
            routeWhileDragging: false,
            showAlternatives: false,
            fitSelectedRoutes: false,
            createMarker: function() { return null; },
            lineOptions: {
                styles: [
                    {
                        color: '#3b82f6',
                        opacity: 0.8,
                        weight: 5,
                        dashArray: '10, 10'
                    }
                ]
            },
            addWaypoints: false,
            draggableWaypoints: false,
            containerClassName: 'routing-machine-container'
        }).addTo(map);

        routeControl.on('routesfound', function(e) {
            const routes = e.routes;
            const summary = routes[0].summary;
            const distanceKm = (summary.totalDistance / 1000).toFixed(2);
            const timeMinutes = Math.round(summary.totalTime / 60);

            // Add distance label at midpoint
            const routeCoordinates = routes[0].coordinates;
            const midIndex = Math.floor(routeCoordinates.length / 2);
            const midPoint = routeCoordinates[midIndex];

            if (midPoint) {
                L.marker([midPoint.lat, midPoint.lng], {
                    icon: L.divIcon({
                        html: `<div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 800; white-space: nowrap; box-shadow: 0 2px 12px rgba(59,130,246,0.5); border: 3px solid white;">📍 ${distanceKm} km • ${timeMinutes} min</div>`,
                        className: 'route-distance-label',
                        iconSize: [120, 32],
                        iconAnchor: [60, 16]
                    }),
                    zIndexOffset: 1000
                }).addTo(map);
            }
        });
    }

    // Confirm action helper
    function confirmAction(title, text, url) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, confirm!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create and submit POST form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = '@csrf';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endif
@endpush
@endsection
