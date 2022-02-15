<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::get('/auth', [AuthController::class, 'auth']);
Route::get('/products', [ProductController::class, 'findAll']);
Route::get('/products/{product}', [ProductController::class, 'findOne']);

Route::get('/orders', [OrderController::class, 'findAll']);
Route::get('/orders/{order}', [OrderController::class, 'findOne']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::delete('/orders/{order}', [OrderController::class, 'delete']);

Route::get('/customers', [CustomerController::class, 'findAll']);
