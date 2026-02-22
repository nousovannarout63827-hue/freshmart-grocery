@extends('frontend.layouts.app')

@section('title', 'Terms of Service - FreshMart')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-black mb-4">Terms of Service</h1>
        <p class="text-green-100 text-lg">Last updated: February 2026</p>
    </div>
</div>

<!-- Content -->
<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="prose prose-lg max-w-none">
        
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-8">
            <p class="text-amber-800 mb-0">
                <strong>⚖️ Legal Agreement:</strong> By accessing or using FreshMart, you agree to be bound by these Terms of Service. If you disagree with any part of these terms, please do not use our service.
            </p>
        </div>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">1</span>
                Acceptance of Terms
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    By creating an account, browsing products, or placing orders on FreshMart, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service and our Privacy Policy.
                </p>
                <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg">
                    <span class="text-2xl">📋</span>
                    <p class="text-blue-800 mb-0">
                        <strong>Eligibility:</strong> You must be at least 18 years old or have parental consent to use FreshMart. By using this service, you represent and warrant that you meet these eligibility requirements.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">2</span>
                Account Registration
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">👤</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Your Responsibilities</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>• Provide accurate and complete information</li>
                        <li>• Maintain a valid email address</li>
                        <li>• Keep your password secure</li>
                        <li>• Notify us of unauthorized access</li>
                    </ul>
                </div>
                <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-xl mb-3">🔐</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Account Security</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>• You are responsible for all activities</li>
                        <li>• Do not share your account credentials</li>
                        <li>• Use strong, unique passwords</li>
                        <li>• Log out after each session</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">3</span>
                Ordering & Payment
            </h2>
            <div class="space-y-4">
                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center text-xs">🛒</span>
                        Placing Orders
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="text-primary-500 mt-1">▸</span>
                            <span>All orders are subject to product availability and acceptance.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-500 mt-1">▸</span>
                            <span>We reserve the right to refuse or cancel any order for any reason.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-500 mt-1">▸</span>
                            <span>Product prices are subject to change without notice.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary-500 mt-1">▸</span>
                            <span>We strive to display accurate product images and descriptions.</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center text-xs">💳</span>
                        Payment Terms
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Accepted Payment Methods:</h4>
                            <ul class="space-y-1 text-gray-600 text-sm">
                                <li>• Cash on Delivery (COD)</li>
                                <li>• Credit/Debit Cards</li>
                                <li>• Digital Wallets</li>
                                <li>• Bank Transfers</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Payment Security:</h4>
                            <ul class="space-y-1 text-gray-600 text-sm">
                                <li>• All payments are processed securely</li>
                                <li>• We do not store credit card details</li>
                                <li>• Transactions are encrypted</li>
                                <li>• Fraud detection systems active</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">4</span>
                Delivery & Shipping
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <div class="text-3xl mb-2">🚚</div>
                        <h4 class="font-semibold text-gray-900 mb-2">Delivery Areas</h4>
                        <p class="text-gray-600 text-sm mb-0">We currently deliver to Phnom Penh and surrounding areas. Delivery availability is determined at checkout.</p>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">⏰</div>
                        <h4 class="font-semibold text-gray-900 mb-2">Delivery Times</h4>
                        <p class="text-gray-600 text-sm mb-0">Standard: 12 hours | Express: 6 hours | Fast: 2 hours. Times are estimates and not guaranteed.</p>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">📦</div>
                        <h4 class="font-semibold text-gray-900 mb-2">Shipping Fees</h4>
                        <p class="text-gray-600 text-sm mb-0">FREE delivery on orders over $50. Orders under $50 incur a $6 delivery fee.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">5</span>
                Returns & Refunds
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Eligible for Return
                        </h3>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li>• Damaged or defective products</li>
                            <li>• Wrong items delivered</li>
                            <li>• Expired products received</li>
                            <li>• Missing items from order</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                            <span class="text-red-500">✗</span>
                            Not Eligible for Return
                        </h3>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li>• Perishable items (unless defective)</li>
                            <li>• Products damaged by customer</li>
                            <li>• Items past return window</li>
                            <li>• Gift cards</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-blue-800 mb-0">
                        <strong>Return Window:</strong> Report issues within 24 hours of delivery for perishable items, 7 days for non-perishable items. Contact us at <a href="mailto:support@freshmart.com" class="underline">support@freshmart.com</a>
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">6</span>
                Prohibited Conduct
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    You agree NOT to use FreshMart to:
                </p>
                <div class="grid md:grid-cols-2 gap-3">
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Upload viruses or malicious code</p>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Attempt unauthorized access to systems</p>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Interfere with website security features</p>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Use automated systems to access the site</p>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Make fraudulent or unauthorized orders</p>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-red-50 rounded-lg">
                        <span class="text-red-500 text-lg">⚠️</span>
                        <p class="text-red-800 text-sm mb-0">Harass or abuse customer support staff</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">7</span>
                Limitation of Liability
            </h2>
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                <p class="text-amber-800 mb-4">
                    <strong>⚖️ Important Legal Notice:</strong> To the maximum extent permitted by law, FreshMart shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including:
                </p>
                <ul class="space-y-2 text-amber-800 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600">•</span>
                        <span>Loss of profits, data, or business opportunities</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600">•</span>
                        <span>Personal injury or property damage</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-amber-600">•</span>
                        <span>Service interruptions or data breaches</span>
                    </li>
                </ul>
                <p class="text-amber-800 mt-4 mb-0">
                    Our total liability shall not exceed the amount you paid for the products that gave rise to the claim.
                </p>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">8</span>
                Modifications to Terms
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    We reserve the right to modify these Terms of Service at any time. Changes will be effective immediately upon posting to the website.
                </p>
                <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg">
                    <span class="text-2xl">📢</span>
                    <p class="text-blue-800 mb-0">
                        <strong>Notification:</strong> We will notify users of material changes via email or prominent notice on our website. Continued use of FreshMart after changes constitutes acceptance of the new terms.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">9</span>
                Governing Law
            </h2>
            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                <p class="text-gray-600 mb-4">
                    These Terms shall be governed by and construed in accordance with the laws of the Kingdom of Cambodia, without regard to its conflict of law provisions.
                </p>
                <div class="flex items-start gap-3 p-4 bg-green-50 rounded-lg">
                    <span class="text-2xl">⚖️</span>
                    <p class="text-green-800 mb-0">
                        <strong>Dispute Resolution:</strong> Any disputes arising from these terms shall first be attempted to be resolved through good faith negotiation. If unresolved, disputes shall be submitted to the competent courts of Phnom Penh, Cambodia.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm">10</span>
                Contact Information
            </h2>
            <div class="bg-gradient-to-r from-primary-50 to-emerald-50 border border-primary-100 rounded-xl p-6">
                <p class="text-gray-700 mb-4">
                    For questions about these Terms of Service, please contact us:
                </p>
                <div class="space-y-2 text-gray-600">
                    <p class="mb-0"><strong>📧 Email:</strong> <a href="mailto:legal@freshmart.com" class="text-primary-600 hover:underline">legal@freshmart.com</a></p>
                    <p class="mb-0"><strong>📞 Phone:</strong> +855 12 345 678</p>
                    <p class="mb-0"><strong>📍 Address:</strong> 123 Fresh Blvd, Khan Daun Penh, Phnom Penh, Cambodia</p>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
