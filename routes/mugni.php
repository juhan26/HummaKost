<?php

use App\Http\Controllers\InstanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('instance', InstanceController::class);

});



?>
