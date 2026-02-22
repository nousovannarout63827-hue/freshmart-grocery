<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        \App\Models\User::create([
            'name' => 'Sovannarout Admin',
            'email' => 'admin@grocery.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Create Driver
        \App\Models\User::create([
            'name' => 'Rout Driver',
            'email' => 'driver@grocery.com',
            'password' => bcrypt('password123'),
            'role' => 'driver',
        ]);
    }
}
