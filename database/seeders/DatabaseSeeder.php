<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin 1',
            'email' => 'admin1@jpbexpress.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'admin 2',
            'email' => 'admin2@jpbexpress.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'admin 3',
            'email' => 'admin3@jpbexpress.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
