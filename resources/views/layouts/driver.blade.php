<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Driver Dashboard') - Grocery System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('grocery-icon.png') }}?v=2">
    
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-950: #0f2a5f;
            --brand-800: #1741a1;
            --brand-700: #1e4fab;
            --brand-500: #3b82f6;
            --accent-500: #f97316;
            --accent-100: #ffedd5;
            --surface-100: #ffffff;
            --surface-90: #f8fbff;
            --surface-80: #eef4ff;
            --line: #dbe6f7;
            --text-900: #0f172a;
            --text-600: #5b6b87;
            --success-500: #16a34a;
            --error-500: #dc2626;
            --radius-lg: 18px;
            --radius-md: 12px;
            --shadow-soft: 0 24px 50px -30px rgba(15, 42, 95, 0.42);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: var(--text-900);
            background:
                radial-gradient(120% 100% at 80% -15%, rgba(249, 115, 22, 0.16), transparent 50%),
                radial-gradient(80% 90% at -10% 10%, rgba(59, 130, 246, 0.2), transparent 55%),
                #f3f7ff;
        }

        .driver-shell {
            display: flex;
            min-height: 100vh;
        }

        .driver-sidebar {
            width: 286px;
            flex-shrink: 0;
            padding: 22px 16px 18px;
            background: linear-gradient(190deg, var(--brand-950) 0%, var(--brand-800) 82%);
            color: #ffffff;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .driver-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 10px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .driver-logo-mark {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .driver-logo-title {
            margin: 0;
            font-size: 17px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: 0.2px;
        }

        .driver-logo-subtitle {
            margin: 2px 0 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            font-weight: 600;
        }

        .driver-side-summary {
            margin: 16px 4px;
            padding: 14px;
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(2px);
        }

        .driver-side-summary-label {
            color: rgba(255, 255, 255, 0.76);
            font-size: 11px;
            letter-spacing: 0.55px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .driver-side-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .driver-side-summary-value {
            font-size: 22px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .driver-side-summary-title {
            font-size: 11px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.76);
        }

        .driver-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 4px;
        }

        .driver-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.82);
            font-size: 14px;
            font-weight: 700;
            border-radius: 11px;
            padding: 12px 13px;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .driver-nav-link:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            transform: translateX(2px);
        }

        .driver-nav-link.is-active {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }

        .driver-nav-count {
            margin-left: auto;
            min-width: 22px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 11px;
            line-height: 1.3;
            text-align: center;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .driver-profile {
            margin-top: auto;
            padding: 14px;
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.08);
        }

        .driver-profile-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .driver-profile-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
            border-radius: 10px;
            padding: 2px;
            transition: background 0.2s ease;
        }

        .driver-profile-link:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .driver-avatar-link {
            text-decoration: none;
            color: inherit;
        }

        .driver-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 17px;
            font-weight: 800;
            color: #ffffff;
            background: linear-gradient(145deg, #58a3ff, #2f6fed);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        .driver-avatar-image {
            width: 100%;
            height: 100%;
            border-radius: inherit;
            object-fit: cover;
            display: block;
        }

        .driver-profile-name {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
        }

        .driver-profile-role {
            margin: 2px 0 0;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.74);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 700;
        }

        .driver-logout-btn {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(220, 38, 38, 0.18);
            color: #ffd8d8;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .driver-logout-btn:hover {
            background: rgba(220, 38, 38, 0.28);
            color: #ffffff;
        }

        .driver-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .driver-topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .driver-topbar-tag {
            margin: 0;
            color: #4f6291;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.55px;
            text-transform: uppercase;
        }

        .driver-topbar h1 {
            margin: 3px 0 0;
            font-size: 24px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.2px;
            color: #10203f;
        }

        .driver-topbar p:last-child {
            margin: 4px 0 0;
            color: var(--text-600);
            font-size: 13px;
            font-weight: 600;
        }

        .driver-topbar-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .driver-time-box {
            text-align: right;
            padding: 8px 11px;
            border-radius: 11px;
            border: 1px solid var(--line);
            background: var(--surface-100);
        }

        .driver-time-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.45px;
            color: #68799a;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .driver-time-value {
            font-size: 13px;
            color: #1f3156;
            font-weight: 800;
        }

        .driver-page {
            padding: 24px 28px 30px;
            width: 100%;
        }

        .driver-alert {
            margin-bottom: 16px;
            border-radius: var(--radius-md);
            border: 1px solid;
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: var(--shadow-soft);
        }

        .driver-alert-success {
            border-color: rgba(22, 163, 74, 0.38);
            color: #14532d;
            background: #dcfce7;
        }

        .driver-alert-error {
            border-color: rgba(220, 38, 38, 0.35);
            color: #7f1d1d;
            background: #fee2e2;
        }

        .driver-mobile-nav {
            display: none;
        }

        @media (max-width: 1024px) {
            .driver-sidebar {
                display: none;
            }

            .driver-topbar {
                padding: 14px 14px 13px;
                gap: 10px;
                align-items: flex-start;
            }

            .driver-topbar h1 {
                font-size: 21px;
            }

            .driver-topbar p:last-child {
                font-size: 12px;
            }

            .driver-time-box {
                padding: 7px 9px;
            }

            .driver-avatar {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                font-size: 15px;
            }

            .driver-page {
                padding: 14px 12px 104px;
            }

            .driver-alert {
                margin-bottom: 12px;
                padding: 11px 12px;
                font-size: 12px;
            }

            .driver-mobile-nav {
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 70;
                display: grid;
                grid-template-columns: repeat(6, minmax(0, 1fr));
                gap: 6px;
                padding: 9px 8px calc(9px + env(safe-area-inset-bottom));
                background: rgba(255, 255, 255, 0.94);
                backdrop-filter: blur(12px);
                border-top: 1px solid var(--line);
            }

            .driver-mobile-nav form {
                margin: 0;
            }

            .driver-mobile-link,
            .driver-mobile-logout {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                text-decoration: none;
                min-height: 56px;
                border-radius: 12px;
                border: 1px solid transparent;
                color: #5e7094;
                font-size: 10px;
                font-weight: 800;
                line-height: 1.25;
                background: transparent;
                width: 100%;
                min-width: 0;
                padding: 6px 2px;
            }

            .driver-mobile-link.is-active {
                background: #eaf2ff;
                border-color: #bed2ff;
                color: #1d4fb2;
            }

            .driver-mobile-link strong {
                font-size: 13px;
            }

            .driver-mobile-logout {
                cursor: pointer;
                color: #b42323;
            }

            .driver-mobile-logout strong {
                font-size: 13px;
            }
        }

        @media (max-width: 640px) {
            .driver-topbar {
                padding: 11px 10px 10px;
            }

            .driver-topbar h1 {
                font-size: 19px;
            }

            .driver-topbar p:last-child {
                display: none;
            }

            .driver-topbar-meta {
                gap: 6px;
            }

            .driver-time-box {
                padding: 6px 7px;
            }

            .driver-page {
                padding: 12px 10px 104px;
            }

            .driver-mobile-link strong,
            .driver-mobile-logout strong {
                font-size: 12px;
            }

            .driver-mobile-link,
            .driver-mobile-logout {
                font-size: 9px;
            }
        }

    </style>
    @stack('styles')
