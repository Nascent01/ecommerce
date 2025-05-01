<?php

namespace App\Livewire\Admin\Auth\Permissions;

use App\Models\Auth\Permission\Permission;
use App\Traits\Sortable;
use Livewire\Component;

class PermissionList extends Component
{
    use Sortable;

    public function clearFilters()
    {
      $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.auth.permissions.permission-list', [
            'permissions' => Permission::all(),
        ]);
    }
}
