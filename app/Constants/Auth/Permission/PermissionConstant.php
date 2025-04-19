<?php

namespace App\Constants\Auth\Permission;

class PermissionConstant
{
    const PERMISSION_VIEW_ADMIN_DASHBOARD = 'view-admin-dashboard';
    const PERMISSION_MANAGE_USERS = 'manage-users';

    const PERMISSIONS_ARRAY = [
        self::PERMISSION_VIEW_ADMIN_DASHBOARD => 'View admin dashboard - access to the admin dashboard',
        self::PERMISSION_MANAGE_USERS => 'Manage users - ability to create, update, and delete users',
    ];
}
