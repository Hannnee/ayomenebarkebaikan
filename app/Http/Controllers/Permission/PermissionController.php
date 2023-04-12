<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Repositories\Permission\PermissionRepositoryInterface;

class PermissionController extends Controller
{

    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $p)
    {
        $this->permissionRepository = $p;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionRepository->getList();
        return view('feature.permission.index', compact('permissions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('feature.permission.show', compact('permission'));
    }
}
