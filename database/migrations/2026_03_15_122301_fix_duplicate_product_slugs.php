<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration fixes duplicate product slugs by appending numbers to duplicates.
     */
    public function up(): void
    {
        // Find all duplicate slugs
        $duplicates = DB::table('products')
            ->select('slug')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->groupBy('slug')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            // Get all products with this slug, ordered by ID (keep the first one unchanged)
            $products = DB::table('products')
                ->where('slug', $duplicate->slug)
                ->orderBy('id')
                ->get();

            // Skip the first one (keep original slug), rename the rest
            foreach ($products->skip(1) as $index => $product) {
                $newSlug = $duplicate->slug . '-' . ($index + 2); // Start from -2
                
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['slug' => $newSlug]);
                    
                echo "Fixed product ID {$product->id}: '{$duplicate->slug}' -> '{$newSlug}'\n";
            }
        }

        // Add unique index to prevent future duplicates
        Schema::table('products', function (Blueprint $table) {
            // First, ensure no null/empty slugs exist
            DB::table('products')
                ->whereNull('slug')
                ->orWhere('slug', '')
                ->chunkById(100, function ($products) {
                    foreach ($products as $product) {
                        $name = json_decode($product->name, true);
                        $nameStr = '';
                        
                        if (is_array($name)) {
                            $nameStr = $name['en'] ?? $name['km'] ?? $name['zh'] ?? '';
                        } else {
                            $nameStr = $product->name ?? '';
                        }
                        
                        $slug = Str::slug($nameStr) . '-' . $product->id;
                        
                        DB::table('products')
                            ->where('id', $product->id)
                            ->update(['slug' => $slug]);
                    }
                });
            
            // Add unique index
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the unique index
            $table->dropUnique(['slug']);
        });
    }
};
