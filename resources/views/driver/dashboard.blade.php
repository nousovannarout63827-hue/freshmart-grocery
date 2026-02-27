@extends('layouts.driver')

@section('page-title', 'Driver Dashboard')
@section('page-subtitle', 'Phone-first workflow for faster deliveries')

@php
    $activeFilter = strtolower($filter ?? 'all');
    if ($activeFilter === 'assigned') {
        $activeFilter = 'pickup';
    }
    if (!in_array($activeFilter, ['all', 'active', 'pickup', 'available', 'history', 'report'], true)) {
        $activeFilter = 'all';
    }

    $showActive = in_array($activeFilter, ['all', 'active'], true);
    $showPickup = in_array($activeFilter, ['all', 'pickup'], true);
    $showAvailable = in_array($activeFilter, ['all', 'available'], true);
    $showHistory = in_array($activeFilter, ['all', 'history'], true);
    $showReport = $activeFilter === 'report';
@endphp

@push('styles')
<style>
    .driver-dashboard {
        display: grid;
        gap: 18px;
    }

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        padding: 18px;
        background:
            radial-gradient(90% 100% at 100% -10%, rgba(249, 115, 22, 0.32), transparent 58%),
            linear-gradient(155deg, #154197 0%, #1f5ec6 78%);
        color: #ffffff;
        box-shadow: 0 24px 45px -32px rgba(15, 42, 95, 0.7);
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 999px;
        right: -70px;
        bottom: -100px;
        background: rgba(255, 255, 255, 0.14);
        pointer-events: none;
    }

    .hero-kicker {
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.55px;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.88);
    }

    .hero-title {
        margin: 8px 0 5px;
        font-size: 23px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -0.2px;
        max-width: 320px;
    }

    .hero-subtitle {
        margin: 0;
        color: rgba(255, 255, 255, 0.84);
        font-size: 13px;
        line-height: 1.45;
        max-width: 340px;
    }

    .hero-metrics {
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .hero-metric {
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.28);
        background: rgba(255, 255, 255, 0.14);
        padding: 10px;
    }

    .hero-metric-label {
        margin: 0 0 3px;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.78);
        text-transform: uppercase;
        letter-spacing: 0.45px;
    }

    .hero-metric-value {
        margin: 0;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.1;
    }

    .dashboard-filters {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 2px;
        scrollbar-width: none;
    }

    .dashboard-filters::-webkit-scrollbar {
        display: none;
    }

    .filter-pill {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        border: 1px solid #d6e2f6;
        background: #ffffff;
        color: #325088;
        border-radius: 999px;
        padding: 9px 13px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .filter-pill-count {
        min-width: 19px;
        border-radius: 999px;
        background: #edf2ff;
        color: #28467f;
        font-size: 11px;
        font-weight: 800;
        text-align: center;
        line-height: 1.5;
        padding: 0 5px;
    }

    .filter-pill:hover {
        transform: translateY(-1px);
        border-color: #b4caf0;
        color: #1f3f78;
    }

    .filter-pill.is-active {
        background: linear-gradient(145deg, #eff5ff, #dfeafe);
        border-color: #9ebcf1;
        color: #1e478f;
        box-shadow: 0 10px 22px -18px rgba(21, 65, 151, 0.8);
    }

    .filter-pill.is-active .filter-pill-count {
        background: #1f5ec6;
        color: #ffffff;
    }

    .dashboard-section {
        display: grid;
        gap: 12px;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-title {
        margin: 0;
        font-size: 18px;
        line-height: 1.2;
        font-weight: 800;
        color: #102345;
        letter-spacing: -0.2px;
    }

    .section-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        border-radius: 999px;
        padding: 4px 9px;
        font-size: 12px;
        font-weight: 800;
        color: #1f4d9f;
        background: #e8f0ff;
        border: 1px solid #c8daf9;
    }

    .order-grid {
        display: grid;
        gap: 12px;
    }

    .order-card {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #dce6f7;
        box-shadow: 0 16px 32px -28px rgba(24, 64, 136, 0.7);
        overflow: hidden;
        animation: card-rise 0.45s ease both;
        animation-delay: calc(var(--stagger, 0) * 70ms);
    }

    .order-card::before {
        content: '';
        display: block;
        height: 4px;
        background: #9bb7e9;
    }

    .order-card--active::before {
        background: linear-gradient(90deg, #f97316, #fb923c);
    }

    .order-card--pickup::before {
        background: linear-gradient(90deg, #2563eb, #3b82f6);
    }

    .order-card--available::before {
        background: linear-gradient(90deg, #16a34a, #22c55e);
    }

    .order-card--history::before {
        background: linear-gradient(90deg, #475569, #64748b);
    }

    .order-content {
        padding: 12px;
        display: grid;
        gap: 11px;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: flex-start;
    }

    .order-no {
        margin: 0 0 4px;
        color: #48608a;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.42px;
    }

    .order-name {
        margin: 0;
        color: #102345;
        font-size: 16px;
        line-height: 1.25;
        font-weight: 800;
        word-break: break-word;
    }

    .status-chip {
        flex-shrink: 0;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 800;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }

    .status-chip--active {
        color: #9a3412;
        background: #ffedd5;
        border: 1px solid #fed7aa;
    }

    .status-chip--pickup {
        color: #1d4ed8;
        background: #dbeafe;
        border: 1px solid #bfdbfe;
    }

    .status-chip--available {
        color: #166534;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
    }

    .status-chip--history {
        color: #475569;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
    }

    .order-address {
        margin: 0;
        color: #304e80;
        background: #f4f8ff;
        border: 1px solid #d7e4fa;
        border-radius: 11px;
        padding: 9px 10px;
        font-size: 12px;
        line-height: 1.42;
    }

    .metric-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .metric-item {
        border-radius: 10px;
        border: 1px solid #e2e8f5;
        background: #fafcff;
        padding: 8px 9px;
    }

    .metric-label {
        margin: 0;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.45px;
        color: #5f7193;
        font-weight: 700;
    }

    .metric-value {
        margin: 3px 0 0;
        font-size: 14px;
        line-height: 1.3;
        color: #112a54;
        font-weight: 800;
    }

    .action-stack {
        display: grid;
        gap: 8px;
    }

    .action-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 7px;
    }

    .btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        text-decoration: none;
        border-radius: 10px;
        border: 1px solid transparent;
        padding: 10px;
        font-size: 12px;
        font-weight: 800;
        line-height: 1.2;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .btn:focus-visible {
        outline: 2px solid #93c5fd;
        outline-offset: 1px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1f5ec6, #3b82f6);
        color: #ffffff;
        box-shadow: 0 12px 24px -20px rgba(31, 94, 198, 0.85);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 22px -18px rgba(31, 94, 198, 0.9);
    }

    .btn-success {
        background: linear-gradient(135deg, #0f9f4a, #16a34a);
        color: #ffffff;
        box-shadow: 0 12px 24px -20px rgba(15, 159, 74, 0.82);
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 22px -18px rgba(15, 159, 74, 0.88);
    }

    .btn-soft {
        background: #edf4ff;
        border-color: #c8daf8;
        color: #245198;
    }

    .btn-soft:hover {
        background: #dfeeff;
        border-color: #afcaf3;
    }

    .btn-ghost {
        background: #ffffff;
        border-color: #d4deee;
        color: #536889;
    }

    .btn-ghost:hover {
        border-color: #bacadd;
        color: #324a6e;
        background: #f8fbff;
    }

    .section-empty {
        border-radius: 14px;
        border: 1px dashed #c8d8f0;
        padding: 16px;
        background: #f9fbff;
    }

    .section-empty h4 {
        margin: 0 0 4px;
        color: #1a3568;
        font-size: 14px;
        font-weight: 800;
    }

    .section-empty p {
        margin: 0;
        color: #5d7298;
        font-size: 12px;
        line-height: 1.4;
    }

    .report-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    }

    .report-card {
        border-radius: 14px;
        border: 1px solid #d7e4fa;
        background: #f8fbff;
        padding: 12px;
    }

    .report-card-label {
        margin: 0 0 5px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #5f7193;
        font-weight: 700;
    }

    .report-card-value {
        margin: 0;
        font-size: 19px;
        font-weight: 800;
        line-height: 1.2;
        color: #102345;
    }

    .report-card-note {
        margin: 5px 0 0;
        font-size: 11px;
        color: #59719a;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    .chart-wrap {
        border: 1px solid #dce7f8;
        border-radius: 14px;
        padding: 12px;
        background: #ffffff;
    }

    .chart-title {
        margin: 0 0 10px;
        font-size: 14px;
        font-weight: 800;
        color: #17366b;
    }

    .chart-helper {
        display: none;
        margin: -4px 0 8px;
        font-size: 10px;
        color: #6a7fa5;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .chart-scroll {
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .chart-bars {
        min-width: 520px;
        display: grid;
        grid-template-columns: repeat(var(--bars), minmax(28px, 1fr));
        align-items: end;
        gap: 8px;
        height: 170px;
    }

    .chart-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
    }

    .chart-bar {
        width: 100%;
        min-height: 4px;
        border-radius: 8px 8px 4px 4px;
        background: linear-gradient(180deg, #3b82f6, #1f5ec6);
        position: relative;
    }

    .chart-bar-month {
        background: linear-gradient(180deg, #14b8a6, #0f766e);
    }

    .chart-amount {
        position: absolute;
        top: -17px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 9px;
        font-weight: 800;
        color: #1d3f78;
        white-space: nowrap;
    }

    .chart-label {
        font-size: 10px;
        color: #5f7193;
        font-weight: 700;
        white-space: nowrap;
    }

    .leaderboard-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .leaderboard-card {
        border: 1px solid #dce7f8;
        border-radius: 14px;
        background: #ffffff;
        padding: 12px;
    }

    .leaderboard-title {
        margin: 0 0 10px;
        font-size: 14px;
        color: #17366b;
        font-weight: 800;
    }

    .leaderboard-list {
        display: grid;
        gap: 8px;
    }

    .leaderboard-row {
        border-radius: 10px;
        border: 1px solid #e3ebf8;
        background: #f8fbff;
        padding: 9px 10px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .leaderboard-row--me {
        border-color: #bcd3fb;
        background: #ebf3ff;
    }

    .leaderboard-rank {
        width: 20px;
        text-align: center;
        font-size: 11px;
        font-weight: 800;
        color: #2d4e87;
        flex-shrink: 0;
    }

    .leaderboard-name {
        margin: 0;
        font-size: 12px;
        font-weight: 800;
        color: #152d58;
        word-break: break-word;
    }

    .leaderboard-meta {
        margin: 1px 0 0;
        font-size: 10px;
        color: #5e7397;
    }

    @keyframes card-rise {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (min-width: 760px) {
        .dashboard-hero {
            padding: 20px;
        }

        .hero-metrics {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            max-width: 760px;
        }

        .order-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .driver-dashboard {
            gap: 14px;
        }

        .dashboard-hero {
            padding: 14px;
            border-radius: 16px;
        }

        .hero-title {
            font-size: 20px;
            max-width: none;
        }

        .hero-subtitle {
            font-size: 12px;
            max-width: none;
        }

        .hero-metrics {
            margin-top: 12px;
            gap: 8px;
        }

        .hero-metric {
            padding: 9px;
        }

        .hero-metric-value {
            font-size: 18px;
        }

        .filter-pill {
            padding: 8px 11px;
            font-size: 11px;
        }

        .section-title {
            font-size: 16px;
        }

        .section-count {
            min-width: 24px;
            padding: 3px 7px;
            font-size: 11px;
        }

        .order-content {
            padding: 11px;
        }

        .order-header {
            flex-direction: column;
            gap: 8px;
        }

        .status-chip {
            align-self: flex-start;
        }

        .order-name {
            font-size: 15px;
        }

        .metric-grid {
            grid-template-columns: 1fr;
        }

        .action-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .action-row .btn:last-child,
        .action-row span.btn:last-child {
            grid-column: 1 / -1;
        }

        .dashboard-section--report {
            gap: 10px;
        }

        .dashboard-section--report .section-head {
            align-items: flex-start;
            gap: 8px;
        }

        .report-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .leaderboard-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .report-card {
            padding: 10px;
            border-radius: 12px;
        }

        .report-card-value {
            font-size: 15px;
            line-height: 1.15;
        }

        .report-card-note {
            font-size: 10px;
        }

        .chart-wrap {
            padding: 9px;
            border-radius: 12px;
        }

        .chart-title {
            font-size: 12px;
            margin-bottom: 8px;
        }

        .chart-helper {
            display: block;
        }

        .chart-bars {
            min-width: 100% !important;
            grid-template-columns: repeat(var(--bars), minmax(14px, 1fr));
            height: 128px;
            gap: 4px;
        }

        .chart-col {
            gap: 5px;
        }

        .chart-amount {
            display: none;
        }

        .chart-label {
            font-size: 9px;
            letter-spacing: -0.1px;
        }

        .leaderboard-card {
            padding: 10px;
            border-radius: 12px;
        }

        .leaderboard-title {
            font-size: 13px;
            margin-bottom: 8px;
        }

        .leaderboard-row {
            align-items: flex-start;
            padding: 8px;
            gap: 8px;
        }

        .leaderboard-rank {
            width: 24px;
            font-size: 10px;
        }

        .leaderboard-meta {
            font-size: 9px;
        }
    }

    @media (max-width: 380px) {
        .report-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="driver-dashboard {{ $showReport ? 'driver-dashboard--report' : '' }}">
    <section class="dashboard-hero">
        <p class="hero-kicker">Dispatch board</p>
        <h2 class="hero-title">Stay in flow and clear deliveries faster</h2>
        <p class="hero-subtitle">Prioritized for phone use: active stops first, then pickup queue, then open jobs.</p>

        <div class="hero-metrics">
            <div class="hero-metric">
                <p class="hero-metric-label">Active</p>
                <p class="hero-metric-value">{{ $stats['active'] }}</p>
            </div>
            <div class="hero-metric">
                <p class="hero-metric-label">Pickup Queue</p>
                <p class="hero-metric-value">{{ $stats['to_pickup'] }}</p>
            </div>
            <div class="hero-metric">
                <p class="hero-metric-label">Open Jobs</p>
                <p class="hero-metric-value">{{ $stats['available'] }}</p>
            </div>
            <div class="hero-metric">
                <p class="hero-metric-label">Completed Today</p>
                <p class="hero-metric-value">{{ $stats['completed_today'] }}</p>
            </div>
        </div>
    </section>

    <nav class="dashboard-filters">
        <a href="{{ route('driver.dashboard') }}" class="filter-pill {{ $activeFilter === 'all' ? 'is-active' : '' }}">
            All
            <span class="filter-pill-count">{{ $stats['active'] + $stats['to_pickup'] + $stats['available'] }}</span>
        </a>
        <a href="{{ route('driver.dashboard', ['filter' => 'active']) }}" class="filter-pill {{ $activeFilter === 'active' ? 'is-active' : '' }}">
            Active
            <span class="filter-pill-count">{{ $stats['active'] }}</span>
        </a>
        <a href="{{ route('driver.dashboard', ['filter' => 'pickup']) }}" class="filter-pill {{ $activeFilter === 'pickup' ? 'is-active' : '' }}">
            Pickup
            <span class="filter-pill-count">{{ $stats['to_pickup'] }}</span>
        </a>
        <a href="{{ route('driver.dashboard', ['filter' => 'available']) }}" class="filter-pill {{ $activeFilter === 'available' ? 'is-active' : '' }}">
            Open
            <span class="filter-pill-count">{{ $stats['available'] }}</span>
        </a>
        <a href="{{ route('driver.dashboard', ['filter' => 'history']) }}" class="filter-pill {{ $activeFilter === 'history' ? 'is-active' : '' }}">
            History
            <span class="filter-pill-count">{{ $deliveryHistory->count() }}</span>
        </a>
        <a href="{{ route('driver.dashboard', ['filter' => 'report']) }}" class="filter-pill {{ $activeFilter === 'report' ? 'is-active' : '' }}">
            Report
            <span class="filter-pill-count">{{ $stats['month_deliveries'] ?? 0 }}</span>
        </a>
    </nav>

    @if($showActive)
        <section class="dashboard-section">
            <div class="section-head">
                <h3 class="section-title">Active Deliveries</h3>
                <span class="section-count">{{ $myActiveOrders->count() }}</span>
            </div>

            @if($myActiveOrders->isEmpty())
                <div class="section-empty">
                    <h4>No active deliveries</h4>
                    <p>Accept or pick up an order to begin your next route.</p>
                </div>
            @else
                <div class="order-grid">
                    @foreach($myActiveOrders as $order)
                        @php
                            $phone = $order->phone ?? optional($order->customer)->phone_number;
                            $address = $order->delivery_address ?? $order->address ?? 'No delivery address provided';
                            $isCod = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery'], true);
                        @endphp
                        <article class="order-card order-card--active" style="--stagger: {{ $loop->index }};">
                            <div class="order-content">
                                <div class="order-header">
                                    <div>
                                        <p class="order-no">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                                        <h4 class="order-name">{{ $order->customer->name ?? 'Guest Customer' }}</h4>
                                    </div>
                                    <span class="status-chip status-chip--active">{{ $order->status === 'arrived' ? 'Arrived' : 'On Route' }}</span>
                                </div>

                                <p class="order-address">{{ $address }}</p>

                                <div class="metric-grid">
                                    <div class="metric-item">
                                        <p class="metric-label">Items</p>
                                        <p class="metric-value">{{ $order->orderItems->sum('quantity') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Order Total</p>
                                        <p class="metric-value">${{ number_format($order->total_amount, 2) }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Payment</p>
                                        <p class="metric-value">{{ $isCod ? 'Cash on Delivery' : 'Paid Online' }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Updated</p>
                                        <p class="metric-value">{{ $order->updated_at->format('h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="action-stack">
                                    @if($order->status === 'out_for_delivery')
                                        <form action="{{ route('driver.confirm-arrival', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Mark as Arrived</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-success" onclick="confirmAction('Confirm Delivery', 'Mark this order as delivered?', '{{ route('driver.confirm-delivery', $order->id) }}')">Confirm Delivery</button>
                                    @endif

                                    <div class="action-row">
                                        <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" rel="noopener" class="btn btn-soft">Map</a>
                                        @if($phone)
                                            <a href="tel:{{ $phone }}" class="btn btn-soft">Call</a>
                                        @else
                                            <span class="btn btn-ghost">No Phone</span>
                                        @endif
                                        <a href="{{ route('driver.order.details', $order->id) }}" class="btn btn-ghost">Details</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    @if($showPickup)
        <section class="dashboard-section">
            <div class="section-head">
                <h3 class="section-title">Pickup Queue</h3>
                <span class="section-count">{{ $myToPickupOrders->count() }}</span>
            </div>

            @if($myToPickupOrders->isEmpty())
                <div class="section-empty">
                    <h4>No pickup tasks</h4>
                    <p>All picked up. Open jobs are ready below when you need the next order.</p>
                </div>
            @else
                <div class="order-grid">
                    @foreach($myToPickupOrders as $order)
                        @php
                            $phone = $order->phone ?? optional($order->customer)->phone_number;
                            $address = $order->delivery_address ?? $order->address ?? 'No delivery address provided';
                        @endphp
                        <article class="order-card order-card--pickup" style="--stagger: {{ $loop->index }};">
                            <div class="order-content">
                                <div class="order-header">
                                    <div>
                                        <p class="order-no">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                                        <h4 class="order-name">{{ $order->customer->name ?? 'Guest Customer' }}</h4>
                                    </div>
                                    <span class="status-chip status-chip--pickup">Ready to Pick Up</span>
                                </div>

                                <p class="order-address">{{ $address }}</p>

                                <div class="metric-grid">
                                    <div class="metric-item">
                                        <p class="metric-label">Items</p>
                                        <p class="metric-value">{{ $order->orderItems->sum('quantity') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Order Total</p>
                                        <p class="metric-value">${{ number_format($order->total_amount, 2) }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Placed</p>
                                        <p class="metric-value">{{ $order->created_at->format('M d, h:i A') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Phone</p>
                                        <p class="metric-value">{{ $phone ?: 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="action-stack">
                                    <form action="{{ route('driver.confirm-pickup', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Confirm Pickup</button>
                                    </form>

                                    <div class="action-row">
                                        <a href="{{ route('driver.get-directions', $order->id) }}" target="_blank" rel="noopener" class="btn btn-soft">Map</a>
                                        @if($phone)
                                            <a href="tel:{{ $phone }}" class="btn btn-soft">Call</a>
                                        @else
                                            <span class="btn btn-ghost">No Phone</span>
                                        @endif
                                        <a href="{{ route('driver.order.details', $order->id) }}" class="btn btn-ghost">Details</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    @if($showAvailable)
        <section class="dashboard-section">
            <div class="section-head">
                <h3 class="section-title">Open Jobs</h3>
                <span class="section-count">{{ $availableOrders->count() }}</span>
            </div>

            @if($availableOrders->isEmpty())
                <div class="section-empty">
                    <h4>No open jobs right now</h4>
                    <p>Refresh later. New ready-for-pickup orders will appear here.</p>
                </div>
            @else
                <div class="order-grid">
                    @foreach($availableOrders as $order)
                        @php
                            $phone = $order->phone ?? optional($order->customer)->phone_number;
                            $address = $order->delivery_address ?? $order->address ?? 'No delivery address provided';
                            $isCod = in_array(strtolower($order->payment_method ?? ''), ['cod', 'cash', 'cash on delivery'], true);
                        @endphp
                        <article class="order-card order-card--available" style="--stagger: {{ $loop->index }};">
                            <div class="order-content">
                                <div class="order-header">
                                    <div>
                                        <p class="order-no">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                                        <h4 class="order-name">{{ $order->customer->name ?? 'Guest Customer' }}</h4>
                                    </div>
                                    <span class="status-chip status-chip--available">Ready</span>
                                </div>

                                <p class="order-address">{{ $address }}</p>

                                <div class="metric-grid">
                                    <div class="metric-item">
                                        <p class="metric-label">Items</p>
                                        <p class="metric-value">{{ $order->orderItems->sum('quantity') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Order Total</p>
                                        <p class="metric-value">${{ number_format($order->total_amount, 2) }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Payment</p>
                                        <p class="metric-value">{{ $isCod ? 'Cash on Delivery' : 'Paid Online' }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Placed</p>
                                        <p class="metric-value">{{ $order->created_at->format('M d, h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="action-stack">
                                    <form action="{{ route('driver.accept-order', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept Order</button>
                                    </form>

                                    <div class="action-row">
                                        @if($phone)
                                            <a href="tel:{{ $phone }}" class="btn btn-soft">Call</a>
                                        @else
                                            <span class="btn btn-ghost">No Phone</span>
                                        @endif
                                        <a href="{{ route('driver.contact-customer', $order->id) }}" class="btn btn-soft">Dial Link</a>
                                        <a href="{{ route('driver.order.details', $order->id) }}" class="btn btn-ghost">Details</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    @if($showHistory)
        <section class="dashboard-section">
            <div class="section-head">
                <h3 class="section-title">Recent History</h3>
                <span class="section-count">{{ $deliveryHistory->count() }}</span>
            </div>

            @if($deliveryHistory->isEmpty())
                <div class="section-empty">
                    <h4>No delivery history yet</h4>
                    <p>Your completed orders will show here.</p>
                </div>
            @else
                <div class="order-grid">
                    @foreach($deliveryHistory as $order)
                        @php
                            $address = $order->delivery_address ?? $order->address ?? 'No delivery address provided';
                        @endphp
                        <article class="order-card order-card--history" style="--stagger: {{ $loop->index }};">
                            <div class="order-content">
                                <div class="order-header">
                                    <div>
                                        <p class="order-no">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
                                        <h4 class="order-name">{{ $order->customer->name ?? 'Guest Customer' }}</h4>
                                    </div>
                                    <span class="status-chip status-chip--history">Delivered</span>
                                </div>

                                <p class="order-address">{{ $address }}</p>

                                <div class="metric-grid">
                                    <div class="metric-item">
                                        <p class="metric-label">Items</p>
                                        <p class="metric-value">{{ $order->orderItems->sum('quantity') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Order Total</p>
                                        <p class="metric-value">${{ number_format($order->total_amount, 2) }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Delivered At</p>
                                        <p class="metric-value">{{ $order->updated_at->format('M d, h:i A') }}</p>
                                    </div>
                                    <div class="metric-item">
                                        <p class="metric-label">Payment Status</p>
                                        <p class="metric-value">{{ ucfirst($order->payment_status ?? 'unknown') }}</p>
                                    </div>
                                </div>

                                <a href="{{ route('driver.order.details', $order->id) }}" class="btn btn-ghost">View Details</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    @if($showReport)
        <section class="dashboard-section dashboard-section--report">
            <div class="section-head">
                <h3 class="section-title">My Performance Report</h3>
                <span class="section-count">{{ $stats['month_deliveries'] ?? 0 }}</span>
            </div>

            <div class="report-grid">
                <article class="report-card">
                    <p class="report-card-label">Today</p>
                    <p class="report-card-value">{{ $performanceReport['today']['my_deliveries'] ?? 0 }} deliveries</p>
                    <p class="report-card-note">Earnings: ${{ number_format($performanceReport['today']['my_earnings'] ?? 0, 2) }}</p>
                </article>
                <article class="report-card">
                    <p class="report-card-label">This Month</p>
                    <p class="report-card-value">{{ $performanceReport['month']['my_deliveries'] ?? 0 }} deliveries</p>
                    <p class="report-card-note">Earnings: ${{ number_format($performanceReport['month']['my_earnings'] ?? 0, 2) }}</p>
                </article>
                <article class="report-card">
                    <p class="report-card-label">Rank Today</p>
                    <p class="report-card-value">{{ isset($performanceReport['today']['my_rank']) ? '#' . $performanceReport['today']['my_rank'] : 'N/A' }}</p>
                    <p class="report-card-note">Compared with all drivers today.</p>
                </article>
                <article class="report-card">
                    <p class="report-card-label">Rank This Month</p>
                    <p class="report-card-value">{{ isset($performanceReport['month']['my_rank']) ? '#' . $performanceReport['month']['my_rank'] : 'N/A' }}</p>
                    <p class="report-card-note">Commission rate: {{ number_format(config('app.driver_commission_rate', 0.10) * 100, 0) }}%</p>
                </article>
            </div>

            @php
                $dailyMax = max(1, (float) ($performanceReport['daily_max_earnings'] ?? 1));
                $monthlyMax = max(1, (float) ($performanceReport['monthly_max_earnings'] ?? 1));
            @endphp

            <div class="chart-wrap">
                <h4 class="chart-title">Earnings History by Day (Last 14 Days)</h4>
                <p class="chart-helper">Swipe to view all days</p>
                <div class="chart-scroll">
                    <div class="chart-bars" style="--bars: {{ count($performanceReport['daily_history'] ?? []) }};">
                        @foreach(($performanceReport['daily_history'] ?? []) as $point)
                            @php
                                $height = max(4, (int) round((($point['earnings'] ?? 0) / $dailyMax) * 130));
                            @endphp
                            <div class="chart-col">
                                <div class="chart-bar" style="height: {{ $height }}px;">
                                    @if(($point['earnings'] ?? 0) > 0)
                                        <span class="chart-amount">${{ number_format($point['earnings'], 0) }}</span>
                                    @endif
                                </div>
                                <span class="chart-label">{{ $point['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="chart-wrap">
                <h4 class="chart-title">Earnings History by Month (Last 6 Months)</h4>
                <p class="chart-helper">Swipe to view all months</p>
                <div class="chart-scroll">
                    <div class="chart-bars" style="--bars: {{ count($performanceReport['monthly_history'] ?? []) }}; min-width: 360px;">
                        @foreach(($performanceReport['monthly_history'] ?? []) as $point)
                            @php
                                $height = max(4, (int) round((($point['earnings'] ?? 0) / $monthlyMax) * 130));
                            @endphp
                            <div class="chart-col">
                                <div class="chart-bar chart-bar-month" style="height: {{ $height }}px;">
                                    @if(($point['earnings'] ?? 0) > 0)
                                        <span class="chart-amount">${{ number_format($point['earnings'], 0) }}</span>
                                    @endif
                                </div>
                                <span class="chart-label">{{ $point['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="leaderboard-grid">
                <article class="leaderboard-card">
                    <h4 class="leaderboard-title">Best Performance Today</h4>
                    <div class="leaderboard-list">
                        @forelse(($performanceReport['today']['leaderboard'] ?? []) as $index => $driver)
                            <div class="leaderboard-row {{ (int) $driver['id'] === (int) auth()->id() ? 'leaderboard-row--me' : '' }}">
                                <div class="leaderboard-rank">#{{ $index + 1 }}</div>
                                <div>
                                    <p class="leaderboard-name">{{ $driver['name'] }}</p>
                                    <p class="leaderboard-meta">{{ $driver['deliveries'] }} deliveries | ${{ number_format($driver['earnings'], 2) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="section-empty">
                                <h4>No daily data yet</h4>
                                <p>Daily ranking appears once deliveries are completed.</p>
                            </div>
                        @endforelse
                    </div>
                </article>

                <article class="leaderboard-card">
                    <h4 class="leaderboard-title">Best Performance This Month</h4>
                    <div class="leaderboard-list">
                        @forelse(($performanceReport['month']['leaderboard'] ?? []) as $index => $driver)
                            <div class="leaderboard-row {{ (int) $driver['id'] === (int) auth()->id() ? 'leaderboard-row--me' : '' }}">
                                <div class="leaderboard-rank">#{{ $index + 1 }}</div>
                                <div>
                                    <p class="leaderboard-name">{{ $driver['name'] }}</p>
                                    <p class="leaderboard-meta">{{ $driver['deliveries'] }} deliveries | ${{ number_format($driver['earnings'], 2) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="section-empty">
                                <h4>No monthly data yet</h4>
                                <p>Monthly ranking appears once deliveries are completed.</p>
                            </div>
                        @endforelse
                    </div>
                </article>
            </div>
        </section>
    @endif
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 for nice alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Auto Location Tracker for Driver Dashboard
    (function() {
        let autoLocationEnabled = false;
        const STORAGE_KEY = 'driver_auto_location_enabled';
        
        // Check if auto-tracking was previously enabled
        function wasAutoTrackingEnabled() {
            return localStorage.getItem(STORAGE_KEY) === 'true';
        }
        
        // Save auto-tracking preference
        function saveAutoTrackingPreference(enabled) {
            localStorage.setItem(STORAGE_KEY, enabled ? 'true' : 'false');
        }
        
        // Update driver location
        function updateDriverLocation(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            
            fetch('{{ route("driver.location.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    latitude: latitude,
                    longitude: longitude
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('✅ Location updated:', new Date().toLocaleTimeString());
                }
            })
            .catch(error => {
                console.error('❌ Location update failed:', error);
            });
        }
        
        // Get current location and update
        function getCurrentLocation() {
            if (!navigator.geolocation) {
                console.warn('Geolocation not supported');
                return;
            }
            
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    updateDriverLocation(position);
                },
                (error) => {
                    console.error('Geolocation error:', error.message);
                    if (error.code === 1 && autoLocationEnabled) {
                        // Permission denied - show notification
                        Swal.fire({
                            icon: 'warning',
                            title: 'Location Access Needed',
                            text: 'Please allow location access to enable automatic tracking.',
                            confirmButtonColor: '#10b981',
                            confirmButtonText: 'OK',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: true,
                            timer: 5000
                        });
                        autoLocationEnabled = false;
                        saveAutoTrackingPreference(false);
                    }
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 30000
                }
            );
        }
        
        // Start auto-tracking
        function startAutoTracking() {
            autoLocationEnabled = true;
            saveAutoTrackingPreference(true);
            
            // Get location immediately
            getCurrentLocation();
            
            // Then update every 30 seconds
            setInterval(getCurrentLocation, 30000);
            
            console.log('🔄 Auto location tracking started');
        }
        
        // Show location permission prompt on page load
        function showLocationPrompt() {
            const wasEnabled = wasAutoTrackingEnabled();
            
            if (wasEnabled) {
                // Auto-start if previously enabled
                startAutoTracking();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Location Tracking Active',
                    html: '<p>🔄 Your location is being updated automatically every 30 seconds.</p>',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            } else {
                // Ask user to enable
                Swal.fire({
                    icon: 'question',
                    title: 'Enable Auto Location Tracking?',
                    html: '<p style="font-size: 14px;">Automatically update your location every 30 seconds so customers can track their delivery.</p><p style="font-size: 12px; color: #64748b; margin-top: 8px;">This uses your device GPS.</p>',
                    showCancelButton: true,
                    confirmButtonText: '✅ Enable',
                    cancelButtonText: '❌ Not Now',
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#64748b',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        startAutoTracking();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Enabled! 🎉',
                            text: 'Your location will update automatically.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                    }
                });
            }
        }
        
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Wait 2 seconds then show prompt
            setTimeout(showLocationPrompt, 2000);
        });
        
        // Add location status indicator to page
        function addLocationStatusIndicator() {
            const heroSection = document.querySelector('.dashboard-hero');
            if (!heroSection) return;
            
            const indicator = document.createElement('div');
            indicator.style.cssText = `
                position: absolute;
                top: 18px;
                right: 18px;
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 12px;
                background: rgba(255, 255, 255, 0.18);
                border: 1px solid rgba(255, 255, 255, 0.32);
                border-radius: 20px;
                backdrop-filter: blur(8px);
            `;
            
            const dot = document.createElement('div');
            dot.id = 'location-status-dot';
            dot.style.cssText = `
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #fbbf24;
                transition: background 0.3s;
            `;
            
            const text = document.createElement('span');
            text.id = 'location-status-text';
            text.style.cssText = `
                font-size: 11px;
                font-weight: 700;
                color: white;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            `;
            text.textContent = 'GPS';
            
            indicator.appendChild(dot);
            indicator.appendChild(text);
            heroSection.appendChild(indicator);
        }
        
        // Update status indicator
        function updateLocationStatus(isActive) {
            const dot = document.getElementById('location-status-dot');
            const text = document.getElementById('location-status-text');
            
            if (!dot || !text) return;
            
            if (isActive) {
                dot.style.background = '#10b981';
                dot.style.boxShadow = '0 0 12px rgba(16, 185, 129, 0.6)';
                text.textContent = 'Tracking';
            } else {
                dot.style.background = '#fbbf24';
                dot.style.boxShadow = 'none';
                text.textContent = 'GPS';
            }
        }
        
        // Add indicator and update on tracking start
        addLocationStatusIndicator();
        const originalStartAutoTracking = startAutoTracking;
        startAutoTracking = function() {
            originalStartAutoTracking();
            updateLocationStatus(true);
        };
    })();
</script>
@endpush
