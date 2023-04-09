<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $user = $this->model::create([
                'name'              => $attributes['name'],
                'email'             => $attributes['email'],
                'email_verified_at' => now(),
                'password'          => Hash::make($attributes['password']),
            ]);
            $role = $this->role->getById($attributes['role']);
            $user->assignRole($role);

            DB::commit();
            return [
                'status' => 200,
                'message' => 'success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
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
