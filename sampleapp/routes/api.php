<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/users', [UserController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    Route::prefix('/users')->group(function () {
        Route::get('', [UserController::class, 'index']);
        Route::get('/{user_id}', [UserController::class, 'show']);
        Route::put('', [UserController::class, 'update']);
        Route::delete('/{user_id}', [UserController::class, 'destroy']);
    });

    Route::prefix('/posts')->group(function () {
        Route::get('', [PostController::class, 'index']);
        Route::get('/{post_id}', [PostController::class, 'show']);
        Route::post('', [PostController::class, 'store']);
        Route::put('', [PostController::class, 'update']);
        Route::delete('{post_id}', [PostController::class, 'destroy']);
    });
});

