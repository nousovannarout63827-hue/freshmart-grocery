@extends('layouts.admin')

{{-- Auto-refresh every 60 seconds to catch new orders --}}
<meta http-equiv="refresh" content="300">

@section('content')

<style>
@media (max-width: 768px) {
    .admin-dashboard-page {
        padding: 16px !important;
        gap: 16px !important;
    }

    .admin-dashboard-welcome {
        padding: 20px 16px !important;
        border-radius: 16px !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 14px !important;
    }

    .admin-dashboard-welcome h1 {
        font-size: 28px !important;
        line-height: 1.2 !important;
        word-break: break-word;
    }

    .admin-dashboard-welcome p {
        font-size: 15px !important;
    }

    .admin-dashboard-welcome-user {
        width: 100% !important;
        justify-content: space-between !important;
        padding: 10px 12px !important;
        box-sizing: border-box;
    }

    .admin-dashboard-row {
        flex-direction: column !important;
        gap: 16px !important;
        margin-top: 16px !important;
    }

    .admin-dashboard-row > div {
        width: 100% !important;
        min-width: 0 !important;
        padding: 18px !important;
        box-sizing: border-box;
    }

    .admin-dashboard-top-customers {
        flex: 1 1 100% !important;
    }

    .admin-dashboard-alert-btn {
        width: 100% !important;
    }
}

@media (max-width: 480px) {
    .admin-dashboard-welcome h1 {
        font-size: 24px !important;
    }
}

.admin-dashboard-alert-btn {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    max-width: 100%;
    box-sizing: border-box;
    text-align: center;
}
</style>

