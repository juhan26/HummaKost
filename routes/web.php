<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacilityImageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyFacilityController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing.index');
});


Route::get('/login', function () {
    return view('auth.login')->name('login');
});
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register')->name('register');
});

// routes/web.php
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::post('/submit-feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');

Auth::routes();

Route::middleware(['auth', 'role:tenant|admin|super_admin'])->group(function () {
    // facilities
    Route::resource('facilities', FacilityController::class);
    // dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    //facility image controller
    Route::resource('facility_images', FacilityImageController::class);
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // properties add leader
    Route::post('/properties/addPropertyLeader',  [PropertyController::class, 'addPropertyLeader'])->name('properties.addPropertyLeader');
    Route::post('/properties/{property}/editPropertyLeader',  [PropertyController::class, 'editPropertyLeader'])->name('properties.editPropertyLeader');
    // property_facilities
    Route::resource('property_facilities', PropertyFacilityController::class);
    // leases done
    Route::put('/leases/{lease}/done', [LeaseController::class, 'done'])->name('leases.done');
});

// require_once __DIR__ . '/chandra.php';
require_once __DIR__ . '/juhan.php';
require_once __DIR__ . '/ridoq.php';
require_once __DIR__ . '/sano.php';
require_once __DIR__ . '/mugni.php';
