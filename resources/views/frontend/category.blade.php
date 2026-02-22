@extends('frontend.layouts.app')

@section('title', $category->name . ' - FreshMart')

@section('content')
    <!-- Category Header -->
    <div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center gap-6">
                @php
                    $icons = [
                        'vegetable' => '🥬',
                        'vegetables' => '🥬',
                        'fruit' => '🍎',
                        'fruits' => '🍎',
                        'dairy' => '🥛',
                        'bakery' => '🍞',
                        'meat' => '🥩',
                        'seafood' => '🐟',
                        'snack' => '🍿',
                        'snacks' => '🍿',
                        'beverage' => '🥤',
                        'beverages' => '🥤',
                        'frozen' => '🧊',
                        'pantry' => '🥫',
                    ];
                    $icon = $icons[strtolower(str_replace(' ', '', explode('-', $category->slug)[0]))] ?? '🛒';
                @endphp
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                    <span class="text-5xl">{{ $icon }}</span>
                </div>
                <div>
                    <h1 class="text-4xl font-bold mb-2">{{ $category->name }}</h1>
                    <p class="text-green-100 text-lg">
                        {{ $category->description ?? 'Browse our selection of fresh ' . strtolower($category->name) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Category Navigation Pills -->
        <div class="flex flex-nowrap overflow-x-auto gap-4 pb-4 mb-8" style="scrollbar-width: none; -ms-overflow-style: none;">
            <a href="{{ route('shop') }}"
               class="shrink-0 px-6 py-3 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold whitespace-nowrap hover:border-green-500 hover:bg-green-50 hover:text-green-600 transition {{ !request('category') ? 'border-green-600 text-green-700 bg-green-50' : 'text-gray-600' }}">
                All Products
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('category.view', $cat->slug) }}"
                   class="shrink-0 px-6 py-3 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold whitespace-nowrap hover:border-green-500 hover:bg-green-50 hover:text-green-600 transition {{ $cat->id == $category->id ? 'border-green-600 text-green-700 bg-green-50' : 'text-gray-600' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        @if($products->count() > 0)
            <!-- Results Header -->
            <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-200">
                <p class="text-gray-600">
                    <span class="font-semibold text-gray-900">{{ $products->total() }}</span> products in {{ $category->name }}
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden group h-full flex flex-col">
                        @if($product->slug)
                        <a href="{{ route('product.show', $product->slug) }}" class="block group">
                        @endif
                            <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @elseif($product->primaryImage)
                                    <img src="{{ asset('storage/' . $product->primaryImage->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary-50 to-primary-100">
                                        🥬
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-3 left-3 flex flex-col gap-2">
                                    @if($product->stock < 10 && $product->stock > 0)
                                        <span class="bg-accent-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-lg">
                                            Low Stock
                                        </span>
                                    @endif
                                    @if($product->created_at->diffInDays(now()) <= 7)
                                        <span class="bg-primary-500 text-white text-xs px-3 py-1 rounded-full font-medium shadow-lg">
                                            New
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-5">
                                <p class="text-xs text-primary-600 font-semibold mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <h3 class="font-semibold text-gray-800 mb-2 truncate group-hover:text-primary-600 transition">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                        <span class="text-sm text-gray-500">/{{ $product->unit ?? 'unit' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-yellow-400">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-sm text-gray-600 font-medium">4.8</span>
                                    </div>
                                </div>
                            </div>
                        @if($product->slug)
                        </a>
                        @endif

                        <div class="px-5 pb-5 mt-auto">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                        class="w-full bg-primary-600 text-white py-3 rounded-xl hover:bg-primary-700 transition font-medium text-sm flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-5xl">📦</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No products in this category</h3>
                <p class="text-gray-600 mb-6">Check back soon for new arrivals!</p>
                <a href="{{ route('shop') }}" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center gap-2">
                    Browse all products
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Custom Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .pagination li { list-style: none; }
    .pagination a, .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .pagination a {
        background: white;
        border: 1px solid #e5e7eb;
        color: #374151;
    }
    .pagination a:hover {
        background: #f0fdf4;
        border-color: #22c55e;
        color: #16a34a;
    }
    .pagination .active span {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }
    .pagination .disabled span {
        background: #f3f4f6;
        color: #9ca3af;
        cursor: not-allowed;
    }
</style>
@endpush
