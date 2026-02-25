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
                    <div class="flex items-center gap-3">
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
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} w-fit">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                        @if($order->status !== 'cancelled')
                            <a href="{{ route('customer.order.invoice', $order->id) }}"
                               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition"
                               target="_blank">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Invoice
                            </a>
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
                                             alt="{{ $item->product->name ?? 'Product' }}"
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
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->name ?? 'Product' }}</h3>
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
            </div>
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
                <div class="space-y-2 text-gray-600">
                    <p class="font-semibold text-gray-900">{{ $order->customer->name ?? 'Customer' }}</p>
                    <p>{{ $order->address }}</p>
                </div>
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

    <!-- Order Timeline -->
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6">Order Timeline</h2>

        @php
            // Map status to numeric level for comparison (new workflow)
            $statusLevels = [
                'pending' => 1,
                'preparing' => 2,
                'ready_for_pickup' => 3,
                'out_for_delivery' => 4,
                'arrived' => 5,
                'delivered' => 6,
                'cancelled' => 0,
            ];

            // Get current status level
            $currentStatus = strtolower($order->status);
            $level = $statusLevels[$currentStatus] ?? 1;

            $timeline = [
                ['level' => 1, 'label' => 'Order Received', 'icon' => '📋', 'desc' => 'Your order has been placed'],
                ['level' => 2, 'label' => 'Preparing', 'icon' => '🍳', 'desc' => 'Staff is preparing your items'],
                ['level' => 3, 'label' => 'Ready for Pickup', 'icon' => '✅', 'desc' => 'Order ready for driver'],
                ['level' => 4, 'label' => 'Out for Delivery', 'icon' => '🚚', 'desc' => 'Driver is on the way'],
                ['level' => 5, 'label' => 'Arrived', 'icon' => '📍', 'desc' => 'Driver has arrived'],
                ['level' => 6, 'label' => 'Delivered', 'icon' => '🎉', 'desc' => 'Order completed'],
            ];
        @endphp

        @if($level === 0)
            <div class="p-4 bg-red-50 text-red-700 rounded-xl border border-red-200 font-bold flex gap-3 items-center">
                <span class="text-2xl">🚫</span>
                <span>This order has been cancelled.</span>
            </div>
        @elseif($level >= 4)
            <!-- Driver Info Section (shown when driver is assigned) -->
            @if($order->driver)
            <div class="mb-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg flex-shrink-0 overflow-hidden">
                        @if($order->driver->avatar || $order->driver->profile_photo_path)
                            <img src="{{ asset('storage/' . ($order->driver->avatar ?? $order->driver->profile_photo_path)) }}" 
                                 alt="{{ $order->driver->name }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.style.display='none'; this.parentElement.innerText='{{ strtoupper(substr($order->driver->name ?? 'D', 0, 1)) }}'">
                        @else
                            {{ strtoupper(substr($order->driver->name ?? 'D', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">{{ $order->driver->name ?? 'Driver' }}</p>
                        @if($order->driver->phone_number)
                            <a href="tel:{{ $order->driver->phone_number }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $order->driver->phone_number }}
                            </a>
                        @else
                            <p class="text-sm text-gray-500">Phone number not available</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-blue-600 text-white font-bold px-3 py-1 rounded-full text-xs uppercase">
                            Your Driver
                        </span>
                    </div>
                </div>
            </div>
            @else
            <div class="mb-6 p-4 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-sm text-amber-700">Driver will be assigned soon.</p>
            </div>
            @endif
        @endif

        @if($level === 0)
        @elseif($level >= 6)
            <!-- Delivered - Show all steps completed -->
            <div class="relative ml-4">
                <div class="absolute left-4 top-4 bottom-4 w-0.5 bg-green-500 z-0"></div>
                <div class="space-y-6 relative z-10">
                    @foreach($timeline as $step)
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 border-2 bg-green-600 border-green-600 text-white">
                                {{ $step['icon'] }}
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="font-semibold text-gray-900">{{ $step['label'] }}</p>
                                <p class="text-sm text-gray-500">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- In Progress Timeline -->
            <div class="relative ml-4">
                <!-- Vertical connecting line -->
                <div class="absolute left-4 top-4 bottom-4 w-0.5 bg-gray-300 z-0"></div>

                <div class="space-y-6 relative z-10">
                    @foreach($timeline as $step)
                        @php
                            $isCompleted = $level >= $step['level'];
                            $isCurrent = $level == $step['level'];
                        @endphp
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 border-2
                                        {{ $isCompleted ? 'bg-green-600 border-green-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                                {{ $step['icon'] }}
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="font-semibold {{ $isCompleted ? 'text-gray-900' : 'text-gray-400' }}">
                                    {{ $step['label'] }}
                                </p>
                                <p class="text-sm {{ $isCompleted ? 'text-gray-500' : 'text-gray-400' }}">
                                    {{ $step['desc'] }}
                                </p>
                                @if($isCurrent && $level < 6)
                                    <p class="text-sm text-green-600 font-medium mt-1">
                                        ✨ Current status
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
