<?php

namespace App\Services\Auth\Permission;

use App\Models\Auth\Permission\Permission;

class PermissionService
{
    public function create($array)
    {
        Permission::create($array);
    }
}
