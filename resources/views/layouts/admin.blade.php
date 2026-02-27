<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('grocery-icon.png') }}?v=3">

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <style>
        @keyframes pulse-animation {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        :root {
            --sidebar-expanded-width: 256px;
            --sidebar-collapsed-width: 95px;
            --sidebar-transition: 340ms cubic-bezier(0.22, 1, 0.36, 1);
            --sidebar-fade-delay: 70ms;
        }

        body {
            overflow-x: hidden;
        }

        /* Sidebar animation system */
        #sidebar {
            width: var(--sidebar-expanded-width) !important;
            position: fixed !important;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            transition: width var(--sidebar-transition), transform var(--sidebar-transition), box-shadow 0.3s ease !important;
            will-change: width, transform;
        }

        #main-content {
            margin-left: var(--sidebar-expanded-width) !important;
            width: calc(100% - var(--sidebar-expanded-width)) !important;
            box-sizing: border-box;
            transition: margin-left var(--sidebar-transition), width var(--sidebar-transition) !important;
        }

        #main-content > * {
            max-width: 100%;
            box-sizing: border-box;
        }

        #sidebar.is-collapsed ~ #main-content {
            margin-left: var(--sidebar-collapsed-width) !important;
            width: calc(100% - var(--sidebar-collapsed-width)) !important;
        }

        #sidebar .sidebar-header {
            justify-content: flex-start !important;
            gap: 12px;
            transition: padding var(--sidebar-transition), gap var(--sidebar-transition) !important;
        }

        #sidebar .logo-content {
            max-width: 200px;
            opacity: 1;
            transform: translateX(0);
            transition: max-width var(--sidebar-transition), opacity 180ms ease, transform var(--sidebar-transition) !important;
        }

        #sidebar .sidebar-menu-item,
        #sidebar .sidebar-footer-item {
            transition: padding var(--sidebar-transition), gap var(--sidebar-transition), background-color 0.2s ease, color 0.2s ease, transform 0.2s ease !important;
        }

        #sidebar .side-nav {
            overflow-x: hidden !important;
        }

        #sidebar .sidebar-menu-item,
        #sidebar .sidebar-footer-item,
        #sidebar .sidebar-footer form .sidebar-footer-item {
            box-sizing: border-box;
        }

        #sidebar .sidebar-text {
            opacity: 1;
            max-width: 220px;
            transform: translateX(0);
            overflow: hidden;
            transition: opacity 160ms ease, max-width var(--sidebar-transition), transform var(--sidebar-transition) !important;
        }

        #sidebar:not(.is-collapsed) .sidebar-text {
            transition-delay: var(--sidebar-fade-delay), var(--sidebar-fade-delay), 0ms;
        }

        #sidebar:not(.is-collapsed) .logo-content {
            transition-delay: var(--sidebar-fade-delay), 0ms, 0ms;
        }

        #sidebar #sidebar-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            padding: 0 !important;
            line-height: 0;
            margin-left: auto;
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease !important;
        }

        #sidebar #sidebar-toggle:hover {
            background: rgba(255,255,255,0.15) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        #sidebar #sidebar-toggle svg {
            display: block;
            width: 18px;
            height: 18px;
            margin: 0 auto;
            transition: transform var(--sidebar-transition);
            transform-origin: center;
        }

        #sidebar.is-collapsed #sidebar-toggle svg {
            transform: rotate(180deg);
        }

        #sidebar.is-collapsed #sidebar-toggle {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        #sidebar.is-collapsed {
            width: var(--sidebar-collapsed-width) !important;
        }

        #sidebar.is-collapsed .sidebar-header {
            justify-content: center !important;
            gap: 0 !important;
            padding: 20px 16px !important;
        }

        #sidebar.is-collapsed .logo-content {
            max-width: 0 !important;
            opacity: 0 !important;
            transform: translateX(-8px) !important;
            pointer-events: none;
        }

        #sidebar.is-collapsed .side-nav {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        #sidebar.is-collapsed .sidebar-menu-item,
        #sidebar.is-collapsed .sidebar-footer-item {
            justify-content: center !important;
            gap: 0 !important;
            padding: 12px !important;
        }

        #sidebar.is-collapsed .sidebar-menu-item > svg,
        #sidebar.is-collapsed .sidebar-footer-item > svg,
        #sidebar.is-collapsed .sidebar-menu-item > span:first-child,
        #sidebar.is-collapsed .sidebar-footer-item > span:first-child,
        #sidebar.is-collapsed .sidebar-menu-item > div:first-child,
        #sidebar.is-collapsed .sidebar-footer-item > div:first-child {
            margin: 0 !important;
            flex-shrink: 0 !important;
        }

        #sidebar.is-collapsed .sidebar-text {
            opacity: 0 !important;
            max-width: 0 !important;
            transform: translateX(-10px) !important;
            margin-left: 0 !important;
            pointer-events: none;
            transition-delay: 0ms, 0ms, 0ms !important;
        }

        #sidebar.is-collapsed #alerts-box {
            justify-content: center !important;
        }

        #sidebar.is-animating {
            pointer-events: none;
        }

        /* Sidebar Nav Item Hover & Active States */
        .nav-item:hover {
            background: rgba(255,255,255,0.08) !important;
            color: white !important;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(5,150,105,0.15)) !important;
            color: #10b981 !important;
            font-weight: 700 !important;
        }

        /* Sidebar collapsed state - center icons */
        #sidebar.is-collapsed .nav-item {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        #sidebar.is-collapsed .nav-item span:first-child {
            margin-right: 0 !important;
        }

        /* Tooltip on collapsed sidebar */
        #sidebar.is-collapsed .nav-item {
            position: relative;
        }

        #sidebar.is-collapsed .nav-item:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #1e293b;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            white-space: nowrap;
            z-index: 1000;
            margin-left: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        /* Prevent horizontal scrollbar in collapsed sidebar on hover */
        #sidebar.is-collapsed .nav-item:hover::after {
            display: none !important;
        }

        /* ========================================
           MOBILE RESPONSIVE STYLES
           ======================================== */
        @media (max-width: 768px) {
            /* Hide sidebar on mobile by default */
            .sidebar {
                position: fixed !important;
                left: 0 !important;
                top: 0 !important;
                z-index: 9999 !important;
                transform: translateX(-100%) !important;
                transition: transform 0.3s ease !important;
                box-shadow: 2px 0 12px rgba(0,0,0,0.3) !important;
            }

            .sidebar.is-collapsed {
                width: var(--sidebar-expanded-width) !important;
            }

            .sidebar.mobile-open {
                transform: translateX(0) !important;
            }

            /* Main content must ignore desktop sidebar offsets on mobile */
            #main-content,
            #sidebar ~ #main-content,
            #sidebar.is-collapsed ~ #main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }

            /* Mobile header */
            .mobile-header {
                display: flex !important;
                align-items: center;
                justify-content: space-between;
                padding: 12px 16px;
                background: #1e293b;
                color: white;
                position: sticky;
                top: 0;
                z-index: 100;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .mobile-menu-btn {
                background: rgba(255,255,255,0.1);
                border: none;
                color: white;
                padding: 8px 12px;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 600;
            }

            .mobile-logo {
                font-size: 16px;
                font-weight: 800;
            }

            /* Stats grid - 2 columns on mobile */
            .stats-grid,
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }

            .metric-card,
            .stat-card {
                padding: 16px !important;
                border-radius: 10px !important;
            }

            .metric-value,
            .stat-value {
                font-size: 20px !important;
            }

            .metric-label,
            .stat-label {
                font-size: 11px !important;
            }

            /* Charts - single column */
            .charts-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }

            .chart-card {
                padding: 16px !important;
            }

            .chart-wrapper {
                height: 250px !important;
            }

            /* Content grid - single column */
            .content-grid {
                grid-template-columns: 1fr !important;
            }

            /* Data tables - scrollable */
            .data-table-wrapper {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }

            .data-table {
                min-width: 600px !important;
                font-size: 12px !important;
            }

            .data-table th,
            .data-table td {
                padding: 10px 12px !important;
                white-space: nowrap !important;
            }

            /* Cards - mobile friendly */
            .data-card,
            .mini-card {
                border-radius: 10px !important;
                margin-bottom: 16px !important;
            }

            .data-header {
                padding: 14px 16px !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px !important;
            }

            .data-title {
                font-size: 14px !important;
            }

            /* Filter bar - scrollable */
            .filter-bar {
                flex-wrap: wrap !important;
                padding: 12px !important;
            }

            .filter-group {
                width: 100% !important;
                margin-bottom: 8px !important;
            }

            .filter-input {
                width: 100% !important;
                font-size: 14px !important;
                padding: 10px !important;
            }

            .btn {
                padding: 10px 16px !important;
                font-size: 12px !important;
                width: 100% !important;
                justify-content: center !important;
            }

            /* Page header */
            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 12px !important;
                padding: 16px !important;
            }

            .page-title {
                font-size: 20px !important;
            }

            /* Side panel - full width */
            .side-panel {
                display: flex !important;
                flex-direction: column !important;
                gap: 16px !important;
            }

            /* Product/driver items */
            .product-item,
            .top-driver {
                padding: 12px !important;
            }

            .product-thumb,
            .driver-avatar {
                width: 40px !important;
                height: 40px !important;
                font-size: 16px !important;
            }

            .product-name,
            .driver-name {
                font-size: 13px !important;
            }

            /* Badges */
            .badge {
                padding: 3px 8px !important;
                font-size: 10px !important;
            }

            /* Progress bars */
            .progress-bar {
                height: 6px !important;
            }

            /* Rating stars */
            .rating-stars {
                font-size: 12px !important;
            }

            /* Modal adjustments */
            .modal-content {
                max-width: 95% !important;
                margin: 10px !important;
            }

            /* Sidebar footer items */
            .sidebar-footer-item {
                padding: 10px !important;
            }

            /* Hide tooltips on mobile */
            #sidebar.is-collapsed .nav-item:hover::after {
                display: none !important;
            }
        }

        /* Small phones */
        @media (max-width: 375px) {
            .stats-grid,
            .metrics-grid {
                grid-template-columns: 1fr !important;
            }

            .metric-value,
            .stat-value {
                font-size: 18px !important;
            }

            .page-title {
                font-size: 18px !important;
            }
        }

        /* ========================================
           UNIVERSAL ADMIN RESPONSIVE GUARDS
           Handles legacy inline layouts across pages
           ======================================== */
        #main-content {
            overflow-x: hidden !important;
        }

        #main-content > * {
            max-width: 100%;
            box-sizing: border-box;
        }

        #main-content .table-scroll-wrap {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        #main-content .table-scroll-wrap > table {
            min-width: 640px;
        }

        @media (max-width: 1200px) {
            #main-content > div[style*="padding: 30px 30px 30px 300px"] {
                padding: 24px !important;
                max-width: 100% !important;
            }

            #main-content [style*="grid-template-columns: 350px 1fr"],
            #main-content [style*="grid-template-columns: 340px 1fr"],
            #main-content [style*="grid-template-columns: 2fr 1fr"],
            #main-content [style*="grid-template-columns: 1fr 2fr"] {
                grid-template-columns: 1fr !important;
            }

            #main-content [style*="flex: 0 0 380px"] {
                flex: 1 1 100% !important;
                width: 100% !important;
            }
        }

        @media (max-width: 900px) {
            #main-content [style*="grid-template-columns: repeat(4, 1fr)"] {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            #main-content [style*="grid-template-columns: 1fr 1fr 1fr"] {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }

            #main-content [style*="min-width: 450px"],
            #main-content [style*="min-width: 400px"],
            #main-content [style*="min-width: 380px"],
            #main-content [style*="min-width: 350px"] {
                min-width: 0 !important;
            }
        }

        @media (max-width: 768px) {
            #main-content > div[style*="padding: 30px"],
            #main-content > div[style*="padding: 24px"],
            #main-content > div[style*="padding: 30px 30px 30px 300px"] {
                padding: 16px !important;
            }

            #main-content [style*="display: flex; justify-content: space-between"],
            #main-content [style*="display: flex;justify-content: space-between"] {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }

            #main-content [style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }

            #main-content [style*="min-width: 280px"],
            #main-content [style*="min-width: 250px"],
            #main-content [style*="min-width: 200px"],
            #main-content [style*="min-width: 160px"],
            #main-content [style*="min-width: 150px"],
            #main-content [style*="min-width: 140px"],
            #main-content [style*="min-width: 120px"] {
                min-width: 100% !important;
            }

            #main-content .page-header,
            #main-content .header-actions,
            #main-content .filter-bar form {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px !important;
            }

            #main-content .header-actions a,
            #main-content .header-actions button,
            #main-content .filter-bar .btn,
            #main-content .filter-bar button,
            #main-content .filter-bar a {
                width: 100% !important;
                justify-content: center !important;
            }

            #main-content [style*="padding: 32px"],
            #main-content [style*="padding: 30px"] {
                padding: 18px !important;
            }

            #main-content .table-scroll-wrap > table {
                min-width: 560px;
            }
        }
    </style>
    
    <!-- Stack for page-specific styles -->
    @stack('styles')
