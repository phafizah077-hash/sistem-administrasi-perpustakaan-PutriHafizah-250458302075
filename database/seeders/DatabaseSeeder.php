<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Create a specific Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bookify.com',
            'role' => 'Pustakawan', // 'Pustakawan' is the admin role
            'password'  =>  Hash::make('12345'),
            'phone' => '0812345',
            'address' => 'Bogor',
        ]);
    }
}
