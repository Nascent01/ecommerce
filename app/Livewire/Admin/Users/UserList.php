<?php

namespace App\Livewire\Admin\Users;

use App\Models\User\User;
use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        return view('livewire.admin.users.user-list', [
            'users' => User::all(),
        ]);
    }
}
