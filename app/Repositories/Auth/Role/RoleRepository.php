<?php

namespace App\Repositories\Auth\Role;

use App\Models\Auth\Role\Role;

class RoleRepository
{
    public function getByName($name)
    {
        return Role::where('name', $name)->first();
    }
}
