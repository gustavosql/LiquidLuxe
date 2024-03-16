<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product');




//Admin

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
Route::get('/admin/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
