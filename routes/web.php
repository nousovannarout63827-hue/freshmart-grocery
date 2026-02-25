<?php

use Illuminate\Support\Facades\Route;

// 1. Import your Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerProfileController;
use App\Http\Controllers\Frontend\CouponController as FrontendCouponController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\PageController;

// 2. Import your Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CustomerManagementController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DriverPerformanceController;
use App\Http\Controllers\Admin\ReportController;

// 3. Import other controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Driver\DriverProfileController;
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

// Customer Profile Routes (Require Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('customer.wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::get('/customer/profile', [CustomerAuthController::class, 'profile'])->name('customer.profile');
    Route::get('/customer/profile/edit', [CustomerProfileController::class, 'edit'])->name('customer.profile.edit');
    Route::put('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    Route::put('/customer/profile/password', [CustomerAuthController::class, 'updatePassword'])->name('customer.profile.password');
    Route::post('/customer/profile/photo', [CustomerAuthController::class, 'uploadPhoto'])->name('customer.profile.photo');
    Route::get('/customer/orders', [HomeController::class, 'myOrders'])->name('customer.orders');
    Route::get('/customer/order/{orderId}', [CustomerAuthController::class, 'orderDetails'])->name('customer.order.details');
    Route::get('/customer/order/{orderId}/invoice', [CustomerAuthController::class, 'invoice'])->name('customer.order.invoice');
    Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
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
    
    // Order Details & Utilities
    Route::get('/order/{id}/details', [DriverDashboardController::class, 'viewOrder'])->name('order.details');
    Route::get('/order/{id}/directions', [DriverDashboardController::class, 'getDirections'])->name('get-directions');
    Route::get('/order/{id}/contact', [DriverDashboardController::class, 'contactCustomer'])->name('contact-customer');
});
