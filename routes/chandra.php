<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacilityImageController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyFacilityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    // Route::post('/facilities/upload', [FacilityController::class, 'upload'])->name('facilities.upload');
    Route::put('/leases/{lease}/done', [LeaseController::class, 'done'])->name('leases.done');
    Route::resource('facility_images', FacilityImageController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('property_facilities', PropertyFacilityController::class);

    Route::post('/properties/addPropertyLeader',  [PropertyController::class, 'addPropertyLeader'])->name('properties.addPropertyLeader');
    Route::post('/properties/{property}/editPropertyLeader',  [PropertyController::class, 'editPropertyLeader'])->name('properties.editPropertyLeader');
});
