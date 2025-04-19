<?php

namespace App\Constants\Auth\Role;

class RoleConstant
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    const ROLES_ARRAY = [
        self::ROLE_ADMIN => 'Admin role - highest level of access',
        self::ROLE_USER => 'User role - standard level of access',
    ];
}