<div class="admin-dashboard-page" style="padding: 30px; box-sizing: border-box; display: flex; flex-direction: column; gap: 25px;">
    
    <!-- Welcome Banner -->
    <div class="admin-dashboard-welcome" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; padding: 35px 30px; color: white; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 10px rgba(0, 200, 83, 0.2);">
        <div>
            <h1 style="margin: 0; font-size: 32px; font-weight: 900;">Welcome back, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
            <p style="margin: 8px 0 0 0; font-size: 16px; opacity: 0.9; font-weight: 500;">Let's take a detailed look at your store situation today.</p>
        </div>

        <div class="admin-dashboard-welcome-user" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); padding: 10px 20px; border-radius: 14px; display: flex; align-items: center; gap: 15px;">
            <div style="text-align: right;">
                <div style="font-weight: 800; font-size: 15px; line-height: 1.2;">{{ auth()->user()->name }}</div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9;">
                    {{ ucfirst(auth()->user()->role) }}
                </div>
            </div>
            <div style="width: 48px; height: 48px; border-radius: 12px; overflow: hidden; background: white; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; box-shadow: 0 4px 6px rgba(0,0,0,0.1); flex-shrink: 0;">
                @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                    <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>
        </div>
    </div>

    <!-- Dashboard Overviews -->
    <div class="overview-container" style="margin: 0; padding: 30px; background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
        <h2 style="margin-top: 0; margin-bottom: 20px; color: #1e293b; font-size: 22px; font-weight: 800;">Dashboard Overviews</h2>
        
        <div class="card-grid-5">
            
            <div class="stat-card categories">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Categories</span>
                        <span class="value">{{ $categoriesCount }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card products">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Products</span>
                        <span class="value">{{ $productsCount }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.products.index') }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card total-orders">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Total Orders</span>
                        <span class="value">{{ $totalOrders }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card delivered">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Delivered Items</span>
                        <span class="value">{{ $deliveredItems }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card pending">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Pending Items</span>
                        <span class="value">{{ $pendingItems }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card users">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Users</span>
                        <span class="value">{{ $usersCount }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.customers.index') }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card sold-amount">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Sold Amount</span>
                        <span class="value" style="font-size: 32px;">$ {{ number_format($soldAmount ?? 0, 2) }}</span>
                    </div>
                </div>
                <a href="#" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card feedback">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 28px; height: 28px; color: #db2777;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Feedbacks</span>
                        <span class="value">{{ $feedbacksCount }}</span>
                    </div>
                </div>
                <a href="#" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

            <div class="stat-card canceled">
                <div class="card-top-row">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="card-info">
                        <span class="label">Canceled Orders</span>
                        <span class="value">{{ $canceledOrders }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="view-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    View Details
                </a>
            </div>

        </div>
    </div>

    <!-- Out of Stock Alert (Critical - 0 stock) -->
    @if($outOfStockItems->count() > 0)
    <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); border: 1px solid #fca5a5; margin-bottom: 25px;">
        
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <h2 style="margin: 0; color: #991b1b; font-size: 20px; font-weight: 800;">🛑 Out of Stock Action Required</h2>
            <span style="background: #991b1b; color: white; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">{{ $outOfStockCount }} items</span>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
            @foreach($outOfStockItems as $item)
                <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; padding: 15px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 800; color: #7f1d1d; font-size: 14px;">{{ $item->name }}</div>
                        <div style="font-size: 12px; color: #991b1b; opacity: 0.8;">{{ $item->category->name ?? 'None' }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-weight: 900; color: #991b1b; font-size: 20px; line-height: 1;">0</div>
                        <div style="font-size: 11px; color: #991b1b; text-transform: uppercase;">left</div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('admin.products.index', ['out_of_stock' => 1]) }}" class="btn admin-dashboard-alert-btn" style="background: #991b1b; color: white; border: none; font-weight: bold; padding: 8px 16px; border-radius: 8px;">
            Resolve Out of Stock →
        </a>
    </div>
    @endif

    <!-- Low Stock Alert (Warning - 1 to min_stock_level) -->
    @if($lowStockItems->count() > 0)
    <div style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
        
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <h2 style="margin: 0; color: #ef4444; font-size: 20px; font-weight: 800;">⚠️ Low Stock Alert</h2>
            <span style="background: #ef4444; color: white; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">{{ $lowStockCount }} items</span>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
            @foreach($lowStockItems as $item)
                <div style="background: #fff0f2; border-radius: 12px; padding: 15px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 800; color: #1e293b; font-size: 14px;">{{ $item->name }}</div>
                        <div style="font-size: 12px; color: #64748b;">{{ $item->category->name ?? 'None' }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-weight: 900; color: #ef4444; font-size: 20px; line-height: 1;">{{ $item->stock }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">left</div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('admin.products.index', ['low_stock' => 1]) }}" class="btn btn-danger admin-dashboard-alert-btn" style="font-weight: bold; padding: 8px 16px; border-radius: 8px;">
            View All Low Stock →
        </a>
    </div>
    @endif

    <!-- Revenue Chart and Top Customers Side-by-Side -->
    <div class="admin-dashboard-row" style="display: flex; flex-wrap: wrap; gap: 24px; align-items: flex-start; margin-top: 24px;">

        <!-- Monthly Revenue Chart -->
        <div style="flex: 1; min-width: 450px; background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
            <div class="chart-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 28px; height: 28px; color: #10b981;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                <h2 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 800;">Monthly Revenue ({{ date('Y') }})</h2>
            </div>
            <div class="chart-wrapper" style="position: relative; height: 300px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Weekly Sales Chart -->
        <div style="flex: 1; min-width: 450px; background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
            <div class="chart-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 28px; height: 28px; color: #059669;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
                <h2 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 800;">Weekly Sales (Last 7 Days)</h2>
            </div>
            <div class="chart-wrapper" style="position: relative; height: 300px;">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Order Status Distribution & Top Customers -->
    <div class="admin-dashboard-row" style="display: flex; flex-wrap: wrap; gap: 24px; margin-top: 24px;">

        <!-- Order Status Pie Chart -->
        <div style="flex: 1; min-width: 400px; background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
            <div class="chart-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 28px; height: 28px; color: #8b5cf6;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                <h2 style="margin: 0; color: #1e293b; font-size: 20px; font-weight: 800;">Order Status Distribution</h2>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; height: 300px;">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>

        <!-- Top Customers Leaderboard -->
        <div class="admin-dashboard-top-customers" style="flex: 0 0 380px; background: white; padding: 24px; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <h3 style="font-weight: 800; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 18px;">
                <span style="font-size: 24px;">🏆</span> Top Customers
            </h3>

            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($topCustomers as $index => $customer)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; border-radius: 12px; background: {{ $index == 0 ? '#f0fdf4' : '#f8fafc' }}; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: {{ $index == 0 ? '#10b981' : '#e2e8f0' }}; color: {{ $index == 0 ? 'white' : '#64748b' }}; font-size: 12px; font-weight: 800; flex-shrink: 0;">
                            {{ $index + 1 }}
                        </span>
                        @if($customer->avatar ?? $customer->profile_photo_path)
                            <img src="{{ asset('storage/' . ($customer->avatar ?? $customer->profile_photo_path)) }}" alt="{{ $customer->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0; flex-shrink: 0;">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; flex-shrink: 0;">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p style="margin: 0; font-weight: 700; color: #1e293b; font-size: 13px;">{{ $customer->name }}</p>
                            <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">{{ Str::limit($customer->email, 20) }}</p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <p style="margin: 0; font-weight: 800; color: #10b981; font-size: 14px;">${{ number_format($customer->total_spent ?? 0, 2) }}</p>
                        <p style="margin: 2px 0 0 0; font-size: 9px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Total Spent</p>
                    </div>
                </div>
                @endforeach

                @if($topCustomers->isEmpty())
                <div style="text-align: center; padding: 30px 20px;">
                    <div style="font-size: 36px; margin-bottom: 8px;">📊</div>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">No sales data yet</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels ?: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode($data ?: [15000, 22000, 18000, 29000, 24000, 31000]) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return '$' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            }
        }
    });

    // Weekly Sales Bar Chart
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(weeklyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($weeklyLabels ?: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']) !!},
            datasets: [{
                label: 'Sales ($)',
                data: {!! json_encode($weeklySales ?: [0, 0, 0, 0, 0, 0, 0]) !!},
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(5, 150, 105, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(134, 239, 172, 0.8)',
                    'rgba(74, 222, 128, 0.8)',
                    'rgba(110, 231, 183, 0.8)',
                    'rgba(167, 243, 208, 0.8)'
                ],
                borderColor: [
                    '#10b981',
                    '#059669',
                    '#22c55e',
                    '#86efac',
                    '#4ade80',
                    '#6ee7b7',
                    '#a7f3d0'
                ],
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return '$' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            }
        }
    });

    // Order Status Pie Chart
    const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Confirmed', 'Preparing', 'Shipped', 'Out for Delivery', 'Delivered', 'Cancelled'],
            datasets: [{
                data: [
                    {{ $orderStatusData['pending'] ?? 0 }},
                    {{ $orderStatusData['confirmed'] ?? 0 }},
                    {{ $orderStatusData['preparing'] ?? 0 }},
                    {{ $orderStatusData['shipped'] ?? 0 }},
                    {{ $orderStatusData['out_for_delivery'] ?? 0 }},
                    {{ $orderStatusData['delivered'] ?? 0 }},
                    {{ $orderStatusData['cancelled'] ?? 0 }}
                ],
                backgroundColor: [
                    '#fbbf24',
                    '#3b82f6',
                    '#a855f7',
                    '#6366f1',
                    '#06b6d4',
                    '#10b981',
                    '#ef4444'
                ],
                borderWidth: 3,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' orders';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
