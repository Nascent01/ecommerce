<?php

namespace App\Repositories\Auth\Permission;

use App\Models\Auth\Permission\Permission;

class PermissionRepository
{
    public function basePermissionQuery()
    {
        return Permission::query();
    }

    public function getPermissionWithRoles()
    {
        return $this->basePermissionQuery()->get();
    }

    public function getAllPermissionIds()
    {
        return $this->basePermissionQuery()->pluck('id')->toArray();
    }

    public function getAllPermissionNames()
    {
        return $this->basePermissionQuery()->pluck('name', 'name')->toArray();
    }
}
