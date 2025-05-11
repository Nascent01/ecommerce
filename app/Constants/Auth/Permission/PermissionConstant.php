<?php

namespace App\Constants\Auth\Permission;

class PermissionConstant
{
    const PERMISSION_VIEW_ADMIN_DASHBOARD = 'view-admin-dashboard';
    const PERMISSION_MANAGE_USERS = 'manage-users';
    const PERMISSION_MANAGE_ROLES = 'manage-roles';
    const PERMISSION_MANAGE_PRODUCTS = 'manage-products';
    const PERMISSION_MANAGE_PRODUCT_CATEGORIES = 'manage-product-categories';
    const PERMISSION_MANAGE_ATTRIBUTES = 'manage-attributes';

    const PERMISSIONS_ARRAY = [
        self::PERMISSION_VIEW_ADMIN_DASHBOARD => 'View admin dashboard - access to the admin dashboard',
        self::PERMISSION_MANAGE_USERS => 'Manage users - ability to create, update, and delete users',
        self::PERMISSION_MANAGE_ROLES => 'Manage roles - ability to create, update, and delete roles',
        self::PERMISSION_MANAGE_PRODUCTS => 'Manage products - ability to create, update, and delete products',
        self::PERMISSION_MANAGE_PRODUCT_CATEGORIES => 'Manage product categories - ability to create, update, and delete product categories',
        self::PERMISSION_MANAGE_ATTRIBUTES => 'Manage attributes - ability to create, update, and delete product attributes',
    ];
}
