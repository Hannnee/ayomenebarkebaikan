<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permsAdmin = Permission::all();
        $superadmin  = Role::create(['name' => 'superadmin']);
        $superadmin->syncPermissions($permsAdmin);

        $permsStaff = Permission::whereIn('name', [
            'customers-view',
            'customers-detail',
            'items-view',
            'items-detail',
            'orders-view',
            'orders-create',
            'orders-detail',
        ])->get();
        $staff = Role::create(['name' => 'staff']);
        $staff->syncPermissions($permsStaff);
    }
}
