<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Dashboard\Http\Controllers\Admin\AdminController;
use Modules\Dashboard\Http\Controllers\DashboardAuth\LoginController;
use Modules\Dashboard\Http\Controllers\DashboardAuth\LogoutController;
use Modules\Dashboard\Http\Controllers\DashboardAuth\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/dashboard')->group(function () {
    // Authentication Routes
    Route::group([], function () {

        Route::group(['middleware' => 'guest:admin'], function () {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.view');
            Route::post('login', [LoginController::class, 'login'])->name('login.post');
        });

        Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    });

    Route::middleware(['dashboard-auth'])->group(function () {
        // Home
        Route::get('/', [DashboardController::class, 'showDashboardHome'])->name('home');

        // Manage Admins
        Route::resource('admins', AdminController::class);

        // Change Password
        Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
        Route::patch('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password.update');
    });
});
