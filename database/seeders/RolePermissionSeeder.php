<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // --- Roles ---
        $roles = [
            'Super Admin',
            'Admin',
            'HR',
            'Employee',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // --- Permissions ---
        $permissions = [
            // General Access
            'dashboard.view',

            // User Management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Leave Management
            'leave.apply',
            'leave.approve',
            'leave.reject',
            'leave.view',

            // HR & Admin Specific
            'attendance.manage',
            'payroll.manage',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // --- Assign Permissions ---

        // Super Admin → all permissions
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $superAdmin->syncPermissions(Permission::all());

        // Admin → can manage users, view leaves
        $admin = Role::where('name', 'Admin')->first();
        $admin->syncPermissions([
            'dashboard.view',
            'user.view',
            'user.create',
            'user.edit',
            'leave.view',
            'attendance.manage',
        ]);

        // HR → manage leaves and attendance
        $hr = Role::where('name', 'HR')->first();
        $hr->syncPermissions([
            'dashboard.view',
            'leave.view',
            'leave.approve',
            'leave.reject',
            'attendance.manage',
        ]);

        // Employee → can apply leaves & view dashboard
        $employee = Role::where('name', 'Employee')->first();
        $employee->syncPermissions([
            'dashboard.view',
            'leave.apply',
            'leave.view',
        ]);
    }
}
