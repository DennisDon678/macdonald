<?php

use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\WithdrawalController;
use Illuminate\Support\Facades\Route;

// Existing routes...

// Transaction routes
Route::group(['prefix' => 'deposits', 'as' => 'deposits.'], function () {
    Route::get('/', [DepositController::class, 'index'])->name('index');
    Route::get('/{deposit}', [DepositController::class, 'show'])->name('show');
    Route::post('/{deposit}/approve', [DepositController::class, 'approve'])->name('approve');
    Route::post('/{deposit}/reject', [DepositController::class, 'reject'])->name('reject');
});

Route::group(['prefix' => 'withdrawals', 'as' => 'withdrawals.'], function () {
    Route::get('/', [WithdrawalController::class, 'index'])->name('index');
    Route::get('/{withdrawal}', [WithdrawalController::class, 'show'])->name('show');
    Route::post('/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('approve');
    Route::post('/{withdrawal}/reject', [WithdrawalController::class, 'reject'])->name('reject');
});
