<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SchoolController;

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    Route::resource('school', SchoolController::class);

});



?>
