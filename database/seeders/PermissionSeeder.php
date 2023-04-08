<?php

namespace Database\Seeders;

use App\Repositories\Permission\PermissionImplement;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        /**
         * permission backend dashboard

         */
        $permissions = [
            'customers',
            'items',
            'orders',
            'users',
            'roles',
            'permissions',
        ];

        foreach($permissions as $permission)
        {
            $prefixs = ([
                ['name' => $permission],
                ['name' => $permission.'-view'],
                ['name' => $permission.'-create'],
                ['name' => $permission.'-detail'],
                ['name' => $permission.'-update'],
                ['name' => $permission.'-delete'],
            ]);
            foreach($prefixs as $value) {
                Permission::create($value);
            }
        }
    }
}
