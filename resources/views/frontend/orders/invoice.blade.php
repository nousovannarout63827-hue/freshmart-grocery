<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice ORD-{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }} - FreshMart</title>
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
            .invoice-container { box-shadow: none !important; border: none !important; margin: 0 !important; max-width: 100% !important; padding: 20px !important; }
        }
    </style>
</head>
<body class="bg-gray-50 p-8 text-gray-800">

    <!-- Back Button (hidden when printing) -->
    <div class="max-w-4xl mx-auto mb-6 no-print">
        <a href="{{ route('customer.profile') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-bold underline">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to My Orders
        </a>
    </div>

    <!-- Invoice Container -->
    <div class="max-w-4xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-10 invoice-container">

        <!-- Header -->
        <div class="flex justify-between items-start mb-12 border-b border-gray-100 pb-8">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-primary-700">FreshMart</h1>
                    <p class="text-gray-500 text-sm">Grocery & Fresh Produce</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-2xl font-black text-gray-800 tracking-wide uppercase">Invoice</h2>
                <p class="text-gray-500 mt-1">Order No: <span class="font-bold text-gray-700">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-gray-500">Date: <span class="font-bold text-gray-700">{{ $order->created_at->format('M d, Y') }}</span></p>
                <p class="text-gray-500">Time: <span class="font-bold text-gray-700">{{ $order->created_at->format('h:i A') }}</span></p>
            </div>
        </div>

        <!-- Invoice To / From -->
        <div class="grid grid-cols-2 gap-8 mb-12">
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Invoice To:
                </h3>
                <p class="text-gray-700 font-bold text-lg">{{ $order->customer->name }}</p>
                <p class="text-gray-600">{{ $order->customer->email }}</p>
                @if($order->phone)
                    <p class="text-gray-600">📞 {{ $order->phone }}</p>
                @endif
                @if($order->delivery_address)
                    <p class="text-gray-600 mt-3 flex items-start gap-2">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $order->delivery_address }}</span>
                    </p>
                @endif
            </div>
            <div class="bg-primary-50 rounded-xl p-6 border border-primary-100 text-right">
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center justify-end gap-2">
                    Invoice From:
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </h3>
                <p class="text-gray-700 font-bold">FreshMart Grocery</p>
                <p class="text-gray-600">admin@freshmart.com</p>
                <p class="text-gray-600">📞 +855 12 345 678</p>
                <p class="text-gray-600 mt-3">123 Fresh Blvd, Khan Daun Penh<br>Phnom Penh, Cambodia</p>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="border border-gray-200 rounded-xl overflow-hidden mb-8">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-4 px-5 font-bold text-gray-800 w-16 text-center">SL</th>
                        <th class="py-4 px-5 font-bold text-gray-800">Product</th>
                        <th class="py-4 px-5 font-bold text-gray-800 text-center">Qty</th>
                        <th class="py-4 px-5 font-bold text-gray-800 text-right">Unit Price</th>
                        <th class="py-4 px-5 font-bold text-gray-800 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $index => $item)
                    <tr class="border-b border-gray-100 last:border-none hover:bg-gray-50">
                        <td class="py-4 px-5 text-gray-600 text-center font-medium">{{ $index + 1 }}</td>
                        <td class="py-4 px-5">
                            <p class="font-bold text-gray-800">{{ $item->product->translated_name ?? 'Product' }}</p>
                        </td>
                        <td class="py-4 px-5 text-center text-gray-600 font-medium">{{ $item->quantity }}</td>
                        <td class="py-4 px-5 text-right text-gray-600">${{ number_format($item->price, 2) }}</td>
                        <td class="py-4 px-5 text-right font-bold text-gray-800">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Payment & Totals -->
        <div class="flex flex-col lg:flex-row justify-between items-end gap-8 mb-12">
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 w-full lg:w-auto">
                <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Payment Method
                </h3>
                @if($order->payment_method === 'cash')
                    <p class="text-gray-700 font-semibold">💵 Cash On Delivery</p>
                    <p class="text-gray-500 text-sm mt-1">Pay when you receive your order</p>
                @else
                    <p class="text-gray-700 font-semibold">💳 Card Payment</p>
                    <p class="text-gray-500 text-sm mt-1">Paid by credit/debit card</p>
                @endif
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-gray-500 text-sm">Payment Status:</p>
                    @php
                        $paymentStatusColors = [
                            'paid' => 'bg-green-100 text-green-700',
                            'unpaid' => 'bg-amber-100 text-amber-700',
                            'pending' => 'bg-gray-100 text-gray-700',
                        ];
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase {{ $paymentStatusColors[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }} mt-1">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <div class="w-full lg:w-80">
                @php
                    $itemSubtotal = 0;
                    foreach($order->orderItems as $item) {
                        $itemSubtotal += $item->price * $item->quantity;
                    }
                    $deliveryCost = 6.00;
                    $discount = $itemSubtotal + $deliveryCost - $order->total_amount;
                    if ($discount < 0) $discount = 0;
                @endphp
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between py-3 border-b border-gray-200">
                        <span class="font-bold text-gray-700">Subtotal</span>
                        <span class="font-bold text-gray-800">${{ number_format($itemSubtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-200">
                        <span class="font-bold text-gray-700">Delivery Cost</span>
                        <span class="font-bold text-gray-800">${{ number_format($deliveryCost, 2) }}</span>
                    </div>
                    @if($discount > 0)
                    <div class="flex justify-between py-3 border-b border-gray-200 text-green-600">
                        <span class="font-bold text-gray-700">Discount</span>
                        <span class="font-bold text-green-600">-${{ number_format($discount, 2) }}</span>
                    </div>
                    @else
                    <div class="flex justify-between py-3 border-b border-gray-200">
                        <span class="font-bold text-gray-700">Discount</span>
                        <span class="font-bold text-gray-800">-$0.00</span>
                    </div>
                    @endif
                    <div class="flex justify-between py-4">
                        <span class="font-black text-xl text-gray-800">Total Paid</span>
                        <span class="font-black text-xl text-primary-600">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status Badge -->
        <div class="mb-8">
            <h3 class="font-bold text-gray-800 mb-3">Order Status</h3>
            @php
                $statusColors = [
                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'preparing' => 'bg-purple-100 text-purple-700 border-purple-200',
                    'shipped' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                    'out_for_delivery' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                    'arrived' => 'bg-teal-100 text-teal-700 border-teal-200',
                    'delivered' => 'bg-green-100 text-green-700 border-green-200',
                    'cancelled' => 'bg-red-100 text-red-700 border-red-200',
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
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold border {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200' }}">
                <span>{{ $statusIcons[$order->status] ?? '📦' }}</span>
                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-200 pt-8 mt-8 text-center">
            <p class="text-gray-500 text-sm">Thank you for shopping with FreshMart!</p>
            <p class="text-gray-400 text-xs mt-2">For any inquiries, please contact us at admin@freshmart.com or call +855 12 345 678</p>
        </div>

        <!-- Print Button (hidden when printing) -->
        <div class="no-print border-t border-gray-200 pt-6 mt-6 flex justify-center gap-4">
            <button onclick="window.print()" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-primary-500/30 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print Invoice
            </button>
            <a href="{{ route('customer.profile') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-8 rounded-xl transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Orders
            </a>
        </div>

    </div>
</body>
</html>
