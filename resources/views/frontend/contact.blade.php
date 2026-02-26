@extends('frontend.layouts.app')

@section('title', 'Contact Us - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-black mb-2">Contact Us</h1>
        <p class="text-green-100 text-lg">Have a question about your order? We are here to help.</p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <!-- Contact Form -->
        <div class="bg-white border border-gray-100 rounded-2xl p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition @error('first_name') border-red-500 @enderror"
                               placeholder="John">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition @error('last_name') border-red-500 @enderror"
                               placeholder="Doe">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition @error('email') border-red-500 @enderror"
                           placeholder="john@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition @error('phone') border-red-500 @enderror"
                           placeholder="+855 12 345 678">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Message <span class="text-red-500">*</span></label>
                    <textarea name="message" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 outline-none transition resize-y @error('message') border-red-500 @enderror"
                              placeholder="How can we help you?">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold py-4 px-6 rounded-xl transition shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:from-primary-700 hover:to-primary-800 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Send Message
                </button>
            </form>
        </div>

        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in touch</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Whether you are looking for a specific exotic fruit, or need help with a recent delivery, our support team is available 7 days a week to assist you.
            </p>

            <div class="space-y-6 mb-8">
                <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shrink-0 shadow-lg shadow-primary-500/30">
                        📍
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Store Location</h4>
                        <p class="text-gray-600 mt-1">123 Fresh Blvd, Khan Daun Penh<br>Phnom Penh, Cambodia</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shrink-0 shadow-lg shadow-primary-500/30">
                        📞
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Phone Number</h4>
                        <p class="text-gray-600 mt-1">+855 12 345 678</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shrink-0 shadow-lg shadow-primary-500/30">
                        ✉️
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Email Address</h4>
                        <p class="text-gray-600 mt-1">support@freshmart.com</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl shrink-0 shadow-lg shadow-primary-500/30">
                        🕒
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Business Hours</h4>
                        <p class="text-gray-600 mt-1">Monday - Sunday: 8:00 AM - 10:00 PM<br>Delivery: 24/7 Available</p>
                    </div>
                </div>
            </div>

            <!-- Interactive Google Map -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Find us on the map</h2>

                <div class="w-full h-96 bg-gray-200 rounded-2xl overflow-hidden border border-gray-200 shadow-sm relative">
                    <iframe
                        width="100%"
                        height="100%"
                        frameborder="0"
                        scrolling="no"
                        marginheight="0"
                        marginwidth="0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.526994603026!2d104.9282!3d11.5621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095538e9e5760d%3A0x123456789abcdef!2sKhan%20Daun%20Penh%2C%20Phnom%20Penh!5e0!3m2!1sen!2skh!4v1234567890"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="FreshMart Location Map">
                    </iframe>
                </div>

                <p class="text-center text-gray-500 text-sm mt-4">
                    📍 123 Fresh Blvd, Khan Daun Penh, Phnom Penh, Cambodia
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
