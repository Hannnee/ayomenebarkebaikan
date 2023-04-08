<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Models\Role;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleController extends Controller
{

    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepositoryInterface $r, PermissionRepositoryInterface $p)
    {
        $this->roleRepository = $r;
        $this->permissionRepository = $p;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepository->getList();
        return view('feature.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = $this->permissionRepository->getListByFeature();
        return view('feature.role.create', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleRepository->create($request->all());
        return to_route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $features = $this->permissionRepository->getListByFeature();
        return view('feature.role.show', compact('role', 'features'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Role $role)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
