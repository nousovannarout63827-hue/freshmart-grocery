<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class ShowProducts extends Command
{
    protected $signature = 'products:show';
    protected $description = 'Show sample products with units';

    public function handle()
    {
        $this->info('Sample products with units:');
        $this->table(
            ['Name', 'Price', 'Unit', 'Stock'],
            Product::limit(5)->get()->map(fn($p) => [
                $p->name,
                '$' . number_format($p->price, 2),
                $p->unit,
                $p->quantity . ' ' . $p->unit . 's'
            ])->toArray()
        );
        
        return Command::SUCCESS;
    }
}
