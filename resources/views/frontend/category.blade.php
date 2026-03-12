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

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
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
