<?php

namespace App\Constants\Auth\Permission;

class PermissionConstant
{
    const PERMISSION_VIEW_ADMIN_DASHBOARD = 'view-admin-dashboard';
    const PERMISSION_MANAGE_USERS = 'manage-users';

    const PERMISSIONS_ARRAY = [
        self::PERMISSION_VIEW_ADMIN_DASHBOARD,
        self::PERMISSION_MANAGE_USERS,
    ];
}
