<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds missing columns to existing categories and products tables.
     */
    public function up(): void
    {
        // Update categories table
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (!Schema::hasColumn('categories', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('image');
            }
        });

        // Update products table
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->unique()->nullable()->after('slug');
            }
            // Rename 'quantity' to 'stock' if it exists
            if (Schema::hasColumn('products', 'quantity') && !Schema::hasColumn('products', 'stock')) {
                $table->renameColumn('quantity', 'stock');
            }
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable()->after('stock');
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('image');
            }
            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'image', 'is_active']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['slug', 'sku', 'description', 'is_active']);
            if (Schema::hasColumn('products', 'stock')) {
                $table->renameColumn('stock', 'quantity');
            }
        });
    }
};
