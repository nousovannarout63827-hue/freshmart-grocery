@extends('frontend.layouts.app')

@section('title', 'My Orders - FreshMart')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12 rounded-3xl mb-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-2">📦 My Order History</h1>
            <p class="text-green-100">Track all your orders and delivery status</p>
        </div>
    </div>

    <!-- Orders List -->
    <div class="space-y-6">
        @forelse($orders as $order)
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Order Number</p>
                    <p class="font-bold text-gray-700 text-lg">#{{ $order->id }}</p>
                </div>
                <div class="flex items-center gap-4">
                    @php
                        $statusConfig = [
                            'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'label' => 'Pending'],
                            'confirmed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'label' => 'Confirmed'],
                            'preparing' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'label' => 'Preparing'],
                            'shipped' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'label' => 'Shipped'],
                            'out_for_delivery' => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-700', 'label' => 'Out for Delivery'],
                            'delivered' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Delivered'],
                            'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Cancelled'],
                        ];
                        $config = $statusConfig[$order->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => ucfirst($order->status)];
                    @endphp
                    <span class="px-4 py-2 rounded-full text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }}">
                        {{ $config['label'] }}
                    </span>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4 mb-4 last:mb-0 pb-4 last:pb-0 border-b border-gray-50 last:border-0">
                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
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
                        <p class="font-semibold text-gray-800">{{ $item->product->name ?? 'Product' }}</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                    </div>
                    <p class="font-bold text-gray-700">${{ number_format($item->total, 2) }}</p>
                </div>
                @endforeach
            </div>

            <!-- Order Footer -->
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Delivery Address</p>
                    <p class="text-gray-700 font-medium">{{ $order->address }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-600 font-medium">Total Amount Paid:</p>
                    <p class="text-2xl font-extrabold text-primary-600">${{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>

            <!-- View Details Button -->
            <div class="px-6 py-4 border-t border-gray-100">
                <a href="{{ route('customer.order.details', $order->id) }}" 
                   class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition">
                    View Order Details
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-gray-200">
            <div class="w-24 h-24 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-5xl">🛒</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No orders yet</h3>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">You haven't placed any orders yet. Start shopping to see your order history here!</p>
            <a href="{{ route('shop') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-full font-semibold hover:from-primary-700 hover:to-primary-800 transition shadow-lg shadow-primary-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Start Shopping
            </a>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
</div>
@endsection
