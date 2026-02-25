@extends('frontend.layouts.app')

@section('title', 'FreshMart - Premium Organic Groceries Delivered')

@section('content')
    <!-- Hero Section with Gradient Animation -->
    <section class="relative gradient-animate bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 text-9xl">🥬</div>
            <div class="absolute top-40 right-20 text-8xl">🍎</div>
            <div class="absolute bottom-20 left-1/4 text-9xl">🥕</div>
            <div class="absolute bottom-40 right-1/3 text-8xl">🍇</div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in">
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                        <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium">100% Organic & Fresh Products</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                        Fresh & Organic
                        <span class="block text-green-200">Groceries Delivered</span>
                    </h1>
                    <p class="text-lg text-green-100 mb-8 leading-relaxed max-w-xl">
                        Shop the freshest produce, pantry staples, and organic essentials. 
                        From locally sourced farms directly to your doorstep within hours.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('shop') }}" class="group bg-white text-primary-700 px-8 py-4 rounded-full font-semibold hover:bg-green-50 transition shadow-xl hover:shadow-2xl inline-flex items-center gap-2">
                            Shop Now
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="#categories" class="border-2 border-white/50 backdrop-blur-sm text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-primary-700 transition inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                            Browse Categories
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-white/20">
                        <div>
                            <p class="text-3xl font-bold">500+</p>
                            <p class="text-green-200 text-sm">Fresh Products</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">2000+</p>
                            <p class="text-green-200 text-sm">Happy Customers</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">24hr</p>
                            <p class="text-green-200 text-sm">Fast Delivery</p>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Illustration -->
                <div class="hidden lg:block animate-slide-up">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm rounded-3xl transform rotate-6"></div>
                        <div class="relative bg-white/20 backdrop-blur-md rounded-3xl p-8">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/30 rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300">
                                    <span class="text-6xl block mb-3">🥬</span>
                                    <p class="font-semibold">Fresh Vegetables</p>
                                    <p class="text-green-200 text-sm">Farm Direct</p>
                                </div>
                                <div class="bg-white/30 rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300">
                                    <span class="text-6xl block mb-3">🍎</span>
                                    <p class="font-semibold">Organic Fruits</p>
                                    <p class="text-green-200 text-sm">Pesticide Free</p>
                                </div>
                                <div class="bg-white/30 rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300">
                                    <span class="text-6xl block mb-3">🥛</span>
                                    <p class="font-semibold">Dairy & Eggs</p>
                                    <p class="text-green-200 text-sm">Fresh Daily</p>
                                </div>
                                <div class="bg-white/30 rounded-2xl p-6 text-center transform hover:scale-105 transition duration-300">
                                    <span class="text-6xl block mb-3">🍞</span>
                                    <p class="font-semibold">Bakery Items</p>
                                    <p class="text-green-200 text-sm">Freshly Baked</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Browse By Category</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Shop by Category</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Find exactly what you're looking for with our carefully organized categories</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @forelse($categories as $category)
                    <a href="{{ route('category.view', $category->slug) }}" 
                       class="group bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-primary-200 transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            @if($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-12 h-12 object-contain">
                            @elseif($category->emoji)
                                <span class="text-4xl">{{ $category->emoji }}</span>
                            @else
                                <span class="text-4xl">🛒</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-primary-600 transition">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $category->products_count }} products
                        </p>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-12">No categories available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">New Arrivals</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2">Fresh Products</h2>
                    <p class="text-gray-600 mt-2">Check out our latest additions</p>
                </div>
                <a href="{{ route('shop') }}" class="group text-primary-600 font-semibold hover:text-primary-700 flex items-center gap-2 transition">
                    View All Products
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                @forelse($latestProducts as $product)
                    <div class="product-card bg-white rounded-xl lg:rounded-2xl border border-gray-100 overflow-hidden group h-full flex flex-col">
                        @if($product->slug)
                        <a href="{{ route('product.show', $product->slug) }}" class="block group">
                        @endif
                            <div class="relative w-full h-32 sm:h-40 lg:h-48 bg-gray-100 overflow-hidden p-3 lg:p-4">
                                @php
                                    $productImageUrl = null;
                                    if ($product->image) {
                                        // Check if image path already contains 'products/' or 'storage/'
                                        $productImageUrl = str_contains($product->image, 'products/') || str_contains($product->image, 'storage/') 
                                            ? asset('storage/' . $product->image) 
                                            : asset('storage/products/' . $product->image);
                                    }
                                @endphp
                                @if($productImageUrl)
                                    <img src="{{ $productImageUrl }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary-50 to-primary-100">
                                        🥬
                                    </div>
                                @endif

                                <!-- Wishlist Button (Heart Icon) -->
                                <div class="absolute top-2 right-2 sm:top-3 sm:right-3 z-20">
                                    @auth
                                        @php
                                            $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                                                ->where('product_id', $product->id)
                                                ->exists();
                                        @endphp
                                        <button type="button"
                                                class="wishlist-btn w-8 h-8 sm:w-10 sm:h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-sm hover:shadow-lg transition transform hover:scale-110 {{ $isWishlisted ? 'text-red-500 bg-white' : 'text-gray-400 hover:text-red-500 hover:bg-white' }}"
                                                data-product-id="{{ $product->id }}"
                                                title="{{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                            @if($isWishlisted)
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    @else
                                        <a href="{{ route('customer.login') }}"
                                           class="w-8 h-8 sm:w-10 sm:h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-sm hover:shadow-lg transition transform hover:scale-110 text-gray-400 hover:text-red-500 hover:bg-white"
                                           title="Login to add to wishlist">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </a>
                                    @endauth
                                </div>

                                <!-- Badges -->
                                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-20 flex flex-col gap-1 sm:gap-2">
                                    @if($product->stock < 10 && $product->stock > 0)
                                        <span class="bg-accent-500 text-white text-[10px] sm:text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full font-medium shadow-lg">
                                            Low Stock
                                        </span>
                                    @endif
                                    @if($product->created_at->diffInDays(now()) <= 7)
                                        <span class="bg-primary-500 text-white text-[10px] sm:text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full font-medium shadow-lg">
                                            New
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-3 sm:p-5">
                                <p class="text-[10px] sm:text-xs text-primary-600 font-semibold mb-1 sm:mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <h3 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-xs sm:text-sm truncate group-hover:text-primary-600 transition">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between mb-2 sm:mb-4">
                                    <div>
                                        <span class="text-sm sm:text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                        <span class="text-[10px] sm:text-sm text-gray-500">/{{ Str::limit($product->unit ?? 'unit', 3) }}</span>
                                    </div>
                                    <div class="flex items-center gap-0.5 sm:gap-1 text-yellow-400">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-[10px] sm:text-sm text-gray-600 font-medium">4.8</span>
                                    </div>
                                </div>
                            </div>
                        @if($product->slug)
                        </a>
                        @endif

                        <div class="px-3 sm:px-5 pb-3 sm:pb-5 mt-auto">
                            <button type="button"
                                    class="add-to-cart-btn w-full bg-primary-600 text-white py-2 sm:py-3 rounded-lg sm:rounded-xl hover:bg-primary-700 transition font-medium text-[11px] sm:text-sm flex items-center justify-center gap-1 sm:gap-2 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->price }}">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="hidden sm:inline">Add to Cart</span>
                                <span class="sm:hidden">Add</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-12">No products available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Features/Benefits Section -->
    <section class="py-20 bg-gradient-to-br from-primary-50 to-emerald-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Why Choose Us</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">The FreshMart Advantage</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We're committed to providing the best shopping experience with premium quality products</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition group">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-4xl">🚚</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fast Delivery</h3>
                    <p class="text-gray-600">Same-day delivery available for orders placed before 2 PM</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition group">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-4xl">🌱</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">100% Organic</h3>
                    <p class="text-gray-600">Certified organic products sourced directly from local farms</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition group">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-4xl">💰</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Best Prices</h3>
                    <p class="text-gray-600">Competitive pricing with regular discounts and offers</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-xl transition group">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-4xl">🔒</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Secure Payment</h3>
                    <p class="text-gray-600">Multiple payment options with 100% secure transactions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Testimonials</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">What Our Customers Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Don't just take our word for it - hear from our satisfied customers</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 border border-gray-100 shadow-lg">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"FreshMart has completely changed how I shop for groceries. The quality is outstanding and delivery is always on time!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold">SJ</div>
                        <div>
                            <p class="font-semibold text-gray-900">Sarah Johnson</p>
                            <p class="text-sm text-gray-500">Regular Customer</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 border border-gray-100 shadow-lg">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"The vegetables are always fresh and the prices are very reasonable. I love the convenience of home delivery!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-full flex items-center justify-center text-white font-bold">MC</div>
                        <div>
                            <p class="font-semibold text-gray-900">Michael Chen</p>
                            <p class="text-sm text-gray-500">Weekly Shopper</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 border border-gray-100 shadow-lg">
                    <div class="flex items-center gap-1 text-yellow-400 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"Best online grocery store I've used. The app is easy to navigate and customer service is excellent!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">EP</div>
                        <div>
                            <p class="font-semibold text-gray-900">Emily Parker</p>
                            <p class="text-sm text-gray-500">Loyal Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-gradient-to-r from-primary-600 to-emerald-600 rounded-3xl p-12 text-center text-white relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-10 left-10 text-6xl">🥬</div>
                    <div class="absolute bottom-10 right-10 text-6xl">🍎</div>
                    <div class="absolute top-1/2 left-1/4 text-6xl">🥕</div>
                </div>
                
                <div class="relative">
                    <h2 class="text-4xl font-bold mb-4">Ready to Start Shopping Fresh?</h2>
                    <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">Join thousands of happy customers who trust FreshMart for their daily groceries. Get 20% off your first order!</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('shop') }}" class="bg-white text-primary-700 px-8 py-4 rounded-full font-semibold hover:bg-green-50 transition shadow-xl inline-flex items-center gap-2">
                            Start Shopping Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-primary-700 transition">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wishlist toggle functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    
    wishlistButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const isWishlisted = this.classList.contains('text-red-500');
            
            try {
                const response = await fetch('{{ route("wishlist.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ product_id: productId })
                });
                
                const result = await response.json();
                
                // Toggle the heart icon
                if (result.status === 'added') {
                    this.classList.remove('text-gray-400');
                    this.classList.add('text-red-500', 'bg-white');
                    this.title = 'Remove from Wishlist';
                    this.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                    
                    // Show success animation
                    this.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                    
                    // Show toast notification
                    showToast('Added to wishlist! 💚', 'success');
                } else {
                    this.classList.remove('text-red-500', 'bg-white');
                    this.classList.add('text-gray-400');
                    this.title = 'Add to Wishlist';
                    this.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>';
                    
                    // Show toast notification
                    showToast('Removed from wishlist.', 'info');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.', 'error');
            }
        });
    });
    
    // Add to Cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            
            // Disable button and show loading state
            const originalText = this.innerHTML;
            this.disabled = true;
            this.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...';
            
            try {
                const response = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ 
                        product_id: productId,
                        quantity: 1
                    })
                });
                
                if (response.ok) {
                    // Show success animation
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                    
                    // Show toast notification
                    showToast(`Added "${productName}" to cart! 🛒`, 'success');
                    
                    // Update cart count in header (if exists)
                    updateCartCount();
                } else {
                    const error = await response.json();
                    showToast(error.message || 'Failed to add to cart.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.', 'error');
            } finally {
                // Restore button
                this.disabled = false;
                this.innerHTML = originalText;
            }
        });
    });
    
    // Update cart count function
    async function updateCartCount() {
        try {
            const response = await fetch('{{ route("cart.count") }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });
            if (response.ok) {
                const data = await response.json();
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(el => {
                    el.textContent = data.count;
                    // Animate the badge
                    el.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        el.style.transform = 'scale(1)';
                    }, 200);
                });
            }
        } catch (error) {
            console.error('Error updating cart count:', error);
        }
    }
    
    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 z-50 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        } text-white font-medium`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        });
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.remove('translate-x-0', 'opacity-100');
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush
