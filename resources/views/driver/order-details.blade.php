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
                                        <img src="{{ $imageUrl }}" alt="{{ $item->product->name }}">
                                    </a>
                                @else
                                    <span>No image</span>
                                @endif
                            </div>
                            <div>
                                <p class="od-item-name">{{ $item->product->name ?? 'Product unavailable' }}</p>
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
@endsection
