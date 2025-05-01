<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class UserHandler
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handleStore($request)
    {
        $user = $this->userService->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return $user;
    }

    public function handleUpdate($request, $id)
    {
        $user = User::find($id);

        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request['password']) {
            $user->password = Hash::make($request['password']);
        }

        $user->save();

        return $user;
    }

    public function handleDelete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}