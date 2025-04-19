<?php

namespace App\Repositories\Auth\Permission;

use App\Models\Auth\Permission\Permission;

class PermissionRepository
{

    public function getPermissionWithRoles()
    {
        return Permission::with('roles')->get();
    }

    public function getAllPermissionIds()
    {
        return Permission::pluck('id')->toArray();
    }
}
