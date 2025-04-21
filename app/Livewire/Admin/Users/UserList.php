<?php

namespace App\Livewire\Admin\Users;

use App\Models\User\User;
use Livewire\Component;

class UserList extends Component
{
    public $name, $email;

    public function clearFilters()
    {
      $this->reset();
    }

    public function render()
    {
        $userQb = User::fillter($this->name, $this->email);

        return view('livewire.admin.users.user-list', [
            'users' => $userQb->latest()->paginate(10),
        ]);
    }
}
