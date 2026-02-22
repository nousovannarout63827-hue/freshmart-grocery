@extends('frontend.layouts.app')

@section('title', 'My Wishlist - FreshMart')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-red-500 via-pink-500 to-red-600 text-white py-12 rounded-3xl mb-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-2">💚 My Wishlist</h1>
            <p class="text-red-100">Save your favorite items for later</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('info') }}
        </div>
    @endif

    @if($wishlists->count() > 0)
        <!-- Wishlist Stats -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-8 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Items</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCount }}</p>
                </div>
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Wishlist Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlists as $item)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-lg transition group">
                    <!-- Product Image -->
                    <div class="relative aspect-square bg-gray-100 overflow-hidden">
                        @if($item->product && $item->product->image)
                            <a href="{{ route('product.show', $item->product->slug) }}">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </a>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-red-50 to-red-100">
                                💚
                            </div>
                        @endif

                        <!-- Remove Button -->
                        <div class="absolute top-3 right-3">
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition transform hover:scale-110 text-red-500 hover:bg-red-50"
                                        title="Remove from wishlist">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        @if($item->product)
                            <p class="text-xs text-primary-600 font-semibold mb-2">{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                            <h3 class="font-semibold text-gray-800 mb-2 truncate">
                                <a href="{{ route('product.show', $item->product->slug) }}" class="hover:text-primary-600 transition">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xl font-bold text-gray-900">${{ number_format($item->product->price, 2) }}</span>
                                @if($item->product->stock > 0)
                                    <span class="text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded-full">In Stock</span>
                                @else
                                    <span class="text-xs text-red-600 font-medium bg-red-50 px-2 py-1 rounded-full">Out of Stock</span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" 
                                            {{ $item->product->stock <= 0 ? 'disabled' : '' }}
                                            class="w-full bg-primary-600 text-white py-2.5 rounded-xl hover:bg-primary-700 transition font-medium text-sm flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 disabled:bg-gray-300 disabled:cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">This product is no longer available.</p>
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">Remove from wishlist</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-gradient-to-br from-red-50 to-pink-50 rounded-3xl border-2 border-dashed border-red-200">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                <span class="text-5xl">💔</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Your wishlist is empty!</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">Start adding some fresh groceries to save them for later. Click the heart icon on any product to add it to your wishlist.</p>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white px-8 py-4 rounded-full hover:from-primary-700 hover:to-primary-800 transition font-semibold shadow-lg shadow-primary-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Go Shopping
            </a>
        </div>
    @endif
</div>
@endsection
