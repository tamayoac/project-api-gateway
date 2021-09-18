<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TodoController, UserController, LoginController};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);

// Todo App endpoint 
Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::get('/todos/{todos}', [TodoController::class, 'show']);
    Route::put('/todos/{todos}', [TodoController::class, 'update']);
    Route::patch('/todos/{todos}', [TodoController::class, 'update']);
    Route::delete('/todos/{todos}', [TodoController::class, 'destory']);
    Route::get('/user/me', [UserController::class, 'me']);
});

