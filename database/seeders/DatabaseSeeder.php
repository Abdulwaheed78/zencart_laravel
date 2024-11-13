<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Baba Books',
            'email' => 'admin@gmail.com',
            'role' => 2,
            'password' => Hash::make('Admin@12'),
        ]);
    }
}
