<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;



Route::get('/home', [LandingController::class, 'index'])->name('home.index');
Route::get('/home/show.{id}', [LandingController::class, 'show'])->name('home.show');