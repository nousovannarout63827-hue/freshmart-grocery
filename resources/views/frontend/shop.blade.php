@extends('frontend.layouts.app')

@section('title', 'Shop - FreshMart')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">Shop All Products</h1>
                <p class="text-green-100 text-lg max-w-2xl mx-auto">Browse our complete selection of fresh, organic groceries</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-72 flex-shrink-0">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filters
                        </h3>
                        @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'rating']))
                            <a href="{{ route('shop') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                Clear All
                            </a>
                        @endif
                    </div>
                    
                    <form action="{{ route('shop') }}" method="GET" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Search..."
                                       class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition appearance-none bg-white">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="w-5 h-5 text-gray-400 absolute right-8 mt-32 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                       placeholder="Min" step="0.01" min="0"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                       placeholder="Max" step="0.01" min="0"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-gray-700">Minimum Rating</label>
                                @if(request('rating'))
                                    <a href="{{ request()->fullUrlWithQuery(['rating' => null]) }}"
                                       class="text-xs text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Clear
                                    </a>
                                @endif
                            </div>
                            <div class="space-y-2">
                                @for($r = 5; $r >= 1; $r--)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="rating" value="{{ $r }}"
                                               {{ request('rating') == $r ? 'checked' : '' }}
                                               class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $r)
                                                    <svg class="w-4 h-4 fill-yellow-400 text-yellow-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @else
                                                    <svg class="w-4 h-4 fill-gray-300 text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endif
                                            @endfor
                                            <span class="text-sm text-gray-600 group-hover:text-gray-900">{!! '&amp;' !!} up</span>
                                        </div>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary-600 text-white py-3 rounded-xl hover:bg-primary-700 transition font-semibold shadow-lg shadow-primary-500/30">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Results Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                    <p class="text-gray-600">
                        <span class="font-semibold text-gray-900">{{ $products->total() }}</span> products found
                    </p>
                    <form action="{{ route('shop') }}" method="GET" class="flex items-center gap-3">
                        <!-- Preserve existing filters -->
                        @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
                        @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                        @if(request('min_price'))<input type="hidden" name="min_price" value="{{ request('min_price') }}">@endif
                        @if(request('max_price'))<input type="hidden" name="max_price" value="{{ request('max_price') }}">@endif
                        @if(request('rating'))<input type="hidden" name="rating" value="{{ request('rating') }}">@endif

                        <label class="text-sm text-gray-600">Sort by:</label>
                        <select name="sort" onchange="this.form.submit()" class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 appearance-none bg-white pr-8 cursor-pointer">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>💰 Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>💰 Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>🔤 Name: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>🔤 Name: Z-A</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>⭐ Top Rated</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </form>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                        @foreach($products as $product)
                            @include('frontend.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links('vendor.pagination.tailwind') }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-5xl">🔍</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your filters or search term</p>
                        <a href="{{ route('shop') }}" class="text-primary-600 font-medium hover:text-primary-700 inline-flex items-center gap-2">
                            Clear all filters
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Custom Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .pagination li {
        list-style: none;
    }
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

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wishlist toggle functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    
    wishlistButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const isWishlisted = this.classList.contains('text-red-500');
            
            try {
                const response = await fetch('{{ route("wishlist.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ product_id: productId })
                });
                
                const result = await response.json();
                
                // Toggle the heart icon
                if (result.status === 'added') {
                    this.classList.remove('text-gray-400');
                    this.classList.add('text-red-500', 'bg-white');
                    this.title = 'Remove from Wishlist';
                    this.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                    
                    // Show success animation
                    this.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                    
                    // Show toast notification
                    showToast('Added to wishlist! 💚', 'success');
                } else {
                    this.classList.remove('text-red-500', 'bg-white');
                    this.classList.add('text-gray-400');
                    this.title = 'Add to Wishlist';
                    this.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>';
                    
                    // Show toast notification
                    showToast('Removed from wishlist.', 'info');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.', 'error');
            }
        });
    });
    
    // Add to Cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            
            // Disable button and show loading state
            const originalText = this.innerHTML;
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
                
                if (response.ok) {
                    const data = await response.json();
                    
                    // Show success animation
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);

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

                    // Update cart count immediately with the count from response
                    if (data.cart_count !== undefined) {
                        updateCartCountDisplay(data.cart_count);
                    } else {
                        // Fallback: fetch the count
                        updateCartCount();
                    }
                } else {
                    const error = await response.json();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: error.message || 'Failed to add to cart',
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

    // Update cart count function
    async function updateCartCount() {
        try {
            const response = await fetch('{{ route("cart.count") }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });
            if (response.ok) {
                const data = await response.json();
                updateCartCountDisplay(data.count);
            }
        } catch (error) {
            console.error('Error fetching cart count:', error);
        }
    }

    // Update cart count display directly
    function updateCartCountDisplay(count) {
        const cartCountElements = document.querySelectorAll('#cart-count, .cart-count');
        console.log('Updating cart count to:', count, 'Found elements:', cartCountElements.length);
        
        if (cartCountElements.length === 0) {
            console.warn('No cart count element found!');
            return;
        }
        
        cartCountElements.forEach(el => {
            // Animate the badge
            el.style.transition = 'all 0.3s ease';
            el.style.transform = 'scale(1.3)';
            setTimeout(() => {
                el.textContent = count;
                el.style.transform = 'scale(1)';
                el.classList.remove('hidden');
            }, 150);
        });
    }

    // Wishlist toast notifications using SweetAlert2
    function showToast(message, type = 'success') {
        const colors = {
            success: { bg: '#f0fdf4', color: '#166534', icon: '#16a34a' },
            error: { bg: '#fef2f2', color: '#991b1b', icon: '#dc2626' },
            info: { bg: '#eff6ff', color: '#1e40af', icon: '#2563eb' }
        };
        const scheme = colors[type] || colors.success;
        
        Swal.fire({
            icon: type,
            title: message,
            iconColor: scheme.icon,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            background: scheme.bg,
            color: scheme.color
        });
    }
});
</script>
@endpush
