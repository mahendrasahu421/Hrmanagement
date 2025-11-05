<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
            'status' => 1,
        ]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 2,
            'status' => 1,
        ]);

        // HR
        User::create([
            'name' => 'HR User',
            'email' => 'hr@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 3,
            'status' => 1,
        ]);

        // Employee
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 4,
            'status' => 1,
        ]);
    }
}
