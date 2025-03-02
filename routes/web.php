<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\CourseController;
use App\Http\Controllers\Auth\AdminAuthController;

Route::get('/', function () {
    return view('admin.login');
});


// require __DIR__.'/auth.php';

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/courses', CourseController::class);
});
