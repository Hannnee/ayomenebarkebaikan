<?php

namespace App\Repositories\Permission;

use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * @return
     */
    public function getList()
    {
        return $this->model->all();
    }

    public function getListByFeature()
    {
        $features = $this->model::where('name', 'NOT LIKE', '%-%')->get();
        foreach($features as $feature) {
            $feature->permissions =  $this->model::where([['name', 'LIKE', $feature->name.'-%']])->orderBy('id', 'asc')->get();
        }
        return $features;
    }

    /**
     * @return
     */
    public function getById($id)
    {

    }

    /**
     * @return
     */
    public function create($attributes)
    {

    }


}
