<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration adds indexes to frequently queried columns to improve performance.
     * Uses raw SQL with IGNORE to skip duplicate indexes.
     */
    public function up(): void
    {
        // Products table indexes
        DB::statement("ALTER TABLE products ADD INDEX IF NOT EXISTS products_slug_idx (slug)");
        DB::statement("ALTER TABLE products ADD INDEX IF NOT EXISTS products_category_id_idx (category_id)");
        DB::statement("ALTER TABLE products ADD INDEX IF NOT EXISTS products_stock_idx (stock)");
        DB::statement("ALTER TABLE products ADD INDEX IF NOT EXISTS products_is_active_idx (is_active)");
        DB::statement("ALTER TABLE products ADD INDEX IF NOT EXISTS products_stock_active_idx (stock, is_active)");

        // Orders table indexes
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_customer_id_idx (customer_id)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_driver_id_idx (driver_id)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_status_idx (status)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_created_at_idx (created_at)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_payment_status_idx (payment_status)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_status_created_idx (status, created_at)");
        DB::statement("ALTER TABLE orders ADD INDEX IF NOT EXISTS orders_customer_status_idx (customer_id, status)");

        // Order items table indexes
        DB::statement("ALTER TABLE order_items ADD INDEX IF NOT EXISTS order_items_order_id_idx (order_id)");
        DB::statement("ALTER TABLE order_items ADD INDEX IF NOT EXISTS order_items_product_id_idx (product_id)");

        // Reviews table indexes
        DB::statement("ALTER TABLE reviews ADD INDEX IF NOT EXISTS reviews_product_id_idx (product_id)");
        DB::statement("ALTER TABLE reviews ADD INDEX IF NOT EXISTS reviews_user_id_idx (user_id)");
        DB::statement("ALTER TABLE reviews ADD INDEX IF NOT EXISTS reviews_is_approved_idx (is_approved)");
        DB::statement("ALTER TABLE reviews ADD INDEX IF NOT EXISTS reviews_product_approved_idx (product_id, is_approved)");

        // Users table indexes
        DB::statement("ALTER TABLE users ADD INDEX IF NOT EXISTS users_email_idx (email)");
        DB::statement("ALTER TABLE users ADD INDEX IF NOT EXISTS users_role_idx (role)");
        DB::statement("ALTER TABLE users ADD INDEX IF NOT EXISTS users_status_idx (status)");

        // Categories table indexes
        DB::statement("ALTER TABLE categories ADD INDEX IF NOT EXISTS categories_slug_idx (slug)");
        DB::statement("ALTER TABLE categories ADD INDEX IF NOT EXISTS categories_is_active_idx (is_active)");

        // Activity logs table indexes
        DB::statement("ALTER TABLE activity_logs ADD INDEX IF NOT EXISTS activity_logs_user_id_idx (user_id)");
        DB::statement("ALTER TABLE activity_logs ADD INDEX IF NOT EXISTS activity_logs_module_idx (module)");
        DB::statement("ALTER TABLE activity_logs ADD INDEX IF NOT EXISTS activity_logs_created_at_idx (created_at)");

        // Coupons table indexes
        DB::statement("ALTER TABLE coupons ADD UNIQUE INDEX IF NOT EXISTS coupons_code_unique (code)");
        DB::statement("ALTER TABLE coupons ADD INDEX IF NOT EXISTS coupons_status_idx (status)");

        // Wishlists table indexes
        DB::statement("ALTER TABLE wishlists ADD INDEX IF NOT EXISTS wishlists_user_id_idx (user_id)");
        DB::statement("ALTER TABLE wishlists ADD INDEX IF NOT EXISTS wishlists_product_id_idx (product_id)");
        DB::statement("ALTER TABLE wishlists ADD UNIQUE INDEX IF NOT EXISTS wishlists_user_product_unique (user_id, product_id)");

        // Notifications table indexes
        DB::statement("ALTER TABLE notifications ADD INDEX IF NOT EXISTS notifications_notifiable_type_idx (notifiable_type)");
        DB::statement("ALTER TABLE notifications ADD INDEX IF NOT EXISTS notifications_read_at_idx (read_at)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop all indexes added by this migration
        DB::statement("ALTER TABLE products DROP INDEX IF EXISTS products_slug_idx");
        DB::statement("ALTER TABLE products DROP INDEX IF EXISTS products_category_id_idx");
        DB::statement("ALTER TABLE products DROP INDEX IF EXISTS products_stock_idx");
        DB::statement("ALTER TABLE products DROP INDEX IF EXISTS products_is_active_idx");
        DB::statement("ALTER TABLE products DROP INDEX IF EXISTS products_stock_active_idx");

        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_customer_id_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_driver_id_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_status_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_created_at_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_payment_status_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_status_created_idx");
        DB::statement("ALTER TABLE orders DROP INDEX IF EXISTS orders_customer_status_idx");

        DB::statement("ALTER TABLE order_items DROP INDEX IF EXISTS order_items_order_id_idx");
        DB::statement("ALTER TABLE order_items DROP INDEX IF EXISTS order_items_product_id_idx");

        DB::statement("ALTER TABLE reviews DROP INDEX IF EXISTS reviews_product_id_idx");
        DB::statement("ALTER TABLE reviews DROP INDEX IF EXISTS reviews_user_id_idx");
        DB::statement("ALTER TABLE reviews DROP INDEX IF EXISTS reviews_is_approved_idx");
        DB::statement("ALTER TABLE reviews DROP INDEX IF EXISTS reviews_product_approved_idx");

        DB::statement("ALTER TABLE users DROP INDEX IF EXISTS users_email_idx");
        DB::statement("ALTER TABLE users DROP INDEX IF EXISTS users_role_idx");
        DB::statement("ALTER TABLE users DROP INDEX IF EXISTS users_status_idx");

        DB::statement("ALTER TABLE categories DROP INDEX IF EXISTS categories_slug_idx");
        DB::statement("ALTER TABLE categories DROP INDEX IF EXISTS categories_is_active_idx");

        DB::statement("ALTER TABLE activity_logs DROP INDEX IF EXISTS activity_logs_user_id_idx");
        DB::statement("ALTER TABLE activity_logs DROP INDEX IF EXISTS activity_logs_module_idx");
        DB::statement("ALTER TABLE activity_logs DROP INDEX IF EXISTS activity_logs_created_at_idx");

        DB::statement("ALTER TABLE coupons DROP INDEX IF EXISTS coupons_code_unique");
        DB::statement("ALTER TABLE coupons DROP INDEX IF EXISTS coupons_status_idx");

        DB::statement("ALTER TABLE wishlists DROP INDEX IF EXISTS wishlists_user_id_idx");
        DB::statement("ALTER TABLE wishlists DROP INDEX IF EXISTS wishlists_product_id_idx");
        DB::statement("ALTER TABLE wishlists DROP INDEX IF EXISTS wishlists_user_product_unique");

        DB::statement("ALTER TABLE notifications DROP INDEX IF EXISTS notifications_notifiable_type_idx");
        DB::statement("ALTER TABLE notifications DROP INDEX IF EXISTS notifications_read_at_idx");
    }
};
