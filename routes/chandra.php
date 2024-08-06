<?php

use App\Http\Controllers\FurnitureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('furnitures', FurnitureController::class);
});
