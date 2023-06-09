<?php

namespace App\Repositories\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{

    protected $model;
    protected $modelPermission;

    public function __construct(Role $model, Permission $modelPermission)
    {
        $this->model           = $model;
        $this->modelPermission = $modelPermission;
    }

    /**
     * @param
     * @return
     */
    public function getList()
    {
        return $this->model->all();
    }

    /**
     * @param
     * @return
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param
     * @return
     */
    public function create($attributes)
    {
        DB::beginTransaction();
        try {
            $role = $this->model::create(['name' => $attributes['name']]);
            $permissions = $this->modelPermission::whereIn('id', $attributes['permission'])->get();
            if($permissions->count() > 0) {
                $role->syncPermissions($permissions);
                foreach($permissions as $permission) {
                    $explode  = explode('-', $permission->name);
                    $string   = array_shift($explode);
                    $features = $this->modelPermission::where('name', $string)->orWhere('name', $string.'-view')->get();
                    foreach($features as $feature){
                        $role->givePermissionTo($feature);
                    }
                }
            }

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
}
