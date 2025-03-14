<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function () {
    // Users routes
    Route::get('users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('users/{id}/assign', [AdminController::class, 'assignUser'])->name('admin.users.assign');

    // Roles routes
    Route::get('roles', [AdminController::class, 'indexRoles'])->name('admin.roles.index');
    Route::get('roles/create', [AdminController::class, 'createRole'])->name('admin.roles.create');
    Route::post('roles', [AdminController::class, 'storeRole'])->name('admin.roles.store');
    Route::get('roles/{id}/edit', [AdminController::class, 'editRole'])->name('admin.roles.edit');
    Route::put('roles/{id}', [AdminController::class, 'updateRole'])->name('admin.roles.update');
    Route::delete('roles/{id}', [AdminController::class, 'destroyRole'])->name('admin.roles.destroy');

    // Permissions routes
    Route::get('permissions', [AdminController::class, 'indexPermissions'])->name('admin.permissions.index');
    Route::get('permissions/create', [AdminController::class, 'createPermission'])->name('admin.permissions.create');
    Route::post('permissions', [AdminController::class, 'storePermission'])->name('admin.permissions.store');
    Route::get('permissions/{id}/edit', [AdminController::class, 'editPermission'])->name('admin.permissions.edit');
    Route::put('permissions/{id}', [AdminController::class, 'updatePermission'])->name('admin.permissions.update');
    Route::delete('permissions/{id}', [AdminController::class, 'destroyPermission'])->name('admin.permissions.destroy');
});

require __DIR__ . '/auth.php';
