<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InvestmentController;
use App\Http\Controllers\Dashboard\DepositController;
use App\Http\Controllers\Dashboard\WithdrawalController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\WalletController;
use App\Http\Controllers\Dashboard\ReferralController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Route;

// Main Dashboard Routes
Route::middleware([])->prefix('dashboard')->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/overview', [DashboardController::class, 'overview'])->name('dashboard.overview');
    
    // Investment Routes
    Route::controller(InvestmentController::class)->group(function () {
        Route::get('/investments', 'index')->name('dashboard.investments');
        Route::get('/investments/create/{plan}', 'create')->name('dashboard.investments.create');
        Route::post('/investments/store', 'store')->name('dashboard.investments.store');
        Route::get('/investments/{investment}', 'show')->name('dashboard.investments.show');
    });
    
    // Deposit Routes
    Route::controller(DepositController::class)->group(function () {
        Route::get('/deposits/create', 'create')->name('dashboard.deposits.create');
        Route::post('/deposits/store', 'store')->name('dashboard.deposits.store');
        Route::get('/deposits/history', 'history')->name('dashboard.deposits.history');
        Route::get('/deposits/{deposit}', 'show')->name('dashboard.deposits.show');
        Route::get('/deposits/confirm/{reference}', 'confirm')->name('dashboard.deposits.confirm');
    });
    
    // Withdrawal Routes
    Route::controller(WithdrawalController::class)->group(function () {
        Route::get('/withdrawals/create', 'create')->name('dashboard.withdrawals.create');
        Route::post('/withdrawals/store', 'store')->name('dashboard.withdrawals.store');
        Route::get('/withdrawals/history', 'history')->name('dashboard.withdrawals.history');
        Route::get('/withdrawals/{withdrawal}', 'show')->name('dashboard.withdrawals.show');
    });
    
    // Transaction Routes
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index')->name('dashboard.transactions');
        Route::get('/transactions/{transaction}', 'show')->name('dashboard.transactions.show');
    });
    
    // Wallet Routes
    Route::controller(WalletController::class)->group(function () {
        Route::get('/wallet', 'index')->name('dashboard.wallet');
        Route::get('/wallet/addresses', 'addresses')->name('dashboard.wallet.addresses');
        Route::post('/wallet/update', 'update')->name('dashboard.wallet.update');
    });
    
    // Referral Routes
    Route::controller(ReferralController::class)->group(function () {
        Route::get('/referrals', 'index')->name('dashboard.referrals');
        Route::get('/referrals/marketing', 'marketing')->name('dashboard.referrals.marketing');
    });
    
    // User Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('dashboard.profile');
        Route::post('/profile/update', 'update')->name('dashboard.profile.update');
        Route::get('/profile/security', 'security')->name('dashboard.profile.security');
        Route::post('/profile/password', 'updatePassword')->name('dashboard.profile.password');
    });
    
    // Settings Routes
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('dashboard.settings');
        Route::post('/settings/update', 'update')->name('dashboard.settings.update');
    });
});