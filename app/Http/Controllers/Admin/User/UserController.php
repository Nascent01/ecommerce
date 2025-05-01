<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User\User;
use App\Services\User\UserHandler;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserHandler $userHandler;
    
    public function __construct(UserHandler $userHandler)
    {
        $this->userHandler = $userHandler;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.user_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.user_edit', [
            'user' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
      $user = $this->userHandler->handleStore($request);

        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.users.user_edit', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
       $user = $this->userHandler->handleUpdate($request->all(), $id);

       return redirect()->route('admin.users.edit', $user->id)->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userHandler->handleDelete($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
