<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::get('/api/categories', [\App\Http\Controllers\CategorieController::class, 'getCategories']);

Route::get('/api/new-products', [\App\Http\Controllers\ProductStatusController::class, 'getNewProducts']);

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
