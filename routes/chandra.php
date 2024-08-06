<?php

use App\Http\Controllers\FurnitureController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('furnitures', FurnitureController::class);
});
