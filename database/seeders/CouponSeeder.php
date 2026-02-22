<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::truncate();

        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'fixed',
            'value' => 10.00,
            'min_purchase' => 30.00,
            'status' => true,
            'expires_at' => null,
        ]);

        Coupon::create([
            'code' => 'FRESH20',
            'type' => 'percent',
            'value' => 20.00,
            'min_purchase' => 50.00,
            'status' => true,
            'expires_at' => Carbon::now()->addMonths(3),
        ]);

        Coupon::create([
            'code' => 'SAVE5',
            'type' => 'fixed',
            'value' => 5.00,
            'min_purchase' => 20.00,
            'status' => true,
            'expires_at' => null,
        ]);

        Coupon::create([
            'code' => 'HALF50',
            'type' => 'percent',
            'value' => 50.00,
            'min_purchase' => 100.00,
            'status' => true,
            'expires_at' => Carbon::now()->addMonths(1),
        ]);

        // Expired coupon for testing
        Coupon::create([
            'code' => 'EXPIRED',
            'type' => 'percent',
            'value' => 30.00,
            'min_purchase' => 0,
            'status' => true,
            'expires_at' => Carbon::now()->subDays(7),
        ]);

        // Disabled coupon for testing
        Coupon::create([
            'code' => 'DISABLED',
            'type' => 'fixed',
            'value' => 15.00,
            'min_purchase' => 0,
            'status' => false,
            'expires_at' => null,
        ]);
    }
}