</head>
<body>
@php
    $availableOrdersCount = \App\Models\Order::where('status', 'ready_for_pickup')
        ->whereNull('driver_id')
        ->count();

    $myAssignedCount = \App\Models\Order::where('driver_id', auth()->id())
        ->where('status', 'ready_for_pickup')
        ->count();

    $myActiveCount = \App\Models\Order::where('driver_id', auth()->id())
        ->whereIn('status', ['out_for_delivery', 'arrived'])
        ->count();

    $completedToday = \App\Models\Order::where('driver_id', auth()->id())
        ->where('status', 'delivered')
        ->whereDate('updated_at', today())
        ->count();

    $myMonthDelivered = \App\Models\Order::where('driver_id', auth()->id())
        ->where('status', 'delivered')
        ->whereYear('updated_at', now()->year)
        ->whereMonth('updated_at', now()->month)
        ->count();

    $currentFilter = request('filter', 'all');
    if ($currentFilter === 'assigned') {
        $currentFilter = 'pickup';
    }
    $isDashboardRoute = request()->routeIs('driver.dashboard');
    $isProfileRoute = request()->routeIs('driver.profile');

    $driverPhotoPath = auth()->user()->avatar ?? auth()->user()->profile_photo_path;
    $driverPhotoUrl = null;
    if (!empty($driverPhotoPath)) {
        if (\Illuminate\Support\Str::startsWith($driverPhotoPath, ['http://', 'https://'])) {
            $driverPhotoUrl = $driverPhotoPath;
        } else {
            $driverPhotoUrl = asset('storage/' . $driverPhotoPath);
        }
    }
@endphp

