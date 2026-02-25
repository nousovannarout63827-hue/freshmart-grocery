@extends('frontend.layouts.app')

@section('title', 'My Reviews - Customer Profile')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">My Reviews</h1>
                <p class="text-gray-600">Manage and view all your product reviews</p>
            </div>
            <a href="{{ route('customer.profile') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Profile
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Reviews</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Published</p>
                    <p class="text-xl font-bold text-green-600">{{ $stats['approved'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Pending</p>
                    <p class="text-xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Banned</p>
                    <p class="text-xl font-bold text-red-600">{{ $stats['banned'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <form action="{{ route('customer.reviews') }}" method="GET" class="flex flex-wrap gap-2">
            <a href="{{ route('customer.reviews') }}" class="px-4 py-2 rounded-xl font-medium transition {{ !request('status') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </a>
            <button type="submit" name="status" value="approved" class="px-4 py-2 rounded-xl font-medium transition {{ request('status') == 'approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Published
            </button>
            <button type="submit" name="status" value="pending" class="px-4 py-2 rounded-xl font-medium transition {{ request('status') == 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Pending
            </button>
            <button type="submit" name="status" value="banned" class="px-4 py-2 rounded-xl font-medium transition {{ request('status') == 'banned' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Banned
            </button>
        </form>
    </div>

    <!-- Reviews List -->
    <div class="space-y-4">
        @forelse($reviews as $review)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 {{ $review->is_banned ? 'opacity-60 border-red-200' : '' }}">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <!-- Product Info -->
                    <div class="flex-1">
                        <div class="flex items-start gap-4">
                            @if($review->product && $review->product->image)
                                <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="w-20 h-20 object-cover rounded-xl">
                            @else
                                <div class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center text-3xl">
                                    🥬
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">
                                    @if($review->product && $review->product->slug)
                                        <a href="{{ route('product.show', $review->product->slug) }}" class="text-primary-600 hover:text-primary-700">
                                            {{ $review->product->name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">Product Unavailable</span>
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">Reviewed on {{ $review->created_at->format('M d, Y') }}</p>
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="flex items-center gap-0.5 text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 fill-gray-300 text-gray-300" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                    @if($review->is_approved && !$review->is_banned)
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded-full">Published</span>
                                    @elseif($review->is_banned)
                                        <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded-full">Banned</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">Pending</span>
                                    @endif
                                </div>
                                @if($review->comment)
                                    <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                                @endif
                                @if($review->images && count($review->images) > 0)
                                    <div class="flex gap-2 mt-3">
                                        @foreach($review->images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Review photo" class="w-16 h-16 object-cover rounded-lg cursor-pointer hover:opacity-90 transition" onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                        @endforeach
                                    </div>
                                @endif
                                @if($review->is_banned && $review->ban_reason)
                                    <div class="mt-3 flex items-start gap-2 bg-red-50 border border-red-200 rounded-lg p-3">
                                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-semibold text-red-900">Ban Reason</p>
                                            <p class="text-sm text-red-700">{{ $review->ban_reason }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col gap-2 lg:w-48">
                        @if($review->is_approved && !$review->is_banned)
                            <button onclick="openEditModal({{ $review->id }}, {{ $review->rating }}, {!! json_encode($review->comment) !!})" class="w-full px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition font-semibold text-sm">
                                Edit Review
                            </button>
                        @endif
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-semibold text-sm">
                                Delete
                            </button>
                        </form>
                        @if($review->is_approved && !$review->is_banned && $review->product && $review->product->slug)
                            <a href="{{ route('product.show', $review->product->slug) }}" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-semibold text-sm text-center">
                                View Product
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-5xl">💬</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No reviews yet</h3>
                <p class="text-gray-600 mb-6">Start sharing your shopping experiences!</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Browse Products
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($reviews->hasPages())
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @endif
</div>

<!-- Edit Review Modal -->
<div id="editReviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Edit Your Review</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editReviewForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                    <div class="flex gap-2" id="editRatingStars">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="edit-star{{ $i }}" class="hidden">
                            <label for="edit-star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 hover:text-yellow-400 transition" onclick="updateEditStars({{ $i }})">★</label>
                        @endfor
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                    <textarea name="comment" id="editComment" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Share your experience..."></textarea>
                </div>
            </div>
            
            <div class="p-6 border-t border-gray-200 flex gap-3">
                <button type="submit" class="flex-1 bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 transition font-semibold">Save Changes</button>
                <button type="button" onclick="closeEditModal()" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition font-semibold text-gray-700">Cancel</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(reviewId, rating, comment) {
        document.getElementById('editReviewForm').action = '/reviews/' + reviewId;
        document.querySelectorAll('#editRatingStars input').forEach(input => input.checked = false);
        document.getElementById('edit-star' + rating).checked = true;
        updateEditStars(rating);
        document.getElementById('editComment').value = comment || '';
        document.getElementById('editReviewModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editReviewModal').classList.add('hidden');
    }

    function updateEditStars(rating) {
        document.querySelectorAll('#editRatingStars label').forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });
    }

    function openImageModal(imageSrc) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4';
        modal.style.backdropFilter = 'blur(4px)';
        modal.innerHTML = `
            <div class="relative max-w-5xl max-h-full">
                <img src="${imageSrc}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
                <button onclick="this.closest('.fixed').remove()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        document.body.appendChild(modal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.remove();
        });
    }
</script>
@endpush
@endsection
