@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-black mb-4">Privacy Policy</h1>
        <p class="text-green-100 text-lg">Last updated: February 2026</p>
    </div>
</div>

<!-- Content -->
<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="prose prose-lg max-w-none">
        
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <p class="text-blue-800 mb-0">
                <strong>🔒 Your Privacy Matters:</strong> At FreshMart, we are committed to protecting your personal information and your right to privacy. This policy explains how we collect, use, and safeguard your data.
            </p>
        </div>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">1</span>
                Information We Collect
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900 mb-3">Personal Information</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Name and Contact Data:</strong> Name, email address, phone number, and delivery address when you create an account or place an order.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Payment Information:</strong> Payment method details (we do not store credit card numbers).</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Account Credentials:</strong> Username and encrypted password.</span>
                    </li>
                </ul>

                <h3 class="font-semibold text-gray-900 mb-3 mt-6">Automatically Collected Information</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Device Information:</strong> IP address, browser type, operating system.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Usage Data:</strong> Pages visited, products viewed, time spent on site.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">•</span>
                        <span><strong>Order History:</strong> Products purchased, order dates, and amounts.</span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">2</span>
                How We Use Your Information
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">🛒</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Process Orders</h3>
                    <p class="text-gray-600 text-sm mb-0">To process and deliver your grocery orders, including payment processing and delivery coordination.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">📧</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Communicate</h3>
                    <p class="text-gray-600 text-sm mb-0">To send order confirmations, delivery updates, and respond to your inquiries.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">🎯</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Improve Service</h3>
                    <p class="text-gray-600 text-sm mb-0">To analyze usage patterns and improve our website, products, and customer experience.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">🔐</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Security</h3>
                    <p class="text-gray-600 text-sm mb-0">To detect and prevent fraud, unauthorized access, and other illegal activities.</p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">3</span>
                Information Sharing
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    We do <strong class="text-primary-600">NOT sell or rent</strong> your personal information to third parties. We only share information in the following cases:
                </p>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs flex-shrink-0 mt-0.5">✓</span>
                        <div><strong>Delivery Partners:</strong> We share your name, address, and phone number with delivery drivers to complete your order.</div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs flex-shrink-0 mt-0.5">✓</span>
                        <div><strong>Payment Processors:</strong> Payment information is processed securely through third-party payment providers.</div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs flex-shrink-0 mt-0.5">✓</span>
                        <div><strong>Legal Requirements:</strong> We may disclose information if required by law or to protect our rights.</div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">4</span>
                Data Security
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <p class="text-gray-700 mb-4">
                    We implement industry-standard security measures to protect your personal information:
                </p>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl mb-2">🔒</div>
                        <strong class="text-gray-900">SSL Encryption</strong>
                        <p class="text-gray-600 text-sm mb-0">All data transmitted is encrypted using SSL technology.</p>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl mb-2">🔐</div>
                        <strong class="text-gray-900">Password Hashing</strong>
                        <p class="text-gray-600 text-sm mb-0">Passwords are encrypted using bcrypt hashing.</p>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-2xl mb-2">🛡️</div>
                        <strong class="text-gray-900">Secure Servers</strong>
                        <p class="text-gray-600 text-sm mb-0">Data is stored on secure, access-controlled servers.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">5</span>
                Your Rights
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">You have the right to:</p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">▸</span>
                        <span>Access your personal information held by us</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">▸</span>
                        <span>Correct inaccurate or incomplete information</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">▸</span>
                        <span>Request deletion of your personal information</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">▸</span>
                        <span>Opt-out of marketing communications</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">▸</span>
                        <span>Export your data in a portable format</span>
                    </li>
                </ul>
                <p class="text-gray-600 mt-4">
                    To exercise these rights, please contact us at <a href="mailto:support@freshmart.com" class="text-primary-600 hover:underline">support@freshmart.com</a>
                </p>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">6</span>
                Cookies
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    We use cookies to enhance your shopping experience. Cookies are small data files stored on your device that help us:
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">•</span>
                        <span>Remember items in your shopping cart</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">•</span>
                        <span>Keep you logged in during your session</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500">•</span>
                        <span>Understand how you use our website</span>
                    </li>
                </ul>
                <p class="text-gray-600 mt-4">
                    For more details, please see our <a href="{{ route('cookies') }}" class="text-primary-600 hover:underline font-semibold">Cookie Policy</a>.
                </p>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">7</span>
                Contact Us
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <p class="text-gray-700 mb-4">
                    If you have any questions about this Privacy Policy or our data practices, please contact us:
                </p>
                <div class="space-y-2 text-gray-600">
                    <p class="mb-0"><strong>📧 Email:</strong> <a href="mailto:support@freshmart.com" class="text-primary-600 hover:underline">support@freshmart.com</a></p>
                    <p class="mb-0"><strong>📞 Phone:</strong> +855 12 345 678</p>
                    <p class="mb-0"><strong>📍 Address:</strong> 123 Fresh Blvd, Khan Daun Penh, Phnom Penh, Cambodia</p>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
