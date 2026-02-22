@extends('frontend.layouts.app')

@section('title', 'About Us - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-16">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-black mb-4">Fresh Food, Delivered.</h1>
        <p class="text-lg text-green-100 max-w-2xl mx-auto">FreshMart is your neighborhood's premier destination for organic, locally sourced groceries. We believe in bringing the farm directly to your front door.</p>
    </div>
</div>

<!-- Our Story Section -->
<div class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Story</h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
                Founded with a passion for healthy living, FreshMart started as a small local stand and has grown into a full-service digital grocery platform. We carefully select every apple, potato, and bundle of greens to ensure you only get the highest quality produce.
            </p>
            <p class="text-gray-600 leading-relaxed">
                By cutting out the middleman, we guarantee fresher food, better prices, and a more sustainable local economy. Welcome to the future of grocery shopping.
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
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Why Choose FreshMart?</h2>
        <p class="text-gray-600">We're committed to providing the best grocery experience</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                🌱
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">100% Organic</h3>
            <p class="text-gray-600 text-sm text-center">We strictly partner with certified organic farmers to bring you pesticide-free food.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                ⚡
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Lightning Fast</h3>
            <p class="text-gray-600 text-sm text-center">Choose our Fast Delivery option to get your groceries from our store to your kitchen in just 2 hours.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg shadow-primary-500/30">
                💚
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Locally Loved</h3>
            <p class="text-gray-600 text-sm text-center">Proudly serving the community with top-tier customer service and support.</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="mt-16 bg-gradient-to-r from-primary-50 to-emerald-50 rounded-2xl p-8 border border-primary-100">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">500+</div>
                <div class="text-gray-600 text-sm">Fresh Products</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">1000+</div>
                <div class="text-gray-600 text-sm">Happy Customers</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">50+</div>
                <div class="text-gray-600 text-sm">Local Farmers</div>
            </div>
            <div>
                <div class="text-4xl font-black text-primary-600 mb-2">24/7</div>
                <div class="text-gray-600 text-sm">Customer Support</div>
            </div>
        </div>
    </div>
</div>
@endsection
