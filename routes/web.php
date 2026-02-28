<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// 1. Import your Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerProfileController;
use App\Http\Controllers\Frontend\CouponController as FrontendCouponController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ReviewController;

// 2. Import your Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CustomerManagementController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\DriverPerformanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewManagementController;

// 3. Import other controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\OrderTrackingController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Driver\DriverProfileController;
use App\Http\Controllers\Driver\DriverLocationController;
use App\Http\Controllers\ProfileController;

// 4. Import Middleware
use App\Http\Middleware\CheckAdminRole;

/*
|--------------------------------------------------------------------------
| 🛒 PUBLIC STOREFRONT ROUTES (No login required)
|--------------------------------------------------------------------------
| Anyone on the internet can visit these pages to browse and buy groceries.
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [HomeController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [HomeController::class, 'categoryView'])->name('category.view');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/cookies', [PageController::class, 'cookies'])->name('cookies');

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    // Only allow our 3 specific languages
    if (in_array($locale, ['en', 'km', 'zh'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
Route::post('/contact/submit', [PageController::class, 'submitContact'])->name('contact.submit');

// Cart Routes (View cart is public, but actions require auth)
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

// Debug route - remove after testing
Route::get('/debug-images', [\App\Http\Controllers\DebugController::class, 'checkImages']);
Route::get('/debug-orders', [\App\Http\Controllers\DebugController::class, 'checkOrders']);

// Checkout Routes - REQUIRE LOGIN
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [HomeController::class, 'processCheckout'])->name('checkout.process');
});

// Cart Actions - Can be done without login (guest checkout support)
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update', [HomeController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [HomeController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/count', [HomeController::class, 'cartCount'])->name('cart.count');

// Coupon Routes (Frontend)
Route::post('/apply-coupon', [FrontendCouponController::class, 'apply'])->name('coupon.apply');
Route::post('/remove-coupon', [FrontendCouponController::class, 'remove'])->name('coupon.remove');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Authentication Routes
Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register']);

// Customer Password Reset Routes
Route::get('/customer/forgot-password', [CustomerAuthController::class, 'showForgotPassword'])->name('customer.forgot-password');
Route::post('/customer/forgot-password', [CustomerAuthController::class, 'forgotPassword']);
Route::get('/customer/reset-password/{token}', [CustomerAuthController::class, 'showResetPassword'])->name('customer.reset-password.form');
Route::post('/customer/reset-password', [CustomerAuthController::class, 'resetPassword'])->name('customer.reset-password');

// Customer Profile Routes (Require Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('customer.wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Review Routes
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/{id}/helpful', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');
    Route::get('/products/{productId}/reviews', [ReviewController::class, 'filter'])->name('reviews.filter');
    Route::get('/customer/reviews', [ReviewController::class, 'myReviews'])->name('customer.reviews');
    
    // Review Reply Routes
    Route::post('/reviews/{id}/reply', [ReviewController::class, 'storeReply'])->name('reviews.reply');
    Route::delete('/reviews/reply/{id}', [ReviewController::class, 'destroyReply'])->name('reviews.reply.destroy');

    Route::get('/customer/profile', [CustomerAuthController::class, 'profile'])->name('customer.profile');
    Route::get('/customer/profile/edit', [CustomerProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::put('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    Route::put('/customer/profile/password', [CustomerAuthController::class, 'updatePassword'])->name('customer.profile.password');
    Route::post('/customer/profile/photo', [CustomerAuthController::class, 'uploadPhoto'])->name('customer.profile.photo');
    Route::get('/customer/orders', [HomeController::class, 'myOrders'])->name('customer.orders');
    Route::get('/customer/order/{orderId}', [CustomerAuthController::class, 'orderDetails'])->name('customer.order.details');
    Route::get('/customer/order/{orderId}/track', [OrderTrackingController::class, 'track'])->name('customer.order.track');
    Route::get('/customer/order/{orderId}/track-api', [OrderTrackingController::class, 'getTrackingData'])->name('customer.order.track-api');
    Route::get('/customer/order/{orderId}/invoice', [CustomerAuthController::class, 'invoice'])->name('customer.order.invoice');
    Route::get('/customer/order/{orderId}/invoice-pdf', [CustomerAuthController::class, 'downloadInvoice'])->name('customer.order.invoice-pdf');
    Route::post('/customer/order/{orderId}/cancel', [CustomerAuthController::class, 'cancelOrder'])->name('customer.order.cancel');
    Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    
    // Customer Notifications
    Route::get('/customer/notifications', [NotificationController::class, 'index'])->name('customer.notifications');
    Route::post('/customer/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('customer.notifications.read');
    Route::post('/customer/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('customer.notifications.read-all');
    Route::delete('/customer/notifications/{id}', [NotificationController::class, 'destroy'])->name('customer.notifications.destroy');
    Route::delete('/customer/notifications/delete-all', [NotificationController::class, 'destroyAll'])->name('customer.notifications.destroy-all');
    Route::get('/customer/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('customer.notifications.unread-count');
});

/*
|--------------------------------------------------------------------------
| 🔐 SECURE ADMIN ROUTES (Requires Login + Permissions)
|--------------------------------------------------------------------------
| Routes are now protected by permission-based middleware.
| Admins have automatic access to everything.
| Staff/Drivers only see what they have permissions for.
*/
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', CheckAdminRole::class],
    'as' => 'admin.',
], function () {

    // Main Dashboard - Everyone can access
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 👤 ADMIN PROFILE ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.photo');

    // 🛒 ORDER MANAGEMENT ROUTES
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::post('orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('orders/{order}/ready-for-pickup', [OrderController::class, 'markReadyForPickup'])->name('orders.ready-for-pickup');

    // 🎟️ COUPON MANAGEMENT ROUTES
    Route::resource('coupons', CouponController::class)->except(['show']);
    
    // 🎉 PROMOTION MANAGEMENT ROUTES
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/{id}', [PromotionController::class, 'show'])->name('promotions.show');
    Route::get('/promotions/{id}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/promotions/{id}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{id}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::post('/promotions/give-to-customers', [PromotionController::class, 'giveToCustomers'])->name('promotions.give-to-customers');
    Route::post('/promotions/flash-sale', [PromotionController::class, 'createFlashSale'])->name('promotions.flash-sale');
    Route::post('/promotions/{id}/toggle', [PromotionController::class, 'toggleStatus'])->name('promotions.toggle');

    // 👥 CUSTOMER MANAGEMENT ROUTES
    Route::get('/customers', [CustomerManagementController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [CustomerManagementController::class, 'show'])->name('customers.show');
    Route::post('/customers/{id}/toggle', [CustomerManagementController::class, 'toggleStatus'])->name('customers.toggle');
    Route::put('/customers/{id}/role', [CustomerManagementController::class, 'updateRole'])->name('customers.update-role');
    Route::delete('/customers/{id}', [CustomerManagementController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers/trash', [CustomerManagementController::class, 'trash'])->name('customers.trash');

    // 📦 INVENTORY ROUTES - Locked down with permission check!
    Route::middleware(['permission:manage_inventory'])->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        
        // ⚠️ Image routes MUST come before /{id} routes to prevent conflicts!
        Route::delete('/products/images/{id}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::post('/products/images/{id}', [ProductController::class, 'destroyImage'])->name('products.images.destroy.post');
        
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');

        // Custom Product Actions
        Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
        Route::post('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');
        Route::post('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
        Route::post('/products/bulk-restore', [ProductController::class, 'bulkRestore'])->name('products.bulk-restore');
        Route::post('/products/bulk-force-delete', [ProductController::class, 'bulkForceDelete'])->name('products.bulk-force-delete');
        Route::get('/products/export-pdf', [ProductController::class, 'exportPDF'])->name('products.export');
        Route::get('/products/export-excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
    });

    // 📁 CATEGORY ROUTES - Locked down with permission check!
    Route::middleware(['permission:manage_categories'])->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // 👥 STAFF ROUTES - Locked down with permission check!
    Route::middleware(['permission:manage_staff'])->group(function () {
        Route::get('/staff', [DashboardController::class, 'staffIndex'])->name('staff.index');
        Route::get('/staff/create', [DashboardController::class, 'createStaff'])->name('staff.create');
        Route::get('/staff/{id}', [DashboardController::class, 'showStaff'])->name('staff.show');
        Route::post('/staff/store', [DashboardController::class, 'storeStaff'])->name('staff.store');
        Route::get('/staff/{id}/edit', [DashboardController::class, 'editStaff'])->name('staff.edit');
        Route::put('/staff/{id}', [DashboardController::class, 'updateStaff'])->name('staff.update');
        Route::post('/staff/{id}/deactivate', [DashboardController::class, 'deactivateStaff'])->name('staff.deactivate');
        Route::delete('/staff/{id}/delete', [DashboardController::class, 'deleteStaff'])->name('staff.delete');
        Route::post('/staff/{id}/change-role', [DashboardController::class, 'changeRole'])->name('staff.change-role');
        Route::get('/staff/{id}/history', [DashboardController::class, 'staffHistory'])->name('staff.history');

        // 📜 MASTER ACTIVITY LOG - Only for users with manage_staff permission
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');

        // 🚚 DRIVER TRACKING - View all driver locations on map (Admins only)
        Route::get('/drivers/tracking', [DriverLocationController::class, 'showTracking'])->name('drivers.tracking');
        Route::get('/api/drivers/location', [DriverLocationController::class, 'getAllDriversLocation'])->name('api.drivers.location');

        // 💬 REVIEW MANAGEMENT - Moderate customer reviews
        Route::get('/reviews', [ReviewManagementController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{id}', [ReviewManagementController::class, 'show'])->name('reviews.show');
        Route::get('/reviews/{id}/edit', [ReviewManagementController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewManagementController::class, 'update'])->name('reviews.update');
        Route::post('/reviews/{id}/approve', [ReviewManagementController::class, 'approve'])->name('reviews.approve');
        Route::post('/reviews/{id}/reject', [ReviewManagementController::class, 'reject'])->name('reviews.reject');
        Route::post('/reviews/{id}/flag', [ReviewManagementController::class, 'flag'])->name('reviews.flag');
        Route::post('/reviews/{id}/unflag', [ReviewManagementController::class, 'unflag'])->name('reviews.unflag');
        Route::post('/reviews/{id}/ban', [ReviewManagementController::class, 'ban'])->name('reviews.ban');
        Route::post('/reviews/{id}/unban', [ReviewManagementController::class, 'unban'])->name('reviews.unban');
        Route::delete('/reviews/{id}', [ReviewManagementController::class, 'destroy'])->name('reviews.destroy');
        Route::post('/reviews/bulk-action', [ReviewManagementController::class, 'bulkAction'])->name('reviews.bulk-action');
        Route::get('/reviews-statistics', [ReviewManagementController::class, 'statistics'])->name('reviews.statistics');
        
        // Review Reply Management
        Route::delete('/reviews/reply/{id}', [ReviewManagementController::class, 'destroyReply'])->name('reviews.reply.destroy');
        Route::post('/reviews/reply/{id}/toggle', [ReviewManagementController::class, 'toggleReplyVisibility'])->name('reviews.reply.toggle');
        Route::put('/reviews/reply/{id}', [ReviewManagementController::class, 'updateReply'])->name('reviews.reply.update');
    });

    // 📈 REPORTS - Admin only
    Route::middleware(['role:admin,super_user'])->group(function () {
        // Main Reports Page - Financial & Driver Analytics
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export-financial', [ReportController::class, 'exportFinancial'])->name('reports.export-financial');
        Route::get('/reports/export-driver', [ReportController::class, 'exportDriver'])->name('reports.export-driver');
        Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
        
        // Legacy driver reports route
        Route::get('/reports/drivers', [DashboardController::class, 'driverPerformance'])->name('reports.drivers');
        Route::get('/driver-performance', [DriverPerformanceController::class, 'index'])->name('driver-performance.index');
        Route::get('/driver-performance/{id}', [DriverPerformanceController::class, 'show'])->name('driver-performance.show');
        Route::get('/driver-performance/export', [DriverPerformanceController::class, 'export'])->name('driver-performance.export');
    });
});

/*
|--------------------------------------------------------------------------
| 🚚 DRIVER ROUTES (Requires Login AND Driver Role)
|--------------------------------------------------------------------------
| Only users with 'driver' role can access these routes.
*/
Route::group([
    'prefix' => 'driver',
    'middleware' => ['auth', 'role:driver'],
    'as' => 'driver.',
], function () {
    // Dashboard
    Route::get('/dashboard', [DriverDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [DriverProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [DriverProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [DriverProfileController::class, 'updatePhoto'])->name('profile.photo');
    
    // Order Actions
    Route::post('/order/{id}/accept', [DriverDashboardController::class, 'acceptOrder'])->name('accept-order');
    Route::post('/order/{id}/pickup', [DriverDashboardController::class, 'confirmPickup'])->name('confirm-pickup');
    Route::post('/order/{id}/arrival', [DriverDashboardController::class, 'confirmArrival'])->name('confirm-arrival');
    Route::post('/order/{id}/confirm-delivery', [DriverDashboardController::class, 'confirmDelivery'])->name('confirm-delivery');
    
    // Update order status (new guided workflow)
    Route::patch('/order/{id}/status', [DriverDashboardController::class, 'updateStatus'])->name('order.update-status');
    
    // Order Details & Utilities
    Route::get('/order/{id}/details', [DriverDashboardController::class, 'viewOrder'])->name('order.details');
    Route::get('/order/{id}/directions', [DriverDashboardController::class, 'getDirections'])->name('get-directions');
    Route::get('/order/{id}/contact', [DriverDashboardController::class, 'contactCustomer'])->name('contact-customer');

    // Location Tracking
    Route::get('/location', [DriverLocationController::class, 'index'])->name('location');
    Route::post('/location', [DriverLocationController::class, 'update'])->name('location.update');
    Route::get('/location/get', [DriverLocationController::class, 'getLocation'])->name('location.get');
});
