<?php

use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyFurnitureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('furnitures', FurnitureController::class);
    Route::resource('property_furnitures', PropertyFurnitureController::class);

    Route::post('/properties/addPropertyLeader',  [PropertyController::class, 'addPropertyLeader'])->name('properties.addPropertyLeader');
    Route::post('/properties/{property}/editPropertyLeader',  [PropertyController::class, 'editPropertyLeader'])->name('properties.editPropertyLeader');
});
