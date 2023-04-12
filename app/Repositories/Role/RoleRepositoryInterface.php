<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function getList();
    public function getById($id);
    public function create($attributes);
    // public function delete($id);
}
