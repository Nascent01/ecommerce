<?php

namespace App\Http\Controllers\Admin\Auth\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRoleRequest;
use App\Http\Requests\Auth\UpdateRoleRequest;
use App\Models\Auth\Role\Role;
use App\Repositories\Auth\Permission\PermissionRepository;
use App\Services\Auth\Role\RoleHandler;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function __construct(
        private RoleHandler $roleHandler
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.auth.roles.role_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.auth.roles.role_edit', [
            'role' => new Role(),
            'permissions' => (new PermissionRepository())->getPermissionWithRoles(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = $this->roleHandler->handleStore($request->validated());

        return redirect()->route('admin.roles.edit', $role->id)->with('success', 'Role created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        $role->load('permissions');

        return view('admin.auth.roles.role_edit', [
            'role' => $role,
            'permissions' => (new PermissionRepository())->getPermissionWithRoles(),
            'selectedPermissionIds' => $role->permissions->pluck('id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role = $this->roleHandler->handleUpdate($request->validated(), $role);
        
        return redirect()->route('admin.roles.edit', $role->id)->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
    }
}
