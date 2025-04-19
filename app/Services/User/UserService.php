<?php

namespace App\Services\User;

use App\Models\User\User;

class UserService
{
    public function create($array)
    {
        return User::create($array);
    }
}
