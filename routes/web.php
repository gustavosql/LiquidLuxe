<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', [homeController::class, 'index']);
Route::get('/product', [ProductController::class, 'show']);




//Admin

Route::get('/admin/products', [AdminProductController::class, 'index']);
Route::get('/admin/edit', [AdminProductController::class, 'edit']);
