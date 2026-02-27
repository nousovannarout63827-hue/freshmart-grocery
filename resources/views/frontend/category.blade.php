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
        <div class="flex flex-wrap gap-3 pb-4 mb-8">
            <a href="{{ route('shop') }}"
               class="px-6 py-3 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold whitespace-nowrap hover:border-green-500 hover:bg-green-50 hover:text-green-600 transition {{ !request('category') ? 'border-green-600 text-green-700 bg-green-50' : 'text-gray-600' }}">
                All Products
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('category.view', $cat->slug) }}"
                   class="px-6 py-3 bg-white border-2 border-gray-200 rounded-full text-sm font-semibold whitespace-nowrap hover:border-green-500 hover:bg-green-50 hover:text-green-600 transition {{ $cat->id == $category->id ? 'border-green-600 text-green-700 bg-green-50' : 'text-gray-600' }}">
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
                                @php
                                    $productImageUrl = null;
                                    if ($product->image) {
                                        $productImageUrl = str_contains($product->image, 'products/') || str_contains($product->image, 'storage/')
                                            ? asset('storage/' . $product->image)
                                            : asset('storage/products/' . $product->image);
                                    }
                                @endphp
                                @if($productImageUrl)
                                    <img src="{{ $productImageUrl }}"
                                         alt="{{ $product->translated_name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @elseif($product->primaryImage)
                                    <img src="{{ asset('storage/' . $product->primaryImage->image) }}"
                                         alt="{{ $product->translated_name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl bg-gradient-to-br from-primary-50 to-primary-100">
                                        🥬
                                    </div>
                                @endif

                                <!-- Wishlist Button (Heart Icon) -->
                                <div class="absolute top-3 right-3 z-20">
                                    @auth
                                        @php
                                            $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                                                ->where('product_id', $product->id)
                                                ->exists();
                                        @endphp
                                        <button type="button"
                                                class="wishlist-btn w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-sm hover:shadow-lg transition transform hover:scale-110 {{ $isWishlisted ? 'text-red-500 bg-white' : 'text-gray-400 hover:text-red-500 hover:bg-white' }}"
                                                data-product-id="{{ $product->id }}"
                                                title="{{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                            @if($isWishlisted)
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            @endif
                                        </button>
                                    @else
                                        <a href="{{ route('customer.login') }}"
                                           class="w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-sm hover:shadow-lg transition transform hover:scale-110 text-gray-400 hover:text-red-500 hover:bg-white"
                                           title="Login to add to wishlist">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </a>
                                    @endauth
                                </div>

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
                                <h3 class="font-semibold text-gray-800 mb-2 truncate group-hover:text-primary-600 transition {{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">{{ $product->translated_name }}</h3>
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="text-xl font-bold text-gray-900">
                                            @php
                                                $displayPrice = ($product->price == floor($product->price)) ? '$' . number_format($product->price, 0) : '$' . number_format($product->price, 2);
                                            @endphp
                                            {{ $displayPrice }}
                                        </span>
                                        <span class="text-sm text-gray-500">/{{ Str::limit($product->unit ?? 'unit', 3) }}</span>
                                    </div>
                                    @php
                                        $avgRating = $product->approvedReviews()->avg('rating');
                                        $reviewsCount = $product->approvedReviews()->count();
                                    @endphp
                                    <div class="flex items-center gap-1 text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avgRating ?? 0))
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 fill-gray-300 text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endif
                                        @endfor
                                        @if($reviewsCount > 0)
                                            <span class="text-xs text-gray-500">({{ $reviewsCount }})</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @if($product->slug)
                        </a>
                        @endif

                        <div class="px-5 pb-5 mt-auto">
                            <button type="button"
                                    class="add-to-cart-btn w-full bg-primary-600 text-white py-3 rounded-xl hover:bg-primary-700 transition font-medium text-sm flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->translated_name }}"
                                    data-product-price="{{ $product->price }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Add to Cart
                            </button>
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

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Add to Cart AJAX Functionality
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            const originalText = this.innerHTML;

            // Disable button and show loading state
            this.disabled = true;
            this.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...';

            try {
                const response = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Show SweetAlert2 toast notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        text: `"${productName}" has been added to your cart`,
                        iconColor: '#16a34a',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        color: '#166534'
                    });

                    // Update cart count with animation
                    if (data.cart_count !== undefined) {
                        updateCartCountDisplay(data.cart_count);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Failed to add to cart',
                        iconColor: '#dc2626',
                        confirmButtonColor: '#16a34a'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    iconColor: '#dc2626',
                    confirmButtonColor: '#16a34a'
                });
            } finally {
                // Restore button
                this.disabled = false;
                this.innerHTML = originalText;
            }
        });
    });

    // Update cart count display with animation
    function updateCartCountDisplay(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            // Animate the badge
            el.style.transition = 'all 0.3s ease';
            el.style.transform = 'scale(1.3)';
            setTimeout(() => {
                el.textContent = count;
                el.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // Wishlist AJAX Functionality
    document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const isWishlisted = this.classList.contains('text-red-500');
            
            try {
                const url = isWishlisted 
                    ? '{{ route("wishlist.remove", ":id") }}'.replace(':id', productId)
                    : '{{ route("wishlist.add") }}';
                
                const response = await fetch(url, {
                    method: isWishlisted ? 'POST' : 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: isWishlisted 
                        ? JSON.stringify({ _method: 'DELETE' })
                        : JSON.stringify({ product_id: productId })
                });
                
                const data = await response.json();

                if (data.success) {
                    // Toggle heart icon and show toast
                    if (isWishlisted) {
                        this.classList.remove('text-red-500', 'bg-white');
                        this.classList.add('text-gray-400', 'hover:text-red-500');
                        this.innerHTML = `
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        `;
                        this.title = 'Add to Wishlist';
                        
                        Swal.fire({
                            icon: 'info',
                            title: 'Removed from Wishlist',
                            iconColor: '#2563eb',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            background: '#eff6ff',
                            color: '#1e40af'
                        });
                    } else {
                        this.classList.remove('text-gray-400', 'hover:text-red-500');
                        this.classList.add('text-red-500', 'bg-white');
                        this.innerHTML = `
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        `;
                        this.title = 'Remove from Wishlist';
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Wishlist!',
                            iconColor: '#16a34a',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            background: '#f0fdf4',
                            color: '#166534'
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                // Redirect to login if not authenticated
                if (!{{ auth()->check() ? 'true' : 'false' }}) {
                    window.location.href = '{{ route("customer.login") }}';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update wishlist. Please try again.',
                        iconColor: '#dc2626',
                        confirmButtonColor: '#16a34a'
                    });
                }
            }
        });
    });
</script>
@endpush

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
