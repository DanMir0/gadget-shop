<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/logout', [AuthController::class, 'logout']);
Route::post('/api/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/api/reset-password', [\App\Http\Controllers\ResetPasswordController::class, 'reset']);
Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/api/product-categories', [FavoriteController::class, 'getProductsWithCategories']);
Route::middleware('auth:sanctum')->post('/api/favorites/{product}', [FavoriteController::class, 'toggle']);


Route::get('/products', [ProductController::class, 'index']);
Route::get('/api/products', [ProductController::class, 'getProducts']);
Route::get('/api/categories', [\App\Http\Controllers\CategorieController::class, 'getCategories']);

Route::get('/api/new-products', [\App\Http\Controllers\ProductStatusController::class, 'getNewProducts']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
});

Route::post('/api/cart', [CartController::class, 'postCart']);
Route::delete('/cart', [CartController::class, 'decreaseCart']);
Route::get('/api/get_cart', [CartController::class, 'getCart']);

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
