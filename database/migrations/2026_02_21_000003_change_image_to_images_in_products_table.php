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
     * Changes the image column from string to JSON to support multiple images
     */
    public function up(): void
    {
        // First, rename the existing column temporarily
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('image', 'image_old');
        });
        
        // Add new JSON column
        Schema::table('products', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image_old');
        });
        
        // Migrate existing single image to JSON array
        DB::statement("UPDATE products SET images = JSON_ARRAY(image_old) WHERE image_old IS NOT NULL");
        
        // Drop old column
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_old');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back old column
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
        
        // Extract first image from JSON array
        DB::statement("UPDATE products SET image = JSON_EXTRACT(images, '$[0]') WHERE images IS NOT NULL");
        
        // Drop JSON column
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
