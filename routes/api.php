<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SuppliersProductsController;

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

Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);

Route::get('suppliers', [SupplierController::class, 'index']);
Route::post('suppliers', [SupplierController::class, 'store']);
Route::get('suppliers/{id}', [SupplierController::class, 'show']);
Route::put('suppliers/{id}', [SupplierController::class, 'update']);
Route::delete('suppliers/{id}', [SupplierController::class, 'destroy']);

Route::get('suppliers-products', [SuppliersProductsController::class, 'index']);
Route::post('suppliers-products', [SuppliersProductsController::class, 'store']);
Route::get('suppliers-products/{id}', [SuppliersProductsController::class, 'show']);
Route::put('suppliers-products/{id}', [SuppliersProductsController::class, 'update']);
Route::delete('suppliers-products/{id}', [SuppliersProductsController::class, 'destroy']);

