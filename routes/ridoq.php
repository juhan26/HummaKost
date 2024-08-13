<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;


Route::middleware(['auth'])->group(function () {
    Route::resource('properties',PropertyController::class);
    Route::post('/user/accept/{user}', [UserController::class, 'accept'])->name('user.accept');
    Route::post('/user/reject/{user}', [UserController::class, 'reject'])->name('user.reject');
});
