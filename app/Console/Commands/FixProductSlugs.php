<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class FixProductSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:fix-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for all products that are missing them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Finding products without slugs...');
        
        $products = Product::whereNull('slug')
            ->orWhere('slug', '')
            ->get();
        
        if ($products->count() === 0) {
            $this->info('All products already have slugs!');
            return 0;
        }
        
        $this->info("Found {$products->count()} products without slugs. Generating...");
        
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();
        
        foreach ($products as $product) {
            // Generate unique slug with product ID to avoid duplicates
            $baseSlug = Str::slug($product->name);
            $slug = $baseSlug . '-' . $product->id;
            
            // Check if slug already exists and make it unique
            $counter = 1;
            $originalSlug = $slug;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $product->slug = $slug;
            $product->save();
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('Successfully generated slugs for all products!');
        
        return 0;
    }
}
