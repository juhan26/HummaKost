<?php

use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\PropertyFurnitureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('furnitures', FurnitureController::class);
    Route::resource('property_furnitures', PropertyFurnitureController::class);
});
