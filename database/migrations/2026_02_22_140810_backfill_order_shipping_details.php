<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Backfill existing orders with customer data
        DB::statement('
            UPDATE orders
            INNER JOIN users ON orders.customer_id = users.id
            SET orders.phone = COALESCE(orders.phone, users.phone_number),
                orders.delivery_address = COALESCE(orders.delivery_address, users.current_address)
            WHERE orders.phone IS NULL OR orders.delivery_address IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed for data update
    }
};
