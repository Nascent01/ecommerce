<?php

namespace App\Livewire\Admin\Users;

use App\Models\User\User;
use App\Repositories\Auth\Role\RoleRepository;
use App\Traits\Sortable;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use Sortable, WithPagination;

    public $name, $email;
    public User $user;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedRoles = [];

    public function clearFilters()
    {
        $this->reset();
    }

    public function openUserRolesModal(User $user)
    {
        $this->user = $user;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
    }

    public function saveUserRoles()
    {
        $this->validate([
            'selectedRoles' => 'required',
        ]);

        $this->user->roles()->sync($this->selectedRoles);

        session()->flash('success', 'Roles updated successfully.');

        $this->dispatch('closeModal');
    }

    public function render()
    {
        $usersQb = User::filter($this->name, $this->email);

        return view('livewire.admin.users.user-list', [
            'users' => $usersQb->orderBy($this->sortField, $this->sortDirection)->paginate(10),
            'roles' => (new RoleRepository())->getRoles(),
        ]);
    }
}
