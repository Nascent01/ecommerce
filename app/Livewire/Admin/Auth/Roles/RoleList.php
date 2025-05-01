<?php

namespace App\Livewire\Admin\Auth\Roles;

use App\Models\Auth\Role\Role;
use App\Traits\Sortable;
use Livewire\Component;

class RoleList extends Component
{
    use Sortable;

    public function clearFilters()
    {
      $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.auth.roles.role-list', [
            'roles' => Role::all(),
        ]);
    }
}
