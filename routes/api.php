<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\BasketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Public routes
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/', [ProductController::class, 'index']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//Admin routes
Route::middleware(['auth:sanctum', 'role:Admin'])->group( function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
// User routes
Route::middleware(['auth:sanctum', 'role:Admin|User'])->group( function () {
    Route::post('/basket/{id}', [BasketController::class, 'store']);
    Route::delete('/basket/{id}', [BasketController::class, 'destroy']);
    Route::get('/basket', [BasketController::class, 'index']);
});
