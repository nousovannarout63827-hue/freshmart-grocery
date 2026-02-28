@extends('customer.profile.layout')

@section('title', 'Order ' . $order->order_number . ' - FreshMart')

@section('profile-content')
    <!-- Back Button -->
    <a href="{{ route('customer.profile') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Dashboard
    </a>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #059669; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info Card -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">Order #{{ $order->id }}</h1>
                        <p class="text-gray-500">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap">
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-100 text-amber-700',
                                'confirmed' => 'bg-blue-100 text-blue-700',
                                'preparing' => 'bg-purple-100 text-purple-700',
                                'shipped' => 'bg-indigo-100 text-indigo-700',
                                'out_for_delivery' => 'bg-cyan-100 text-cyan-700',
                                'arrived' => 'bg-teal-100 text-teal-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ];
                            
                            // Map status for timeline display
                            $displayStatus = $order->status;
                            if ($displayStatus === 'picked_up') {
                                $displayStatus = 'out_for_delivery';
                            }
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} w-fit">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                        
                        @if(in_array($order->status, ['pending', 'preparing', 'ready_for_pickup', 'out_for_delivery', 'arrived']))
                            <a href="{{ route('customer.order.track', $order->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-primary-500/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                                Track Order
                            </a>
                        @endif
                        
                        @if($order->status !== 'cancelled')
                            <a href="{{ route('customer.order.invoice', $order->id) }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Invoice
                            </a>
                            <a href="{{ route('customer.order.invoice-pdf', $order->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download PDF
                            </a>
                            @if($order->status === 'pending')
                                <button onclick="openCancelOrderModal()"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel Order
                                </button>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex gap-4 p-4 bg-gray-50 rounded-xl">
                                <div class="w-20 h-20 bg-white rounded-lg flex-shrink-0 overflow-hidden border border-gray-100">
                                    @php
                                        $productImage = null;
                                        if($item->product) {
                                            $productImage = $item->product->image ? asset('storage/' . $item->product->image) : null;
                                        }
                                    @endphp
                                    @if($productImage)
                                        <img src="{{ $productImage }}"
                                             alt="{{ $item->product->translated_name ?? 'Product' }}"
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
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->translated_name ?? 'Product' }}</h3>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-500">Price: ${{ number_format($item->price, 2) }} each</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">${{ number_format($item->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment & Delivery Info -->
                <div class="border-t border-gray-100 pt-6 mt-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 mb-3">Payment Method</h3>
                            <div class="flex items-center gap-3 text-gray-700">
                                @if($order->payment_method === 'cash')
                                    <span class="text-2xl">💵</span>
                                    <span>Cash on Delivery</span>
                                @else
                                    <span class="text-2xl">💳</span>
                                    <span>Card Payment</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Payment Status: <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-amber-600' }}">
                                    {{ ucfirst($order->payment_status ?? 'unknown') }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 mb-3">Delivery Address</h3>
                            <p class="text-gray-700">{{ $order->delivery_address ?? 'No delivery address provided' }}</p>
                            @if($order->latitude && $order->longitude)
                                <a href="https://www.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}" 
                                   target="_blank"
                                   class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 text-sm font-medium mt-2">
                                    📍 View on Map
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            @include('customer.profile._order-timeline')
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h2>
                
                @php
                    // Calculate the exact subtotal of the food items
                    $calculatedSubtotal = 0;
                    foreach($order->orderItems as $item) {
                        $calculatedSubtotal += ($item->price * $item->quantity);
                    }

                    // Figure out the delivery fee (total - subtotal)
                    $calculatedDelivery = $order->total_amount - $calculatedSubtotal;
                @endphp

                <div class="space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-medium">${{ number_format($calculatedSubtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Delivery</span>
                        @if($calculatedDelivery > 0)
                            <span class="font-medium text-gray-800">${{ number_format($calculatedDelivery, 2) }}</span>
                        @else
                            <span class="font-bold text-green-600">FREE</span>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 pt-3 flex justify-between text-lg font-bold text-gray-900">
                        <span>Total</span>
                        <span class="text-primary-600">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Delivery Address</h2>
                <div class="space-y-3 text-gray-600">
                    <p class="font-semibold text-gray-900">{{ $order->customer->name ?? 'Customer' }}</p>
                    <p>{{ $order->address }}</p>
                    @if($order->phone)
                        <p class="text-sm">
                            <span class="font-medium">Phone:</span> 
                            <a href="tel:{{ $order->phone }}" class="text-primary-600 hover:text-primary-700">{{ $order->phone }}</a>
                        </p>
                    @endif
                    @if($order->delivery_notes)
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 mt-2">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-blue-900 text-sm">Delivery Instructions:</p>
                                    <p class="text-blue-700 text-sm mt-1">{{ $order->delivery_notes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Google Map Location -->
                @if($order->latitude && $order->longitude)
                    <div class="mt-4" id="delivery-map">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">📍 Delivery Location on Map</h3>
                        <div class="bg-gray-100 rounded-xl overflow-hidden border-2 border-gray-200" style="height: 250px;">
                            <div id="order-map" style="height: 100%; width: 100%;"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Coordinates: {{ number_format($order->latitude, 6) }}, {{ number_format($order->longitude, 6) }}
                        </p>
                    </div>
                @else
                    <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <p class="text-sm text-gray-600 text-center">
                            📍 Map location not available for this order
                        </p>
                    </div>
                @endif
            </div>

            <!-- Payment Info -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Payment Method</h2>
                <div class="flex items-center gap-3">
                    @if($order->payment_method === 'cash')
                        <span class="text-3xl">💵</span>
                        <div>
                            <p class="font-semibold text-gray-900">Cash on Delivery</p>
                            <p class="text-sm text-gray-500">Pay when you receive</p>
                        </div>
                    @else
                        <span class="text-3xl">💳</span>
                        <div>
                            <p class="font-semibold text-gray-900">Card Payment</p>
                            <p class="text-sm text-gray-500">Paid by card</p>
                        </div>
                    @endif
                </div>

                <!-- Payment Status Badge -->
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-500 mb-2">Payment Status:</p>
                    @if(strtolower($order->status) == 'delivered' || strtolower($order->payment_status ?? '') == 'paid')
                        <span class="inline-block bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wide">
                            ✓ Paid
                        </span>
                    @else
                        <span class="inline-block bg-amber-100 text-amber-700 font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wide">
                            ⏳ Unpaid
                        </span>
                    @endif
                </div>
            </div>

            <!-- Delivery Method -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Delivery Method</h2>
                @php
                    $shippingMethod = $order->shipping_method ?? 'Standard Delivery';
                    $shippingColor = 'blue';
                    $shippingIcon = '🚚';
                    $shippingBg = 'bg-blue-50';
                    $shippingBorder = 'border-blue-200';
                    $shippingText = 'text-blue-700';
                    
                    if (str_contains(strtolower($shippingMethod), 'fast')) {
                        $shippingColor = 'red';
                        $shippingIcon = '⚡';
                        $shippingBg = 'bg-red-50';
                        $shippingBorder = 'border-red-200';
                        $shippingText = 'text-red-700';
                    } elseif (str_contains(strtolower($shippingMethod), 'express')) {
                        $shippingColor = 'amber';
                        $shippingIcon = '🚀';
                        $shippingBg = 'bg-amber-50';
                        $shippingBorder = 'border-amber-200';
                        $shippingText = 'text-amber-700';
                    }
                @endphp
                <div class="{{ $shippingBg }} rounded-xl border {{ $shippingBorder }} p-4">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">{{ $shippingIcon }}</span>
                        <div>
                            <p class="font-semibold {{ $shippingText }}">{{ $shippingMethod }}</p>
                            <p class="text-sm text-gray-500">
                                @if(str_contains(strtolower($shippingMethod), 'fast'))
                                    Delivery in 2 hours
                                @elseif(str_contains(strtolower($shippingMethod), 'express'))
                                    Delivery in 6 hours
                                @else
                                    Delivery in 12 hours
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($order->latitude && $order->longitude)
    @push('scripts')
    <!-- Leaflet.js for Order Map - Free OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const orderLat = {{ $order->latitude ?? 11.5564 }};
            const orderLng = {{ $order->longitude ?? 104.9282 }};

            // Create map centered on delivery location
            const map = L.map('order-map').setView([orderLat, orderLng], 15);

            // Load OpenStreetMap tiles (free!)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Create marker at delivery location
            L.marker([orderLat, orderLng]).addTo(map)
                .bindPopup('<b>📍 Delivery Location</b><br>Your delivery address')
                .openPopup();
        });
    </script>

    <!-- Cancel Order Modal -->
    <div id="cancelOrderModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 16px; padding: 32px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                <h3 style="margin: 0; font-weight: 800; color: #1e293b; font-size: 20px;">🚫 Cancel Order</h3>
                <button onclick="closeCancelOrderModal()" style="background: none; border: none; font-size: 24px; color: #64748b; cursor: pointer; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='none'">✕</button>
            </div>

            @if(session('error'))
                <div style="background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; font-size: 14px;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <div style="background: #fef3c7; border: 1px solid #fcd34d; border-left: 4px solid #f59e0b; padding: 16px; border-radius: 8px; margin-bottom: 20px;">
                <p style="margin: 0; font-size: 14px; color: #92400e; line-height: 1.6;">
                    <strong>⚠️ Important:</strong> Orders can only be cancelled before they are confirmed by our staff. Once the order status changes to "Preparing", cancellation is no longer available.
                </p>
            </div>

            <form action="{{ route('customer.order.cancel', $order->id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 700; color: #1e293b; margin-bottom: 8px; font-size: 14px;">
                        Why do you want to cancel this order? <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea name="cancellation_reason" rows="5" required 
                        placeholder="Please tell us why you're cancelling this order (e.g., ordered by mistake, found better price, no longer needed, delivery time too long, etc.)" 
                        style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 14px; resize: vertical; box-sizing: border-box; font-family: inherit; outline: none; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'"></textarea>
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #64748b;">Maximum 1000 characters</p>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="closeCancelOrderModal()" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                        Back
                    </button>
                    <button type="submit" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(239, 68, 68, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.3)'">
                        🚫 Confirm Cancellation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCancelOrderModal() {
            document.getElementById('cancelOrderModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeCancelOrderModal() {
            document.getElementById('cancelOrderModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        document.getElementById('cancelOrderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCancelOrderModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCancelOrderModal();
            }
        });
    </script>
    @endpush
    @endif
@endsection
