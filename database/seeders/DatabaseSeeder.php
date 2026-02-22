<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Admin Demo Account
        User::updateOrCreate(
            ['email' => 'admin@grocery.com'], // Checks if this email already exists
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), // Securely encrypts the password
                'role' => 'admin'
            ]
        );

        // 2. Create the Driver Demo Account
        User::updateOrCreate(
            ['email' => 'driver@grocery.com'],
            [
                'name' => 'Delivery Driver',
                'password' => Hash::make('password123'),
                'role' => 'driver'
            ]
        );
        
        // 3. Create a Staff Demo Account
        User::updateOrCreate(
            ['email' => 'staff@grocery.com'],
            [
                'name' => 'Store Staff',
                'password' => Hash::make('password123'),
                'role' => 'staff'
            ]
        );

        // Call other seeders
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
