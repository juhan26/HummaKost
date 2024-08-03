<?php

use App\Http\Controllers\FinancialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/financials', [FinancialController::class, 'index'])->name('financial.index');
    Route::post('/financial/store', [FinancialController::class, 'store'])->name('financial.store');
    Route::put('/financial/update/{financial}', [FinancialController::class, 'update'])->name('financial.update');
    Route::delete('/financial/{financial}', [FinancialController::class, 'destroy'])->name('financial.destroy');

    Route::put('/financial/accept/{financial}', [FinancialController::class, 'accept'])->name('financial.accept');
});
