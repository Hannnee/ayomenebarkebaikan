<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Role\RoleRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    protected $model;
    protected $role;

    public function __construct(User $model, RoleRepositoryInterface $role)
    {
        $this->model = $model;
        $this->role = $role;

    }

    public function getList()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($attributes)
    {
        $user = $this->model::create([
            'name'              => $attributes['name'],
            'email'             => $attributes['email'],
            'email_verified_at' => now(),
            'password'          => Hash::make($attributes['password']),
        ]);
        $role = $this->role->getById($attributes['role']);

        $user->assignRole($role);
        return $user;
    }

    public function update($user, $attributes)
    {
        $user->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);
        if ($attributes['password'] != null) {
            $user->update([
                'password' => Hash::make($attributes['password'])
            ]);
        }
        $role = $this->role->getById($attributes['role']);

        $user->syncRoles($role);
        return $user;
    }
}
