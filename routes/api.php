<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('post', [PostController::class, 'create']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{categoryId}', [PostController::class, 'listCategory']);
    Route::post('category', [CategoryController::class, 'create']);
    Route::get('categories', [CategoryController::class, 'index']);
});
