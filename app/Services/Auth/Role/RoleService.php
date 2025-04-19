<?php

namespace App\Services\Auth\Role;

use App\Models\Auth\Role\Role;

class RoleService
{
    public function create($array)
    {
        Role::create($array);
    }
}
