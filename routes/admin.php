<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserController;

Route::name('admin.')->prefix('admin')->middleware('adminAuth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('users', UserController::class);
});
