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
        // Update existing statuses to new workflow
        DB::statement("UPDATE orders SET status = 'preparing' WHERE status = 'pending'");
        DB::statement("UPDATE orders SET status = 'ready_for_pickup' WHERE status = 'confirmed'");
        DB::statement("UPDATE orders SET status = 'out_for_delivery' WHERE status = 'shipped'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert statuses back
        DB::statement("UPDATE orders SET status = 'pending' WHERE status = 'preparing'");
        DB::statement("UPDATE orders SET status = 'confirmed' WHERE status = 'ready_for_pickup'");
        DB::statement("UPDATE orders SET status = 'shipped' WHERE status = 'out_for_delivery'");
    }
};
