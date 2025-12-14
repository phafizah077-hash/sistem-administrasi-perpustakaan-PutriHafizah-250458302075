<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bookify.com',
            'role' => 'Pustakawan', 
            'password'  =>  Hash::make('12345'),
            'phone' => '0812345',
            'address' => 'Bogor',
        ]);
    }
}
