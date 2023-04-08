<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getList();
    public function getById($id);
    public function create($attributes);
    public function update($id, $attributes);
}
