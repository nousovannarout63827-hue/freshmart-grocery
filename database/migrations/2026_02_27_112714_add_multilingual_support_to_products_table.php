<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration converts name and description columns to JSON
     * to support multi-language product information.
     */
    public function up(): void
    {
        // First, convert existing data to JSON format
        DB::statement("ALTER TABLE products MODIFY name VARCHAR(5000)");
        
        // Get all products and update them one by one to avoid SQL escaping issues
        $products = DB::table('products')->get(['id', 'name']);
        foreach ($products as $product) {
            $jsonName = json_encode([
                'en' => $product->name,
                'km' => $product->name,
                'zh' => $product->name,
            ], JSON_UNESCAPED_UNICODE);
            DB::table('products')->where('id', $product->id)->update(['name' => $jsonName]);
        }
        
        // Now convert to JSON type
        Schema::table('products', function (Blueprint $table) {
            $table->json('name')->change()->nullable(false);
            
            // Add description as JSON if it doesn't exist, or convert it
            if (!Schema::hasColumn('products', 'description')) {
                $table->json('description')->nullable()->after('name');
            } else {
                $table->json('description')->change()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert back to string - keep English version
            $table->string('name')->change();
            $table->text('description')->change()->nullable();
        });
        
        // Extract English version from JSON
        DB::statement("UPDATE products SET name = JSON_UNQUOTE(JSON_EXTRACT(name, '$.en'))");
    }
};
