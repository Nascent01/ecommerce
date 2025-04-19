<?php

namespace Database\Seeders;

use App\Constants\Auth\Permission\PermissionConstant;
use App\Constants\Auth\Role\RoleConstant;
use App\Repositories\Auth\Permission\PermissionRepository;
use App\Repositories\Auth\Role\RoleRepository;
use App\Services\Auth\Permission\PermissionService;
use App\Services\Auth\Role\RoleService;
use App\Services\User\UserService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(
        PermissionService $permissionService,
        RoleService $roleService,
        UserService $userService,
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository
    ): void {
        $user = $userService->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $permissions = PermissionConstant::PERMISSIONS_ARRAY;

        foreach ($permissions as $permission => $description) {
            $permissionService->create([
                'name' => $permission,
                'description' => $description,
            ]);
        }

        $roles = RoleConstant::ROLES_ARRAY;

        foreach ($roles as $role => $description) {
            $roleService->create([
                'name' => $role,
                'description' => $description,
            ]);
        }

        $adminRole = $roleRepository->getByName(RoleConstant::ROLE_ADMIN);

        $user->roles()->attach($adminRole->id);
        $adminRole->permissions()->attach($permissionRepository->getAllPermissionIds());
    }
}
