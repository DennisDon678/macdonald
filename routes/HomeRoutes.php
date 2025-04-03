<?php

use App\Http\Controllers\HomeLayout\homeController;
use Illuminate\Support\Facades\Route;

Route::controller(homeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/about','about')->name('about');
    Route::get('/faq','faq')->name('faq');
    Route::get('/buy-btc','buyBtc')->name('buy-btc');
    Route::get('/support','support')->name('support');
    Route::get('/privacy','privacy')->name('privacy');
    Route::get('/auth/login','login')->name('login');
    Route::get('/auth/signup','signup')->name('signup');
    Route::get('/auth/forgot-password','forgotPassword')->name('forgot-password');
});