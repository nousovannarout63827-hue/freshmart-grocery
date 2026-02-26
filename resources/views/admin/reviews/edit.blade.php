@extends('layouts.admin')

@section('title', 'Edit Review')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reviews.show', $review->id) }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Review</h2>
                <p class="text-gray-500 text-sm">Modify review content and rating</p>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
            <div class="flex items-center gap-2 text-red-800 font-semibold mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Validation Errors
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Review Info -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($review->user->name ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $review->user->name ?? 'Deleted User' }}</h3>
                            <p class="text-sm text-gray-500">{{ $review->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>{{ $review->product->name ?? 'Deleted Product' }}</span>
                    </div>
                </div>

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rating</label>
                    <div class="flex items-center gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" 
                                class="hidden peer" 
                                {{ old('rating', $review->rating) == $i ? 'checked' : '' }} required>
                            <label for="star{{ $i }}" 
                                class="cursor-pointer text-4xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 transition">
                                ★
                            </label>
                        @endfor
                        <span class="ml-2 text-sm font-medium text-gray-600">
                            <span id="rating-text">{{ old('rating', $review->rating) }} out of 5</span>
                        </span>
                    </div>
                </div>

                <!-- Comment -->
                <div>
                    <label for="comment" class="block text-sm font-semibold text-gray-700 mb-3">
                        Review Comment
                    </label>
                    <textarea name="comment" id="comment" rows="6" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition {{ $errors->has('comment') ? 'border-red-500' : '' }}"
                        placeholder="Write the review comment here..." required>{{ old('comment', $review->comment) }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">
                        <span id="char-count">{{ strlen(old('comment', $review->comment)) }}</span>/1000 characters
                    </p>
                </div>

                <!-- Status Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Review Status</p>
                            <p>
                                @if($review->is_banned)
                                    <span class="font-bold text-red-600">Banned</span>
                                @elseif($review->is_flagged)
                                    <span class="font-bold text-yellow-600">Flagged</span>
                                @elseif($review->is_approved)
                                    <span class="font-bold text-green-600">Published</span>
                                @else
                                    <span class="font-bold text-gray-600">Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex gap-3">
                <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.reviews.show', $review->id) }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Rating text update
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('rating-text').textContent = this.value + ' out of 5';
        });
    });

    // Character counter
    const commentField = document.getElementById('comment');
    if (commentField) {
        commentField.addEventListener('input', function() {
            document.getElementById('char-count').textContent = this.value.length;
        });
    }
</script>
@endpush

@endsection
