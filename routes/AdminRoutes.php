<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Protected Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Admin Profile
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password');
    
    // User Management
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::put('users/{user}/status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::put('users/{user}/verify', [UserController::class, 'verifyUser'])->name('admin.users.verify');
    Route::get('users/{user}/login-as', [UserController::class, 'loginAs'])->name('admin.users.login-as');
    Route::post('users/{user}/adjust-balance', [UserController::class, 'adjustBalance'])->name('admin.users.adjust-balance');
    
    // Investment Plans
    Route::resource('plans', PlanController::class)->names([
        'index' => 'admin.plans.index',
        'create' => 'admin.plans.create',
        'store' => 'admin.plans.store',
        'show' => 'admin.plans.show',
        'edit' => 'admin.plans.edit',
        'update' => 'admin.plans.update',
        'destroy' => 'admin.plans.destroy',
    ]);
    Route::put('plans/{plan}/toggle', [PlanController::class, 'toggleStatus'])->name('admin.plans.toggle-status');
    
    // Investments
    Route::resource('investments', InvestmentController::class)->names([
        'index' => 'admin.investments.index',
        'create' => 'admin.investments.create',
        'store' => 'admin.investments.store',
        'show' => 'admin.investments.show',
        'edit' => 'admin.investments.edit',
        'update' => 'admin.investments.update',
        'destroy' => 'admin.investments.destroy',
    ]);
    Route::put('investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('admin.investments.approve');
    Route::put('investments/{investment}/reject', [InvestmentController::class, 'reject'])->name('admin.investments.reject');
    Route::put('investments/{investment}/terminate', [InvestmentController::class, 'terminate'])->name('admin.investments.terminate');
    
    // Deposits
    Route::resource('deposits', DepositController::class)->except(['create', 'store'])->names([
        'index' => 'admin.deposits.index',
        'show' => 'admin.deposits.show',
        'edit' => 'admin.deposits.edit',
        'update' => 'admin.deposits.update',
        'destroy' => 'admin.deposits.destroy',
    ]);
    Route::post('deposits/{deposit}/approve', [DepositController::class, 'approve'])->name('admin.deposits.approve');
    Route::post('deposits/{deposit}/reject', [DepositController::class, 'reject'])->name('admin.deposits.reject');
    
    // Withdrawals
    Route::resource('withdrawals', WithdrawalController::class)->except(['create', 'store'])->names([
        'index' => 'admin.withdrawals.index',
        'show' => 'admin.withdrawals.show',
        'edit' => 'admin.withdrawals.edit',
        'update' => 'admin.withdrawals.update',
        'destroy' => 'admin.withdrawals.destroy',
    ]);
    Route::post('withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('admin.withdrawals.approve');
    Route::post('withdrawals/{withdrawal}/reject', [WithdrawalController::class, 'reject'])->name('admin.withdrawals.reject');
    
    // Payment Methods
    Route::resource('payment-methods', PaymentMethodController::class)->names([
        'index' => 'admin.payment-methods.index',
        'create' => 'admin.payment-methods.create',
        'store' => 'admin.payment-methods.store',
        'show' => 'admin.payment-methods.show',
        'edit' => 'admin.payment-methods.edit',
        'update' => 'admin.payment-methods.update',
        'destroy' => 'admin.payment-methods.destroy',
    ]);
    Route::put('payment-methods/{method}/toggle', [PaymentMethodController::class, 'toggleStatus'])->name('admin.payment-methods.toggle');
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('settings/general', [SettingController::class, 'updateGeneral'])->name('admin.settings.general');
    Route::put('settings/email', [SettingController::class, 'updateEmail'])->name('admin.settings.email');
    Route::put('settings/security', [SettingController::class, 'updateSecurity'])->name('admin.settings.security');
    
    // Support Tickets
    Route::get('tickets', [AdminController::class, 'tickets'])->name('admin.tickets.index');
    Route::get('tickets/{ticket}', [AdminController::class, 'showTicket'])->name('admin.tickets.show');
    Route::post('tickets/{ticket}/reply', [AdminController::class, 'replyTicket'])->name('admin.tickets.reply');
    Route::put('tickets/{ticket}/close', [AdminController::class, 'closeTicket'])->name('admin.tickets.close');
    
    // Audit Logs
    Route::get('activity-logs', [AdminController::class, 'activityLogs'])->name('admin.activity-logs');
    
    // Logout
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
});