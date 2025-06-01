<?php

namespace App\Services\Auth\Role;

use App\Models\Auth\Role\Role;
use Illuminate\Support\Arr;

class RoleHandler
{
    public function __construct(
        private RoleService $roleService
    ) {}

    /**
     * Handle the creation of a new role.
     */
    public function handleStore(array $data): Role
    {
        $dataToInsert = Arr::except($data, ['permission_ids']);

        $role = $this->roleService->create($dataToInsert);

        if (!empty($data['permission_ids']) && count($data['permission_ids']) > 0) {
            $role->permissions()->sync($data['permission_ids']);
        }

        return $role;
    }

    /**
     * Handle the update of an existing role.
     */
    public function handleUpdate(array $data, Role $role): Role
    {
        $dataToInsert = Arr::except($data, ['permission_ids']);

        $this->roleService->update($role, $dataToInsert);

        if (!empty($data['permission_ids']) && count($data['permission_ids']) > 0) {
            $role->permissions()->sync($data['permission_ids']);
        }

        return $role;
    }
}
