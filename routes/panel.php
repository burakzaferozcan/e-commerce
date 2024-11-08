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

    Route::get('/about', [AboutController::class,'index'])->name('about.index');
    Route::post('/about/update', [AboutController::class,'update'])->name('about.update');
});

