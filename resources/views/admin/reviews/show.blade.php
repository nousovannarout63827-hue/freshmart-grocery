@extends('layouts.admin')

@section('title', 'Review Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.reviews.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Review Details</h2>
                </div>
                <p class="text-gray-500 text-sm ml-12">View and moderate customer review</p>
            </div>
            <div class="flex gap-2">
                @if(!$review->is_banned)
                    @if(!$review->is_approved)
                        <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-semibold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('admin.reviews.flag', $review->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700 transition font-semibold text-sm {{ $review->is_flagged ? 'ring-2 ring-yellow-300' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                            </svg>
                            {{ $review->is_flagged ? 'Flagged' : 'Flag' }}
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.reviews.unban', $review->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-semibold text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Unban
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Review Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <a href="{{ route('admin.customers.show', $review->user_id) }}" class="flex items-center gap-3 hover:bg-gray-50 rounded-xl p-2 -ml-2 transition">
                        @if($review->user && $review->user->avatar)
                            <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name ?? 'Customer' }}" class="w-12 h-12 rounded-full object-cover cursor-pointer hover:scale-110 transition-transform">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white font-bold text-lg cursor-pointer hover:scale-110 transition-transform">
                                {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-gray-900 hover:text-primary-600 transition">{{ $review->user->name ?? 'Deleted User' }}</h3>
                            <p class="text-xs text-gray-500">{{ $review->created_at->format('F d, Y') }} • {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-0.5 text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'fill-current' : 'fill-gray-200 text-gray-200' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        @if($review->is_banned)
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Banned</span>
                        @elseif($review->is_flagged)
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Flagged</span>
                        @elseif($review->is_approved)
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Published</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-full">Pending</span>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if($review->comment)
                        <p class="text-gray-900 text-base leading-relaxed mb-6">{{ $review->comment }}</p>
                    @else
                        <p class="text-gray-400 italic mb-6">No comment provided</p>
                    @endif

                    @if($review->images && count($review->images) > 0)
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Customer Photos</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($review->images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Review photo" class="w-full aspect-square object-cover rounded-xl cursor-pointer hover:opacity-90 transition shadow-sm" onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($review->ban_reason)
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-red-900 mb-1">Ban Reason</h4>
                                    <p class="text-sm text-red-700 mb-2">{{ $review->ban_reason }}</p>
                                    <p class="text-xs text-red-600">
                                        <strong>Banned by:</strong> {{ $review->moderator->name ?? 'Unknown' }} • 
                                        <strong>Date:</strong> {{ $review->banned_at ? $review->banned_at->format('M d, Y H:i') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Product Details
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-32 h-32 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            @if($review->product->image)
                                <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <span class="text-4xl">🥬</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900 text-lg mb-2">{{ $review->product->name }}</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Category:</span>
                                    <span class="font-medium text-gray-900">{{ $review->product->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Price:</span>
                                    <span class="font-bold text-primary-600">${{ number_format($review->product->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Stock:</span>
                                    <span class="font-medium {{ $review->product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $review->product->stock > 0 ? $review->product->stock . ' units available' : 'Out of Stock' }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('product.show', $review->product->slug) }}" target="_blank" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition font-semibold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                View Product Page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Customer
                    </h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('admin.customers.show', $review->user_id) }}" class="block text-center mb-4 group">
                        @if($review->user && $review->user->avatar)
                            <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name ?? 'Customer' }}" class="w-20 h-20 rounded-full object-cover mx-auto mb-3 group-hover:scale-110 transition-transform cursor-pointer shadow-lg">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white font-bold text-2xl mx-auto mb-3 group-hover:scale-110 transition-transform cursor-pointer shadow-lg">
                                {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                            </div>
                        @endif
                        <h4 class="font-bold text-gray-900 group-hover:text-primary-600 transition">{{ $review->user->name ?? 'Deleted User' }}</h4>
                        <p class="text-sm text-gray-500">{{ Str::limit($review->user->email ?? 'N/A', 30) }}</p>
                    </a>
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-xs text-gray-500 mb-1">Total Reviews</p>
                            <p class="text-xl font-bold text-gray-900">{{ $review->user->reviews()->count() ?? 0 }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-xs text-gray-500 mb-1">Avg Rating</p>
                            <p class="text-xl font-bold text-gray-900">{{ round($review->user->reviews()->avg('rating') ?? 0, 1) }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.customers.show', $review->user_id) }}" class="block w-full px-4 py-2 bg-primary-50 text-primary-700 rounded-xl hover:bg-primary-100 transition font-semibold text-sm text-center">
                        View Customer Profile
                    </a>
                </div>
            </div>

            <!-- Review Stats -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Statistics
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500">Helpful Votes</span>
                            <span class="text-lg font-bold text-gray-900">{{ $review->helpful_count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full transition-all" style="width: {{ min(100, $review->helpful_count * 5) }}%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                        <span class="text-sm text-gray-500">Verified Purchase</span>
                        @if($review->order_id)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Yes</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-full">No</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                        <span class="text-sm text-gray-500">Review Age</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-2xl shadow-sm border border-red-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-red-200 bg-red-50">
                    <h3 class="font-bold text-red-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Danger Zone
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    @if(!$review->is_banned)
                        <button onclick="document.getElementById('banModal').classList.remove('hidden')" class="w-full px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-semibold text-sm">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Ban Review
                        </button>
                    @endif
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-white border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 transition font-semibold text-sm">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ban Modal -->
@if(!$review->is_banned)
<div id="banModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <form action="{{ route('admin.reviews.ban', $review->id) }}" method="POST">
            @csrf
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Ban Review</h3>
                    <p class="text-sm text-gray-500">This will hide the review from public view</p>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ban Reason <span class="text-red-500">*</span></label>
                <textarea name="ban_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500" required placeholder="Explain why this review is being banned..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('banModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-semibold">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-semibold">Ban Review</button>
            </div>
        </form>
    </div>
</div>
@endif

@push('scripts')
<script>
    function openImageModal(imageSrc) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4';
        modal.style.backdropFilter = 'blur(4px)';
        modal.innerHTML = `
            <div class="relative max-w-5xl max-h-full">
                <img src="${imageSrc}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
                <button onclick="this.closest('.fixed').remove()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(modal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }
</script>
@endpush
@endsection