</head>
<body style="background-color: #f8fafc; margin: 0; font-family: 'Instrument Sans', sans-serif; min-height: 100vh;">

<!-- Mobile Header (Visible only on mobile) -->
<div class="mobile-header" style="display: none;" id="mobile-header">
    <button class="mobile-menu-btn" onclick="toggleMobileSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
        Menu
    </button>
    <div class="mobile-logo">Grocery Admin</div>
    <div style="width: 36px;"></div> <!-- Spacer for balance -->
</div>

@php
    // Get the total number of pending orders
    $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();

    // Get the 5 most recent pending orders with their items for the dropdown and modals
    $latestPendingOrders = \App\Models\Order::with(['orderItems.product', 'customer'])->where('status', 'pending')
                                            ->latest()
                                            ->take(5)
                                            ->get();

    // Get low stock count for alerts
    $lowStockCount = \App\Models\Product::where('stock', '>', 0)
                                        ->where('stock', '<=', 10)
                                        ->count();

    // Get out of stock count for alerts
    $outOfStockCount = \App\Models\Product::where('stock', 0)->count();

    // Total alerts count
    $totalAlertsCount = $pendingOrdersCount + $lowStockCount + $outOfStockCount;
@endphp

    <aside id="sidebar" class="sidebar w-64 transition-all duration-300 ease-in-out" style="flex-shrink: 0; width: 256px; background: #1e293b; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; overflow-y: auto;">

        <div id="sidebar-header" class="sidebar-header" style="display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
            <div id="sidebar-logo-content" class="logo-content" style="display: flex; align-items: center; gap: 12px; transition: all 0.3s ease; overflow: hidden; white-space: nowrap;">
                <div class="logo-icon" style="flex-shrink: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 28px; height: 28px; color: #10b981;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" style="
    color: #fff;" />
                    </svg>
                </div>
                <div class="logo-text" style="color: white; font-weight: 700; font-size: 16px; line-height: 1.2;">
                    Grocery<br><span style="color: #94a3b8; font-weight: 500;">Admin</span>
                </div>
            </div>
            
            <button id="sidebar-toggle" onclick="toggleSidebar()" title="Collapse menu" aria-label="Collapse menu" style="background: rgba(255,255,255,0.1); border: none; color: #94a3b8; cursor: pointer; border-radius: 10px; transition: all 0.2s; flex-shrink: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="display: block;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <nav class="side-nav" style="display: flex; flex-direction: column; height: calc(100vh - 80px); overflow-y: auto; padding: 16px 12px;">
            <a href="{{ route('admin.dashboard') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-tooltip="Dashboard" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Dashboard</span>
            </a>

            @if(auth()->user()->hasPermission('manage_categories'))
                <a href="{{ route('admin.categories.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" data-tooltip="Categories" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Categories</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_inventory'))
                <a href="{{ route('admin.products.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" data-tooltip="Inventory" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Inventory</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_staff'))
                <a href="{{ route('admin.staff.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" data-tooltip="Team Management" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Team Management</span>
                </a>

                <a href="{{ route('admin.drivers.tracking') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}" data-tooltip="Driver Tracking" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">🚚 Driver Tracking</span>
                </a>

                <a href="{{ route('admin.customers.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" data-tooltip="Customer Management" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Customer Management</span>
                </a>

                <a href="{{ route('admin.activity_logs.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.activity_logs.*') ? 'active' : '' }}" data-tooltip="System Audit Logs" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">System Audit Logs</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_orders'))
                <a href="{{ route('admin.orders.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" data-tooltip="Orders" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Orders</span>
                </a>
            @endif

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.coupons.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}" data-tooltip="Coupons" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Coupons</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" data-tooltip="Reviews" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Reviews</span>
                    @php
                        $flaggedReviewsCount = \App\Models\Review::where('is_flagged', true)->where('is_banned', false)->count();
                    @endphp
                    @if($flaggedReviewsCount > 0)
                        <span class="badge bg-danger ms-auto" style="font-size: 10px;">{{ $flaggedReviewsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.driver-performance.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.driver-performance.*') ? 'active' : '' }}" data-tooltip="Driver Performance" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9 1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Driver Performance</span>
                </a>

                <a href="{{ route('admin.reports.index') }}" class="nav-item sidebar-menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" data-tooltip="Reports" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; text-decoration: none; color: #94a3b8; border-radius: 10px; transition: all 0.2s; margin-bottom: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                    <span class="sidebar-text" style="font-weight: 600; font-size: 14px; white-space: nowrap; transition: opacity 0.2s;">Reports</span>
                </a>
            @endif

            <div class="sidebar-footer" style="margin-top: auto; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 10px;">

                <!-- Notification Bell - Opens Modal -->
                <div id="alerts-box" class="sidebar-footer-item flex items-center justify-center px-4 py-3 bg-slate-800 rounded-xl transition-all duration-300 mb-4 cursor-pointer group hover:bg-slate-700" style="display: flex; align-items: center; justify-content: center; padding: 10px 12px; border-radius: 8px; transition: all 0.3s; background: rgba(255,255,255,0.1); cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'" onclick="openAlertsModal()">

                    <div class="relative inline-block" style="position: relative; display: inline-block;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 22px; height: 22px; color: #fff;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>

                        @if($totalAlertsCount > 0)
                            <div id="alerts-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center border-2 border-slate-800" style="position: absolute; top: -4px; right: -4px; background: #ef4444; color: white; font-size: 9px; font-weight: 800; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #1e293b;">{{ $totalAlertsCount }}</div>
                        @endif
                    </div>

                    <span class="sidebar-text font-medium text-slate-300 ml-3" style="color: white; font-weight: 600; font-size: 14px; margin-left: 12px; white-space: nowrap; transition: opacity 0.2s;">Alerts</span>

                </div>

                <a href="{{ route('admin.profile') }}" class="sidebar-footer-item" style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; text-decoration: none; border-radius: 8px; transition: all 0.3s; margin-bottom: 10px; background: transparent;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">

                    <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; flex-shrink: 0;">
                        @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    </div>

                    <div class="sidebar-text" style="overflow: hidden; flex: 1; transition: opacity 0.2s;">
                        <div style="color: white; font-weight: 600; font-size: 14px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                            {{ auth()->user()->name }}
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px; margin-top: 2px; flex-wrap: wrap;">
                            @php
                                $userRole = auth()->user()->role;
                                if ($userRole === 'admin' || $userRole === 'super_user') {
                                    $badgeColor = '#7c3aed';
                                    $badgeText = 'Admin';
                                    $badgeIcon = '👑';
                                } elseif ($userRole === 'staff') {
                                    $badgeColor = '#2563eb';
                                    $badgeText = 'Staff';
                                    $badgeIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 10px; height: 10px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5M12 6.75h1.5M15 6.75h1.5M9 11.25h1.5M12 11.25h1.5M15 11.25h1.5M9 15.75h1.5M12 15.75h1.5M15 15.75h1.5M9 20.25h1.5M12 20.25h1.5M15 20.25h1.5" /></svg>';
                                } elseif ($userRole === 'driver') {
                                    $badgeColor = '#d97706';
                                    $badgeText = 'Driver';
                                    $badgeIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 10px; height: 10px;"><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9 1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>';
                                } else {
                                    $badgeColor = '#64748b';
                                    $badgeText = ucfirst($userRole);
                                    $badgeIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 10px; height: 10px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>';
                                }
                                $loginTime = session('login_time');
                            @endphp
                            <span style="background: {{ $badgeColor }}; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 3px; white-space: nowrap;">
                                {{ $badgeIcon }} {{ $badgeText }}
                            </span>
                            {{-- DEBUG: Check session --}}
                            @if($loginTime)
                                <span style="color: #94a3b8; font-size: 10px; white-space: nowrap;">&middot; {{ \Carbon\Carbon::parse($loginTime)->diffForHumans() }}</span>
                            @else
                                <span style="color: #ef4444; font-size: 9px;">[No login session]</span>
                            @endif
                        </div>
                    </div>

                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" class="sidebar-footer-item" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 12px 12px; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; font-weight: 600; text-align: left; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.color='#fca5a5';" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#f87171';">

                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>

                        <span class="sidebar-text" style="font-size: 14px; letter-spacing: 0.5px; white-space: nowrap; transition: opacity 0.2s;">Log Out</span>

                    </button>
                </form>

            </div>
        </nav>
    </aside>

    <div id="main-content" class="main-content transition-all duration-300 ease-in-out" style="min-height: 100vh; overflow-x: auto;">
        @yield('content')
    </div>

    <!-- New Order Audio Alert -->
    <audio id="new-order-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    <!-- Alerts List Modal -->
    <div id="alerts-list-modal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.4); display: none; z-index: 9998; align-items: center; justify-content: center; backdrop-filter: blur(4px); transition: opacity 0.3s ease;">
        <div style="background: white; width: 100%; max-width: 500px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: 1px solid #e2e8f0; overflow: hidden; position: relative;">

            <div style="background: #f8fafc; padding: 16px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 900; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    Warehouse Alerts
                    @if($totalAlertsCount > 0)
                        <span style="background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px; text-transform: uppercase;">{{ $totalAlertsCount }} Total</span>
                    @endif
                </h2>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button id="toggle-sound-btn" style="background: none; border: none; cursor: pointer; transition: all 0.2s; opacity: 1;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Toggle Alert Sound">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                        </svg>
                    </button>
                    <button onclick="closeAlertsModal()" style="background: none; border: none; padding: 8px; border-radius: 8px; cursor: pointer; color: #94a3b8; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#ef4444'" onmouseout="this.style.background='transparent'; this.style.color='#94a3b8'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <div style="max-height: 400px; overflow-y: auto; overflow-x: hidden; padding: 8px;">

                <!-- Pending Orders Section -->
                @if($pendingOrdersCount > 0)
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 14px; height: 14px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        Pending Orders ({{ $pendingOrdersCount }})
                    </div>
                    @foreach($latestPendingOrders as $pending)
                        <button onclick="closeAlertsModal(); openOrderModal({{ $pending->id }})" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #f8fafc; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 24px; height: 24px; flex-shrink: 0; color: #64748b;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #1e293b; font-size: 14px;">Order #{{ str_pad($pending->id, 8, '0', STR_PAD_LEFT) }}</p>
                                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $pending->customer->name ?? 'Customer' }} &middot; ${{ number_format($pending->total_amount, 2) }}</p>
                                    <p style="margin: 6px 0 0 0; font-size: 11px; color: #ef4444; font-weight: 800; text-transform: uppercase;">Waiting: {{ $pending->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </button>
                    @endforeach
                @endif

                <!-- Out of Stock Section -->
                @php
                    $outOfStockProducts = \App\Models\Product::where('stock', 0)->limit(3)->get();
                @endphp
                @if($outOfStockCount > 0)
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        Out of Stock ({{ $outOfStockCount }})
                    </div>
                    @foreach($outOfStockProducts as $product)
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #fef2f2; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 24px; height: 24px; flex-shrink: 0; color: #dc2626;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #b91c1c; font-size: 14px;">{{ $product->translated_name }}</p>
                                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p style="margin: 6px 0 0 0; font-size: 11px; color: #dc2626; font-weight: 800; text-transform: uppercase;">0 in stock</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

                <!-- Low Stock Section -->
                @php
                    $lowStockProducts = \App\Models\Product::where('stock', '>', 0)->where('stock', '<=', 10)->limit(3)->get();
                @endphp
                @if($lowStockCount > 0)
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 14px; height: 14px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        Low Stock ({{ $lowStockCount }})
                    </div>
                    @foreach($lowStockProducts as $product)
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #fffbeb; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#fffbeb'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 24px; height: 24px; flex-shrink: 0; color: #d97706;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #92400e; font-size: 14px;">{{ $product->translated_name }}</p>
                                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p style="margin: 6px 0 0 0; font-size: 11px; color: #d97706; font-weight: 800; text-transform: uppercase;">Only {{ $product->stock }} left</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

                @if($pendingOrdersCount == 0 && $outOfStockCount == 0 && $lowStockCount == 0)
                    <div style="padding: 40px 20px; text-align: center;">
                        <span style="font-size: 48px; display: block; margin-bottom: 8px;">OK</span>
                        <p style="margin: 0; font-weight: 800; color: #1e293b; font-size: 14px;">All clear!</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #94a3b8;">No pending orders or stock alerts.</p>
                    </div>
                @endif
            </div>

            <div style="padding: 12px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                <a href="{{ route('admin.orders.index') }}" style="font-size: 13px; font-weight: 800; color: #16a34a; text-decoration: none; text-align: center; padding: 8px; border-radius: 8px; background: #f0fdf4;" onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">View Orders -></a>
                <a href="{{ route('admin.products.index', ['low_stock' => 1]) }}" style="font-size: 13px; font-weight: 800; color: #d97706; text-decoration: none; text-align: center; padding: 8px; border-radius: 8px; background: #fffbeb;" onmouseover="this.style.background='#fef3c7'" onmouseout="this.style.background='#fffbeb'">Low Stock -></a>
            </div>
        </div>
    </div>

    <!-- Order Quick View Modals -->
    @foreach($latestPendingOrders as $pending)
    <div id="order-modal-{{ $pending->id }}" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.4); display: none; z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px); transition: opacity 0.3s ease;">
        <div style="background: white; width: 100%; max-width: 448px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: 1px solid #e2e8f0; overflow: hidden; position: relative;">
            
            <div style="background: #f8fafc; padding: 16px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 900; color: #1e293b;">Order #{{ str_pad($pending->id, 8, '0', STR_PAD_LEFT) }}</h2>
                <button onclick="closeOrderModal({{ $pending->id }})" style="background: none; border: none; padding: 8px; border-radius: 8px; cursor: pointer; color: #94a3b8; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#ef4444'" onmouseout="this.style.background='transparent'; this.style.color='#94a3b8'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div style="padding: 24px;">
                <div style="margin-bottom: 16px;">
                    <p style="margin: 0 0 4px 0; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Customer</p>
                    <p style="margin: 0; font-weight: 700; color: #1e293b; font-size: 15px;">{{ $pending->customer->name ?? 'N/A' }} <span style="color: #64748b; font-weight: 400;">({{ $pending->phone ?? 'No Phone' }})</span></p>
                </div>

                <div style="margin-bottom: 24px;">
                    <p style="margin: 0 0 8px 0; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Items to Pick</p>
                    <div style="max-height: 128px; overflow-y: auto; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #f1f5f9;">
                        @foreach($pending->orderItems as $item)
                            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; margin-bottom: 4px;">
                                <span style="font-weight: 700; color: #334155;">{{ $item->quantity }}x {{ $item->product->translated_name ?? 'Product' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                    <span style="font-weight: 700; color: #64748b;">Total Value:</span>
                    <span style="font-size: 24px; font-weight: 900; color: #16a34a;">${{ number_format($pending->total_amount, 2) }}</span>
                </div>
            </div>

            <div style="padding: 16px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <button onclick="closeOrderModal({{ $pending->id }})" style="width: 100%; padding: 10px; border-radius: 12px; font-weight: 700; color: #475569; border: 1px solid #cbd5e1; background: white; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">Cancel</button>
                <a href="{{ route('admin.orders.show', $pending->id) }}" style="width: 100%; padding: 10px; border-radius: 12px; font-weight: 700; color: white; background: #16a34a; cursor: pointer; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background 0.2s; box-sizing: border-box;" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">Manage Order</a>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // --- 1. SOUND TOGGLE LOGIC ---
        const soundBtn = document.getElementById('toggle-sound-btn');
        // Check memory: If it's not explicitly 'off', default to 'on'
        let soundEnabled = localStorage.getItem('freshmart_sound') !== 'off';

        function updateSoundUI() {
            if (soundBtn) {
                soundBtn.innerText = soundEnabled ? 'ON' : 'OFF';
                soundBtn.title = soundEnabled ? 'Mute Alerts' : 'Unmute Alerts';
                soundBtn.style.opacity = soundEnabled ? '1' : '0.5';
            }
        }

        // Run once on load to set the correct icon
        updateSoundUI();

        // When staff clicks the speaker icon
        if (soundBtn) {
            soundBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                soundEnabled = !soundEnabled;
                localStorage.setItem('freshmart_sound', soundEnabled ? 'on' : 'off');
                updateSoundUI();
            });
        }


        // --- 2. AUTO-ALERT LOGIC ---
        document.addEventListener("DOMContentLoaded", function() {
            const currentPendingCount = {{ $pendingOrdersCount ?? 0 }};
            const previousPendingCount = localStorage.getItem('freshmart_pending_count') || 0;

            // If a new order arrives
            if (currentPendingCount > previousPendingCount) {

                // 1. Play the Sound
                if (soundEnabled) {
                    const alertSound = document.getElementById('new-order-sound');
                    let playPromise = alertSound.play();
                    if (playPromise !== undefined) {
                        playPromise.catch(error => console.log("Audio blocked by browser."));
                    }
                }

                // 2. AUTO-OPEN THE NEWEST ORDER MODAL!
                @if($latestPendingOrders->isNotEmpty())
                    openOrderModal({{ $latestPendingOrders->first()->id }});
                @endif
            }

            localStorage.setItem('freshmart_pending_count', currentPendingCount);
        });


        // --- 3. MODAL POPUP LOGIC ---
        function openOrderModal(id) {
            const modal = document.getElementById('order-modal-' + id);
            if (modal) modal.style.display = 'flex';
        }

        function closeOrderModal(id) {
            const modal = document.getElementById('order-modal-' + id);
            if (modal) modal.style.display = 'none';
        }

        // --- 4. ALERTS LIST MODAL LOGIC ---
        function openAlertsModal() {
            const modal = document.getElementById('alerts-list-modal');
            if (modal) modal.style.display = 'flex';
        }

        function closeAlertsModal() {
            const modal = document.getElementById('alerts-list-modal');
            if (modal) modal.style.display = 'none';
        }

        // --- 5. SIDEBAR TOGGLE LOGIC ---
        let sidebarAnimationLock = false;
        const SIDEBAR_ANIMATION_MS = 340;
        const SIDEBAR_STATE_KEY = 'admin_sidebar_collapsed';

        function getStoredSidebarState() {
            try {
                const fromLocal = localStorage.getItem(SIDEBAR_STATE_KEY);
                if (fromLocal === '1' || fromLocal === '0') {
                    return fromLocal === '1';
                }
            } catch (e) {
                // Ignore localStorage access errors and fallback to cookies.
            }

            const cookieMatch = document.cookie.match(/(?:^|;\s*)admin_sidebar_collapsed=(1|0)(?:;|$)/);
            if (cookieMatch) {
                return cookieMatch[1] === '1';
            }

            return false;
        }

        function persistSidebarState(collapsed) {
            const value = collapsed ? '1' : '0';

            try {
                localStorage.setItem(SIDEBAR_STATE_KEY, value);
            } catch (e) {
                // Ignore localStorage errors and rely on cookie fallback.
            }

            document.cookie = `admin_sidebar_collapsed=${value}; path=/; max-age=31536000; SameSite=Lax`;
        }

        function syncSidebarToggleButton(collapsed) {
            const toggleBtn = document.getElementById('sidebar-toggle');
            if (!toggleBtn) return;

            toggleBtn.title = collapsed ? 'Expand menu' : 'Collapse menu';
            toggleBtn.setAttribute('aria-label', collapsed ? 'Expand menu' : 'Collapse menu');
        }

        function syncMainContentLayout() {
            const mainContent = document.getElementById('main-content');
            const sidebar = document.getElementById('sidebar');
            if (!mainContent || !sidebar) return;

            if (window.innerWidth <= 768) {
                mainContent.style.setProperty('margin-left', '0px', 'important');
                mainContent.style.setProperty('width', '100%', 'important');
                return;
            }

            const collapsed = sidebar.classList.contains('is-collapsed');
            if (collapsed) {
                mainContent.style.setProperty('margin-left', 'var(--sidebar-collapsed-width)', 'important');
                mainContent.style.setProperty('width', 'calc(100% - var(--sidebar-collapsed-width))', 'important');
            } else {
                mainContent.style.setProperty('margin-left', 'var(--sidebar-expanded-width)', 'important');
                mainContent.style.setProperty('width', 'calc(100% - var(--sidebar-expanded-width))', 'important');
            }
        }

        function setSidebarCollapsed(collapsed, options = {}) {
            const skipAnimation = !!options.skipAnimation;
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;

            const alreadyCollapsed = sidebar.classList.contains('is-collapsed');
            if (alreadyCollapsed === collapsed) {
                syncSidebarToggleButton(collapsed);
                syncMainContentLayout();
                return;
            }

            if (!skipAnimation && sidebarAnimationLock) {
                return;
            }

            if (!skipAnimation) {
                sidebarAnimationLock = true;
                sidebar.classList.add('is-animating');
            }

            sidebar.classList.toggle('is-collapsed', collapsed);
            syncSidebarToggleButton(collapsed);
            persistSidebarState(collapsed);
            syncMainContentLayout();

            if (!skipAnimation) {
                window.setTimeout(function() {
                    sidebar.classList.remove('is-animating');
                    sidebarAnimationLock = false;
                }, SIDEBAR_ANIMATION_MS);
            }
        }

        function toggleSidebar() {
            // On mobile, use slide-in drawer only (no desktop collapse mode)
            if (window.innerWidth <= 768) {
                toggleMobileSidebar();
                return;
            }

            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;

            setSidebarCollapsed(!sidebar.classList.contains('is-collapsed'));
        }

        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
                
                // Add overlay
                let overlay = document.getElementById('mobile-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.id = 'mobile-overlay';
                    overlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9998; display: none;';
                    overlay.onclick = toggleMobileSidebar;
                    document.body.appendChild(overlay);
                }
                overlay.style.display = sidebar.classList.contains('mobile-open') ? 'block' : 'none';
            }
        }

        // Ensure tables stay usable on phones by wrapping them in horizontal scroll containers.
        function normalizeAdminTables() {
            if (window.innerWidth > 1024) {
                return;
            }

            const tables = document.querySelectorAll('#main-content table');

            tables.forEach(function(table) {
                if (
                    table.closest('.table-scroll-wrap') ||
                    table.closest('.data-table-wrapper') ||
                    table.closest('[style*="overflow-x: auto"]')
                ) {
                    return;
                }

                const wrapper = document.createElement('div');
                wrapper.className = 'table-scroll-wrap';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            });
        }

        // Restore sidebar state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileHeader = document.getElementById('mobile-header');
            const savedCollapsed = getStoredSidebarState();

            normalizeAdminTables();

            // Keep native browser tooltip for collapsed navigation labels.
            document.querySelectorAll('#sidebar .nav-item[data-tooltip]').forEach(function(item) {
                if (!item.getAttribute('title')) {
                    item.setAttribute('title', item.getAttribute('data-tooltip'));
                }
            });

            if (window.innerWidth <= 768) {
                if (mobileHeader) mobileHeader.style.display = 'flex';
                if (sidebar) setSidebarCollapsed(false, { skipAnimation: true });
            } else {
                if (mobileHeader) mobileHeader.style.display = 'none';
                if (sidebar) setSidebarCollapsed(savedCollapsed, { skipAnimation: true });
            }

            syncMainContentLayout();

            // Handle resize
            window.addEventListener('resize', function() {
                const mobileHeader = document.getElementById('mobile-header');
                const sidebar = document.getElementById('sidebar');

                if (!mobileHeader || !sidebar) return;

                if (window.innerWidth <= 768) {
                    mobileHeader.style.display = 'flex';
                    setSidebarCollapsed(false, { skipAnimation: true });
                } else {
                    mobileHeader.style.display = 'none';

                    // Close mobile sidebar on desktop
                    sidebar.classList.remove('mobile-open');
                    const overlay = document.getElementById('mobile-overlay');
                    if (overlay) overlay.style.display = 'none';

                    const shouldCollapse = getStoredSidebarState();
                    setSidebarCollapsed(shouldCollapse, { skipAnimation: true });
                }

                syncMainContentLayout();
                normalizeAdminTables();
            });
        });
    </script>

    @yield('scripts')
    @stack('scripts')

</body>
</html>
