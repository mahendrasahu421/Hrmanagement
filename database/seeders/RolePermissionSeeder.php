<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin      = Role::create(['name' => 'admin']);
        $hr         = Role::create(['name' => 'hr']);
        $employee   = Role::create(['name' => 'employee']);

        // Permissions (example)
        $permissions = [
            'view dashboard',
            'manage users',
            'manage employees',
            'view reports',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all()); // super-admin can do everything
        $admin->givePermissionTo(['view dashboard', 'manage users']);
        $hr->givePermissionTo(['view dashboard', 'manage employees', 'view reports']);
        $employee->givePermissionTo(['view dashboard']);

        // Example users (replace with your own)
        $user1 = User::find(1); // super-admin
        if ($user1) $user1->assignRole('super-admin');

        $user2 = User::find(2); // admin
        if ($user2) $user2->assignRole('admin');

        $user3 = User::find(3); // hr
        if ($user3) $user3->assignRole('hr');

        $user4 = User::find(4); // employee
        if ($user4) $user4->assignRole('employee');
    }
}
