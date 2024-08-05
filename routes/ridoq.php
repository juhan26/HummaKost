<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::resource('properties',PropertyController::class);
});
