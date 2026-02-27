@extends('layouts.admin')

@section('title', 'Review Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                        <span>Review Management</span>
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Moderate and manage customer reviews</p>
                </div>
                <a href="{{ route('admin.reviews.statistics') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-pink-50 text-pink-600 rounded-xl hover:bg-pink-100 transition font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="hidden sm:inline">Statistics</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Reviews -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Reviews</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Approved</p>
                    <p class="text-2xl sm:text-3xl font-bold text-green-600">{{ $stats['approved'] }}</p>
                </div>
            </div>
        </div>

        <!-- Flagged -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Flagged</p>
                    <p class="text-2xl sm:text-3xl font-bold text-yellow-600">{{ $stats['flagged'] }}</p>
                </div>
            </div>
        </div>

        <!-- Banned -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Banned</p>
                    <p class="text-2xl sm:text-3xl font-bold text-red-600">{{ $stats['banned'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filters
            </h3>
            @if(request()->anyFilled(['status', 'search', 'rating', 'sort']))
                <a href="{{ route('admin.reviews.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Clear All
                </a>
            @endif
        </div>
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="grid grid-cols-2 md:grid-cols-6 gap-3">
            <div class="col-span-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="flagged" {{ $status == 'flagged' ? 'selected' : '' }}>Flagged</option>
                    <option value="banned" {{ $status == 'banned' ? 'selected' : '' }}>Banned</option>
                </select>
            </div>
            <div class="col-span-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                <input type="text" name="search" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" placeholder="Search..." value="{{ $search }}">
            </div>
            <div class="col-span-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Rating</label>
                <select name="rating" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                    <option value="">All</option>
                    <option value="5" {{ $rating == '5' ? 'selected' : '' }}>5★</option>
                    <option value="4" {{ $rating == '4' ? 'selected' : '' }}>4★</option>
                    <option value="3" {{ $rating == '3' ? 'selected' : '' }}>3★</option>
                    <option value="2" {{ $rating == '2' ? 'selected' : '' }}>2★</option>
                    <option value="1" {{ $rating == '1' ? 'selected' : '' }}>1★</option>
                </select>
            </div>
            <div class="col-span-2 md:col-span-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Sort By</label>
                <select name="sort" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                    <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="rating_high" {{ $sortBy == 'rating_high' ? 'selected' : '' }}>Highest</option>
                    <option value="rating_low" {{ $sortBy == 'rating_low' ? 'selected' : '' }}>Lowest</option>
                    <option value="helpful" {{ $sortBy == 'helpful' ? 'selected' : '' }}>Most Helpful</option>
                    <option value="flagged" {{ $sortBy == 'flagged' ? 'selected' : '' }}>Flagged</option>
                </select>
            </div>
            <div class="col-span-1 flex items-end">
                <button type="submit" class="w-full py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition font-semibold text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Reviews Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                Customer Reviews
            </h3>
            <span class="px-3 py-1 bg-primary-600 text-white text-xs font-bold rounded-full">{{ $reviews->total() }} reviews</span>
        </div>

        @if($reviews->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Review</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Helpful</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($reviews as $review)
                            <tr class="hover:bg-gray-50 transition {{ $review->is_banned ? 'bg-red-50' : ($review->is_flagged ? 'bg-yellow-50' : '') }}">
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="text-sm text-gray-900 truncate">{{ $review->comment ?? '<span class="text-gray-400 italic">No comment</span>' }}</p>
                                    @if($review->images && count($review->images) > 0)
                                        <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ count($review->images) }}
                                        </span>
                                    @endif
                                    @if($review->ban_reason)
                                        <p class="text-xs text-red-600 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            {{ Str::limit($review->ban_reason, 25) }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('product.show', $review->product->slug) }}" target="_blank" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                                        {{ Str::limit($review->product->translated_name, 25) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ Str::limit($review->user->name ?? 'Deleted', 20) }}</p>
                                        <p class="text-xs text-gray-500">{{ Str::limit($review->user->email ?? 'N/A', 20) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-0.5 text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'fill-gray-300 text-gray-300' }}" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($review->is_banned)
                                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-md">Banned</span>
                                    @elseif($review->is_flagged)
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-md">Flagged</span>
                                    @elseif($review->is_approved)
                                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md">Approved</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-md">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-md">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        {{ $review->helpful_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900">{{ $review->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        @if(!$review->is_banned)
                                            @if(!$review->is_approved)
                                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition" title="Approve">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.reviews.flag', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition {{ $review->is_flagged ? 'ring-2 ring-yellow-600 bg-yellow-200' : '' }}" title="{{ $review->is_flagged ? 'Unflag' : 'Flag' }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button onclick="openBanModal('{{ $review->id }}')" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Ban">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </button>
                                        @else
                                            <form action="{{ route('admin.reviews.unban', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition" title="Unban">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.reviews.show', $review->id) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Ban Modal -->
                            @if(!$review->is_banned)
                            <div id="banModal{{ $review->id }}" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 transition-opacity">
                                <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden transform transition-all">
                                    
                                    <div class="bg-red-50 px-6 py-4 border-b border-red-100 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-red-700 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Ban Review
                                        </h3>
                                        <button onclick="closeBanModal('{{ $review->id }}')" class="text-red-400 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <form action="{{ route('admin.reviews.ban', $review->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        
                                        <div class="px-6 py-6">
                                            <div class="flex items-start gap-3 mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                                <div class="flex items-center h-5">
                                                    <input id="hide_review_{{ $review->id }}" type="checkbox" checked disabled class="w-4 h-4 text-red-600 bg-slate-200 border-slate-300 rounded">
                                                </div>
                                                <div class="text-sm">
                                                    <label for="hide_review_{{ $review->id }}" class="font-medium text-slate-800">Hide from public view</label>
                                                    <p class="text-slate-500 mt-0.5">This will immediately remove the review from the FreshMart shop.</p>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                    Ban Reason <span class="text-red-500">*</span>
                                                </label>
                                                <textarea 
                                                    name="ban_reason" 
                                                    rows="4" 
                                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-red-500 focus:border-red-500 bg-slate-50 focus:bg-white transition-colors text-sm"
                                                    placeholder="Explain why this review is being banned (e.g., inappropriate language, spam, fake review)..."
                                                    required
                                                ></textarea>
                                            </div>
                                        </div>

                                        <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex justify-end gap-3">
                                            <button type="button" onclick="closeBanModal('{{ $review->id }}')" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm transition-colors">
                                                Ban Review
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($reviews as $review)
                    <div class="p-4 {{ $review->is_banned ? 'bg-red-50' : ($review->is_flagged ? 'bg-yellow-50' : '') }}">
                        <div class="flex items-start gap-2 mb-3">
                            @if($review->is_banned)
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-md">Banned</span>
                            @elseif($review->is_flagged)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-md">Flagged</span>
                            @elseif($review->is_approved)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md">Approved</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-md">Pending</span>
                            @endif
                            <div class="flex items-center gap-0.5 text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'fill-gray-300 text-gray-300' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-900 mb-3 line-clamp-2">{{ $review->comment ?? 'No comment' }}</p>
                        <div class="space-y-1 text-xs text-gray-600 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span>{{ Str::limit($review->product->translated_name, 30) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ Str::limit($review->user->name ?? 'Deleted', 25) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span>{{ $review->helpful_count }} helpful</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @if(!$review->is_banned)
                                @if(!$review->is_approved)
                                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-3 py-2 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 transition">
                                            Approve
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.reviews.flag', $review->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-xl hover:bg-yellow-700 transition">
                                        {{ $review->is_flagged ? 'Unflag' : 'Flag' }}
                                    </button>
                                </form>
                                <a href="{{ route('admin.reviews.show', $review->id) }}" class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition text-center">
                                    View
                                </a>
                            @else
                                <form action="{{ route('admin.reviews.unban', $review->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 transition">
                                        Unban
                                    </button>
                                </form>
                            @endif
                            <button onclick="document.getElementById('banModalMobile{{ $review->id }}').classList.remove('hidden')" class="px-3 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Ban Modal -->
                    @if(!$review->is_banned)
                    <div id="banModalMobile{{ $review->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-2xl max-w-md w-full p-6">
                            <form action="{{ route('admin.reviews.ban', $review->id) }}" method="POST">
                                @csrf
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Ban Review</h3>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ban Reason</label>
                                    <textarea name="ban_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500" required></textarea>
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" onclick="document.getElementById('banModalMobile{{ $review->id }}').classList.add('hidden')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-semibold">Cancel</button>
                                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-semibold">Ban</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100">
                {{ $reviews->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No reviews found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your filters</p>
                <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Clear Filters
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    // Ban Modal Functions
    function openBanModal(reviewId) {
        const modal = document.getElementById('banModal' + reviewId);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeBanModal(reviewId) {
        const modal = document.getElementById('banModal' + reviewId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Close modal when clicking outside (on the backdrop)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            const modal = event.target;
            modal.classList.add('hidden');
        }
    });
</script>
@endsection
