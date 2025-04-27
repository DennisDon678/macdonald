<?php


// import layout Routes

use App\Mail\Welcome;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/HomeRoutes.php';

// import dashboard Routes
require_once __DIR__ . '/DashboardRoutes.php';

// import admin Routes
require_once __DIR__ . '/AdminRoutes.php';

// test routes

Route::get('/test', function () {
    $user = \App\Models\User::find(1);
    Mail::to($user->email,'Denn')->send(new Welcome($user));
    return 'Email sent to ' . $user->email;
})->name('test');

Route::prefix('command')->group(function () {
    Route::get('/storage',function () {
        Artisan::call('storage:link');
        return 'Storage link created';
    });
});