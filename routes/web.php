<?php

use App\Http\Controllers\{AdminController, LoginAdminController};
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


Route::get('/users', [AdminController::class, 'index'])->name('users');

Route::get('/login', [LoginAdminController::class, 'index'])->name('index');
Route::post('/login', [LoginAdminController::class, 'login'])->name('login');
Route::get('/logout', [LoginAdminController::class, 'logout'])->name('logout');