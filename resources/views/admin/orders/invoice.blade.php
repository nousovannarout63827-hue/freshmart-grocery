<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }} - FreshMart</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <style>
        /* 🖨️ STRICT PRINT RULES TO FIX THE LAYOUT & SHOW THE LOGO */
        @media print {
            .no-print { display: none !important; }
            body { 
                background-color: white !important; 
                margin: 0 !important; 
                padding: 0 !important;
                /* This line forces Chrome/Edge to print the green boxes and logo! */
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important;
            }
            .invoice-container { 
                box-shadow: none !important; 
                border: none !important; 
                margin: 0 !important; 
                padding: 10px !important; 
                width: 100% !important; 
                max-width: 100% !important; 
            }
            /* Prevent the page from cutting elements in half */
            .avoid-break { page-break-inside: avoid !important; break-inside: avoid !important; }
            
            /* Force exact background colors on print */
            .bg-green-50 { background-color: #f0fdf4 !important; }
            .bg-green-600 { background-color: #16a34a !important; }
            .bg-slate-50 { background-color: #f8fafc !important; }
            .text-green-600 { color: #16a34a !important; }
        }
    </style>
</head>
<body class="bg-slate-50 p-6 md:p-10 font-sans text-slate-800">

    <div class="max-w-4xl mx-auto mb-6 no-print">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-green-600 hover:text-green-700 font-bold flex items-center gap-2 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Back to My Orders
        </a>
    </div>

    <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-2xl shadow-sm p-8 md:p-10 invoice-container">
        
        <div class="flex justify-between items-start mb-10 avoid-break">
            <div class="flex items-center gap-3">
                <div class="bg-green-600 p-2.5 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-green-600 leading-none mb-1">FreshMart</h1>
                    <p class="text-slate-500 text-xs font-medium">Grocery & Fresh Produce</p>
                </div>
            </div>
            <div class="text-right text-sm">
                <h2 class="text-2xl font-black text-slate-800 tracking-wide mb-3">INVOICE</h2>
                <p class="text-slate-500 mb-1">Order No: <span class="font-bold text-slate-800">#{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-slate-500 mb-1">Date: <span class="font-bold text-slate-800">{{ $order->created_at->format('M d, Y') }}</span></p>
                <p class="text-slate-500">Time: <span class="font-bold text-slate-800">{{ $order->created_at->format('h:i A') }}</span></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10 avoid-break">
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <h3 class="font-bold text-green-600 mb-4 flex items-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                    Invoice To:
                </h3>
                <p class="font-bold text-slate-800 text-lg mb-1">{{ $order->customer->name ?? 'Customer' }}</p>
                <p class="text-slate-500 text-sm mb-3">{{ $order->customer->email ?? 'N/A' }}</p>
                <p class="text-slate-500 text-sm flex items-center gap-2 mb-2">
                    <span class="text-pink-600">📞</span> {{ $order->phone ?? 'N/A' }}
                </p>
                <p class="text-slate-500 text-sm flex items-start gap-2">
                    <span class="text-slate-400">📍</span> {{ $order->delivery_address ?? $order->address ?? 'N/A' }}
                </p>
            </div>

            <div class="bg-green-50 border border-green-100 rounded-xl p-6 text-right">
                <h3 class="font-bold text-green-600 mb-4 flex items-center justify-end gap-2 text-sm">
                    Invoice From: 🏢
                </h3>
                <p class="font-bold text-slate-800 text-lg mb-1">FreshMart Grocery</p>
                <p class="text-slate-500 text-sm mb-3">admin@freshmart.com</p>
                <p class="text-slate-500 text-sm flex items-center justify-end gap-2 mb-2">
                    <span class="text-pink-600">📞</span> +855 12 345 678
                </p>
                <p class="text-slate-500 text-sm">
                    123 Fresh Blvd, Khan Daun Penh<br>Phnom Penh, Cambodia
                </p>
            </div>
        </div>

        <div class="border border-slate-200 rounded-xl overflow-hidden mb-10 avoid-break">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-5 font-bold text-slate-800">SL</th>
                        <th class="py-3 px-5 font-bold text-slate-800">Product</th>
                        <th class="py-3 px-5 font-bold text-slate-800 text-center">Qty</th>
                        <th class="py-3 px-5 font-bold text-slate-800 text-right">Unit Price</th>
                        <th class="py-3 px-5 font-bold text-slate-800 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($order->orderItems as $index => $item)
                    <tr>
                        <td class="py-4 px-5 text-slate-600">{{ $index + 1 }}</td>
                        <td class="py-4 px-5 font-bold text-slate-800">{{ $item->product->name ?? 'Product' }}</td>
                        <td class="py-4 px-5 text-center text-slate-600">{{ $item->quantity }}</td>
                        <td class="py-4 px-5 text-right text-slate-600">${{ number_format($item->price, 2) }}</td>
                        <td class="py-4 px-5 text-right font-bold text-slate-800">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            $itemTotal = 0;
            foreach($order->orderItems as $item) {
                $itemTotal += ($item->price * $item->quantity);
            }
            $discountValue = 0;
            $deliveryValue = $order->total_amount - $itemTotal + $discountValue;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 avoid-break">
            <div>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mb-6">
                    <h4 class="font-bold text-slate-800 text-sm flex items-center gap-2 mb-3">💳 Payment Method</h4>
                    <p class="font-bold text-slate-800 mb-1 text-sm flex items-center gap-2"><span class="text-green-600 text-lg">💵</span> Cash On Delivery</p>
                    <p class="text-slate-500 text-xs mb-4">Pay when you receive your order</p>
                    
                    <p class="text-xs text-slate-500 mb-2">Payment Status:</p>
                    @php $isPaid = strtolower($order->status) == 'delivered' || ($order->payment_status ?? '') == 'paid'; @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $isPaid ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $isPaid ? 'PAID' : 'UNPAID' }}
                    </span>
                </div>

                <div>
                    <h4 class="font-bold text-slate-800 text-sm mb-3">Order Status</h4>
                    <span class="inline-block bg-green-100 text-green-700 font-bold px-4 py-1.5 rounded-full text-sm">
                        🎉 {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6">
                <div class="flex justify-between items-center text-sm mb-4">
                    <span class="font-bold text-slate-700">Subtotal</span>
                    <span class="font-bold text-slate-800">${{ number_format($itemTotal, 2) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm mb-4">
                    <span class="font-bold text-slate-700">Delivery Cost</span>
                    @if($deliveryValue > 0)
                        <span class="font-bold text-slate-800">${{ number_format($deliveryValue, 2) }}</span>
                    @else
                        <span class="font-bold text-green-600">FREE</span>
                    @endif
                </div>
                <div class="flex justify-between items-center text-sm mb-4 pb-4 border-b border-slate-200">
                    <span class="font-bold text-slate-700">Discount</span>
                    <span class="font-bold text-slate-800">-${{ number_format($discountValue, 2) }}</span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="font-black text-lg text-slate-800">Total Paid</span>
                    <span class="font-black text-xl text-green-600">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-slate-200 text-center avoid-break">
            <p class="font-bold text-slate-600 text-sm mb-1">Thank you for shopping with FreshMart! 🥬🍎</p>
            <p class="text-slate-400 text-xs">For any inquiries, please contact us at admin@freshmart.com or call +855 12 345 678</p>
        </div>

        <div class="mt-10 flex justify-center gap-4 no-print">
            <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-6 rounded-lg transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.243H7.23a1.125 1.125 0 01-1.12-1.243L6.34 18m11.318-6.318A4.486 4.486 0 0012.016 5a4.486 4.486 0 00-4.198 2.307M9.64 8.284a42.412 42.412 0 014.72 0M9.64 8.284a3.96 3.96 0 00-4.574 3.473L4.63 15.52a1.125 1.125 0 001.12 1.243h12.499a1.125 1.125 0 001.12-1.243l-.436-4.763a3.96 3.96 0 00-4.574-3.473L9.64 8.284z" /></svg>
                Print Invoice
            </button>
            <a href="{{ route('admin.orders.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-300 font-bold py-2.5 px-6 rounded-lg transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Back to Orders
            </a>
        </div>

    </div>
</body>
</html>
