<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
            'email_verified_at' => now(),
        ]);

        // Create Printer Manager User
        User::create([
            'name' => 'Printer Manager',
            'email' => 'printer@example.com',
            'password' => Hash::make('password'),
            'role' => UserRole::PRINTER_MANAGER,
            'email_verified_at' => now(),
        ]);
    }
}
