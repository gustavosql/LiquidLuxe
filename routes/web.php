<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product');




//Admin

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.product');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.product.create');
Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.product.store');

Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');
Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
