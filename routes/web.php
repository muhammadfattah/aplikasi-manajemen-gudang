<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\RoleController as AdminRole;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Models\Role;

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
    return redirect()->to('/login');
});

Route::get('/home', function () {
    if (auth()->user()->hasRole(Role::ADMIN) || auth()->user()->hasRole(Role::MANAJERPUSAT) || auth()->user()->hasRole(Role::ADMINPUSAT)) {
        return redirect()->to('/admin/gudang-pusat/stok-barang');
    } else if (auth()->user()->hasRole(Role::MANAJERCABANG) || auth()->user()->hasRole(Role::ADMINCABANG)) {
        return redirect()->to('/admin/gudang-cabang/stok-barang');
    } else {
        return redirect()->to('/admin/outlet/stok-barang');
    }
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard.index');

    Route::get('roles/reload-permissions/{id}', [AdminRole::class, 'reloadPermissions'])->name('roles.update');
    Route::get('roles/reload-permissions', [AdminRole::class, 'reloadPermissions'])->name('roles.update');
    Route::resource('roles', AdminRole::class);
    Route::resource('users', AdminUser::class);

    Route::get('settings/remove/{id}', [AdminSetting::class, 'remove'])->name('settings.update');
    Route::get('settings', [AdminSetting::class, 'index'])->name('settings.update');
    Route::post('settings', [AdminSetting::class, 'update'])->name('settings.update');
});
