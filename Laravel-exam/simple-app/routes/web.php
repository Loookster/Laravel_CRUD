<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/store', [ProductController::class, 'store'])->name('products.store');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/dproducts/{id}', [ProductController::class, 'destroy'])->name('products.delete');
