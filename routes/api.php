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

Route::get('category', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

Route::get('category/all/{id}', [CategoryController::class, 'all']);

Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::get('supplier', [SupplierController::class, 'index']);
Route::post('supplier', [SupplierController::class, 'store']);
Route::get('supplier/{id}', [SupplierController::class, 'show']);
Route::put('supplier/{id}', [SupplierController::class, 'update']);
Route::delete('supplier/{id}', [SupplierController::class, 'destroy']);

Route::get('supplier-product', [SuppliersProductsController::class, 'index']);
Route::post('supplier-product', [SuppliersProductsController::class, 'store']);
Route::get('supplier-product/{id}', [SuppliersProductsController::class, 'show']);
Route::put('supplier-product/{id}', [SuppliersProductsController::class, 'update']);
Route::delete('supplier-product/{id}', [SuppliersProductsController::class, 'destroy']);

