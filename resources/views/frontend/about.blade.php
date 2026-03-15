@extends('frontend.layouts.app')

@section('title', __('messages.about_us') . ' - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-16">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-black mb-4">{{ __('messages.fresh_food_delivered') }}</h1>
        <p class="text-lg text-green-100 max-w-2xl mx-auto">{{ __('messages.about_freshmart_description') }}</p>
    </div>
</div>

<!-- Our Story Section -->
<div class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.our_story') }}</h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
                {{ __('messages.our_story_paragraph1') }}
            </p>
            <p class="text-gray-600 leading-relaxed">
                {{ __('messages.our_story_paragraph2') }}
            </p>
        </div>
        <div class="bg-gradient-to-br from-primary-50 to-emerald-50 rounded-2xl h-80 flex items-center justify-center overflow-hidden shadow-sm border border-gray-100">
            <div class="text-6xl flex gap-4">
                <span>🛒</span>
                <span>🍎</span>
                <span>🥕</span>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Grid -->
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('messages.why_choose_freshmart') }}</h2>
        <p class="text-gray-600">{{ __('messages.we_are_committed_to_providing_the_best_shopping_experience') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                🌱
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">{{ __('messages.100_organic') }}</h3>
            <p class="text-gray-600 text-sm text-center">{{ __('messages.organic_description') }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                ⚡
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">{{ __('messages.lightning_fast') }}</h3>
            <p class="text-gray-600 text-sm text-center">{{ __('messages.fast_delivery_description') }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                💚
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">{{ __('messages.locally_loved') }}</h3>
            <p class="text-gray-600 text-sm text-center">{{ __('messages.locally_loved_description') }}</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="mt-16 bg-gradient-to-r from-primary-50 to-emerald-50 rounded-2xl p-8 border border-primary-100">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">500+</div>
                <div class="text-gray-600 text-sm">{{ __('messages.fresh_products') }}</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">1000+</div>
                <div class="text-gray-600 text-sm">{{ __('messages.happy_customers') }}</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">50+</div>
                <div class="text-gray-600 text-sm">{{ __('messages.local_farmers') }}</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">24/7</div>
                <div class="text-gray-600 text-sm">{{ __('messages.customer_support') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
