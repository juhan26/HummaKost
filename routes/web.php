<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

require_once __DIR__ . '/chandra.php';
require_once __DIR__ . '/juhan.php';
require_once __DIR__ . '/ridoq.php';
require_once __DIR__ . '/sano.php';
