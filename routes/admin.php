<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\UserController;

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::get('/', 'index')->name('index');
    });
});