<?php

use App\Http\Controllers\InstanceController;
use App\Http\Controllers\PropertyImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('instance', InstanceController::class);

    Route::delete('/property-images/delete-selected', [PropertyImageController::class, 'destroySelected'])->name('property_images.destroySelected');


});



?>
