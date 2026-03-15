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
        Schema::table('coupons', function (Blueprint $table) {
            // Modify the type column to include 'free_delivery'
            DB::statement("ALTER TABLE coupons MODIFY COLUMN type ENUM('fixed', 'percent', 'free_delivery') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            // Revert back to original enum values
            DB::statement("ALTER TABLE coupons MODIFY COLUMN type ENUM('fixed', 'percent') NOT NULL");
        });
    }
};
