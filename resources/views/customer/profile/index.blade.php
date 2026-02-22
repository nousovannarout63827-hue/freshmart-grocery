@extends('customer.profile.layout')

@section('title', 'My Account - FreshMart')

@section('profile-content')
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $completedOrders }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Spent</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalSpent, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Section -->
    <div id="orders" class="bg-white rounded-2xl border border-gray-100 p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Recent Orders</h2>
            <a href="#" class="text-primary-600 hover:text-primary-700 font-medium text-sm">View All</a>
        </div>
        
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Order #</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Total</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-4 px-4">
                                    <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                                </td>
                                <td class="py-4 px-4 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'confirmed' => 'bg-blue-100 text-blue-700',
                                            'preparing' => 'bg-purple-100 text-purple-700',
                                            'shipped' => 'bg-indigo-100 text-indigo-700',
                                            'out_for_delivery' => 'bg-cyan-100 text-cyan-700',
                                            'delivered' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Pending',
                                            'confirmed' => 'Confirmed',
                                            'preparing' => 'Preparing',
                                            'shipped' => 'Shipped',
                                            'out_for_delivery' => 'Out for Delivery',
                                            'delivered' => 'Delivered',
                                            'cancelled' => 'Cancelled',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('customer.order.details', $order->id) }}"
                                           class="text-primary-600 hover:text-primary-700 font-medium text-sm flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View Details
                                        </a>
                                        @if($order->status !== 'cancelled')
                                            <a href="{{ route('customer.order.invoice', $order->id) }}"
                                               class="text-green-600 hover:text-green-700 font-medium text-sm flex items-center gap-1"
                                               target="_blank">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Invoice
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No orders yet</h3>
                <p class="text-gray-600 mb-6">Start shopping to see your orders here!</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-primary-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-700 transition">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>

    <!-- Profile Settings Section -->
    <div id="profile" class="grid md:grid-cols-2 gap-8">
        <!-- Profile Information -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Profile Information</h2>

            <!-- Profile Photo Upload -->
            <div class="mb-6 pb-6 border-b border-gray-100">
                <label class="block text-sm font-medium text-gray-700 mb-3">Profile Photo</label>
                <div class="flex items-center gap-4">
                    @if($user->avatar)
                        <img id="current-photo" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                    @else
                        <div id="current-photo" class="w-20 h-20 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <form action="{{ route('customer.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                            @csrf
                            <input type="file" name="photo" id="photo-input" accept="image/*" class="hidden" onchange="this.form.submit()">
                            <label for="photo-input" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 cursor-pointer transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                </svg>
                                Upload Photo
                            </label>
                        </form>
                        @if($user->avatar)
                            <p class="text-xs text-gray-500 mt-2">Click to change photo</p>
                        @endif
                    </div>
                </div>
            </div>

            <form action="{{ route('customer.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone_number) }}" 
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="current_address" rows="3" 
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">{{ old('current_address', $user->current_address) }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-600 text-white py-3 rounded-xl font-semibold hover:bg-primary-700 transition">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Change Password</h2>
            
            <form action="{{ route('customer.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" required 
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" required minlength="8"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required minlength="8"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-600 text-white py-3 rounded-xl font-semibold hover:bg-primary-700 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
