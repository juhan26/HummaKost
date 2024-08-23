<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;
use App\Models\PropertyImage;

Route::middleware(['auth'])->group(function () {
    Route::post('/user/accept/{user}', [UserController::class, 'accept'])->name('user.accept');
    Route::post('/user/reject/{user}', [UserController::class, 'reject'])->name('user.reject');
    Route::post('/user/dismissHeadLease/{user}', [UserController::class, 'deletePropertyLeader'])->name('user.dismissHeadLease');

    Route::resource('property_images', PropertyImageController::class);
    Route::resource('properties', PropertyController::class);
});
