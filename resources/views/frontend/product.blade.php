@extends('frontend.layouts.app')

@section('title', $product->translated_name . ' - FreshMart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('shop') }}" class="hover:text-primary-600 transition">Shop</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('category.view', $product->category->slug ?? 'uncategorized') }}" class="hover:text-primary-600 transition">
                {{ $product->category->name ?? 'Uncategorized' }}
            </a>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Product Image Gallery -->
            <div>
                @php
                    // Collect all images
                    $allImages = [];
                    if ($product->image) {
                        $allImages[] = $product->image;
                    }
                    if ($product->productImages && $product->productImages->count() > 0) {
                        foreach ($product->productImages as $productImage) {
                            if ($productImage->image_path) {
                                $allImages[] = $productImage->image_path;
                            }
                        }
                    }
                    // Remove duplicates
                    $allImages = array_unique($allImages);
                @endphp

                @if(count($allImages) > 1)
                    <!-- Main Image -->
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm mb-4">
                        <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img id="mainImage" 
                                 src="{{ asset('storage/' . $allImages[0]) }}"
                                 alt="{{ $product->translated_name }}"
                                 class="w-full h-full object-cover hover:scale-105 transition duration-500">
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($allImages as $index => $image)
                            <button type="button" 
                                    onclick="changeImage('{{ asset('storage/' . $image) }}')"
                                    class="thumbnail-btn bg-white rounded-xl border-2 border-gray-200 overflow-hidden hover:border-primary-600 transition aspect-square {{ $index === 0 ? 'active border-primary-600' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}"
                                     alt="{{ $product->translated_name }} {{ $index + 1 }}"
                                     class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @else
                    <!-- Single Image -->
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                        <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            @if(count($allImages) > 0)
                                <img src="{{ asset('storage/' . $allImages[0]) }}"
                                     alt="{{ $product->translated_name }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            @else
                                <span class="text-9xl">🥬</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <p class="text-primary-600 font-semibold mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $product->category->name ?? 'Uncategorized' }}
                </p>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $product->translated_name }}</h1>
                
                <!-- Rating -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center gap-1 text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating ?? 0))
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @elseif($i - 0.5 <= $averageRating)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><defs><linearGradient id="half-{{ $i }}"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="#e5e7eb"/></linearGradient></defs><path fill="url(#half-{{ $i }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @else
                                <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-600">({{ number_format($averageRating ?? 0, 1) }} / 5.0)</span>
                    <span class="text-gray-400">|</span>
                    <a href="#reviews" class="text-primary-600 hover:text-primary-700 font-medium">{{ $reviewsCount ?? 0 }} reviews</a>
                </div>
                
                <!-- Price & Stock -->
                <div class="flex items-baseline gap-3 mb-6">
                    <span class="text-4xl font-bold text-primary-600">
                        @php
                            $displayPrice = ($product->price == floor($product->price)) ? '$' . number_format($product->price, 0) : '$' . number_format($product->price, 2);
                        @endphp
                        {{ $displayPrice }}
                    </span>
                    <span class="text-gray-500 text-lg">/{{ $product->unit ?? 'unit' }}</span>
                </div>

                @if($product->stock > 0)
                    <div class="flex items-center gap-2 mb-6 p-4 bg-green-50 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-green-700 font-medium">In Stock - {{ $product->stock }} units available</span>
                    </div>
                @else
                    <div class="flex items-center gap-2 mb-6 p-4 bg-red-50 rounded-xl">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="text-red-700 font-medium">Out of Stock</span>
                    </div>
                @endif

                <p class="text-gray-600 mb-8 leading-relaxed">
                    {{ $product->description ?? 'Fresh and high-quality product available at FreshMart. Perfect for your daily needs. Sourced from trusted local farms and suppliers.' }}
                </p>

                @if($product->stock > 0)
                    <!-- Add to Cart Form -->
                    <div class="flex gap-4 mb-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                            <button type="button" onclick="decrementQty()"
                                    class="px-4 py-4 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="w-20 text-center border-x-2 border-gray-200 py-3 focus:outline-none font-semibold">
                            <button type="button" onclick="incrementQty({{ $product->stock }})"
                                    class="px-4 py-4 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                        <button type="button" onclick="addToCart()"
                                class="flex-1 bg-primary-600 text-white px-8 py-4 rounded-xl hover:bg-primary-700 transition font-semibold flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add to Cart
                        </button>
                    </div>
                @else
                    <button disabled 
                            class="w-full bg-gray-200 text-gray-500 px-8 py-4 rounded-xl font-semibold cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif

                <!-- Features -->
                <div class="border-t border-gray-200 pt-6 space-y-4">
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>Fresh & Quality Guaranteed</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span>Same-day Delivery Available</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <span>Easy Returns & Refunds</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="product-card bg-white rounded-xl lg:rounded-2xl border border-gray-100 overflow-hidden group h-full flex flex-col">
                            @if($related->slug)
                            <a href="{{ route('product.show', $related->slug) }}" class="block group">
                            @endif
                                <div class="relative w-full h-32 sm:h-40 lg:h-48 bg-gray-100 overflow-hidden">
                                    @php
                                        $productImageUrl = null;
                                        if ($related->image) {
                                            // Check if image path already contains 'products/' or 'storage/'
                                            $productImageUrl = str_contains($related->image, 'products/') || str_contains($related->image, 'storage/')
                                                ? asset('storage/' . $related->image)
                                                : asset('storage/products/' . $related->image);
                                        }
                                    @endphp
                                    @if($productImageUrl)
                                        <img src="{{ $productImageUrl }}"
                                             alt="{{ $related->name }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary-50 to-primary-100">
                                            🥬
                                        </div>
                                    @endif
                                </div>

                                <div class="p-3 sm:p-5">
                                    <p class="text-[10px] sm:text-xs text-primary-600 font-semibold mb-1 sm:mb-2">{{ $related->category->name ?? 'Uncategorized' }}</p>
                                    <h3 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-xs sm:text-sm truncate group-hover:text-primary-600 transition">{{ $related->name }}</h3>
                                    <div class="flex items-center justify-between mb-2 sm:mb-4">
                                        <span class="text-sm sm:text-xl font-bold text-gray-900">
                                            @php
                                                $displayPrice = ($related->price == floor($related->price)) ? '$' . number_format($related->price, 0) : '$' . number_format($related->price, 2);
                                            @endphp
                                            {{ $displayPrice }}
                                        </span>
                                        <span class="text-[10px] sm:text-sm text-gray-500">/{{ Str::limit($related->unit ?? 'unit', 3) }}</span>
                                    </div>
                                </div>
                            @if($related->slug)
                            </a>
                            @endif

                            <div class="px-3 sm:px-5 pb-3 sm:pb-5 mt-auto">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $related->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                            class="w-full bg-primary-600 text-white py-2 sm:py-3 rounded-lg sm:rounded-xl hover:bg-primary-700 transition font-medium text-[11px] sm:text-sm flex items-center justify-center gap-1 sm:gap-2 shadow-lg shadow-primary-500/30">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Add to Cart</span>
                                        <span class="sm:hidden">Add</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Reviews Section -->
        <div id="reviews" class="mt-20">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Rating Summary -->
                <div class="lg:col-span-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
                    
                    <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                        <div class="text-center mb-6">
                            <div class="text-5xl font-bold text-gray-900 mb-2">{{ number_format($averageRating ?? 0, 1) }}</div>
                            <div class="flex items-center justify-center gap-1 text-yellow-400 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($averageRating ?? 0))
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @else
                                        <svg class="w-6 h-6 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-gray-600">Based on {{ $reviewsCount ?? 0 }} reviews</p>
                        </div>

                        <!-- Rating Distribution -->
                        <div class="space-y-2">
                            @for($i = 5; $i >= 1; $i--)
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium text-gray-600 w-8">{{ $i }}</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        @php
                                            $totalReviews = $reviewsCount ?? 1;
                                            $ratingCount = $ratingDistribution[$i] ?? 0;
                                            $percentage = $totalReviews > 0 ? ($ratingCount / $totalReviews) * 100 : 0;
                                        @endphp
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-8 text-right">{{ $ratingCount }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Write Review Button -->
                    @auth
                        @if(!$userReview)
                            <button onclick="document.getElementById('reviewForm').classList.remove('hidden')"
                                    class="w-full bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition font-semibold shadow-lg shadow-primary-500/30">
                                Write a Review
                            </button>
                        @else
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                                <p class="text-green-700 font-medium">You've reviewed this product</p>
                                <p class="text-green-600 text-sm mt-1">Rating: {{ $userReview->rating }}/5</p>
                                <button onclick="openEditModal({{ $userReview->id }}, {{ $userReview->rating }}, {{ json_encode($userReview->comment ?? '') }})"
                                        class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Your Review
                                </button>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('customer.login') }}"
                           class="block w-full bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition font-semibold text-center shadow-lg shadow-primary-500/30">
                            Login to Write a Review
                        </a>
                    @endauth
                </div>

                <!-- Reviews List -->
                <div class="lg:col-span-2">
                    <!-- Review Form -->
                    @auth
                        @if(!$userReview)
                            <div id="reviewForm" class="hidden bg-white border border-gray-200 rounded-2xl p-6 mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Write Your Review</h3>
                                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                        <div class="flex gap-2" id="ratingStars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="hidden" required>
                                                <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 hover:text-yellow-400 transition"
                                                       onclick="updateStars({{ $i }})">★</label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                        <textarea name="comment" rows="4"
                                                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('comment') border-red-500 @enderror"
                                                  placeholder="Share your experience with this product..."></textarea>
                                        @error('comment')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Add Photos (Optional)</label>
                                        <div class="flex items-center gap-4">
                                            <label class="flex-1 border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition">
                                                <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-sm text-gray-600">Click to upload images</span>
                                                <input type="file" name="images[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                                            </label>
                                        </div>
                                        <div id="imagePreview" class="flex gap-2 mt-4 flex-wrap"></div>
                                        @error('images')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex gap-3">
                                        <button type="submit"
                                                class="flex-1 bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition font-semibold">
                                            Submit Review
                                        </button>
                                        <button type="button" onclick="document.getElementById('reviewForm').classList.add('hidden')"
                                                class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition font-semibold text-gray-700">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <!-- Edit Review Modal -->
                    @auth
                        <div id="editReviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                            <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                                <div class="p-6 border-b border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-xl font-bold text-gray-900">Edit Your Review</h3>
                                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <form id="editReviewForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="p-6 space-y-4">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                            <div class="flex gap-2" id="editRatingStars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" name="rating" value="{{ $i }}" id="edit-star{{ $i }}" class="hidden">
                                                    <label for="edit-star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 hover:text-yellow-400 transition"
                                                           onclick="updateEditStars({{ $i }})">★</label>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                            <textarea name="comment" id="editComment" rows="4"
                                                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                                      placeholder="Share your experience with this product..."></textarea>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Add More Photos (Optional)</label>
                                            <div class="flex items-center gap-4">
                                                <label class="flex-1 border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition">
                                                    <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="text-sm text-gray-600">Click to upload images</span>
                                                    <input type="file" name="images[]" multiple accept="image/*" class="hidden" onchange="previewEditImages(this)">
                                                </label>
                                            </div>
                                            <div id="editImagePreview" class="flex gap-2 mt-4 flex-wrap"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6 border-t border-gray-200 flex gap-3">
                                        <button type="submit"
                                                class="flex-1 bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition font-semibold">
                                            Save Changes
                                        </button>
                                        <button type="button" onclick="closeEditModal()"
                                                class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition font-semibold text-gray-700">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endauth

                    <!-- Reviews -->
                    <div class="space-y-6">
                        @if($reviews && $reviews->count() > 0)
                            @foreach($reviews as $review)
                                <div class="bg-white border border-gray-200 rounded-2xl p-6 {{ $review->is_banned ? 'opacity-60' : '' }}">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            @if($review->user && $review->user->avatar)
                                                <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name ?? 'Customer' }}" class="w-12 h-12 rounded-full object-cover">
                                            @else
                                                <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                    {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="font-semibold text-gray-900">{{ $review->user->name ?? 'Customer' }}</h4>
                                                    @if($review->is_banned)
                                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded-full">Banned</span>
                                                    @endif
                                                </div>
                                                <p class="text-sm text-gray-500">{{ $review->formatted_date }}</p>
                                                @if($review->is_banned && $review->ban_reason)
                                                    <div class="mt-1 flex items-start gap-1.5 bg-red-50 border border-red-200 rounded-lg px-2 py-1.5">
                                                        <svg class="w-4 h-4 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        <p class="text-xs text-red-700">{{ $review->ban_reason }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1 text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @else
                                                    <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    @if($review->comment)
                                        <p class="text-gray-700 mb-4 leading-relaxed">{{ $review->comment }}</p>
                                    @endif

                                    @if($review->images && count($review->images) > 0)
                                        <div class="flex gap-2 mb-4 overflow-x-auto">
                                            @foreach($review->images as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Review image"
                                                     class="w-24 h-24 object-cover rounded-lg cursor-pointer hover:opacity-90 transition"
                                                     onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                                        <button class="helpful-btn flex items-center gap-2 text-sm text-gray-500 hover:text-primary-600 transition"
                                                data-review-id="{{ $review->id }}"
                                                data-marked="{{ $review->isMarkedHelpfulBy(auth()->id()) ? 'true' : 'false' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                            </svg>
                                            <span>Helpful</span>
                                            <span class="helpful-count">{{ $review->helpful_count }}</span>
                                        </button>

                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <div class="flex items-center gap-2 ml-auto">
                                                    <button onclick="openEditModal({{ $review->id }}, {{ $review->rating }}, {{ json_encode($review->comment ?? '') }})"
                                                            class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 transition font-medium">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        <span>Edit</span>
                                                    </button>
                                                    <button onclick="confirmDeleteReview({{ $review->id }})"
                                                            class="flex items-center gap-1 text-sm text-red-600 hover:text-red-700 transition font-medium">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        <span>Delete</span>
                                                    </button>
                                                </div>
                                            @else
                                                <button onclick="toggleReplyForm({{ $review->id }})"
                                                        class="ml-auto flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900 transition font-medium">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                                    </svg>
                                                    <span>Reply</span>
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                    
                                    <!-- Reply Form -->
                                    @auth
                                        <div id="reply-form-{{ $review->id }}" class="hidden mt-4 pt-4 border-t border-gray-100">
                                            <form action="{{ route('reviews.reply', $review->id) }}" method="POST">
                                                @csrf
                                                <div class="flex gap-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <textarea name="comment" rows="3"
                                                                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 resize-none"
                                                                  placeholder="Write your reply..."></textarea>
                                                        @error('comment')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                        <div class="flex justify-end gap-2 mt-2">
                                                            <button type="button" onclick="toggleReplyForm({{ $review->id }})"
                                                                    class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                    class="px-4 py-2 bg-primary-600 text-white text-sm rounded-lg hover:bg-primary-700 transition font-medium">
                                                                Post Reply
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endauth
                                    
                                    <!-- Display Replies -->
                                    @if($review->replies && $review->replies->count() > 0)
                                        <div class="mt-4 pt-4 border-t border-gray-100 space-y-4">
                                            @foreach($review->replies as $reply)
                                                @if(!$reply->is_hidden || (auth()->check() && auth()->id() === $reply->user_id))
                                                    <div class="flex gap-3 bg-gray-50 rounded-xl p-4">
                                                        <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                            @if($reply->user && ($reply->user->avatar ?? $reply->user->profile_photo_path))
                                                                <img src="{{ asset('storage/' . ($reply->user->avatar ?? $reply->user->profile_photo_path)) }}"
                                                                     alt="{{ $reply->user->name ?? 'User' }}"
                                                                     class="w-full h-full rounded-full object-cover">
                                                            @else
                                                                {{ strtoupper(substr($reply->user->name ?? 'U', 0, 1)) }}
                                                            @endif
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="flex items-center gap-2 mb-1">
                                                                <h5 class="font-semibold text-gray-900 text-sm">{{ $reply->user->name ?? 'User' }}</h5>
                                                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-gray-700 text-sm">{{ $reply->comment }}</p>
                                                            @auth
                                                                @if(auth()->id() === $reply->user_id)
                                                                    <form action="{{ route('reviews.reply.destroy', $reply->id) }}" method="POST" class="mt-2">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-xs text-red-600 hover:text-red-700 font-medium">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">💬</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No reviews yet</h3>
                                <p class="text-gray-600">Be the first to review this product!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* SweetAlert2 Custom Styling */
        .swal2-popup {
            border-radius: 1rem !important;
            font-family: inherit !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        }
        .swal2-title {
            font-weight: 700 !important;
            font-size: 1.5rem !important;
            color: #1e293b !important;
        }
        .swal2-html-container, .swal2-content {
            font-size: 1rem !important;
            color: #64748b !important;
        }
        .swal2-confirm, .swal2-cancel {
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            transition: all 0.2s !important;
        }
        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
        .swal2-cancel:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
        .swal2-toast {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
        .swal2-toast .swal2-title {
            font-size: 0.875rem !important;
            font-weight: 600 !important;
        }
        .swal2-loading {
            justify-content: center !important;
        }

        /* Product Image Gallery */
        .thumbnail-btn {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .thumbnail-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .thumbnail-btn.active {
            border-color: #16a34a !important;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
        }
        .thumbnail-btn img {
            transition: transform 0.2s ease;
        }
        .thumbnail-btn:hover img {
            transform: scale(1.05);
        }
    </style>
    @endpush

    @push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function incrementQty(max) {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }

        // Update star rating display
        function updateStars(rating) {
            const stars = document.querySelectorAll('#ratingStars label');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Preview uploaded images
        function previewImages(input) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-24 h-24 object-cover rounded-lg">
                            <button type="button" onclick="this.parentElement.remove()" 
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        // Mark review as helpful
        document.querySelectorAll('.helpful-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const reviewId = this.dataset.reviewId;
                const isMarked = this.dataset.marked === 'true';
                const countSpan = this.querySelector('.helpful-count');
                const csrfToken = document.querySelector('meta[name="csrf-token"]');

                if (!csrfToken) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: 'Please login to mark reviews as helpful',
                        iconColor: '#f59e0b',
                        showConfirmButton: true,
                        confirmButtonText: 'Login Now',
                        confirmButtonColor: '#16a34a',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/customer/login';
                        }
                    });
                    return;
                }

                fetch(`/reviews/${reviewId}/helpful`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.content,
                    },
                })
                .then(response => {
                    if (response.status === 401) {
                        throw new Error('Unauthorized');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        this.dataset.marked = data.helpful ? 'true' : 'false';
                        countSpan.textContent = data.helpful_count;

                        if (data.helpful) {
                            this.classList.add('text-primary-600');
                            this.classList.remove('text-gray-500');
                            
                            // Show success toast
                            Swal.fire({
                                icon: 'success',
                                title: 'Thanks!',
                                text: 'You marked this review as helpful',
                                iconColor: '#16a34a',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                background: '#f0fdf4',
                                color: '#166534'
                            });
                        } else {
                            this.classList.remove('text-primary-600');
                            this.classList.add('text-gray-500');
                            
                            // Show undo toast
                            Swal.fire({
                                icon: 'info',
                                title: 'Removed',
                                text: 'You unmarked this review',
                                iconColor: '#2563eb',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                background: '#eff6ff',
                                color: '#1e40af'
                            });
                        }
                    } else if (data.message) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Login Required',
                            text: data.message,
                            iconColor: '#f59e0b',
                            confirmButtonText: 'Login',
                            confirmButtonColor: '#16a34a'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/customer/login';
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Required',
                        text: 'Please login to mark reviews as helpful',
                        iconColor: '#f59e0b',
                        confirmButtonText: 'Login',
                        confirmButtonColor: '#16a34a'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/customer/login';
                        }
                    });
                });
            });
        });

        // Open image modal
        function openImageModal(imageSrc) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="relative max-w-4xl max-h-full">
                    <img src="${imageSrc}" class="max-w-full max-h-[90vh] object-contain rounded-lg">
                    <button onclick="this.closest('.fixed').remove()" 
                            class="absolute -top-10 right-0 text-white hover:text-gray-300 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `;
            document.body.appendChild(modal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }

        // Edit Review Functions
        function openEditModal(reviewId, rating, comment) {
            console.log('Opening edit modal:', { reviewId, rating, comment });
            
            // Set the form action
            const form = document.getElementById('editReviewForm');
            if (!form) {
                console.error('Edit form not found!');
                return;
            }
            form.action = '/reviews/' + reviewId;

            // Set the rating
            document.querySelectorAll('#editRatingStars input').forEach(input => {
                input.checked = false;
            });
            const ratingInput = document.getElementById('edit-star' + rating);
            if (ratingInput) {
                ratingInput.checked = true;
            }
            updateEditStars(rating);

            // Set the comment
            const commentField = document.getElementById('editComment');
            if (commentField) {
                commentField.value = comment || '';
            }

            // Show the modal
            const modal = document.getElementById('editReviewModal');
            if (modal) {
                modal.classList.remove('hidden');
            } else {
                console.error('Edit modal not found!');
            }
        }

        function closeEditModal() {
            document.getElementById('editReviewModal').classList.add('hidden');
            document.getElementById('editReviewForm').reset();
            document.getElementById('editImagePreview').innerHTML = '';
        }

        function updateEditStars(rating) {
            const stars = document.querySelectorAll('#editRatingStars label');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        function previewEditImages(input) {
            const preview = document.getElementById('editImagePreview');
            
            if (input.files) {
                Array.from(input.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-24 h-24 object-cover rounded-lg">
                            <button type="button" onclick="this.parentElement.remove()" 
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        // Toggle reply form visibility
        function toggleReplyForm(reviewId) {
            const form = document.getElementById(`reply-form-${reviewId}`);
            if (form) {
                form.classList.toggle('hidden');
                // Focus on textarea when showing
                if (!form.classList.contains('hidden')) {
                    const textarea = form.querySelector('textarea');
                    if (textarea) {
                        textarea.focus();
                    }
                }
            }
        }

        function confirmDeleteReview(reviewId) {
            Swal.fire({
                title: 'Delete Review?',
                text: "Are you sure you want to delete your review? This action cannot be undone.",
                icon: 'warning',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Delete It!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    title: 'fw-bold',
                    confirmButton: 'rounded-start-xl px-4',
                    cancelButton: 'rounded-end-xl px-4'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show deleting toast
                    Swal.fire({
                        title: 'Deleting...',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        background: '#f8fafc',
                        color: '#475569'
                    }).then(() => {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/reviews/' + reviewId;

                        const csrfToken = document.querySelector('meta[name="csrf-token"]');
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';

                        const tokenInput = document.createElement('input');
                        tokenInput.type = 'hidden';
                        tokenInput.name = '_token';
                        tokenInput.value = csrfToken.content;

                        form.appendChild(methodInput);
                        form.appendChild(tokenInput);
                        document.body.appendChild(form);
                        form.submit();
                    });
                }
            });
        }

        // Change product image when clicking thumbnails
        function changeImage(imageSrc) {
            // Update main image with fade effect
            const mainImage = document.getElementById('mainImage');
            mainImage.style.opacity = '0';
            mainImage.style.transition = 'opacity 0.3s ease';

            setTimeout(() => {
                mainImage.src = imageSrc;
                mainImage.style.opacity = '1';
            }, 300);

            // Update thumbnail active state
            document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                btn.classList.remove('active', 'border-primary-600');
                btn.classList.add('border-gray-200');
            });
            event.currentTarget.classList.remove('border-gray-200');
            event.currentTarget.classList.add('active', 'border-primary-600');
        }

        // Add to Cart Function
        function addToCart() {
            const productId = document.querySelector('input[name="product_id"]').value;
            const quantity = document.getElementById('quantity').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Show loading state
            const addToCartBtn = event.currentTarget;
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.disabled = true;
            addToCartBtn.innerHTML = `
                <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Adding...
            `;

            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: parseInt(quantity)
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Add to cart response:', data);
                
                // Reset button
                addToCartBtn.disabled = false;
                addToCartBtn.innerHTML = originalText;

                if (data.success) {
                    // Show success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        text: 'Product has been added to your cart',
                        iconColor: '#16a34a',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        color: '#166534'
                    });

                    // Update cart count immediately with the count from response
                    console.log('Cart count from server:', data.cart_count);
                    if (data.cart_count !== undefined) {
                        updateCartCountDisplay(data.cart_count);
                    } else {
                        console.log('No cart_count in response, fetching...');
                        updateCartCount();
                    }
                } else {
                    // Show error
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Failed to add to cart',
                        iconColor: '#dc2626',
                        confirmButtonColor: '#16a34a'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                addToCartBtn.disabled = false;
                addToCartBtn.innerHTML = originalText;
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
            });
        }

        // Update Cart Count Display with Animation
        function updateCartCountDisplay(count) {
            const cartCountElements = document.querySelectorAll('#cart-count, .cart-count');
            console.log('Updating cart count to:', count, 'Found elements:', cartCountElements.length);
            
            if (cartCountElements.length === 0) {
                console.warn('No cart count element found!');
                return;
            }
            
            cartCountElements.forEach(el => {
                // Animate the badge
                el.style.transition = 'all 0.3s ease';
                el.style.transform = 'scale(1.3)';
                setTimeout(() => {
                    el.textContent = count;
                    el.style.transform = 'scale(1)';
                    el.classList.remove('hidden');
                }, 150);
            });
        }

        // Update Cart Count (fetch from server)
        function updateCartCount() {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    updateCartCountDisplay(data.count);
                })
                .catch(error => console.error('Error updating cart count:', error));
        }
    </script>
    @endpush
@endsection
