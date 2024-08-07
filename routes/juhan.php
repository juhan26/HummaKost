<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;



Route::get('/', [LandingController::class, 'index'])->name('home.index');
Route::get('/properties/show/{id}', [LandingController::class, 'show'])->name('home.show');