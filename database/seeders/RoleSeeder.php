<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner
        // $role = Role::create([
        //     'name' => 'Owner',
        //     'guard_name' => 'web',
        // ]);

        // $permissions = Permission::create([
        //     'name' => 'Manage Products',
        //     'guard_name' => 'web',
        // ]);

        // $role->givePermissionTo($permissions);

        // Cashier
        // $role = Role::create([
        //     'name' => 'Cashier',
        //     'guard_name' => 'web',
        // ]);

        // $permissions = Permission::create([
        //     'name' => 'Transaction',
        //     'guard_name' => 'web',
        // ]);

        // $role->givePermissionTo($permissions);
    }
}
