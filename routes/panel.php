<?php

use Illuminate\Support\Facades\Route;


Route::group(["middleware" => ["panelsetting","auth"],"prefix"=>"panel","as"=>"panel."], function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name("index");
    Route::get('/slider', [\App\Http\Controllers\Backend\SliderController::class, 'index'])->name("slider.index");
    Route::get('/slider/create', [\App\Http\Controllers\Backend\SliderController::class, 'create'])->name("slider.create");
    Route::get('/slider/{id}/edit', [\App\Http\Controllers\Backend\SliderController::class,'edit'])->name('slider.edit');
    Route::post('/slider/store', [\App\Http\Controllers\Backend\SliderController::class, 'store'])->name("slider.store");
    Route::put('/slider/{id}/update', [\App\Http\Controllers\Backend\SliderController::class, 'update'])->name("slider.update");
    Route::delete('/slider/destroy', [\App\Http\Controllers\Backend\SliderController::class, 'destroy'])->name("slider.destroy");
    Route::post('/slider-status/update', [\App\Http\Controllers\Backend\SliderController::class, 'status'])->name("slider.status");

    Route::resource('/category', \App\Http\Controllers\Backend\CategoryController::class)->except('destroy');
    Route::delete('/category/destroy', [\App\Http\Controllers\Backend\CategoryController::class,'destroy'])->name('category.destroy');
    Route::post('/category-status/update', [\App\Http\Controllers\Backend\CategoryController::class,'status'])->name('category.status');

    Route::get('/about', [\App\Http\Controllers\Backend\AboutController::class,'index'])->name('about.index');
    Route::post('/about/update', [\App\Http\Controllers\Backend\AboutController::class,'update'])->name('about.update');

    Route::get('/contact', [\App\Http\Controllers\Backend\ContactController::class,'index'])->name('contact.index');
    Route::get('/contact/{id}/edit', [\App\Http\Controllers\Backend\ContactController::class,'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [\App\Http\Controllers\Backend\ContactController::class,'update'])->name('contact.update');
    Route::delete('/contact/destroy', [\App\Http\Controllers\Backend\ContactController::class,'destroy'])->name('contact.destroy');
    Route::post('/contact-durum/update', [\App\Http\Controllers\Backend\ContactController::class,'status'])->name('contact.status');

    Route::get('/setting', [\App\Http\Controllers\Backend\SettingController::class,'index'])->name('setting.index');
    Route::get('/setting/create', [\App\Http\Controllers\Backend\SettingController::class,'create'])->name('setting.create');
    Route::post('/setting/store', [\App\Http\Controllers\Backend\SettingController::class,'store'])->name('setting.store');
    Route::get('/setting/{id}/edit', [\App\Http\Controllers\Backend\SettingController::class,'edit'])->name('setting.edit');
    Route::put('/setting/{id}/update', [\App\Http\Controllers\Backend\SettingController::class,'update'])->name('setting.update');
    Route::delete('/setting/destroy', [\App\Http\Controllers\Backend\SettingController::class,'destroy'])->name('setting.destroy');

    Route::resource('/product', ProductController::class)->except('destroy');
    Route::delete('/product/destroy', [ProductController::class,'destroy'])->name('product.destroy');
    Route::post('/product-durum/update', [ProductController::class,'status'])->name('product.status');
});

