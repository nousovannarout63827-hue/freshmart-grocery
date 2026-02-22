@extends('frontend.layouts.app')

@section('title', $product->name . ' - FreshMart')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600 transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('shop') }}" class="hover:text-primary-600 transition">Shop</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('category.view', $product->category->slug ?? 'uncategorized') }}" class="hover:text-primary-600 transition">
                {{ $product->category->name ?? 'Uncategorized' }}
            </a>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                <div class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain hover:scale-105 transition duration-500">
                    @elseif($product->primaryImage)
                        <img src="{{ asset('storage/' . $product->primaryImage->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain hover:scale-105 transition duration-500">
                    @else
                        <span class="text-9xl">🥬</span>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <p class="text-primary-600 font-semibold mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $product->category->name ?? 'Uncategorized' }}
                </p>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <!-- Rating -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center gap-1 text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <span class="text-gray-600">(4.8 / 5.0)</span>
                    <span class="text-gray-400">|</span>
                    <span class="text-gray-600">128 reviews</span>
                </div>
                
                <!-- Price & Stock -->
                <div class="flex items-baseline gap-3 mb-6">
                    <span class="text-4xl font-bold text-primary-600">${{ number_format($product->price, 2) }}</span>
                    <span class="text-gray-500 text-lg">/{{ $product->unit ?? 'unit' }}</span>
                </div>

                @if($product->stock > 0)
                    <div class="flex items-center gap-2 mb-6 p-4 bg-green-50 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-green-700 font-medium">In Stock - {{ $product->stock }} units available</span>
                    </div>
                @else
                    <div class="flex items-center gap-2 mb-6 p-4 bg-red-50 rounded-xl">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="text-red-700 font-medium">Out of Stock</span>
                    </div>
                @endif

                <p class="text-gray-600 mb-8 leading-relaxed">
                    {{ $product->description ?? 'Fresh and high-quality product available at FreshMart. Perfect for your daily needs. Sourced from trusted local farms and suppliers.' }}
                </p>

                @if($product->stock > 0)
                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="flex gap-4 mb-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                            <button type="button" onclick="decrementQty()" 
                                    class="px-4 py-4 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="w-20 text-center border-x-2 border-gray-200 py-3 focus:outline-none font-semibold">
                            <button type="button" onclick="incrementQty({{ $product->stock }})" 
                                    class="px-4 py-4 text-gray-600 hover:text-primary-600 hover:bg-gray-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" 
                                class="flex-1 bg-primary-600 text-white px-8 py-4 rounded-xl hover:bg-primary-700 transition font-semibold flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled 
                            class="w-full bg-gray-200 text-gray-500 px-8 py-4 rounded-xl font-semibold cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif

                <!-- Features -->
                <div class="border-t border-gray-200 pt-6 space-y-4">
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span>Fresh & Quality Guaranteed</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span>Same-day Delivery Available</span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <span>Easy Returns & Refunds</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden group h-full flex flex-col">
                            @if($related->slug)
                            <a href="{{ route('product.show', $related->slug) }}" class="block group">
                            @endif
                                <div class="relative aspect-square bg-gray-100 overflow-hidden">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}"
                                             alt="{{ $related->name }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @elseif($related->primaryImage)
                                        <img src="{{ asset('storage/' . $related->primaryImage->image) }}"
                                             alt="{{ $related->name }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary-50 to-primary-100">
                                            🥬
                                        </div>
                                    @endif
                                </div>

                                <div class="p-5">
                                    <p class="text-xs text-primary-600 font-semibold mb-2">{{ $related->category->name ?? 'Uncategorized' }}</p>
                                    <h3 class="font-semibold text-gray-800 mb-2 truncate group-hover:text-primary-600 transition">{{ $related->name }}</h3>
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-xl font-bold text-gray-900">${{ number_format($related->price, 2) }}</span>
                                        <span class="text-sm text-gray-500">/{{ $related->unit ?? 'unit' }}</span>
                                    </div>
                                </div>
                            @if($related->slug)
                            </a>
                            @endif

                            <div class="px-5 pb-5 mt-auto">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $related->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                            class="w-full bg-primary-600 text-white py-3 rounded-xl hover:bg-primary-700 transition font-medium text-sm flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30">
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
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        
        function incrementQty(max) {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
    </script>
    @endpush
@endsection
