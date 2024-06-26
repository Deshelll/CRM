<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');
    Route::post('users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin/permissions', [UserController::class, 'permissions'])->name('admin.permissions');
    Route::post('users/{user}/update-permissions', [UserController::class, 'updatePermissions'])->name('users.update-permissions');
});
