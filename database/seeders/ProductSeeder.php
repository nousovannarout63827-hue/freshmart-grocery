<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'Organic Carrots', 'price' => 1.50, 'quantity' => 50],
            ['category_id' => 1, 'name' => 'Red Tomatoes', 'price' => 2.00, 'quantity' => 3], // Low stock alert!
            ['category_id' => 2, 'name' => 'Fuji Apples', 'price' => 3.00, 'quantity' => 25],
            ['category_id' => 2, 'name' => 'Cavendish Bananas', 'price' => 1.20, 'quantity' => 40],
            ['category_id' => 3, 'name' => 'Chicken Breast', 'price' => 5.50, 'quantity' => 15],
            ['category_id' => 3, 'name' => 'Fresh Salmon', 'price' => 12.00, 'quantity' => 8],
            ['category_id' => 4, 'name' => 'Whole Milk', 'price' => 2.50, 'quantity' => 2], // Low stock alert!
            ['category_id' => 4, 'name' => 'Brown Eggs (12pk)', 'price' => 4.00, 'quantity' => 20],
            ['category_id' => 5, 'name' => 'Coca-Cola 1.5L', 'price' => 1.50, 'quantity' => 100],
            ['category_id' => 5, 'name' => 'Mineral Water', 'price' => 0.50, 'quantity' => 200],
            ['category_id' => 6, 'name' => 'Vanilla Ice Cream', 'price' => 4.50, 'quantity' => 12],
            ['category_id' => 7, 'name' => 'White Bread', 'price' => 1.00, 'quantity' => 30],
            ['category_id' => 7, 'name' => 'Chocolate Croissant', 'price' => 2.50, 'quantity' => 10],
            ['category_id' => 8, 'name' => 'Potato Chips', 'price' => 1.80, 'quantity' => 60],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
