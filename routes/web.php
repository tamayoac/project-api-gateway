<?php

use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\Admin\{AdminController, ApplicationController};
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginAdminController::class, 'index'])->name('index');
Route::post('/login', [LoginAdminController::class, 'login'])->name('login');
Route::get('/logout', [LoginAdminController::class, 'logout'])->name('logout');

Route::middleware(['is.admin', 'auth'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('user.show');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
});
