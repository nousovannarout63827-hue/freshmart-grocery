<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Account - FreshMart')</title>
    
    @if(request()->routeIs('customer.order.details'))
        <!-- Auto-refresh every 30 seconds for live order tracking -->
        <meta http-equiv="refresh" content="30">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('grocery-icon.png') }}?v=2">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac',
                            400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d',
                            800: '#166534', 900: '#14532d',
                        },
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Top Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl">
                        🛒
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">FreshMart</span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('shop') }}" class="text-gray-600 hover:text-primary-600 font-medium hidden sm:block">
                        Continue Shopping
                    </a>
                    <form action="{{ route('customer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-red-600 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar (Only for Customers) -->
            @if(auth()->check() && auth()->user()->role === 'customer')
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24">
                    <!-- Profile Card -->
                    @php $user = auth()->user(); @endphp
                    <div class="text-center mb-6 pb-6 border-b border-gray-100">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100 mx-auto mb-3">
                        @else
                            <div class="w-20 h-20 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-3">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <h3 class="font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-1">
                        <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.profile') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.orders') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            My Orders
                        </a>
                        <a href="{{ route('customer.reviews') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.reviews') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            My Reviews
                        </a>
                        <a href="{{ route('customer.wishlist') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.wishlist') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            Wishlist
                        </a>
                        <a href="{{ route('customer.profile') }}#profile" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.profile.edit') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Settings
                        </a>
                        <a href="{{ route('customer.notifications') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('customer.notifications') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            Notifications
                            @php $unreadCount = auth()->user()->unreadNotifications()->count(); @endphp
                            @if($unreadCount > 0)
                                <span class="ml-auto px-2 py-0.5 bg-red-500 text-white text-xs font-bold rounded-full">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </nav>
                </div>
            </aside>
            @endif

            <!-- Main Content -->
            <main class="flex-1">
                @if(auth()->check() && auth()->user()->role !== 'customer')
                    <!-- Staff Quick Access Banner -->
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-6 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl">
                                💻
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-green-800">Staff Mode Active</h3>
                                <p class="text-sm text-green-600">You are viewing the customer area as {{ auth()->user()->role }}.</p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-green-600 text-white rounded-xl font-medium hover:bg-green-700 transition whitespace-nowrap">
                                Back to Dashboard &rarr;
                            </a>
                        </div>
                    </div>
                @endif
                @yield('profile-content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
