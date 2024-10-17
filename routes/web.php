<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "sitesetting"], function () {
    Route::get('/', [PageHomeController::class, 'index'])->name("home");
    Route::get('/about', [PageController::class, 'about'])->name("about");
    Route::get('/contact', [PageController::class, 'contact'])->name("contact");
    Route::post('/contact/save', [AjaxController::class, 'contact_save'])->name("contact.save");
    Route::get('/products', [PageController::class, 'products'])->name("products");
    Route::get('/mens_products', [PageController::class, 'products'])->name("mens_products");
    Route::get('/womens_products', [PageController::class, 'products'])->name("womens_products");
    Route::get('/childrens_products', [PageController::class, 'products'])->name("childrens_products");
    Route::get('/sale_products', [PageController::class, 'sale_products'])->name("sale_products");

    Route::get('/product/detail', [PageController::class, 'product_detail'])->name("product_detail");
    Route::get('/cart', [PageController::class, 'cart'])->name("cart");
});


