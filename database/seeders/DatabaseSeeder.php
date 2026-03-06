<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Add password to User!
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ],
        );

        Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Tiker',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
