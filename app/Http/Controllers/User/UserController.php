<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepositoryInterface $u, RoleRepositoryInterface $r)
    {
        $this->userRepository = $u;
        $this->roleRepository = $r;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->getList();
        return view('feature.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleRepository->getList();
        return view('feature.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        return $this->callback('user.index', $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('feature.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = $this->roleRepository->getList();
        return view('feature.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userRepository->update($user, $request->all());
        alert('success', 'Successfully update data');
        return to_route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert('success', 'Successfully delete data');
        return back();
    }
}
