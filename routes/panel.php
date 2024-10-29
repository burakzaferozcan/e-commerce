<?php

use Illuminate\Support\Facades\Route;


Route::group(["middleware" => "panelsetting","prefix"=>"panel"], function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name("panel");
});

