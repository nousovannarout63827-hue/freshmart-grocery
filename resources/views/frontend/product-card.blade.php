<div class="product-card bg-white rounded-xl lg:rounded-2xl border border-gray-100 overflow-hidden group h-full flex flex-col">
    @if($product->slug)
    <a href="{{ route('product.show', $product->slug) }}" class="block group">
    @endif
        <div class="relative w-full h-32 sm:h-40 lg:h-48 bg-gray-100 overflow-hidden">
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
                        alt="{{ $product->translated_name }}"
                        class="w-full h-full object-cover block group-hover:scale-110 transition duration-500">
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
                @if($product->discount_percent > 0)
                    <span class="bg-red-500 text-white text-[10px] sm:text-xs px-2 sm:px-3 py-0.5 sm:py-1 rounded-full font-bold shadow-lg animate-pulse">
                        🏷️ {{ number_format($product->discount_percent, 0) }}% OFF
                    </span>
                @endif
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
            <h3 class="font-semibold text-gray-800 mb-1 sm:mb-2 text-xs sm:text-sm truncate group-hover:text-primary-600 transition {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $product->translated_name }}</h3>
            <div class="flex items-center justify-between mb-2 sm:mb-4">
                <div>
                    @if($product->discount_percent > 0 && $product->discounted_price)
                        <div class="flex flex-col">
                            <span class="text-xs sm:text-sm text-gray-400 line-through">
                                @php
                                    $originalPrice = ($product->price == floor($product->price)) ? '$' . number_format($product->price, 0) : '$' . number_format($product->price, 2);
                                @endphp
                                {{ $originalPrice }}
                            </span>
                            <span class="text-sm sm:text-xl font-bold text-red-600">
                                @php
                                    $discountedPrice = ($product->discounted_price == floor($product->discounted_price)) ? '$' . number_format($product->discounted_price, 0) : '$' . number_format($product->discounted_price, 2);
                                @endphp
                                {{ $discountedPrice }}
                            </span>
                        </div>
                    @else
                        <span class="text-sm sm:text-xl font-bold text-gray-900">
                            @php
                                $displayPrice = ($product->price == floor($product->price)) ? '$' . number_format($product->price, 0) : '$' . number_format($product->price, 2);
                            @endphp
                            {{ $displayPrice }}
                        </span>
                    @endif
                    <span class="text-[10px] sm:text-sm text-gray-500">/{{ Str::limit($product->unit ?? 'unit', 3) }}</span>
                </div>
                @php
                    $avgRating = $product->approvedReviews()->avg('rating');
                    $reviewsCount = $product->approvedReviews()->count();
                @endphp
                <div class="flex items-center gap-0.5 sm:gap-1">
                    <div class="flex items-center gap-0.5 sm:gap-1 text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($avgRating ?? 0))
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @else
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 fill-gray-300 text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        @endfor
                    </div>
                    @if($reviewsCount > 0)
                        <span class="text-[10px] sm:text-xs text-gray-500">({{ $reviewsCount }})</span>
                    @endif
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
                data-product-name="{{ $product->translated_name }}"
                data-product-price="{{ $product->price }}">
            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="hidden sm:inline">Add to Cart</span>
            <span class="sm:hidden">Add</span>
        </button>
    </div>
</div>
