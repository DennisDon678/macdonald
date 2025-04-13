<?php

use App\Http\Controllers\Auth\UserAuth;
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
    Route::get('/auth/signup','signup')->name('register');
    Route::post('/auth/logout','logout')->name('logout');
    Route::get('/auth/forgot-password','forgotPassword')->name('forgot-password');
});

// routes for user auth
Route::controller(UserAuth::class)->group(function(){
    Route::post('/auth/login','Login')->name('login.post');
    Route::post('/auth/signup','Register')->name('register.post');
    Route::post('/auth/forgot-password','ForgotPassword')->name('forgot-password.post');
});