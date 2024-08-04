<?php

use App\Http\Controllers\DailyScheduleController;
use App\Http\Controllers\FinancialController;
use App\Models\DailySchedule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/financials', [FinancialController::class, 'index'])->name('financial.index');
    Route::post('/financial/store', [FinancialController::class, 'store'])->name('financial.store');
    Route::put('/financial/update/{financial}', [FinancialController::class, 'update'])->name('financial.update');
    Route::delete('/financial/{financial}', [FinancialController::class, 'destroy'])->name('financial.destroy');

    Route::put('/financial/accept/{financial}', [FinancialController::class, 'accept'])->name('financial.accept');

    Route::get('/dailyschedules', [DailyScheduleController::class, 'index'])->name('dailyschedule.index');
    Route::post('/dailyschedules/random', [DailyScheduleController::class, 'random'])->name('dailyschedule.random');
});
