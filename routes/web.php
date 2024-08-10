<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing.index');
});


Route::get('/login', function () {
    return view('auth.login')->name('login');
});
Route::get('/register', function () {
    return view('auth.register')->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});
Auth::routes();

require_once __DIR__ . '/chandra.php';
require_once __DIR__ . '/juhan.php';
require_once __DIR__ . '/ridoq.php';
require_once __DIR__ . '/sano.php';
