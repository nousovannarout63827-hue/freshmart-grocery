@extends('customer.profile.layout')

@section('title', 'Notifications - FreshMart')

@section('profile-content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Notifications</h1>
                    <p class="text-gray-500 text-sm">Stay updated with your account activity</p>
                </div>
                @if($unreadCount > 0)
                    <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-bold">
                        {{ $unreadCount }} New
                    </span>
                @endif
            </div>
        </div>

        <!-- Notification Tabs -->
        <div class="bg-white rounded-2xl border border-gray-100 mb-6 overflow-hidden">
            <div class="border-b border-gray-100">
                <nav class="flex">
                    <button onclick="filterNotifications('all')" 
                            class="flex-1 px-6 py-4 text-sm font-semibold transition {{ request('filter', 'all') == 'all' ? 'text-primary-600 border-b-2 border-primary-600 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        All
                        @if($notifications->count() > 0)
                            <span class="ml-2 px-2 py-0.5 bg-gray-200 rounded-full text-xs">{{ $notifications->count() }}</span>
                        @endif
                    </button>
                    <button onclick="filterNotifications('unread')" 
                            class="flex-1 px-6 py-4 text-sm font-semibold transition {{ request('filter') == 'unread' ? 'text-primary-600 border-b-2 border-primary-600 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        Unread
                        @if($unreadCount > 0)
                            <span class="ml-2 px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs">{{ $unreadCount }}</span>
                        @endif
                    </button>
                    <button onclick="filterNotifications('read')" 
                            class="flex-1 px-6 py-4 text-sm font-semibold transition {{ request('filter') == 'read' ? 'text-primary-600 border-b-2 border-primary-600 bg-primary-50' : 'text-gray-600 hover:bg-gray-50' }}">
                        Read
                    </button>
                </nav>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="space-y-3">
            @if($notifications->count() > 0)
                @foreach($notifications as $notification)
                    @php
                        $data = $notification->data;
                        $isUnread = $notification->read_at === null;
                        $timeAgo = $notification->created_at->diffForHumans();
                        $notifType = $notification->type;
                    @endphp

                    <div class="notification-item bg-white rounded-2xl border {{ $isUnread ? 'border-blue-200 shadow-md' : 'border-gray-100' }} p-5 transition hover:shadow-lg {{ $isUnread ? 'bg-gradient-to-r from-blue-50 to-white' : '' }}">
                        <div class="flex items-start gap-4">
                            <!-- Icon -->
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 {{ $isUnread ? 'bg-blue-100' : 'bg-gray-100' }}">
                                @if($notifType === 'review_reply')
                                    <svg class="w-6 h-6 {{ $isUnread ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                @elseif($notifType === 'promotion' || $notifType === 'flash_sale')
                                    <svg class="w-6 h-6 {{ $isUnread ? 'text-green-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 {{ $isUnread ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                @endif
                                @if($isUnread)
                                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white"></span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                @if($notifType === 'review_reply')
                                    <h3 class="font-semibold text-gray-900 mb-1">
                                        {{ $data['replier_name'] ?? 'Someone' }} replied to your review
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2">
                                        on <span class="font-medium">{{ $data['product_name'] ?? 'a product' }}</span>
                                    </p>
                                    <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                        <p class="text-gray-700 text-sm italic">"{{ Str::limit($data['reply_comment'] ?? '', 150) }}"</p>
                                    </div>
                                @elseif($notifType === 'promotion' || $notifType === 'flash_sale')
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $data['title'] ?? 'Special Offer!' }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">{{ $data['message'] ?? '' }}</p>
                                    @if(isset($data['coupon_code']))
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-3 mb-3">
                                            <div class="flex items-center justify-between flex-wrap gap-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-2xl">🎫</span>
                                                    <div>
                                                        <p class="text-xs text-green-700 font-medium">Coupon Code</p>
                                                        <p class="text-lg font-bold text-green-800 font-mono">{{ $data['coupon_code'] }}</p>
                                                    </div>
                                                </div>
                                                @if(isset($data['expires_formatted']))
                                                    <div class="text-right">
                                                        <p class="text-xs text-green-700 font-medium">Expires</p>
                                                        <p class="text-sm font-semibold text-green-800">{{ $data['expires_formatted'] }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $data['title'] ?? 'Notification' }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">{{ $data['message'] ?? '' }}</p>
                                @endif

                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">{{ $timeAgo }}</span>
                                    <div class="flex gap-2">
                                        @if($notifType === 'review_reply')
                                            <a href="{{ route('product.show', $data['product_slug'] ?? '#') }}#reviews"
                                               class="px-4 py-2 bg-primary-600 text-white text-sm rounded-lg hover:bg-primary-700 transition font-medium inline-flex items-center gap-1"
                                               onclick="markAsRead('{{ $notification->id }}')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Review
                                            </a>
                                        @endif
                                        @if($isUnread)
                                            <button onclick="markAsRead('{{ $notification->id }}')"
                                                    class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition font-medium">
                                                Mark as Read
                                            </button>
                                        @endif
                                        <button onclick="deleteNotification('{{ $notification->id }}')"
                                                class="px-4 py-2 bg-red-50 text-red-600 text-sm rounded-lg hover:bg-red-100 transition font-medium">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $notifications->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No notifications yet</h3>
                    <p class="text-gray-600">When you receive notifications, they'll appear here</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        @if($notifications->count() > 0)
            <div class="mt-6 bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex flex-wrap gap-3 justify-between items-center">
                    <h3 class="font-bold text-gray-900">Quick Actions</h3>
                    <div class="flex gap-3">
                        @if($unreadCount > 0)
                            <button onclick="markAllAsRead()" 
                                    class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium text-sm inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Mark All as Read
                            </button>
                        @endif
                        <button onclick="if(confirm('Delete all notifications?')) deleteAllNotifications()" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete All
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function filterNotifications(type) {
        const url = new URL(window.location);
        url.searchParams.set('filter', type);
        window.location.href = url.toString();
    }

    function markAsRead(notificationId) {
        fetch(`/customer/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    function markAllAsRead() {
        fetch('/customer/notifications/read-all', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    function deleteNotification(notificationId) {
        if (!confirm('Delete this notification?')) return;
        
        fetch(`/customer/notifications/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    function deleteAllNotifications() {
        fetch('/customer/notifications/delete-all', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
</script>
@endpush