<div class="driver-shell">
    <aside class="driver-sidebar">
        <div class="driver-logo">
            <div class="driver-logo-mark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;">
                    <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9 1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                </svg>
            </div>
            <div>
                <p class="driver-logo-title">Grocery Driver</p>
                <p class="driver-logo-subtitle">Delivery Control</p>
            </div>
        </div>

        <div class="driver-side-summary">
            <div class="driver-side-summary-label">Today</div>
            <div class="driver-side-summary-grid">
                <div>
                    <div class="driver-side-summary-value">{{ $completedToday }}</div>
                    <div class="driver-side-summary-title">Delivered</div>
                </div>
                <div>
                    <div class="driver-side-summary-value">{{ $myActiveCount }}</div>
                    <div class="driver-side-summary-title">Active</div>
                </div>
            </div>
        </div>

        <nav class="driver-nav">
            <a href="{{ route('driver.dashboard') }}" class="driver-nav-link {{ $isDashboardRoute && $currentFilter === 'all' ? 'is-active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'available']) }}" class="driver-nav-link {{ $isDashboardRoute && $currentFilter === 'available' ? 'is-active' : '' }}">
                Available
                @if($availableOrdersCount > 0)
                    <span class="driver-nav-count">{{ $availableOrdersCount }}</span>
                @endif
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'pickup']) }}" class="driver-nav-link {{ $isDashboardRoute && $currentFilter === 'pickup' ? 'is-active' : '' }}">
                Pickup Queue
                @if($myAssignedCount > 0)
                    <span class="driver-nav-count">{{ $myAssignedCount }}</span>
                @endif
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'active']) }}" class="driver-nav-link {{ $isDashboardRoute && $currentFilter === 'active' ? 'is-active' : '' }}">
                Active Deliveries
                @if($myActiveCount > 0)
                    <span class="driver-nav-count">{{ $myActiveCount }}</span>
                @endif
            </a>

            <a href="{{ route('driver.dashboard', ['filter' => 'report']) }}" class="driver-nav-link {{ $isDashboardRoute && $currentFilter === 'report' ? 'is-active' : '' }}">
                Performance Report
                @if($myMonthDelivered > 0)
                    <span class="driver-nav-count">{{ $myMonthDelivered }}</span>
                @endif
            </a>

            <a href="{{ route('driver.profile') }}" class="driver-nav-link {{ $isProfileRoute ? 'is-active' : '' }}">
                My Profile
            </a>
        </nav>

        <div class="driver-profile">
            <a href="{{ route('driver.profile') }}" class="driver-profile-link">
                <div class="driver-avatar">
                    @if($driverPhotoUrl)
                        <img src="{{ $driverPhotoUrl }}" alt="{{ auth()->user()->name }}" class="driver-avatar-image">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <p class="driver-profile-name">{{ auth()->user()->name }}</p>
                    <p class="driver-profile-role">Driver</p>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="driver-logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    <main class="driver-main">
        <header class="driver-topbar">
            <div>
                <p class="driver-topbar-tag">Route control</p>
                <h1>@yield('page-title', 'Driver Dashboard')</h1>
                <p>@yield('page-subtitle', 'Manage your deliveries fast from your phone')</p>
            </div>
            <div class="driver-topbar-meta">
                <div class="driver-time-box">
                    <span class="driver-time-label">Local Time</span>
                    <span id="current-time" class="driver-time-value">--:--</span>
                </div>
                <a href="{{ route('driver.profile') }}" class="driver-avatar driver-avatar-link" aria-label="Open profile">
                    @if($driverPhotoUrl)
                        <img src="{{ $driverPhotoUrl }}" alt="{{ auth()->user()->name }}" class="driver-avatar-image">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </a>
            </div>
        </header>

        <section class="driver-page">
            @if(session('success'))
                <div id="success-toast" class="driver-alert driver-alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="driver-alert driver-alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </section>
    </main>
</div>

<nav class="driver-mobile-nav">
    <a href="{{ route('driver.dashboard') }}" class="driver-mobile-link {{ $isDashboardRoute && $currentFilter === 'all' ? 'is-active' : '' }}">
        <strong>{{ $myActiveCount }}</strong>
        <span>Home</span>
    </a>
    <a href="{{ route('driver.dashboard', ['filter' => 'active']) }}" class="driver-mobile-link {{ $isDashboardRoute && $currentFilter === 'active' ? 'is-active' : '' }}">
        <strong>{{ $myActiveCount }}</strong>
        <span>Active</span>
    </a>
    <a href="{{ route('driver.dashboard', ['filter' => 'pickup']) }}" class="driver-mobile-link {{ $isDashboardRoute && $currentFilter === 'pickup' ? 'is-active' : '' }}">
        <strong>{{ $myAssignedCount }}</strong>
        <span>Pickup</span>
    </a>
    <a href="{{ route('driver.dashboard', ['filter' => 'available']) }}" class="driver-mobile-link {{ $isDashboardRoute && $currentFilter === 'available' ? 'is-active' : '' }}">
        <strong>{{ $availableOrdersCount }}</strong>
        <span>Open</span>
    </a>
    <a href="{{ route('driver.dashboard', ['filter' => 'report']) }}" class="driver-mobile-link {{ $isDashboardRoute && $currentFilter === 'report' ? 'is-active' : '' }}">
        <strong>{{ $myMonthDelivered }}</strong>
        <span>Report</span>
    </a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="driver-mobile-logout">
            <strong>Out</strong>
            <span>Logout</span>
        </button>
    </form>
</nav>

<script>
    function updateTime() {
        const timeNode = document.getElementById('current-time');
        if (!timeNode) {
            return;
        }
        const now = new Date();
        timeNode.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    }

    updateTime();
    setInterval(updateTime, 1000);

    function confirmAction(title, text, confirmUrl) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (!result.isConfirmed) {
                return;
            }
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = confirmUrl;
            form.innerHTML = '@csrf @method("POST")';
            document.body.appendChild(form);
            form.submit();
        });
    }

    setTimeout(() => {
        const toast = document.getElementById('success-toast');
        if (!toast) {
            return;
        }
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(-4px)';
        toast.style.transition = 'all 0.25s ease';
        setTimeout(() => toast.remove(), 250);
    }, 3800);
</script>

@stack('scripts')
</body>
</html>
