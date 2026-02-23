<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Admin</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <style>
        @keyframes pulse-animation {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
    </style>
</head>
<body style="background-color: #f8fafc; margin: 0; font-family: 'Instrument Sans', sans-serif; display: flex; min-height: 100vh;">

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

    <aside class="sidebar" style="flex-shrink: 0; width: 260px;">
        
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
            </div>
            <div class="logo-text">
                Grocery<br>Admin
            </div>
        </div>
        
        <nav class="side-nav" style="display: flex; flex-direction: column; height: calc(100vh - 80px); overflow-y: auto;">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span style="font-size: 20px; margin-right: 10px;">📊</span>
                Dashboard
            </a>

            @if(auth()->user()->hasPermission('manage_categories'))
                <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">📁</span>
                    Categories
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_inventory'))
                <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">📦</span>
                    Inventory
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_staff'))
                <a href="{{ route('admin.staff.index') }}" class="nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">👥</span>
                    Team Management
                </a>

                <a href="{{ route('admin.customers.index') }}" class="nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">👤</span>
                    Customer Management
                </a>

                <a href="{{ route('admin.activity_logs.index') }}" class="nav-item {{ request()->routeIs('admin.activity_logs.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">👁️</span>
                    System Audit Logs
                </a>
            @endif

            @if(auth()->user()->hasPermission('manage_orders'))
                <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">🛒</span>
                    Orders
                </a>
            @endif

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.coupons.index') }}" class="nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">🎟️</span>
                    Coupons
                </a>

                <a href="{{ route('admin.driver-performance.index') }}" class="nav-item {{ request()->routeIs('admin.driver-performance.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">🚚</span>
                    Driver Performance
                </a>

                <a href="{{ route('admin.reports.drivers') }}" class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <span style="font-size: 20px; margin-right: 10px;">📈</span>
                    Reports
                </a>
            @endif

            <div style="margin-top: auto; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.1); margin-bottom: 10px;">

                <!-- Notification Bell - Opens Modal -->
                <button onclick="openAlertsModal()" style="width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px; border-radius: 8px; transition: background 0.3s; background: rgba(255,255,255,0.1); border: none; cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 22px; height: 22px; color: #e2e8f0;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <span style="color: white; font-weight: 600; font-size: 14px;">Alerts</span>
                    </div>
                    
                    @if($totalAlertsCount > 0)
                        <span style="background: #ef4444; color: white; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px; min-width: 20px; text-align: center;">{{ $totalAlertsCount }}</span>
                    @endif
                </button>

                <a href="{{ route('admin.profile') }}" style="display: flex; align-items: center; gap: 12px; padding: 10px; text-decoration: none; border-radius: 8px; transition: background 0.3s; margin-bottom: 10px;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">

                    <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; flex-shrink: 0;">
                        @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    </div>

                    <div style="overflow: hidden; flex: 1;">
                        <div style="color: white; font-weight: 600; font-size: 14px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                            {{ auth()->user()->name }}
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px; margin-top: 2px; flex-wrap: wrap;">
                            @php
                                $userRole = auth()->user()->role;
                                if ($userRole === 'admin' || $userRole === 'super_user') {
                                    $badgeColor = '#7c3aed';
                                    $badgeIcon = '👑';
                                    $badgeText = 'Admin';
                                } elseif ($userRole === 'staff') {
                                    $badgeColor = '#2563eb';
                                    $badgeIcon = '🏬';
                                    $badgeText = 'Staff';
                                } elseif ($userRole === 'driver') {
                                    $badgeColor = '#d97706';
                                    $badgeIcon = '🚚';
                                    $badgeText = 'Driver';
                                } else {
                                    $badgeColor = '#64748b';
                                    $badgeIcon = '👤';
                                    $badgeText = ucfirst($userRole);
                                }
                                $loginTime = session('login_time');
                            @endphp
                            <span style="background: {{ $badgeColor }}; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 3px; white-space: nowrap;">
                                {{ $badgeIcon }} {{ $badgeText }}
                            </span>
                            {{-- DEBUG: Check session --}}
                            @if($loginTime)
                                <span style="color: #94a3b8; font-size: 10px; white-space: nowrap;">• {{ \Carbon\Carbon::parse($loginTime)->diffForHumans() }}</span>
                            @else
                                <span style="color: #ef4444; font-size: 9px;">[No login session]</span>
                            @endif
                        </div>
                    </div>

                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 12px 15px 10px 15px; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 8px; font-weight: 600; text-align: left; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.color='#fca5a5';" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#f87171';">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>

                        <span style="font-size: 14px; letter-spacing: 0.5px;">Log Out</span>
                        
                    </button>
                </form>

            </div>
        </nav>
    </aside>

    <div class="main-content" style="flex: 1; width: calc(100% - 260px); min-height: 100vh; overflow-x: auto;">
        @yield('content')
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- New Order Audio Alert -->
    <audio id="new-order-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    <!-- Alerts List Modal -->
    <div id="alerts-list-modal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.4); display: none; z-index: 9998; align-items: center; justify-content: center; backdrop-filter: blur(4px); transition: opacity 0.3s ease;">
        <div style="background: white; width: 100%; max-width: 500px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: 1px solid #e2e8f0; overflow: hidden; position: relative;">

            <div style="background: #f8fafc; padding: 16px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 900; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                    🔔 Warehouse Alerts
                    @if($totalAlertsCount > 0)
                        <span style="background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px; text-transform: uppercase;">{{ $totalAlertsCount }} Total</span>
                    @endif
                </h2>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button id="toggle-sound-btn" style="background: none; border: none; font-size: 20px; cursor: pointer; transition: all 0.2s; opacity: 1;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Toggle Alert Sound">
                        🔊
                    </button>
                    <button onclick="closeAlertsModal()" style="background: none; border: none; padding: 8px; border-radius: 8px; cursor: pointer; color: #94a3b8; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2'; this.style.color='#ef4444'" onmouseout="this.style.background='transparent'; this.style.color='#94a3b8'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <div style="max-height: 400px; overflow-y: auto; overflow-x: hidden; padding: 8px;">
                
                <!-- Pending Orders Section -->
                @if($pendingOrdersCount > 0)
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">📦 Pending Orders ({{ $pendingOrdersCount }})</div>
                    @foreach($latestPendingOrders as $pending)
                        <button onclick="closeAlertsModal(); openOrderModal({{ $pending->id }})" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #f8fafc; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <span style="font-size: 24px; line-height: 1;">📦</span>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #1e293b; font-size: 14px;">Order #{{ str_pad($pending->id, 8, '0', STR_PAD_LEFT) }}</p>
                                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $pending->customer->name ?? 'Customer' }} • ${{ number_format($pending->total_amount, 2) }}</p>
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
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px;">🛑 Out of Stock ({{ $outOfStockCount }})</div>
                    @foreach($outOfStockProducts as $product)
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #fef2f2; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <span style="font-size: 24px; line-height: 1;">🛑</span>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #b91c1c; font-size: 14px;">{{ $product->name }}</p>
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
                    <div style="padding: 8px 16px; font-size: 12px; font-weight: 800; color: #d97706; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px;">⚠️ Low Stock ({{ $lowStockCount }})</div>
                    @foreach($lowStockProducts as $product)
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="width: 100%; text-align: left; display: block; padding: 16px; border-bottom: 1px solid #fffbeb; text-decoration: none; transition: background 0.2s; background: none; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#fffbeb'" onmouseout="this.style.background='transparent'">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <span style="font-size: 24px; line-height: 1;">⚠️</span>
                                <div style="flex: 1; min-width: 0;">
                                    <p style="margin: 0; font-weight: 800; color: #92400e; font-size: 14px;">{{ $product->name }}</p>
                                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p style="margin: 6px 0 0 0; font-size: 11px; color: #d97706; font-weight: 800; text-transform: uppercase;">Only {{ $product->stock }} left</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

                @if($pendingOrdersCount == 0 && $outOfStockCount == 0 && $lowStockCount == 0)
                    <div style="padding: 40px 20px; text-align: center;">
                        <span style="font-size: 48px; display: block; margin-bottom: 8px;">🎉</span>
                        <p style="margin: 0; font-weight: 800; color: #1e293b; font-size: 14px;">All clear!</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #94a3b8;">No pending orders or stock alerts.</p>
                    </div>
                @endif
            </div>

            <div style="padding: 12px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                <a href="{{ route('admin.orders.index') }}" style="font-size: 13px; font-weight: 800; color: #16a34a; text-decoration: none; text-align: center; padding: 8px; border-radius: 8px; background: #f0fdf4;" onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">View Orders →</a>
                <a href="{{ route('admin.products.index', ['low_stock' => 1]) }}" style="font-size: 13px; font-weight: 800; color: #d97706; text-decoration: none; text-align: center; padding: 8px; border-radius: 8px; background: #fffbeb;" onmouseover="this.style.background='#fef3c7'" onmouseout="this.style.background='#fffbeb'">Low Stock →</a>
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
                                <span style="font-weight: 700; color: #334155;">{{ $item->quantity }}x {{ $item->product->name ?? 'Product' }}</span>
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
                soundBtn.innerText = soundEnabled ? '🔊' : '🔇';
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

            // 🚨 IF A NEW ORDER ARRIVES
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
    </script>

    @yield('scripts')

</body>
</html>
