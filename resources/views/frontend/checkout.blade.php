@extends('frontend.layouts.app')

@section('title', 'Checkout - FreshMart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12 rounded-3xl mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-2">🔐 Secure Checkout</h1>
                <p class="text-green-100">Complete your order in a few steps</p>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Contact Information -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Contact Information</h2>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" name="first_name" required 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                       placeholder="John">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" name="last_name" required 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                       placeholder="Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" required 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                       placeholder="john@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="phone" required
                                       pattern="[0-9]{10,15}"
                                       inputmode="numeric"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                       placeholder="1234567890">
                                <p class="text-xs text-gray-500 mt-1">Enter numbers only (10-15 digits)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Delivery Address</h2>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address *</label>
                                <input type="text" name="address" required 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                       placeholder="123 Main Street, Apt 4B">
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                    <input type="text" name="city" required 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                           placeholder="New York">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                                    <input type="text" name="postal_code" required 
                                           class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                           placeholder="10001">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Payment Method</h2>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-5 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-500 hover:bg-primary-50 transition">
                                <input type="radio" name="payment_method" value="cash" checked 
                                       class="w-5 h-5 text-primary-600 focus:ring-primary-500">
                                <div class="flex-1 flex items-center gap-4">
                                    <span class="text-3xl">💵</span>
                                    <div>
                                        <span class="font-semibold text-gray-900">Cash on Delivery</span>
                                        <p class="text-sm text-gray-500">Pay when you receive your order</p>
                                    </div>
                                </div>
                            </label>
                            <label class="flex items-center gap-4 p-5 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-primary-500 hover:bg-primary-50 transition">
                                <input type="radio" name="payment_method" value="card" 
                                       class="w-5 h-5 text-primary-600 focus:ring-primary-500">
                                <div class="flex-1 flex items-center gap-4">
                                    <span class="text-3xl">💳</span>
                                    <div>
                                        <span class="font-semibold text-gray-900">Card Payment</span>
                                        <p class="text-sm text-gray-500">Credit or Debit Card</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    @php
                        // Calculate subtotal first for shipping calculation
                        $subtotal = 0;
                        foreach($cart as $productId => $item) {
                            $subtotal += $item['price'] * $item['quantity'];
                        }
                    @endphp

                    <!-- Shipping Method -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm mb-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Shipping Method</h2>
                        </div>

                        @php
                            // Shipping rules - Free standard shipping over $50
                            $deliveryThreshold = 50.00;
                            
                            // Base prices for each tier
                            $baseStandard = 6.00;
                            $baseExpress = 10.00;
                            $baseFast = 20.00;

                            // If subtotal is $50 or more, give $6 discount on ANY shipping method
                            $shippingDiscount = ($subtotal >= $deliveryThreshold) ? $baseStandard : 0;

                            // Calculate final prices for each tier
                            $costStandard = max(0, $baseStandard - $shippingDiscount);
                            $costExpress = max(0, $baseExpress - $shippingDiscount);
                            $costFast = max(0, $baseFast - $shippingDiscount);
                        @endphp

                        <label class="flex items-center justify-between p-5 border-2 border-primary-500 rounded-xl mb-4 cursor-pointer transition bg-primary-50 shipping-label">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="shipping_cost" value="{{ $costStandard }}" class="w-5 h-5 text-primary-600 focus:ring-primary-500 shipping-radio" checked onchange="updateShippingUI()">
                                <div>
                                    <p class="font-bold text-gray-900">🚚 Standard Delivery</p>
                                    <p class="text-sm text-gray-500">Delivery in 12 hours</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if($shippingDiscount > 0)
                                    <span class="line-through text-red-500 text-sm mr-2">${{ number_format($baseStandard, 2) }}</span>
                                    <span class="font-bold text-green-600">FREE</span>
                                @else
                                    <span class="font-bold text-primary-700">${{ number_format($baseStandard, 2) }}</span>
                                @endif
                            </div>
                        </label>

                        <label class="flex items-center justify-between p-5 border-2 border-gray-200 rounded-xl mb-4 cursor-pointer hover:bg-gray-50 transition shipping-label">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="shipping_cost" value="{{ $costExpress }}" class="w-5 h-5 text-primary-600 focus:ring-primary-500 shipping-radio" onchange="updateShippingUI()">
                                <div>
                                    <p class="font-bold text-gray-900">⚡ Express Delivery</p>
                                    <p class="text-sm text-gray-500">Delivery in 6 hours</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if($shippingDiscount > 0)
                                    <span class="line-through text-red-500 text-sm mr-2">${{ number_format($baseExpress, 2) }}</span>
                                @endif
                                <span class="font-bold text-primary-700">${{ number_format($costExpress, 2) }}</span>
                            </div>
                        </label>

                        <label class="flex items-center justify-between p-5 border-2 border-gray-200 rounded-xl mb-4 cursor-pointer hover:bg-gray-50 transition shipping-label">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="shipping_cost" value="{{ $costFast }}" class="w-5 h-5 text-primary-600 focus:ring-primary-500 shipping-radio" onchange="updateShippingUI()">
                                <div>
                                    <p class="font-bold text-gray-900">🚀 Fast Delivery</p>
                                    <p class="text-sm text-gray-500">Delivery in 2 hours</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if($shippingDiscount > 0)
                                    <span class="line-through text-red-500 text-sm mr-2">${{ number_format($baseFast, 2) }}</span>
                                @endif
                                <span class="font-bold text-primary-700">${{ number_format($costFast, 2) }}</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Cart Items -->
                        <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2">
                            @foreach($cart as $productId => $item)
                                @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                                <div class="flex gap-4 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-16 h-16 bg-white rounded-lg flex-shrink-0 overflow-hidden border border-gray-100">
                                        @php
                                            // Try session image first, fallback to database if null
                                            $imagePath = $item['image'] ?? \App\Models\Product::find($productId)?->image;
                                            $imageUrl = $imagePath ? asset('storage/' . $imagePath) : null;
                                        @endphp
                                        @if($imageUrl)
                                            <img src="{{ $imageUrl }}"
                                                 alt="{{ $item['name'] }}"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="w-full h-full flex items-center justify-center text-2xl bg-gradient-to-br from-primary-50 to-primary-100" style="display: none;">
                                                🥬
                                            </div>
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-2xl bg-gradient-to-br from-primary-50 to-primary-100">
                                                🥬
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900 text-sm truncate">{{ $item['name'] }}</p>
                                        <p class="text-sm text-gray-500">
                                            @php
                                                $displayPrice = ($item['price'] == floor($item['price'])) ? '$' . number_format($item['price'], 0) : '$' . number_format($item['price'], 2);
                                            @endphp
                                            {{ $item['quantity'] }} x {{ $displayPrice }}
                                        </p>
                                    </div>
                                    <p class="font-semibold text-gray-900 text-sm">${{ number_format($itemTotal, 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        @php
                            $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;
                            // Get selected shipping cost from the radio button value (default to first option)
                            $defaultShipping = $costStandard;
                            $finalTotal = ($subtotal + $defaultShipping) - $discount;
                        @endphp

                        <!-- Totals -->
                        <div class="border-t-2 border-gray-200 pt-4 space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="summary-subtotal" class="font-medium">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping Fee</span>
                                <span id="summary-delivery" class="font-medium text-primary-600">
                                    @php
                                        $displayDelivery = (6.00 == floor(6.00)) ? '$' . number_format(6.00, 0) : '$' . number_format(6.00, 2);
                                    @endphp
                                    {{ $displayDelivery }}
                                </span>
                            </div>

                            @if(session()->has('coupon'))
                                <div class="flex justify-between text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
                                    <span>Discount ({{ session()->get('coupon')['code'] }})</span>
                                    <span id="summary-discount" class="font-medium">-${{ number_format($discount, 2) }}</span>
                                </div>
                            @elseif($subtotal >= 50)
                                <div class="flex justify-between text-green-600 bg-green-50 p-3 rounded-xl">
                                    <span>Bulk Discount (Orders $50+)</span>
                                    <span id="summary-discount" class="font-medium">-$0.00</span>
                                </div>
                            @else
                                <div class="flex justify-between text-gray-600 bg-gray-50 p-3 rounded-xl">
                                    <span>Discount</span>
                                    <span id="summary-discount" class="font-medium">-$0.00</span>
                                </div>
                            @endif

                            <div class="border-t-2 border-gray-200 pt-3 flex justify-between text-xl font-bold text-gray-900">
                                <span>Total</span>
                                <span id="summary-total" class="text-primary-600">
                                    @php
                                        $displayTotal = ($finalTotal == floor($finalTotal)) ? '$' . number_format($finalTotal, 0) : '$' . number_format($finalTotal, 2);
                                    @endphp
                                    {{ $displayTotal }}
                                </span>
                            </div>
                        </div>

                        <!-- Coupon Section -->
                        @if(!session()->has('coupon'))
                            <form action="{{ route('coupon.apply') }}" method="POST" class="mb-6">
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
                            <form action="{{ route('coupon.remove') }}" method="POST" class="mb-6">
                                @csrf
                                <div class="flex justify-between items-center bg-green-50 border border-green-200 px-4 py-3 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-green-700 font-bold text-sm">Coupon: {{ session()->get('coupon')['code'] }}</span>
                                    </div>
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm underline cursor-pointer">
                                        Remove
                                    </button>
                                </div>
                            </form>
                        @endif

                        <!-- Place Order Button -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 rounded-xl hover:from-primary-700 hover:to-primary-800 transition font-semibold mb-4 shadow-lg shadow-primary-500/30 flex items-center justify-center gap-2 mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Place Order
                        </button>

                        <!-- Back to Cart Link -->
                        <a href="{{ route('cart') }}"
                           class="w-full block text-center border-2 border-gray-200 text-gray-700 py-4 rounded-xl hover:bg-gray-50 transition font-semibold">
                            Back to Cart
                        </a>

                        <!-- Trust Badges -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-500 text-center mb-4">🔒 Secure Checkout Guaranteed</p>
                            <div class="flex justify-center gap-4 opacity-60">
                                <div class="text-2xl">💳</div>
                                <div class="text-2xl">🔐</div>
                                <div class="text-2xl">✅</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Grab PHP values so JS knows the starting math
        const subtotal = {{ $subtotal ?? 0 }};
        const discount = {{ session()->has('coupon') ? session()->get('coupon')['discount'] : 0 }};

        function updateShippingUI() {
            // 1. Find which radio button is currently selected
            const selectedRadio = document.querySelector('.shipping-radio:checked');
            const shippingCost = parseFloat(selectedRadio.value);

            // 2. Update the visual styling of the boxes
            document.querySelectorAll('.shipping-label').forEach(label => {
                label.classList.remove('border-primary-500', 'bg-primary-50');
                label.classList.add('border-gray-200');
            });
            selectedRadio.closest('label').classList.remove('border-gray-200');
            selectedRadio.closest('label').classList.add('border-primary-500', 'bg-primary-50');

            // 3. Do the math and update the text on the screen!
            const finalTotal = (subtotal + shippingCost) - discount;

            // 4. Update delivery fee display - show FREE instead of $0.00
            const deliveryTextElement = document.getElementById('summary-delivery');
            if (shippingCost === 0) {
                deliveryTextElement.innerText = 'FREE';
                deliveryTextElement.classList.remove('text-primary-600');
                deliveryTextElement.classList.add('text-green-600', 'font-bold');
            } else {
                deliveryTextElement.innerText = '$' + shippingCost.toFixed(2);
                deliveryTextElement.classList.remove('text-green-600', 'font-bold');
                deliveryTextElement.classList.add('text-primary-600');
            }

            document.getElementById('summary-total').innerText = '$' + finalTotal.toFixed(2);
        }

        // Run this once when the page loads to ensure correct starting math
        document.addEventListener("DOMContentLoaded", function() {
            updateShippingUI();
        });
    </script>
    @endpush
@endsection
