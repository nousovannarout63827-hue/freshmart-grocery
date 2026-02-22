@extends('frontend.layouts.app')

@section('title', 'Cookie Policy - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-black mb-4">Cookie Policy</h1>
        <p class="text-green-100 text-lg">Last updated: February 2026</p>
    </div>
</div>

<!-- Content -->
<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="prose prose-lg max-w-none">
        
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <p class="text-blue-800 mb-0">
                <strong>🍪 What Are Cookies:</strong> Cookies are small text files stored on your device (computer, smartphone, or tablet) when you visit our website. They help us provide you with a better shopping experience by remembering your preferences and understanding how you use our site.
            </p>
        </div>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">1</span>
                Types of Cookies We Use
            </h2>
            <div class="space-y-4">
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl flex-shrink-0">🔧</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Essential Cookies (Required)</h3>
                            <p class="text-gray-600 mb-0">These cookies are necessary for the website to function properly. They enable basic functions like page navigation, secure access, and shopping cart functionality.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 ml-16">
                        <strong class="text-gray-900 text-sm">Examples:</strong>
                        <ul class="space-y-1 text-gray-600 text-sm mt-2">
                            <li>• Session cookies (keep you logged in)</li>
                            <li>• Shopping cart cookies (remember items)</li>
                            <li>• Security cookies (CSRF protection)</li>
                            <li>• Load balancing cookies</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl flex-shrink-0">⚙️</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Preference Cookies (Functional)</h3>
                            <p class="text-gray-600 mb-0">These cookies remember your choices and settings to provide enhanced, personalized features.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 ml-16">
                        <strong class="text-gray-900 text-sm">Examples:</strong>
                        <ul class="space-y-1 text-gray-600 text-sm mt-2">
                            <li>• Language preference cookies</li>
                            <li>• Region/location cookies</li>
                            <li>• Font size preferences</li>
                            <li>• Recently viewed products</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl flex-shrink-0">📊</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Analytics Cookies (Performance)</h3>
                            <p class="text-gray-600 mb-0">These cookies help us understand how visitors interact with our website by collecting anonymous information.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 ml-16">
                        <strong class="text-gray-900 text-sm">Examples:</strong>
                        <ul class="space-y-1 text-gray-600 text-sm mt-2">
                            <li>• Page visit counting</li>
                            <li>• Traffic source tracking</li>
                            <li>• Bounce rate analysis</li>
                            <li>• User flow tracking</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-xl flex-shrink-0">🎯</div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Marketing Cookies (Optional)</h3>
                            <p class="text-gray-600 mb-0">These cookies track your browsing habits to deliver relevant advertisements and limit the number of times you see an ad.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 ml-16">
                        <strong class="text-gray-900 text-sm">Examples:</strong>
                        <ul class="space-y-1 text-gray-600 text-sm mt-2">
                            <li>• Ad targeting cookies</li>
                            <li>• Retargeting cookies</li>
                            <li>• Social media cookies</li>
                            <li>• Campaign tracking cookies</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">2</span>
                Cookie Duration
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="py-3 px-4 font-bold text-gray-900">Cookie Type</th>
                                <th class="py-3 px-4 font-bold text-gray-900">Duration</th>
                                <th class="py-3 px-4 font-bold text-gray-900">Description</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 font-medium">Session Cookies</td>
                                <td class="py-3 px-4">Until browser closes</td>
                                <td class="py-3 px-4">Deleted when you close your browser</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 font-medium">Persistent Cookies</td>
                                <td class="py-3 px-4">30 days - 2 years</td>
                                <td class="py-3 px-4">Remain until they expire or you delete them</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4 font-medium">First-Party Cookies</td>
                                <td class="py-3 px-4">Varies</td>
                                <td class="py-3 px-4">Set directly by FreshMart</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 font-medium">Third-Party Cookies</td>
                                <td class="py-3 px-4">Varies by provider</td>
                                <td class="py-3 px-4">Set by our service partners</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">3</span>
                Third-Party Cookies
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <p class="text-gray-700 mb-6">
                    We work with trusted third-party services that may set cookies on your device. These services help us improve our website and provide better service:
                </p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">💳</span>
                            <strong class="text-gray-900">Payment Processors</strong>
                        </div>
                        <p class="text-gray-600 text-sm mb-0">Secure payment processing (Stripe, PayPal, etc.)</p>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">📦</span>
                            <strong class="text-gray-900">Delivery Partners</strong>
                        </div>
                        <p class="text-gray-600 text-sm mb-0">Order tracking and delivery coordination</p>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">📊</span>
                            <strong class="text-gray-900">Analytics</strong>
                        </div>
                        <p class="text-gray-600 text-sm mb-0">Website usage analysis (Google Analytics)</p>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">📧</span>
                            <strong class="text-gray-900">Email Services</strong>
                        </div>
                        <p class="text-gray-600 text-sm mb-0">Email delivery and tracking</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">4</span>
                Managing Your Cookies
            </h2>
            <div class="space-y-4">
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">⚙️</span>
                        Browser Settings
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Most web browsers allow you to control cookies through their settings. Here's how to manage cookies in popular browsers:
                    </p>
                    <div class="grid md:grid-cols-2 gap-3">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="text-2xl">🌐</span>
                            <div>
                                <strong class="text-gray-900 text-sm">Google Chrome</strong>
                                <p class="text-gray-600 text-xs mb-0">Settings → Privacy → Cookies</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="text-2xl">🦊</span>
                            <div>
                                <strong class="text-gray-900 text-sm">Mozilla Firefox</strong>
                                <p class="text-gray-600 text-xs mb-0">Options → Privacy → Cookies</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="text-2xl">🧭</span>
                            <div>
                                <strong class="text-gray-900 text-sm">Safari</strong>
                                <p class="text-gray-600 text-xs mb-0">Preferences → Privacy → Cookies</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <span class="text-2xl">🌊</span>
                            <div>
                                <strong class="text-gray-900 text-sm">Microsoft Edge</strong>
                                <p class="text-gray-600 text-xs mb-0">Settings → Privacy → Cookies</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                    <h3 class="font-semibold text-amber-900 mb-3 flex items-center gap-2">
                        <span class="text-xl">⚠️</span>
                        Important Note
                    </h3>
                    <p class="text-amber-800 mb-0">
                        <strong>Disabling Cookies:</strong> If you choose to disable or delete cookies, some features of FreshMart may not function properly. You may not be able to add items to your cart, complete checkout, or access your account.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">5</span>
                Your Cookie Preferences
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-6">
                    You have the right to choose which cookies you accept. You can:
                </p>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <div class="text-3xl mb-2">✅</div>
                        <strong class="text-gray-900 block mb-2">Accept All</strong>
                        <p class="text-gray-600 text-sm mb-0">Allow all cookies for the best experience</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <div class="text-3xl mb-2">⚙️</div>
                        <strong class="text-gray-900 block mb-2">Customize</strong>
                        <p class="text-gray-600 text-sm mb-0">Choose which cookies to accept</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-xl">
                        <div class="text-3xl mb-2">❌</div>
                        <strong class="text-gray-900 block mb-2">Reject All</strong>
                        <p class="text-gray-600 text-sm mb-0">Only essential cookies will be used</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">6</span>
                Updates to This Policy
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    We may update this Cookie Policy from time to time to reflect changes in our practices or for legal reasons. When we do, we will:
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">▸</span>
                        <span>Post the updated policy on this page</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">▸</span>
                        <span>Update the "Last updated" date</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-primary-500 mt-1">▸</span>
                        <span>Notify you of significant changes via email or website notice</span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">7</span>
                Contact Us
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <p class="text-gray-700 mb-4">
                    If you have any questions about our use of cookies or this Cookie Policy, please contact us:
                </p>
                <div class="space-y-2 text-gray-600">
                    <p class="mb-0"><strong>📧 Email:</strong> <a href="mailto:privacy@freshmart.com" class="text-primary-600 hover:underline">privacy@freshmart.com</a></p>
                    <p class="mb-0"><strong>📞 Phone:</strong> +855 12 345 678</p>
                    <p class="mb-0"><strong>📍 Address:</strong> 123 Fresh Blvd, Khan Daun Penh, Phnom Penh, Cambodia</p>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">📄</span>
                Related Policies
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <a href="{{ route('privacy') }}" class="bg-white border-2 border-primary-200 hover:border-primary-500 rounded-xl p-6 shadow-sm transition group">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">🔒</span>
                        <strong class="text-gray-900 group-hover:text-primary-600 transition">Privacy Policy</strong>
                    </div>
                    <p class="text-gray-600 text-sm mb-0">Learn how we collect, use, and protect your personal information.</p>
                </a>
                <a href="{{ route('terms') }}" class="bg-white border-2 border-primary-200 hover:border-primary-500 rounded-xl p-6 shadow-sm transition group">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">⚖️</span>
                        <strong class="text-gray-900 group-hover:text-primary-600 transition">Terms of Service</strong>
                    </div>
                    <p class="text-gray-600 text-sm mb-0">Read our terms and conditions for using FreshMart services.</p>
                </a>
            </div>
        </section>

    </div>
</div>
@endsection
