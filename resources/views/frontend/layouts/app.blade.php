<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FreshMart - Premium Organic Groceries')</title>

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
                        'khmer': ['Battambang', 'sans-serif'],
                    },
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
                        },
                        accent: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Battambang:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        body.font-khmer { font-family: 'Battambang', sans-serif; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #22c55e; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #16a34a; }
        
        /* Smooth Scroll */
        html { scroll-behavior: smooth; }
        
        /* Gradient Animation */
        .gradient-animate {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Product Card Hover */
        .product-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Mobile Menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        /* Toast Animation */
        .toast-enter {
            transform: translateX(100%);
            opacity: 0;
        }
        .toast-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }
        .toast-exit {
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease-in;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-900 antialiased {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
    <!-- Announcement Bar -->
    <div class="bg-gradient-to-r from-primary-700 to-primary-600 text-white py-2 text-sm">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span>🎉 Free Delivery on Orders Over $50 | Use Code: FRESH20 for 20% Off</span>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo & Mobile Menu Button -->
                <div class="flex items-center gap-4">
                    <button id="mobileMenuBtn" class="lg:hidden p-2 hover:bg-gray-100 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:shadow-primary-500/30 transition">
                            🛒
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">FreshMart</h1>
                            <p class="text-xs text-gray-500 -mt-1">Organic & Fresh</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="font-medium {{ request()->routeIs('home') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }} transition">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('shop') }}" class="font-medium {{ request()->routeIs('shop') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }} transition">
                        {{ __('messages.shop') }}
                    </a>
                    @if(isset($categories) && $categories->isNotEmpty())
                        <div class="relative group">
                            <button class="font-medium text-gray-600 hover:text-primary-600 transition flex items-center gap-1">
                                {{ __('messages.categories') }}
                                <svg class="w-4 h-4 transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                                <div class="py-2">
                                    @foreach($categories as $cat)
                                        <a href="{{ route('category.view', $cat->slug) }}" class="block px-4 py-2.5 hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition first:rounded-t-xl last:rounded-b-xl">
                                            {{ $cat->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('about') }}" class="font-medium {{ request()->routeIs('about') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }} transition">{{ __('messages.about') }}</a>
                    <a href="{{ route('contact') }}" class="font-medium {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }} transition">{{ __('messages.contact') }}</a>
                </nav>

                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <!-- Search -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" placeholder="Search products..."
                               class="w-64 h-[44px] pl-9 pr-4 text-sm text-gray-700 bg-white border border-gray-200 rounded-full focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 shadow-sm transition-all"
                               value="{{ request('search') }}">
                    </div>

                    <!-- Cart (Only for Guests and Customers) -->
                    @if(!auth()->check() || auth()->user()->role === 'customer')
                        <a href="{{ route('cart') }}" class="relative group">
                            <div class="w-[44px] h-[44px] bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white shadow-lg shadow-primary-500/30 group-hover:shadow-primary-500/50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span id="cart-count" class="absolute -top-1 -right-1 w-5 h-5 bg-accent-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>
                    @endif

                    <!-- Language Switcher -->
                    <div class="relative group">
                        <button class="flex items-center justify-center gap-2 px-4 h-[44px] bg-gray-50 border border-gray-100 hover:bg-gray-100 rounded-full text-sm font-semibold text-gray-700 transition-colors">
                            <span>🌐</span>
                            <span class="uppercase">{{ app()->getLocale() }}</span>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden">
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition border-b border-gray-100 {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600 font-semibold' : '' }}">
                                🇬🇧 English
                            </a>
                            <a href="{{ route('lang.switch', 'km') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition border-b border-gray-100 {{ app()->getLocale() === 'km' ? 'bg-primary-50 text-primary-600 font-semibold' : '' }}">
                                🇰🇭 ភាសាខ្មែរ
                            </a>
                            <a href="{{ route('lang.switch', 'zh') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition {{ app()->getLocale() === 'zh' ? 'bg-primary-50 text-primary-600 font-semibold' : '' }}">
                                🇨🇳 中文
                            </a>
                        </div>
                    </div>

                    <!-- Auth -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 pl-1.5 pr-4 h-[44px] bg-gray-50 border border-gray-100 hover:bg-gray-100 rounded-full text-sm font-semibold text-gray-700 transition-colors">
                                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-primary-500 flex-shrink-0">
                                    @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold">
                                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium">{{ auth()->user()->name ?? 'Account' }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="p-4 border-b border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500 flex-shrink-0">
                                            @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                                                <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold">
                                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'User' }}</p>
                                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2">
                                    @if(auth()->user()->role !== 'customer')
                                        <p class="text-xs text-gray-400 px-4 py-2 uppercase font-medium">Staff Mode Active</p>
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 hover:bg-green-50 text-green-600 font-medium transition">
                                            💻 Go to Dashboard &rarr;
                                        </a>
                                    @else
                                        <a href="{{ route('customer.orders') }}" class="block px-4 py-2.5 hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition">📦 My Orders</a>
                                        <a href="{{ route('customer.profile.edit') }}" class="block px-4 py-2.5 hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition">✏️ Edit Profile</a>
                                        <a href="{{ route('customer.profile') }}" class="block px-4 py-2.5 hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition">👤 Profile Dashboard</a>
                                    @endif
                                    <hr class="my-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2.5 hover:bg-red-50 text-red-600 transition">🚪 Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('customer.login') }}" class="hidden md:block px-4 py-2.5 bg-primary-600 text-white rounded-full font-medium hover:bg-primary-700 transition shadow-lg shadow-primary-500/30">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed inset-0 z-50 lg:hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
        <div class="absolute left-0 top-0 bottom-0 w-80 bg-white shadow-2xl overflow-y-auto">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                            🛒
                        </div>
                        <div>
                            <span class="text-xl font-bold text-gray-900">FreshMart</span>
                            <p class="text-xs text-gray-500">Fresh Groceries</p>
                        </div>
                    </div>
                    <button onclick="toggleMobileMenu()" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Search -->
                <form action="{{ route('shop') }}" method="GET" class="mb-6">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search products..."
                               class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-gray-50">
                        <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Mobile Nav -->
                <nav class="space-y-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('shop') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Shop Now
                    </a>

                    <!-- Categories Dropdown -->
                    @if(isset($categories) && $categories->isNotEmpty())
                        <div class="pt-2">
                            <button onclick="toggleCategories()" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-medium transition">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    Categories
                                </div>
                                <svg id="categoriesArrow" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="categoriesDropdown" class="hidden pl-4 pr-2 mt-1 space-y-1">
                                @foreach($categories as $cat)
                                    <a href="{{ route('category.view', $cat->slug) }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg hover:bg-primary-50 text-gray-600 hover:text-primary-600 transition text-sm">
                                        <span>{{ $cat->name }}</span>
                                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full">{{ $cat->products_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Contact
                    </a>
                </nav>

                <!-- Mobile Auth -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    @auth
                        <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink:0 border-2 border-primary-500 shadow-md">
                                    @if(auth()->user()->avatar ?? auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . (auth()->user()->avatar ?? auth()->user()->profile_photo_path)) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'User' }}</p>
                                    <p class="text-xs text-gray-500 uppercase">{{ auth()->user()->role ?? 'Customer' }}</p>
                                    @if(auth()->user()->email)
                                        <p class="text-xs text-gray-400 truncate mt-1">{{ auth()->user()->email }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->role !== 'customer')
                            <div class="mb-3 p-3 bg-green-50 border border-green-200 rounded-xl">
                                <p class="text-xs text-green-700 font-semibold mb-2">👨‍💼 Staff Mode Active</p>
                                <a href="{{ route('admin.dashboard') }}" class="block w-full px-4 py-3 bg-green-600 text-white rounded-xl font-medium text-center hover:bg-green-700 transition shadow-lg shadow-green-500/30">
                                    💻 Admin Dashboard →
                                </a>
                            </div>
                        @else
                            <div class="space-y-2">
                                <a href="{{ route('customer.orders') }}" class="block w-full px-4 py-3 bg-primary-600 text-white rounded-xl font-medium text-center hover:bg-primary-700 transition shadow-lg shadow-primary-500/30">
                                    📦 My Orders
                                </a>
                                <a href="{{ route('customer.profile.edit') }}" class="block w-full px-4 py-3 border-2 border-primary-600 text-primary-600 rounded-xl font-medium text-center hover:bg-primary-50 transition">
                                    ✏️ Edit Profile
                                </a>
                                <a href="{{ route('customer.profile') }}" class="block w-full px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium text-center hover:bg-gray-200 transition">
                                    👤 Profile
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-red-50 text-red-600 rounded-xl font-medium text-center hover:bg-red-100 transition border border-red-200">
                                🚪 Logout
                            </button>
                        </form>
                    @else
                        <div class="space-y-2">
                            <a href="{{ route('customer.login') }}" class="block w-full px-4 py-3 bg-primary-600 text-white rounded-xl font-medium text-center hover:bg-primary-700 transition shadow-lg shadow-primary-500/30">
                                🔐 Sign In
                            </a>
                            <a href="{{ route('customer.register') }}" class="block w-full px-4 py-3 border-2 border-primary-600 text-primary-600 rounded-xl font-medium text-center hover:bg-primary-50 transition">
                                📝 Create Account
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- App Download CTA -->
                <div class="mt-6 p-4 bg-gradient-to-r from-primary-500 to-primary-700 rounded-xl text-white text-center">
                    <p class="text-sm font-semibold mb-2">📱 Get the FreshMart App</p>
                    <p class="text-xs opacity-90 mb-3">Better experience, exclusive deals!</p>
                    <div class="flex gap-2 justify-center">
                        <button class="flex-1 bg-white/20 backdrop-blur-sm px-3 py-2 rounded-lg text-xs font-medium hover:bg-white/30 transition">iOS</button>
                        <button class="flex-1 bg-white/20 backdrop-blur-sm px-3 py-2 rounded-lg text-xs font-medium hover:bg-white/30 transition">Android</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Categories Dropdown
        function toggleCategories() {
            const dropdown = document.getElementById('categoriesDropdown');
            const arrow = document.getElementById('categoriesArrow');
            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }
    </script>

    <!-- Flash Messages / Toast Notifications -->
    @if(session('success'))
        <div id="toast" class="fixed top-24 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-up">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
            <button onclick="document.getElementById('toast').remove()" class="ml-2 hover:bg-white/20 rounded-lg p-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div id="toast" class="fixed top-24 right-4 z-50 bg-accent-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-up">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
            <button onclick="document.getElementById('toast').remove()" class="ml-2 hover:bg-white/20 rounded-lg p-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl">
                            🛒
                        </div>
                        <span class="text-2xl font-bold">FreshMart</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Your trusted source for fresh, organic groceries delivered to your doorstep. Quality guaranteed.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-primary-600 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-primary-600 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-primary-600 rounded-full flex items-center justify-center transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.31 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.897 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.897-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-primary-400 transition">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="text-gray-400 hover:text-primary-400 transition">Shop Now</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary-400 transition">FAQs</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Categories</h4>
                    <ul class="space-y-3">
                        @if(isset($categories) && $categories->isNotEmpty())
                            @foreach($categories->take(6) as $cat)
                                <li><a href="{{ route('category.view', $cat->slug) }}" class="text-gray-400 hover:text-primary-400 transition">{{ $cat->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Contact Us</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="text-primary-400 text-lg">📍</span>
                            <span class="text-gray-400">123 Fresh Street, Organic City, OC 12345</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-primary-400 text-lg">📞</span>
                            <span class="text-gray-400">(555) 123-4567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-primary-400 text-lg">✉️</span>
                            <span class="text-gray-400">hello@freshmart.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-primary-400 text-lg">🕐</span>
                            <span class="text-gray-400">Mon-Sat: 8AM - 8PM</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-400 text-sm">© {{ date('Y') }} FreshMart. All rights reserved.</p>
                    <div class="flex flex-wrap justify-center gap-4 md:gap-6">
                        <a href="{{ route('about') }}" class="text-gray-400 hover:text-primary-400 text-sm transition">About</a>
                        <a href="{{ route('contact') }}" class="text-gray-400 hover:text-primary-400 text-sm transition">Contact</a>
                        <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-primary-400 text-sm transition">Privacy Policy</a>
                        <a href="{{ route('terms') }}" class="text-gray-400 hover:text-primary-400 text-sm transition">Terms of Service</a>
                        <a href="{{ route('cookies') }}" class="text-gray-400 hover:text-primary-400 text-sm transition">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('open');
            document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
        }

        document.getElementById('mobileMenuBtn')?.addEventListener('click', toggleMobileMenu);

        // Sticky Header Shadow on Scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });

        // Auto-hide toast after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.add('toast-exit');
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
