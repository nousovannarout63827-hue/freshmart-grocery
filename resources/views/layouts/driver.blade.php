<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard - Grocery System</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes pulse-animation {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .toast-enter { animation: slide-in 0.3s ease-out; }
        
        /* Status badge styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-available { background: #dbeafe; color: #1d4ed8; }
        .status-assigned { background: #fef3c7; color: #b45309; }
        .status-picked-up { background: #ddd6fe; color: #6d28d9; }
        .status-in-transit { background: #bae6fd; color: #0369a1; }
        .status-delivered { background: #dcfce7; color: #15803d; }
        
        /* Card hover effects */
        .order-card {
            transition: all 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-color: #f1f5f9; margin: 0; font-family: 'Instrument Sans', sans-serif; display: flex; min-height: 100vh;">

@php
    // Get counts for the driver
    $availableOrdersCount = \App\Models\Order::where('status', 'ready_for_pickup')->whereNull('driver_id')->count();
    $myAssignedCount = \App\Models\Order::where('driver_id', auth()->id())->whereIn('status', ['assigned', 'ready_for_pickup'])->count();
    $myActiveCount = \App\Models\Order::where('driver_id', auth()->id())->whereIn('status', ['picked_up', 'in_transit'])->count();
    $completedToday = \App\Models\Order::where('driver_id', auth()->id())
        ->where('status', 'delivered')
        ->whereDate('updated_at', today())
        ->count();
@endphp

    <!-- Sidebar -->
    <aside class="sidebar" style="flex-shrink: 0; width: 280px; background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%); min-height: 100vh; position: sticky; top: 0;">

        <!-- Logo -->
        <div class="sidebar-logo" style="padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 28px; height: 28px; color: white;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125m.375-4.5a1.125 1.125 0 01-1.125 1.125H3.375m17.25-4.5c0 .621-.504 1.125-1.125 1.125H3.375m17.25-4.5a1.125 1.125 0 011.125 1.125v3.375m-1.125-4.5h-1.5m-9-9a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m.375-3.375a1.125 1.125 0 011.125-1.125h1.5a1.125 1.125 0 011.125 1.125v1.5m9 0h1.5a1.125 1.125 0 011.125 1.125v1.5a1.125 1.125 0 01-1.125 1.125h-1.5" />
                    </svg>
                </div>
                <div>
                    <div style="color: white; font-weight: 800; font-size: 18px; line-height: 1.2;">Grocery<br>Driver</div>
                    <div style="color: rgba(255,255,255,0.6); font-size: 12px; margin-top: 2px;">Delivery Portal</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="side-nav" style="padding: 16px 12px;">
            
            <!-- Dashboard Stats -->
            <div style="background: rgba(255,255,255,0.1); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                <div style="color: rgba(255,255,255,0.8); font-size: 12px; font-weight: 600; margin-bottom: 12px;">📊 Today's Stats</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="text-align: center;">
                        <div style="color: white; font-size: 24px; font-weight: 800;">{{ $completedToday }}</div>
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px;">Delivered</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="color: #86efac; font-size: 24px; font-weight: 800;">{{ $myActiveCount }}</div>
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px;">Active</div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->
            <a href="{{ route('driver.dashboard') }}" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 10px; text-decoration: none; margin-bottom: 8px; transition: all 0.2s; {{ request()->routeIs('driver.dashboard') ? 'background: rgba(255,255,255,0.15); color: white;' : 'color: rgba(255,255,255,0.8);' }}" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='white'" onmouseout="if(!{{ request()->routeIs('driver.dashboard') ? 'true' : 'false' }}) { this.style.background=''; this.style.color=''; }">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 22px; height: 22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span style="font-weight: 600; font-size: 14px;">Dashboard</span>
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'available']) }}" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 10px; text-decoration: none; margin-bottom: 8px; transition: all 0.2s; color: rgba(255,255,255,0.8);" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='white'" onmouseout="this.style.background=''; this.style.color='rgba(255,255,255,0.8);'">
                <span style="font-size: 20px;">📦</span>
                <span style="font-weight: 600; font-size: 14px; flex: 1;">Ready for Pickup</span>
                @if($availableOrdersCount > 0)
                    <span style="background: #ef4444; color: white; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px;">{{ $availableOrdersCount }}</span>
                @endif
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'assigned']) }}" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 10px; text-decoration: none; margin-bottom: 8px; transition: all 0.2s; color: rgba(255,255,255,0.8);" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='white'" onmouseout="this.style.background=''; this.style.color='rgba(255,255,255,0.8);'">
                <span style="font-size: 20px;">🎯</span>
                <span style="font-weight: 600; font-size: 14px; flex: 1;">To Pickup</span>
                @if($myAssignedCount > 0)
                    <span style="background: #f59e0b; color: white; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px;">{{ $myAssignedCount }}</span>
                @endif
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'active']) }}" style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 10px; text-decoration: none; margin-bottom: 8px; transition: all 0.2s; color: rgba(255,255,255,0.8);" onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.style.color='white'" onmouseout="this.style.background=''; this.style.color='rgba(255,255,255,0.8);'">
                <span style="font-size: 20px;">🚚</span>
                <span style="font-weight: 600; font-size: 14px; flex: 1;">Out for Delivery</span>
                @if($myActiveCount > 0)
                    <span style="background: #8b5cf6; color: white; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 12px;">{{ $myActiveCount }}</span>
                @endif
            </a>

            <!-- Profile Section -->
            <div style="margin-top: auto; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.1);">
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 12px; margin-bottom: 12px;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #60a5fa, #3b82f6); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 18px; flex-shrink: 0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <div style="color: white; font-weight: 700; font-size: 14px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">{{ auth()->user()->name }}</div>
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px; text-transform: uppercase;">Driver</div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0; padding: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 12px; background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 10px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.25)'; this.style.color='#fecaca'" onmouseout="this.style.background='rgba(239, 68, 68, 0.15)'; this.style.color='#fca5a5'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content" style="flex: 1; width: calc(100% - 280px); min-height: 100vh; overflow-x: auto;">
        
        <!-- Top Bar -->
        <div style="background: white; padding: 20px 32px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #1e293b;">@yield('page-title', 'Driver Dashboard')</h1>
                <p style="margin: 4px 0 0 0; font-size: 14px; color: #64748b;">@yield('page-subtitle', 'Manage your deliveries')</p>
            </div>
            <div style="display: flex; align-items: center; gap: 16px;">
                <div style="text-align: right;">
                    <div style="font-size: 12px; color: #64748b;">Current Time</div>
                    <div id="current-time" style="font-weight: 700; color: #1e293b; font-size: 14px;">--:--</div>
                </div>
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #60a5fa, #3b82f6); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 20px;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div style="padding: 32px;">
            @if(session('success'))
                <div id="success-toast" class="toast-enter" style="position: fixed; top: 24px; right: 24px; background: #16a34a; color: white; padding: 16px 20px; border-radius: 12px; box-shadow: 0 10px 40px rgba(22, 163, 74, 0.3); z-index: 9999; display: flex; align-items: center; gap: 12px; max-width: 400px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span style="font-weight: 600; font-size: 14px;">{{ session('success') }}</span>
                </div>
                <script>
                    setTimeout(() => {
                        const toast = document.getElementById('success-toast');
                        if (toast) {
                            toast.style.opacity = '0';
                            toast.style.transform = 'translateX(100%)';
                            toast.style.transition = 'all 0.3s ease';
                            setTimeout(() => toast.remove(), 300);
                        }
                    }, 4000);
                </script>
            @endif

            @if(session('error'))
                <div style="background: #fee2e2; border-left: 4px solid #ef4444; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span style="color: #991b1b; font-weight: 600;">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>

    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Confirm action helper
        function confirmAction(title, text, confirmUrl) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, confirm!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-6 py-3 rounded-xl font-bold',
                    cancelButton: 'px-6 py-3 rounded-xl font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = confirmUrl;
                    form.innerHTML = '@csrf @method("POST")';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
