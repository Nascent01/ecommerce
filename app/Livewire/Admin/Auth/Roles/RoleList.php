<?php

namespace App\Livewire\Admin\Auth\Roles;

use App\Models\Auth\Role\Role;
use App\Repositories\Auth\Permission\PermissionRepository;
use App\Traits\Sortable;
use Livewire\Component;

class RoleList extends Component
{
    use Sortable;

    public $name;
    public Role $role;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedPermissions = [];

    public function clearFilters()
    {
        $this->reset();
    }

    public function openRolePermissionsModal(Role $role)
    {
        $this->role = $role;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function saveRolePermissions()
    {
        $this->validate([
            'selectedPermissions' => 'required',
        ]);

        $this->role->permissions()->sync($this->selectedPermissions);

        session()->flash('success', 'Permissions updated successfully.');

        $this->dispatch('closeModal');
    }

    public function getFilters() {}

    public function render()
    {
        $rolesQb = Role::filter($this->name);

        return view('livewire.admin.auth.roles.role-list', [
            'roles' => $rolesQb->orderBy($this->sortField, $this->sortDirection)->paginate(10),
            'permissions' => (new PermissionRepository())->getPermissionWithRoles(),
        ]);
    }
}
