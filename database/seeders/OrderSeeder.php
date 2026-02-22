<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Order::create([
            'customer_id' => 1, // Any existing user ID
            'total_amount' => 25.50,
            'address' => '123 Street, Phnom Penh',
            'status' => 'ready_for_pickup', // This makes it visible to Drivers
            'payment_method' => 'cod',
            'payment_status' => 'unpaid',
        ]);
    }
}
