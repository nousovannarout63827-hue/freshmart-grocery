<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }} - FreshMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0', 300: '#86efac',
                            400: '#4ade80', 500: '#22c55e', 600: '#16a34a', 700: '#15803d',
                            800: '#166534', 900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; }
            .invoice-container { box-shadow: none !important; border: none !important; margin: 0 !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-gray-50 p-8">

    <!-- Back Button -->
    <div class="max-w-4xl mx-auto mb-6 no-print">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Back to Order Details
        </a>
    </div>

    <!-- Invoice Container -->
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-8 invoice-container">

        <!-- Header -->
        <div class="flex justify-between items-start mb-10 pb-8 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="bg-primary-600 p-2.5 rounded-xl">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-600 leading-none mb-1">FreshMart</h1>
                    <p class="text-gray-500 text-xs font-medium">Grocery & Fresh Produce</p>
                </div>
            </div>
            <div class="text-right text-sm">
                <h2 class="text-2xl font-black text-gray-800 tracking-wide mb-3">INVOICE</h2>
                <p class="text-gray-500 mb-1">Order No: <span class="font-bold text-gray-800">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-gray-500 mb-1">Date: <span class="font-bold text-gray-800">{{ $order->created_at->format('M d, Y') }}</span></p>
                <p class="text-gray-500">Time: <span class="font-bold text-gray-800">{{ $order->created_at->format('h:i A') }}</span></p>
            </div>
        </div>

        <!-- Invoice To / From -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="border border-gray-200 rounded-xl p-6">
                <h3 class="font-bold text-primary-600 mb-4 flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Invoice To:
                </h3>
                <p class="font-bold text-gray-800 text-lg mb-1">{{ $order->customer->name ?? 'Customer' }}</p>
                <p class="text-gray-500 text-sm mb-3">{{ $order->customer->email ?? 'N/A' }}</p>
                <p class="text-gray-500 text-sm flex items-center gap-2 mb-2">
                    <span class="text-pink-600">📞</span> {{ $order->phone ?? 'N/A' }}
                </p>
                <p class="text-gray-500 text-sm flex items-start gap-2">
                    <span class="text-gray-400">📍</span> {{ $order->delivery_address ?? $order->address ?? 'N/A' }}
                </p>
            </div>

            <div class="bg-primary-50 border border-primary-100 rounded-xl p-6 text-right">
                <h3 class="font-bold text-primary-600 mb-4 flex items-center justify-end gap-2 text-sm">
                    Invoice From: 🏢
                </h3>
                <p class="font-bold text-gray-800 text-lg mb-1">FreshMart Grocery</p>
                <p class="text-gray-500 text-sm mb-3">admin@freshmart.com</p>
                <p class="text-gray-500 text-sm flex items-center justify-end gap-2 mb-2">
                    <span class="text-pink-600">📞</span> +855 12 345 678
                </p>
                <p class="text-gray-500 text-sm">
                    123 Fresh Blvd, Khan Daun Penh<br>Phnom Penh, Cambodia
                </p>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="border border-gray-200 rounded-xl overflow-hidden mb-10">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-5 font-bold text-gray-800">SL</th>
                        <th class="py-3 px-5 font-bold text-gray-800">Product</th>
                        <th class="py-3 px-5 font-bold text-gray-800 text-center">Qty</th>
                        <th class="py-3 px-5 font-bold text-gray-800 text-right">Unit Price</th>
                        <th class="py-3 px-5 font-bold text-gray-800 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->orderItems as $index => $item)
                    <tr>
                        <td class="py-4 px-5 text-gray-600">{{ $index + 1 }}</td>
                        <td class="py-4 px-5 font-bold text-gray-800">{{ $item->product->name ?? 'Product' }}</td>
                        <td class="py-4 px-5 text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="py-4 px-5 text-right text-gray-600">${{ number_format($item->price, 2) }}</td>
                        <td class="py-4 px-5 text-right font-bold text-gray-800">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Payment & Totals -->
        @php
            $itemTotal = 0;
            foreach($order->orderItems as $item) {
                $itemTotal += ($item->price * $item->quantity);
            }
            $discountValue = 0;
            $deliveryValue = $order->total_amount - $itemTotal + $discountValue;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div>
                <!-- Payment Method -->
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
                    <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Payment Method
                    </h4>
                    <p class="font-bold text-gray-800 mb-1 text-sm flex items-center gap-2">
                        <span class="text-green-600 text-lg">💵</span> Cash On Delivery
                    </p>
                    <p class="text-gray-500 text-xs mb-4">Pay when you receive your order</p>

                    <p class="text-xs text-gray-500 mb-2">Payment Status:</p>
                    @php $isPaid = strtolower($order->status) == 'delivered' || ($order->payment_status ?? '') == 'paid'; @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $isPaid ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $isPaid ? '✓ PAID' : '⏳ UNPAID' }}
                    </span>
                </div>

                <!-- Order Status -->
                <div>
                    <h4 class="font-bold text-gray-800 text-sm mb-3">Order Status</h4>
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
                        $statusIcons = [
                            'pending' => '📦',
                            'confirmed' => '✅',
                            'preparing' => '👨‍🍳',
                            'shipped' => '🚚',
                            'out_for_delivery' => '📬',
                            'arrived' => '📍',
                            'delivered' => '🎉',
                            'cancelled' => '❌',
                        ];
                    @endphp
                    <span class="inline-block {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }} font-bold px-4 py-1.5 rounded-full text-sm">
                        <span>{{ $statusIcons[$order->status] ?? '📦' }}</span>
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                <div class="flex justify-between items-center text-sm mb-4 pb-4 border-b border-gray-200">
                    <span class="font-bold text-gray-700">Subtotal</span>
                    <span class="font-bold text-gray-800">${{ number_format($itemTotal, 2) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm mb-4 pb-4 border-b border-gray-200">
                    <span class="font-bold text-gray-700">Delivery Cost</span>
                    @if($deliveryValue > 0)
                        <span class="font-bold text-gray-800">${{ number_format($deliveryValue, 2) }}</span>
                    @else
                        <span class="font-bold text-green-600">FREE</span>
                    @endif
                </div>
                <div class="flex justify-between items-center text-sm mb-4 pb-4 border-b border-gray-200">
                    <span class="font-bold text-gray-700">Discount</span>
                    <span class="font-bold text-gray-800">-${{ number_format($discountValue, 2) }}</span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="font-black text-lg text-gray-800">Total Paid</span>
                    <span class="font-black text-xl text-primary-600">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 pt-8 border-t border-gray-200 text-center">
            <p class="font-bold text-gray-600 text-sm mb-1">Thank you for shopping with FreshMart! 🥬🍎</p>
            <p class="text-gray-400 text-xs">For any inquiries, please contact us at admin@freshmart.com or call +855 12 345 678</p>
        </div>

        <!-- Print Button -->
        <div class="mt-10 flex justify-center gap-4 no-print">
            <button onclick="window.print()" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-6 rounded-lg transition flex items-center gap-2 shadow-lg shadow-primary-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.243H7.23a1.125 1.125 0 01-1.12-1.243L6.34 18m11.318-6.318A4.486 4.486 0 0012.016 5a4.486 4.486 0 00-4.198 2.307M9.64 8.284a42.412 42.412 0 014.72 0M9.64 8.284a3.96 3.96 0 00-4.574 3.473L4.63 15.52a1.125 1.125 0 001.12 1.243h12.499a1.125 1.125 0 001.12-1.243l-.436-4.763a3.96 3.96 0 00-4.574-3.473L9.64 8.284z" />
                </svg>
                Print Invoice
            </button>
            <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 font-bold py-2.5 px-6 rounded-lg transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Order
            </a>
        </div>

    </div>
</body>
</html>
