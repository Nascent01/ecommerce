<?php

namespace App\Providers;

use App\Repositories\Auth\Permission\PermissionRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Auth\Access\Response;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(GateContract $gate): void
    {
        $this->registerPolicies();

        if ($this->app->runningInConsole()) {
            return;
        }

        $permissions = (new PermissionRepository)->getPermissionWithRoles();

        foreach ($permissions as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles)
                    ? Response::allow()
                    : Response::deny();
            });
        }
    }
}
