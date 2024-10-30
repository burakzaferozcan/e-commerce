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
    Route::get('/mens_products/{slug?}', [PageController::class, 'products'])->name("erkek_products");
    Route::get('/womens_products/{slug?}', [PageController::class, 'products'])->name("kadin_products");
    Route::get('/childrens_products/{slug?}', [PageController::class, 'products'])->name("cocuk_products");
    Route::get('/sale_products', [PageController::class, 'sale_products'])->name("sale_products");
    Route::get('/product/{slug}', [PageController::class, 'product_detail'])->name("product_detail");
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name("cart");
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name("cart.add");
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name("cart.remove");
    Auth::routes();
Route::get("/logout",[AjaxController::class,"logout"])->name("logout");
});
