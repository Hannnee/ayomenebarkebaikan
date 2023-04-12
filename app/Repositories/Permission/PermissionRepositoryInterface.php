<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function getList();
    public function getListByFeature();
    public function getById($id);
    public function create($attributes);
}
