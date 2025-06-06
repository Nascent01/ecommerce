<?php

use App\Http\Controllers\Admin\Auth\Role\RoleController;
use App\Http\Controllers\Admin\Product\ProductAttributeController;
use App\Http\Controllers\Admin\Product\ProductCategoryController;
use App\Http\Controllers\Admin\Product\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserController;

Route::name('admin.')->prefix('admin')->middleware('adminAuth')->group(function () {
    Route::view('/dashboard', 'admin.dashboard.dashboard')->name('dashboard');

    Route::resource('users', UserController::class)->except(['show'])->middleware('can:manage-users');

    Route::resource('roles', RoleController::class)->except(['show'])->middleware('can:manage-roles');

    Route::resource('products', ProductController::class)->except(['show'])->middleware('can:manage-products');
    Route::resource('product-categories', ProductCategoryController::class)->except(['show', 'destroy'])->middleware('can:manage-product-categories');
    Route::resource('product-attributes', ProductAttributeController::class)->except(['show', 'destroy'])->middleware('can:manage-attributes');
});
