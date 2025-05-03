<?php

namespace App\Console\Commands\Permision;

use App\Constants\Auth\Permission\PermissionConstant;
use App\Models\Auth\Permission\Permission;
use App\Repositories\Auth\Permission\PermissionRepository;
use Illuminate\Console\Command;
use App\Traits\CommandTrait;

class SynchronizePermissions extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:synchronize-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize the permissions with the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scriptTimeStart = $this->displayCommandStart('Permissions synchronization has started...');

        $existingPermissions = (new PermissionRepository)->getAllPermissionNames();
        
        $permissionsFromConstant = PermissionConstant::PERMISSIONS_ARRAY;

        $permissionsToInsert = [];

        foreach ($permissionsFromConstant as $permissionName => $permissionDescription) {
            if (!isset($existingPermissions[$permissionName])) {
                $permissionsToInsert[] = [
                    'name' => $permissionName,
                    'description' => $permissionDescription,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        $this->bulkInsert(Permission::class, $permissionsToInsert);

        $this->displayExecutionTime($scriptTimeStart);
    }
}
