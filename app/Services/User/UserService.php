<?php

namespace App\Services\User;

use App\Models\User\User;

class UserService
{
    public function create($data): User
    {
        return User::create($data);
    }

    public function update(User $user, $data): User
    {
        $user->update($data);
        return $user;
    }
}
