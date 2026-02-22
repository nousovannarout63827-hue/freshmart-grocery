<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Vegetables', 'slug' => 'vegetables', 'icon' => 'fa-carrot'],
            ['name' => 'Fruits', 'slug' => 'fruits', 'icon' => 'fa-apple-whole'],
            ['name' => 'Meat & Fish', 'slug' => 'meat-fish', 'icon' => 'fa-drumstick-bite'],
            ['name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'icon' => 'fa-egg'],
            ['name' => 'Beverages', 'slug' => 'beverages', 'icon' => 'fa-bottle-water'],
            ['name' => 'Frozen Food', 'slug' => 'frozen', 'icon' => 'fa-ice-cream'],
            ['name' => 'Bakery', 'slug' => 'bakery', 'icon' => 'fa-bread-slice'],
            ['name' => 'Snacks', 'slug' => 'snacks', 'icon' => 'fa-cookie'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], // Find by slug
                $category // Update with these values
            );
        }
    }
}
