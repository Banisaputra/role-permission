<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
   
Route::middleware(['auth'])->group(function () {
    Route::middleware(['permission:manage_users'])->resource('users', UserController::class);
    Route::middleware(['permission:manage_roles'])->resource('roles', RoleController::class);
    Route::middleware(['permission:manage_permissions'])->resource('permissions', PermissionController::class);
    Route::middleware(['permission:manage_menus'])->resource('menus', MenuController::class);
});