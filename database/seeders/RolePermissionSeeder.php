<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $SuperAdminRole = Role::create([
            'name' => 'Super_Admin',
        ]);
        $AdminRole = Role::create([
            'name' => 'Admin',
        ]);
        $AccountantRole = Role::create([
            'name' => 'Accountant',
        ]);
        $UserRole = Role::create([
            'name' => 'User',
        ]);

        $SuperAdminPermission = Permission::create([
            'name' => 'Super-Admin-View',
        ]);
        $AdminPermission = Permission::create([
            'name' => 'Admin-View',
        ]);
        $AccountantPermission = Permission::create([
            'name' => 'Account-View',
        ]);
        $UserPermission = Permission::create([
            'name' => 'User-View',
        ]);

        $SuperAdminRole->givePermissionTo($SuperAdminPermission->name);
        $AdminRole->givePermissionTo($AdminPermission->name);
        $AccountantRole->givePermissionTo($AccountantPermission->name);
        $UserRole->givePermissionTo($UserPermission->name);
    }
}
