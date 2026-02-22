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
     * Creates a normalized product_images table with One-to-Many relationship.
     * This follows enterprise database design patterns.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key: Links each image to a specific product
            // onDelete('cascade') automatically deletes images when product is deleted
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            $table->string('image_path'); // Stores file path (e.g., 'products/apple.jpg')
            $table->integer('sort_order')->default(0); // For ordering images (1st, 2nd, 3rd, 4th)
            
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('product_id');
        });
        
        // Migrate existing JSON images to the new table
        $products = DB::table('products')->whereNotNull('images')->get();
        
        foreach ($products as $product) {
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            
            if (is_array($images)) {
                foreach ($images as $index => $imagePath) {
                    DB::table('product_images')->insert([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                        'sort_order' => $index,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
