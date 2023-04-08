<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $superadmin = User::create([
            'name'              => 'Super Admin',
            'email'             => 'superadmin@gmail.com',
            'email_verified_at' => '2023-04-06 19:04:56',
            'password'          => Hash::make(12345678),
        ]);
        $role = Role::find(1);
        $superadmin->assignRole($role);

        $staff = User::create([
            'name'              => 'Staff',
            'email'             => 'staff@gmail.com',
            'email_verified_at' => '2023-04-06 19:04:56',
            'password'          => Hash::make(12345678),
        ]);
        $role = Role::find(2);
        $staff->assignRole($role);

    }
}
