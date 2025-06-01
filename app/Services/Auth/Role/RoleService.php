<?php

namespace App\Services\Auth\Role;

use App\Models\Auth\Role\Role;

class RoleService
{
    public function create($array): Role
    {
        return Role::create($array);
    }

    public function update(Role $role, $data): Role
    {
        $role->update($data);
        return $role;
    }
}
