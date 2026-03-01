@extends('layouts.admin')

@section('content')
<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --secondary: #3b82f6;
        --danger: #ef4444;
        --warning: #f59e0b;
        --success: #10b981;
        --info: #06b6d4;
        --purple: #8b5cf6;
    }

    .reports-container {
        padding: 32px;
        background: #f1f5f9;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .filter-bar {
        background: white;
        padding: 20px 24px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        display: flex;
        gap: 16px;
        align-items: end;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .filter-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-input {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        background: #f8fafc;
        transition: all 0.2s;
    }

    .filter-input:focus {
        outline: none;
        border-color: var(--secondary);
        background: white;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    @media (max-width: 768px) {
        .reports-container {
            padding: 16px !important;
        }

        .page-title {
            font-size: 20px !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 8px !important;
        }

        .page-header {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 16px !important;
        }

        .page-header > div:last-child {
            flex-direction: column !important;
            width: 100% !important;
        }

        .page-header .btn {
            width: 100% !important;
            justify-content: center !important;
        }

        .filter-bar {
            flex-direction: column !important;
            padding: 16px !important;
            gap: 12px !important;
        }

        .filter-group {
            width: 100% !important;
        }

        .filter-input {
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .filter-buttons {
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 8px !important;
        }

        .filter-buttons .btn {
            width: 100% !important;
            justify-content: center !important;
        }

        .metrics-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        .metric-card {
            padding: 16px !important;
        }

        .metric-icon {
            font-size: 24px !important;
        }

        .metric-label {
            font-size: 12px !important;
        }

        .metric-value {
            font-size: 24px !important;
        }

        .charts-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        .content-grid {
            grid-template-columns: 1fr !important;
        }

        .side-panel {
            margin-top: 16px !important;
        }

        .chart-container {
            padding: 16px !important;
        }

        .chart-header h3 {
            font-size: 16px !important;
        }

        .table-wrapper {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }

        .reports-table {
            min-width: 700px !important;
        }

        .data-card {
            padding: 16px !important;
        }

        .mini-card {
            padding: 16px !important;
        }
    }

    @media (max-width: 375px) {
        .reports-container {
            padding: 12px !important;
        }

        .page-title {
            font-size: 18px !important;
        }

        .filter-label {
            font-size: 10px !important;
        }

        .filter-input {
            font-size: 13px !important;
            padding: 8px 12px !important;
        }
    }

    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--secondary), #2563eb);
        color: white;
        box-shadow: 0 2px 8px rgba(59,130,246,0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 2px 8px rgba(16,185,129,0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16,185,129,0.4);
    }

    .btn-pdf {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 2px 8px rgba(239,68,68,0.3);
    }

    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239,68,68,0.45);
    }

    .btn-outline {
        background: white;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .btn-outline:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .metric-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }

    .metric-card.revenue::before { background: linear-gradient(90deg, #10b981, #059669); }
    .metric-card.orders::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
    .metric-card.drivers::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
    .metric-card.commission::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }

    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 12px;
    }

    .metric-card.revenue .metric-icon { background: rgba(16,185,129,0.1); }
    .metric-card.orders .metric-icon { background: rgba(59,130,246,0.1); }
    .metric-card.drivers .metric-icon { background: rgba(245,158,11,0.1); }
    .metric-card.commission .metric-icon { background: rgba(139,92,246,0.1); }

    .metric-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .metric-value {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .metric-change {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .metric-change.positive {
        background: rgba(16,185,129,0.1);
        color: #059669;
    }

    .metric-change.negative {
        background: rgba(239,68,68,0.1);
        color: #dc2626;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }

    .chart-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .chart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .data-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .data-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .data-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .data-body {
        padding: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #f8fafc;
        padding: 14px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
    }

    .data-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #475569;
    }

    .data-table tr:hover {
        background: #f8fafc;
    }

    .driver-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        margin-right: 12px;
    }

    .driver-info {
        display: flex;
        align-items: center;
    }

    .driver-details {
        display: flex;
        flex-direction: column;
    }

    .driver-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
    }

    .driver-email {
        font-size: 12px;
        color: #94a3b8;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-success {
        background: rgba(16,185,129,0.1);
        color: #059669;
    }

    .badge-warning {
        background: rgba(245,158,11,0.1);
        color: #d97706;
    }

    .badge-danger {
        background: rgba(239,68,68,0.1);
        color: #dc2626;
    }

    .badge-info {
        background: rgba(59,130,246,0.1);
        color: #2563eb;
    }

    .progress-bar {
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s;
    }

    .rating-stars {
        color: #f59e0b;
        font-size: 14px;
    }

    .side-panel {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .mini-card {
        background: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .mini-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .stat-row:last-child {
        border-bottom: none;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
    }

    .stat-value {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
    }

    .top-driver {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 8px;
        transition: all 0.2s;
    }

    .top-driver:hover {
        background: #f8fafc;
        transform: translateX(4px);
    }

    .top-driver-rank {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
        flex-shrink: 0;
    }

    .rank-1 { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
    .rank-2 { background: linear-gradient(135deg, #94a3b8, #64748b); color: white; }
    .rank-3 { background: linear-gradient(135deg, #b45309, #92400e); color: white; }
    .rank-other { background: #f1f5f9; color: #64748b; }

    .product-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 8px;
        transition: all 0.2s;
    }

    .product-item:hover {
        background: #f8fafc;
    }

    .product-thumb {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-info {
        flex: 1;
        min-width: 0;
    }

    .product-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-stats {
        font-size: 12px;
        color: #94a3b8;
    }

    .no-data {
        text-align: center;
        padding: 40px 20px;
        color: #94a3b8;
    }

    .no-data-icon {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="reports-container">

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <span style="font-size: 32px;">📊</span>
            Financial & Driver Reports
        </h1>
        <div style="display: flex; gap: 12px;">
            <button type="button" onclick="exportFinancial()" class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export Financial
            </button>
            <button type="button" onclick="exportDriver()" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export Driver
            </button>
            <button type="button" onclick="exportPdf()" class="btn btn-pdf">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    <!-- Date Filter -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="filter-bar">
        <div class="filter-group">
            <label class="filter-label">From Date</label>
            <input type="date" name="date_from" value="{{ $dateFrom }}" class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label">To Date</label>
            <input type="date" name="date_to" value="{{ $dateTo }}" class="filter-input">
        </div>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            Apply Filter
        </button>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0113.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            Reset
        </a>
    </form>

    <!-- Summary Metrics -->
    <div class="metrics-grid">
        <div class="metric-card revenue">
            <div class="metric-icon">💰</div>
            <div class="metric-label">Total Revenue</div>
            <div class="metric-value">${{ number_format($summaryStats['total_revenue'], 2) }}</div>
            @if($summaryStats['revenue_growth'] >= 0)
                <span class="metric-change positive">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                    {{ $summaryStats['revenue_growth'] }}%
                </span>
            @else
                <span class="metric-change negative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{ abs($summaryStats['revenue_growth']) }}%
                </span>
            @endif
        </div>

        <div class="metric-card orders">
            <div class="metric-icon">🛒</div>
            <div class="metric-label">Total Orders</div>
            <div class="metric-value">{{ $summaryStats['total_orders'] }}</div>
            @if($summaryStats['orders_growth'] >= 0)
                <span class="metric-change positive">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                    </svg>
                    {{ $summaryStats['orders_growth'] }}%
                </span>
            @else
                <span class="metric-change negative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    {{ abs($summaryStats['orders_growth']) }}%
                </span>
            @endif
        </div>

        <div class="metric-card drivers">
            <div class="metric-icon">🚚</div>
            <div class="metric-label">Active Drivers</div>
            <div class="metric-value">{{ $summaryStats['active_drivers'] }} / {{ $summaryStats['total_drivers'] }}</div>
            <span class="metric-change" style="background: rgba(148,163,184,0.1); color: #64748b;">
                {{ $summaryStats['total_deliveries'] }} deliveries
            </span>
        </div>

        <div class="metric-card commission">
            <div class="metric-icon">💎</div>
            <div class="metric-label">Driver Commission</div>
            <div class="metric-value">${{ number_format($summaryStats['total_commission'], 2) }}</div>
            <span class="metric-change" style="background: rgba(139,92,246,0.1); color: #7c3aed;">
                10% of revenue
            </span>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-grid">
        <!-- Daily Revenue Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; color: #10b981;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    Daily Revenue Trend
                </h3>
            </div>
            <div class="chart-wrapper">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Order Status Distribution -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; color: #8b5cf6;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    Order Status Distribution
                </h3>
            </div>
            <div class="chart-wrapper">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="content-grid">
        <!-- Driver Performance Table -->
        <div class="data-card">
            <div class="data-header">
                <h3 class="data-title">🚚 Driver Performance</h3>
                <a href="{{ route('admin.driver-performance.index') }}" class="btn btn-outline" style="font-size: 12px; padding: 8px 14px;">
                    View All →
                </a>
            </div>
            <div class="data-body">
                @if(count($driverStats) > 0)
                <div class="table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="reports-table data-table">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th style="text-align: center;">Deliveries</th>
                            <th style="text-align: right;">Revenue</th>
                            <th style="text-align: right;">Commission</th>
                            <th style="text-align: center;">Success Rate</th>
                            <th style="text-align: center;">Rating</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($driverStats as $driver)
                        <tr>
                            <td>
                                <div class="driver-info">
                                    <div class="driver-avatar">
                                        @if($driver['avatar'])
                                            <img src="{{ asset('storage/' . $driver['avatar']) }}" alt="{{ $driver['name'] }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @else
                                            {{ substr($driver['name'], 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="driver-details">
                                        <span class="driver-name">{{ $driver['name'] }}</span>
                                        <span class="driver-email">{{ $driver['email'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span style="font-weight: 700; color: #1e293b;">{{ $driver['total_deliveries'] }}</span>
                                @if($driver['avg_delivery_time'] !== 'N/A')
                                    <div style="font-size: 11px; color: #94a3b8;">Avg: {{ $driver['avg_delivery_time'] }}</div>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <span style="font-weight: 700; color: #10b981;">${{ number_format($driver['total_revenue'], 2) }}</span>
                            </td>
                            <td style="text-align: right;">
                                <span style="font-weight: 700; color: #8b5cf6;">${{ number_format($driver['commission_earned'], 2) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                    <div class="progress-bar" style="width: 60px;">
                                        <div class="progress-fill" style="width: {{ $driver['success_rate'] }}%; background: {{ $driver['success_rate'] >= 80 ? '#10b981' : ($driver['success_rate'] >= 60 ? '#f59e0b' : '#ef4444') }};"></div>
                                    </div>
                                    <span style="font-size: 12px; font-weight: 600;">{{ $driver['success_rate'] }}%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="rating-stars">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < floor($driver['rating']))
                                            ★
                                        @elseif($i < $driver['rating'])
                                            <span style="opacity: 0.5;">★</span>
                                        @else
                                            <span style="opacity: 0.2;">★</span>
                                        @endif
                                    @endfor
                                </div>
                                <span style="font-size: 11px; color: #94a3b8;">{{ $driver['rating'] }}</span>
                            </td>
                            <td style="text-align: center;">
                                @if($driver['active_orders'] > 0)
                                    <span class="badge badge-success">{{ $driver['active_orders'] }} Active</span>
                                @else
                                    <span class="badge" style="background: #f1f5f9; color: #94a3b8;">Idle</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @else
                <div class="no-data">
                    <div class="no-data-icon">🚚</div>
                    <p>No drivers found in the selected period</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Side Panel -->
        <div class="side-panel">
            <!-- Top Drivers -->
            <div class="mini-card">
                <h4 class="mini-card-title">
                    <span>🏆</span> Top Performers
                </h4>
                @if(count($topDrivers) > 0)
                    @foreach($topDrivers as $index => $driver)
                    <div class="top-driver">
                        <div class="top-driver-rank rank-{{ $index < 3 ? $index + 1 : 'other' }}">
                            {{ $index + 1 }}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $driver['name'] }}</div>
                            <div style="font-size: 12px; color: #94a3b8;">{{ $driver['total_deliveries'] }} deliveries</div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: 700; color: #10b981; font-size: 13px;">${{ number_format($driver['commission_earned'], 2) }}</div>
                            <div style="font-size: 11px; color: #94a3b8;">earned</div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p style="text-align: center; color: #94a3b8; padding: 20px;">No performance data yet</p>
                @endif
            </div>

            <!-- Payment Methods -->
            <div class="mini-card">
                <h4 class="mini-card-title">
                    <span>💳</span> Payment Methods
                </h4>
                @if(count($revenueByPayment) > 0)
                    @foreach($revenueByPayment as $payment)
                    <div class="stat-row">
                        <span class="stat-label">{{ ucfirst($payment->payment_method) }}</span>
                        <span class="stat-value">${{ number_format($payment->total, 2) }}</span>
                    </div>
                    @endforeach
                @else
                    <p style="text-align: center; color: #94a3b8; padding: 20px;">No payment data</p>
                @endif
            </div>

            <!-- Monthly Comparison -->
            <div class="mini-card">
                <h4 class="mini-card-title">
                    <span>📅</span> Monthly Comparison
                </h4>
                <div class="stat-row">
                    <span class="stat-label">This Month</span>
                    <span class="stat-value" style="color: #10b981;">${{ number_format($monthlyRevenue['current_month_revenue'], 2) }}</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">Last Month</span>
                    <span class="stat-value">${{ number_format($monthlyRevenue['last_month_revenue'], 2) }}</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">Growth</span>
                    <span class="stat-value" style="color: {{ $monthlyRevenue['revenue_growth'] >= 0 ? '#10b981' : '#ef4444' }};">
                        {{ $monthlyRevenue['revenue_growth'] >= 0 ? '+' : '' }}{{ $monthlyRevenue['revenue_growth'] }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products & Revenue by Category -->
    <div class="charts-grid">
        <!-- Top Selling Products -->
        <div class="data-card">
            <div class="data-header">
                <h3 class="data-title">🔥 Top Selling Products</h3>
            </div>
            <div class="data-body">
                @if(count($topProducts) > 0)
                    @foreach($topProducts->take(5) as $product)
                    @php
                        // Decode JSON name field to array (raw DB query returns JSON string)
                        $nameArray = is_string($product->name) ? json_decode($product->name, true) : $product->name;
                        
                        // Get the display name based on current locale with fallback
                        $displayName = is_array($nameArray) 
                            ? ($nameArray[app()->getLocale()] ?? $nameArray['en'] ?? 'Product')
                            : ($product->name ?? 'Product');
                    @endphp
                    <div class="product-item">
                        <div class="product-thumb">
                            @if(!empty($product->image_url))
                                <img src="{{ $product->image_url }}" alt="{{ $displayName }}">
                            @else
                                📦
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-name">{{ $displayName }}</div>
                            <div class="product-stats">{{ $product->total_sold ?? 0 }} sold • ${{ number_format($product->revenue ?? 0, 2) }} revenue</div>
                        </div>
                        <div style="font-weight: 700; color: #10b981;">
                            #{{ $loop->iteration }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="no-data">
                        <p>No product sales data</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Revenue by Category -->
        <div class="data-card">
            <div class="data-header">
                <h3 class="data-title">📁 Revenue by Category</h3>
            </div>
            <div class="data-body">
                @if(count($revenueByCategory) > 0)
                    @foreach($revenueByCategory->take(6) as $category)
                    <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-weight: 600; color: #1e293b;">{{ $category->category }}</span>
                            <span style="font-weight: 700; color: #10b981;">${{ number_format($category->revenue, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="progress-bar" style="flex: 1; margin-right: 12px;">
                                @php
                                    $maxRevenue = $revenueByCategory->max('revenue');
                                    $percentage = $maxRevenue > 0 ? ($category->revenue / $maxRevenue) * 100 : 0;
                                @endphp
                                <div class="progress-fill" style="width: {{ $percentage }}%; background: linear-gradient(90deg, #10b981, #059669);"></div>
                            </div>
                            <span style="font-size: 12px; color: #94a3b8;">{{ $category->quantity_sold }} items</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="no-data">
                        <p>No category data available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Daily Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = @json($dailyRevenue);

    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: revenueData.map(d => d.label),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(d => d.revenue),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
            }, {
                label: 'Orders',
                data: revenueData.map(d => d.orders),
                borderColor: '#3b82f6',
                backgroundColor: 'transparent',
                borderDash: [5, 5],
                tension: 0.4,
                pointRadius: 0,
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: '#64748b',
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                    },
                    ticks: {
                        color: '#64748b',
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: false,
                    position: 'right',
                    grid: {
                        display: false,
                    },
                }
            }
        }
    });

    // Order Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusData = @json($orderStatusDistribution);
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusData.map(d => d.label),
            datasets: [{
                data: statusData.map(d => d.count),
                backgroundColor: statusData.map(d => d.color),
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 12,
                            weight: '600',
                        },
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.raw / total) * 100).toFixed(1);
                            return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                        }
                    }
                }
            },
        }
    });

    // Export functions
    window.exportFinancial = function() {
        const dateFrom = document.querySelector('input[name="date_from"]').value;
        const dateTo = document.querySelector('input[name="date_to"]').value;
        const params = new URLSearchParams({ date_from: dateFrom, date_to: dateTo });
        window.location.href = "{{ route('admin.reports.export-financial') }}?" + params.toString();
    }

    window.exportDriver = function() {
        const dateFrom = document.querySelector('input[name="date_from"]').value;
        const dateTo = document.querySelector('input[name="date_to"]').value;
        const params = new URLSearchParams({ date_from: dateFrom, date_to: dateTo });
        window.location.href = "{{ route('admin.reports.export-driver') }}?" + params.toString();
    }

    window.exportReport = function() {
        const dateFrom = document.querySelector('input[name="date_from"]').value;
        const dateTo = document.querySelector('input[name="date_to"]').value;
        const params = new URLSearchParams({ date_from: dateFrom, date_to: dateTo });
        window.location.href = "{{ route('admin.reports.export-financial') }}?" + params.toString();
    }

    window.exportPdf = function() {
        const dateFrom = document.querySelector('input[name="date_from"]').value;
        const dateTo = document.querySelector('input[name="date_to"]').value;
        const params = new URLSearchParams({ date_from: dateFrom, date_to: dateTo });
        window.location.href = "{{ route('admin.reports.export-pdf') }}?" + params.toString();
    }
});
</script>
@endsection
