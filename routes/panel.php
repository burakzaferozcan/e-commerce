<?php

use Illuminate\Support\Facades\Route;


Route::group(["middleware" => ["panelsetting","auth"],"prefix"=>"panel","as"=>"panel"], function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name("index");
});

