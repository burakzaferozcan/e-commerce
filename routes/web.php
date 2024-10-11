<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageHomeController::class, 'index'])->name("home");
Route::get('/about', [PageController::class, 'about'])->name("about");
Route::get('/contact', [PageController::class, 'contact'])->name("contact");
Route::get('/products', [PageController::class, 'products'])->name("products");
Route::get('/products/detail', [PageController::class, 'product_detail'])->name("product_detail");
Route::get('/cart', [PageController::class, 'cart'])->name("cart");

