<?php

use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PaymentPerMonthController;
use App\Http\Controllers\UserController;
use App\Models\PaymentPerMonth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/update/{user}',[UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::resource('leases', LeaseController::class);

    Route::resource('payments', PaymentPerMonthController::class);

    Route::get('users/show/{user}', [UserController::class, 'show'])->name('user.show');

});

