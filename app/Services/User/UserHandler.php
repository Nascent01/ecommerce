<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserHandler
{
    public function __construct(
        private UserService $userService
    ) {}

    public function handleStore($data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userService->create($data);
    }

    public function handleUpdate($data, User $user): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userService->update($user, $data);
    }
}
