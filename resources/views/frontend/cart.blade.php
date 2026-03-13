@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - FreshMart')

@section('content')
    <div class="max-w-7xl mx-auto px-3 sm:px-4 py-6 sm:py-8">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-8 sm:py-12 rounded-2xl sm:rounded-3xl mb-6 sm:mb-8">
            <div class="text-center px-4">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">🛒 Shopping Cart</h1>
                <p class="text-sm sm:text-base text-green-100">Review your items before checkout</p>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ session('warning') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-3 sm:space-y-4">
                    @php
                        $total = 0;
                        $subtotal = 0;
                        $totalDiscount = 0;
                    @endphp
                    @foreach($cart as $productId => $item)
                        @php
                            // Calculate item price with discount
                            $itemPrice = $item['price'];
                            if (isset($item['discount_percent']) && $item['discount_percent'] > 0) {
                                if (isset($item['discount_price']) && $item['discount_price']) {
                                    $itemPrice = $item['discount_price'];
                                } else {
                                    $itemPrice = $item['price'] * (1 - $item['discount_percent'] / 100);
                                }
                                $totalDiscount += ($item['price'] - $itemPrice) * $item['quantity'];
                            }
                            
                            $itemTotal = $itemPrice * $item['quantity'];
                            $total += $itemTotal;
                            $subtotal += $item['price'] * $item['quantity'];
                        @endphp
                        <div id="cart-item-{{ $productId }}" class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-3 sm:p-4 lg:p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                                <!-- Product Image -->
                                <div class="w-full sm:w-28 lg:w-28 h-48 sm:h-28 lg:h-28 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex-shrink-0 overflow-hidden">
                                    @php
                                        // Try session image first, fallback to database if null
                                        $imagePath = $item['image'] ?? \App\Models\Product::find($productId)?->image;
                                        $imageUrl = $imagePath ? asset('storage/' . $imagePath) : null;
                                        
                                        // Handle multi-language name array from session
                                        $displayName = is_array($item['name']) 
                                            ? ($item['name'][app()->getLocale()] ?? $item['name']['en'] ?? 'Product')
                                            : $item['name'];
                                    @endphp
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}"
                                             alt="{{ $displayName }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-primary-50 to-primary-100" style="display: none;">
                                            🥬
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-primary-50 to-primary-100">
                                            🥬
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg mb-1">{{ $displayName }}</h3>

                                    @if(isset($item['discount_percent']) && $item['discount_percent'] > 0)
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                                🏷️ {{ number_format($item['discount_percent'], 0) }}% OFF
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-gray-400 line-through text-xs sm:text-sm">
                                                @php
                                                    $originalPrice = ($item['price'] == floor($item['price'])) ? '$' . number_format($item['price'], 0) : '$' . number_format($item['price'], 2);
                                                @endphp
                                                {{ $originalPrice }}
                                            </span>
                                            <span class="text-red-600 font-bold text-lg sm:text-xl">
                                                @if(isset($item['discount_price']) && $item['discount_price'])
                                                    @php
                                                        $discountedPrice = ($item['discount_price'] == floor($item['discount_price'])) ? '$' . number_format($item['discount_price'], 0) : '$' . number_format($item['discount_price'], 2);
                                                    @endphp
                                                    {{ $discountedPrice }}
                                                @else
                                                    @php
                                                        $calcPrice = $item['price'] * (1 - $item['discount_percent'] / 100);
                                                        $displayPrice = ($calcPrice == floor($calcPrice)) ? '$' . number_format($calcPrice, 0) : '$' . number_format($calcPrice, 2);
                                                    @endphp
                                                    {{ $displayPrice }}
                                                @endif
                                            </span>
                                        </div>
                                    @else
                                        <p class="text-primary-600 font-bold text-lg sm:text-xl">
                                            @php
                                                $displayPrice = ($item['price'] == floor($item['price'])) ? '$' . number_format($item['price'], 0) : '$' . number_format($item['price'], 2);
                                            @endphp
                                            {{ $displayPrice }}
                                        </p>
                                    @endif

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-3 sm:gap-4 mt-3 sm:mt-4 flex-wrap">
                                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                            <button type="button" onclick="decreaseQuantity({{ $productId }})"
                                                    class="px-3 sm:px-4 py-2 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition"
                                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            <input type="number" id="quantity-{{ $productId }}" value="{{ $item['quantity'] }}" min="1"
                                                   class="w-12 sm:w-16 text-center border-x-2 border-gray-200 py-2 focus:outline-none font-semibold text-sm sm:text-base"
                                                   onchange="updateQuantityAjax({{ $productId }}, this.value)">
                                            <button type="button" onclick="increaseQuantity({{ $productId }})"
                                                    class="px-3 sm:px-4 py-2 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Remove Button -->
                                        <button type="button" onclick="removeItemAjax({{ $productId }})"
                                                class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition flex items-center gap-2"
                                                title="Remove item">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span class="text-xs sm:hidden">Remove</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Item Total -->
                                <div class="text-right sm:mt-0">
                                    <p class="text-xs sm:text-sm text-gray-500 mb-1">Total</p>
                                    @if(isset($item['discount_percent']) && $item['discount_percent'] > 0)
                                        <p class="item-total text-lg sm:text-xl font-bold text-red-600" data-product-id="{{ $productId }}">${{ number_format($itemTotal, 2) }}</p>
                                        @if($item['quantity'] > 1)
                                            <p class="text-xs text-gray-400 line-through">
                                                Was: ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="item-total text-xl sm:text-2xl font-bold text-gray-900" data-product-id="{{ $productId }}">${{ number_format($itemTotal, 2) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-4 sm:p-6 lg:sticky lg:top-24 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        @php
                            // Store rules
                            $deliveryThreshold = 50.00; // Free shipping over $50
                            $standardDeliveryFee = 6.00; // Normal shipping cost
                            
                            // Determine the actual delivery fee
                            $deliveryFee = ($subtotal >= $deliveryThreshold) ? 0 : $standardDeliveryFee;
                            
                            // Check for coupons in the session
                            $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;
                            
                            // Calculate final total
                            $finalTotal = ($subtotal + $deliveryFee - $totalDiscount) - $discount;
                            
                            // Calculate how much more needed for free shipping
                            $amountNeededForFreeShipping = $deliveryThreshold - $subtotal;
                        @endphp

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="summary-subtotal" class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>

                            @if($totalDiscount > 0)
                                <div id="summary-discount" class="flex justify-between text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        Product Discounts
                                    </span>
                                    <span class="font-medium">-${{ number_format($totalDiscount, 2) }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-gray-600">
                                <span>Delivery Fee</span>
                                <span id="summary-delivery" class="@if($deliveryFee > 0) font-medium text-gray-800 @else font-bold text-green-600 @endif">
                                    @if($deliveryFee > 0)
                                        ${{ number_format($deliveryFee, 2) }}
                                    @else
                                        FREE
                                    @endif
                                </span>
                            </div>

                            @if($discount > 0)
                                <div class="flex justify-between text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        Discount ({{ session()->get('coupon')['code'] }})
                                    </span>
                                    <span class="font-medium">-${{ number_format($discount, 2) }}</span>
                                </div>
                            @endif

                            <div class="border-t-2 border-gray-200 pt-4 flex justify-between text-xl font-bold text-gray-900">
                                <span>Total</span>
                                <span id="summary-total" class="text-primary-600">${{ number_format($finalTotal, 2) }}</span>
                            </div>
                        </div>

                        <!-- Free Shipping Progress -->
                        <div id="shipping-progress-container">
                            @if($amountNeededForFreeShipping > 0)
                                <div id="shipping-progress" class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                                    <p class="text-amber-800 text-sm">
                                        <span class="font-semibold">💡 Tip:</span> Add ${{ number_format($amountNeededForFreeShipping, 2) }} more to get <strong>FREE delivery</strong>!
                                    </p>
                                </div>
                            @else
                                <div id="shipping-progress" class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                                    <p class="text-green-800 text-sm">
                                        <span class="font-semibold">🎉 Awesome!</span> You qualify for <strong>FREE standard delivery</strong>!
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Coupon Section -->
                        @if(!session()->has('coupon'))
                            <form action="{{ route('coupon.apply') }}" method="POST" class="mb-6" id="coupon-apply-form">
                                @csrf
                                <label class="block text-sm font-bold text-gray-800 mb-2">Have a Coupon?</label>
                                <div class="flex border-2 border-primary-600 rounded-xl overflow-hidden bg-white">
                                    <input type="text" name="coupon_code" placeholder="Enter coupon code"
                                           class="w-full px-4 py-3 outline-none border-none text-sm text-gray-700 placeholder-gray-400"
                                           value="{{ old('coupon_code') }}">
                                    <button type="submit" class="bg-primary-600 text-white font-bold px-6 py-3 border-l border-primary-600 hover:bg-primary-700 transition cursor-pointer">
                                        Apply
                                    </button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('coupon.remove') }}" method="POST" class="mb-6" id="coupon-applied-form">
                                @csrf
                                <div class="flex justify-between items-center bg-green-50 border border-green-200 px-4 py-3 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-green-700 font-bold text-sm">Coupon Applied: {{ session()->get('coupon')['code'] }}</span>
                                    </div>
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm underline cursor-pointer">
                                        Remove
                                    </button>
                                </div>
                            </form>
                        @endif

                        @auth
                            <a href="{{ route('checkout') }}"
                               class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 sm:py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition font-semibold text-center block mb-3 shadow-lg shadow-primary-500/30 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline-block -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Secure Checkout
                            </a>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 sm:p-4 mb-6">
                                <p class="text-blue-800 text-xs sm:text-sm">
                                    <span class="font-semibold">🔐 Login Required:</span> Please sign in to complete your order.
                                </p>
                            </div>
                            <a href="{{ route('customer.login') }}"
                               class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 sm:py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition font-semibold text-center block mb-3 shadow-lg shadow-primary-500/30 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 inline-block -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Sign In to Checkout
                            </a>
                        @endauth

                        <a href="{{ route('shop') }}"
                           class="w-full border-2 border-gray-200 text-gray-700 py-3 sm:py-4 rounded-xl hover:bg-gray-50 transition font-semibold text-center block text-sm sm:text-base">
                            Continue Shopping
                        </a>

                        <!-- Clear Cart -->
                        <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit"
                                    class="w-full text-red-500 hover:text-red-700 hover:bg-red-50 py-2 rounded-lg transition font-medium text-sm">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-8">
                    <span class="text-6xl">🛒</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">Looks like you haven't added anything to your cart yet. Start shopping and fill it up!</p>
                <a href="{{ route('shop') }}" 
                   class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-full hover:from-primary-700 hover:to-primary-800 transition font-semibold inline-flex items-center gap-2 shadow-lg shadow-primary-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>

    @push('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        console.log('Cart page loaded, CSRF token:', csrfToken ? 'found' : 'NOT FOUND');

        // Track loading state for each product to prevent rapid clicks
        const loadingProducts = new Set();

        // Helper functions for quantity buttons
        function increaseQuantity(productId) {
            // Prevent action if this product is already being updated
            if (loadingProducts.has(productId)) {
                console.log('Product', productId, 'is already updating, ignoring click');
                return;
            }

            const input = document.getElementById(`quantity-${productId}`);
            const currentValue = parseInt(input.value) || 0;
            const newQty = currentValue + 1;
            console.log('Increasing quantity for product', productId, 'to', newQty);
            updateQuantityAjax(productId, newQty);
        }

        function decreaseQuantity(productId) {
            // Prevent action if this product is already being updated
            if (loadingProducts.has(productId)) {
                console.log('Product', productId, 'is already updating, ignoring click');
                return;
            }

            const input = document.getElementById(`quantity-${productId}`);
            const currentValue = parseInt(input.value) || 0;
            const newQty = currentValue - 1;
            console.log('Decreasing quantity for product', productId, 'to', newQty);
            if (newQty < 1) {
                if (!confirm('Remove this item from cart?')) return;
                removeItemAjax(productId);
            } else {
                updateQuantityAjax(productId, newQty);
            }
        }

        // Update Quantity with AJAX
        function updateQuantityAjax(productId, quantity) {
            console.log('Updating quantity for product', productId, 'to', quantity);

            // Prevent duplicate requests
            if (loadingProducts.has(productId)) {
                console.log('Product', productId, 'is already updating, skipping');
                return;
            }

            if (quantity < 1) {
                if (!confirm('Remove this item from cart?')) return;
                removeItemAjax(productId);
                return;
            }

            const quantityInput = document.getElementById(`quantity-${productId}`);
            const originalValue = quantityInput.value;

            // Mark as loading
            loadingProducts.add(productId);

            // Show loading state
            quantityInput.disabled = true;
            quantityInput.value = '...';

            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': 'PUT',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: parseInt(quantity)
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);

                // Release the loading lock
                loadingProducts.delete(productId);

                if (data.success) {
                    // Update cart count badge
                    if (data.cart_count !== undefined) {
                        updateCartCountDisplay(data.cart_count);
                    }

                    // Update item total using the item-total class
                    const cartItem = document.getElementById(`cart-item-${productId}`);
                    if (cartItem && data.item_total) {
                        const totalEl = cartItem.querySelector('.item-total');
                        if (totalEl) {
                            totalEl.textContent = '$' + data.item_total.toFixed(2);
                        }
                    }

                    // Update all totals dynamically
                    try {
                        updateCartTotalsImproved();
                    } catch (error) {
                        console.error('Error updating totals:', error);
                    }

                    // 🛡️ Check if coupon was removed due to subtotal dropping below minimum
                    if (data.coupon_removed) {
                        // Remove coupon section from Order Summary
                        removeCouponSection();
                        
                        // Show warning that coupon was removed
                        Swal.fire({
                            icon: 'warning',
                            title: 'Coupon Removed',
                            html: 'Your cart subtotal is now below the minimum requirement.<br>Coupon has been automatically removed.',
                            confirmButtonColor: '#16a34a',
                            timer: 4000,
                            timerProgressBar: true
                        });
                    } else {
                        // Show success toast
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Cart quantity updated',
                            iconColor: '#16a34a',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            background: '#f0fdf4',
                            color: '#166534'
                        });
                    }

                    // Re-enable input
                    quantityInput.disabled = false;
                    quantityInput.value = quantity;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update quantity',
                        iconColor: '#dc2626',
                        confirmButtonColor: '#16a34a'
                    });
                    quantityInput.value = originalValue;
                    quantityInput.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Release the loading lock
                loadingProducts.delete(productId);
                // Re-enable input on error
                quantityInput.disabled = false;
                quantityInput.value = originalValue;

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
            });
        }

        // Remove Item with AJAX (No Refresh)
        async function removeItemAjax(productId) {
            console.log('Removing item', productId);

            // Prevent duplicate remove requests
            if (loadingProducts.has(productId)) {
                console.log('Product', productId, 'is already updating, ignoring remove');
                return;
            }

            const cartItem = document.getElementById(`cart-item-${productId}`);
            console.log('Cart item element:', cartItem);

            if (!cartItem) {
                console.error('Cart item not found!');
                return;
            }

            // Mark as loading
            loadingProducts.add(productId);

            try {
                // Use POST method with _method spoofing for Laravel
                const url = '{{ url('cart/remove') }}/' + productId;
                console.log('Delete URL:', url);

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-HTTP-Method-Override': 'DELETE',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                });

                console.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Success:', data);

                // Release the loading lock
                loadingProducts.delete(productId);

                // 🛡️ Check if coupon was removed
                if (data.coupon_removed) {
                    // Remove coupon section from Order Summary
                    removeCouponSection();
                    
                    // Show warning that coupon was removed
                    Swal.fire({
                        icon: 'warning',
                        title: 'Coupon Removed',
                        html: 'Your cart subtotal is now below the minimum requirement.<br>Coupon has been automatically removed.',
                        confirmButtonColor: '#16a34a',
                        timer: 4000,
                        timerProgressBar: true
                    });
                } else {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed!',
                        text: 'Item has been removed from your cart',
                        iconColor: '#16a34a',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        color: '#166534'
                    });
                }

                // Animate and remove the item
                console.log('Animating removal...');
                cartItem.style.transition = 'all 0.3s ease';
                cartItem.style.opacity = '0';
                cartItem.style.transform = 'translateX(-20px)';
                cartItem.style.maxHeight = '0';
                cartItem.style.padding = '0';
                cartItem.style.margin = '0';
                cartItem.style.overflow = 'hidden';

                setTimeout(() => {
                    console.log('Removing element from DOM');
                    cartItem.remove();

                    // Update cart count badge
                    if (data.cart_count !== undefined) {
                        updateCartCountDisplay(data.cart_count);
                    }

                    // Recalculate totals
                    updateCartTotalsImproved();

                    // Check if cart is empty
                    const remainingItems = document.querySelectorAll('[id^="cart-item-"]');
                    console.log('Remaining items:', remainingItems.length);
                    if (remainingItems.length === 0) {
                        // Reload to show empty cart message
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }
                }, 300);
                
            } catch (error) {
                console.error('Error removing item:', error);
                // Release the loading lock
                loadingProducts.delete(productId);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
            }
        }

        // Update Cart Count Display with Animation
        function updateCartCountDisplay(count) {
            console.log('Updating cart count display to:', count);
            const cartCountElements = document.querySelectorAll('#cart-count, .cart-count');
            console.log('Found cart count elements:', cartCountElements.length);
            
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

        // Update Cart Totals Dynamically
        function updateCartTotals() {
            console.log('Updating cart totals...');
            let subtotal = 0;
            let totalItems = 0;

            document.querySelectorAll('[id^="cart-item-"]').forEach(item => {
                const priceText = item.querySelector('.text-2xl.font-bold').textContent.replace('$', '');
                subtotal += parseFloat(priceText);
                totalItems++;
            });

            console.log('Calculated subtotal:', subtotal);

            // Update subtotal display
            const subtotalEl = document.querySelector('.flex.justify-between.text-gray-600 .font-medium');
            if (subtotalEl) {
                subtotalEl.textContent = '$' + subtotal.toFixed(2);
            }

            // Update delivery fee
            const deliveryThreshold = 50.00;
            const deliveryFee = (subtotal >= deliveryThreshold) ? 0 : 6.00;
            
            const deliveryEl = document.querySelector('.flex.justify-between.text-gray-600 .font-medium');
            if (deliveryEl && deliveryEl.parentElement.querySelector('.text-green-600')) {
                const deliveryTextEl = deliveryEl.parentElement.querySelector('.text-green-600') || deliveryEl;
                if (deliveryFee === 0) {
                    deliveryTextEl.textContent = 'FREE';
                    deliveryTextEl.className = 'font-bold text-green-600';
                } else {
                    deliveryTextEl.textContent = '$' + deliveryFee.toFixed(2);
                    deliveryTextEl.className = 'font-medium text-gray-800';
                }
            }

            // Update total
            const finalTotal = subtotal + deliveryFee;
            const totalEl = document.querySelector('.text-primary-600');
            if (totalEl) {
                totalEl.textContent = '$' + finalTotal.toFixed(2);
            }

            // Update free shipping progress
            const progressEl = document.querySelector('.bg-amber-50, .bg-green-50');
            if (progressEl) {
                const amountNeeded = deliveryThreshold - subtotal;
                if (amountNeeded > 0) {
                    progressEl.className = 'bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `
                        <p class="text-amber-800 text-sm">
                            <span class="font-semibold">💡 Tip:</span> Add $${amountNeeded.toFixed(2)} more to get <strong>FREE delivery</strong>!
                        </p>
                    `;
                } else {
                    progressEl.className = 'bg-green-50 border border-green-200 rounded-xl p-4 mb-6';
                    progressEl.innerHTML = `
                        <p class="text-green-800 text-sm">
                            <span class="font-semibold">🎉 Awesome!</span> You qualify for <strong>FREE standard delivery</strong>!
                        </p>
                    `;
                }
            }
            
            console.log('Cart totals updated successfully');
        }

        // Improved Update Cart Totals (use this one)
        function updateCartTotalsImproved() {
            console.log('Updating cart totals (improved)...');
            let subtotal = 0;
            const deliveryThreshold = 50.00;
            const standardDeliveryFee = 6.00;

            // Calculate from cart items using the item-total class
            document.querySelectorAll('.item-total').forEach(item => {
                const priceText = item.textContent.replace('$', '').replace(',', '');
                subtotal += parseFloat(priceText) || 0;
            });

            // Calculate delivery fee
            const deliveryFee = (subtotal >= deliveryThreshold) ? 0 : standardDeliveryFee;

            // Update subtotal using ID
            const subtotalEl = document.getElementById('summary-subtotal');
            if (subtotalEl) {
                subtotalEl.textContent = '$' + subtotal.toFixed(2);
            }

            // Update delivery fee using ID
            const deliveryEl = document.getElementById('summary-delivery');
            if (deliveryEl) {
                if (deliveryFee === 0) {
                    deliveryEl.textContent = 'FREE';
                    deliveryEl.className = 'font-bold text-green-600';
                } else {
                    deliveryEl.textContent = '$' + deliveryFee.toFixed(2);
                    deliveryEl.className = 'font-medium text-gray-800';
                }
            }

            // Check if coupon section exists and get discount
            let couponDiscount = 0;
            const couponSection = document.getElementById('summary-discount');
            if (couponSection) {
                const couponDiscountEl = couponSection.querySelector('.font-medium');
                if (couponDiscountEl) {
                    couponDiscount = parseFloat(couponDiscountEl.textContent.replace('$', '').replace('-', '')) || 0;
                }
            }

            // Update total using ID
            const totalEl = document.getElementById('summary-total');
            if (totalEl) {
                const finalTotal = subtotal + deliveryFee - couponDiscount;
                totalEl.textContent = '$' + finalTotal.toFixed(2);
            }

            // Update shipping progress bar using ID
            const progressContainer = document.getElementById('shipping-progress-container');
            if (progressContainer) {
                const amountNeeded = deliveryThreshold - subtotal;
                if (amountNeeded > 0) {
                    progressContainer.innerHTML = `
                        <div id="shipping-progress" class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                            <p class="text-amber-800 text-sm">
                                <span class="font-semibold">💡 Tip:</span> Add $${amountNeeded.toFixed(2)} more to get <strong>FREE delivery</strong>!
                            </p>
                        </div>
                    `;
                } else {
                    progressContainer.innerHTML = `
                        <div id="shipping-progress" class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                            <p class="text-green-800 text-sm">
                                <span class="font-semibold">🎉 Awesome!</span> You qualify for <strong>FREE standard delivery</strong>!
                            </p>
                        </div>
                    `;
                }
            }

            console.log('Totals updated! Subtotal:', subtotal, 'Delivery:', deliveryFee, 'Coupon Discount:', couponDiscount);
        }

        // Remove coupon section from Order Summary
        function removeCouponSection() {
            console.log('Removing coupon section...');
            
            // 1. Remove the coupon discount row from Order Summary
            const couponDiscountRow = document.getElementById('summary-discount');
            if (couponDiscountRow) {
                couponDiscountRow.style.transition = 'all 0.3s ease';
                couponDiscountRow.style.opacity = '0';
                setTimeout(() => {
                    couponDiscountRow.remove();
                }, 300);
            }

            // 2. Replace the "Coupon Applied" box with "Have a Coupon?" form
            const couponForm = document.getElementById('coupon-applied-form');
            if (couponForm) {
                const couponContainer = couponForm.parentElement;
                couponContainer.style.transition = 'all 0.3s ease';
                couponContainer.style.opacity = '0';
                
                setTimeout(() => {
                    couponContainer.innerHTML = `
                        <form action="{{ route('coupon.apply') }}" method="POST" class="mb-6" id="coupon-apply-form" style="opacity: 0; transition: opacity 0.3s ease;">
                            @csrf
                            <label class="block text-sm font-bold text-gray-800 mb-2">Have a Coupon?</label>
                            <div class="flex border-2 border-primary-600 rounded-xl overflow-hidden bg-white">
                                <input type="text" name="coupon_code" placeholder="Enter coupon code"
                                       class="w-full px-4 py-3 outline-none border-none text-sm text-gray-700 placeholder-gray-400"
                                       value="{{ old('coupon_code') }}">
                                <button type="submit" class="bg-primary-600 text-white font-bold px-6 py-3 border-l border-primary-600 hover:bg-primary-700 transition cursor-pointer">
                                    Apply
                                </button>
                            </div>
                        </form>
                    `;
                    
                    // Fade in the new form
                    setTimeout(() => {
                        const newForm = couponContainer.querySelector('form');
                        if (newForm) {
                            newForm.style.opacity = '1';
                        }
                    }, 50);
                }, 300);
            }
            
            console.log('Coupon section removed successfully');
        }
    </script>
    @endpush
@endsection
