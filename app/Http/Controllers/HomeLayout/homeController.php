<?php

namespace App\Http\Controllers\HomeLayout;

use App\Http\Controllers\Controller;
use App\Services\ThemeService;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        return ThemeService::view('welcome');
    }

    public function about()
    {
        return ThemeService::view('about');
    }

    public function faq()
    {
        return ThemeService::view('faq');
    }

    public function support()
    {
        return ThemeService::view('support');
    }

    public function privacy()
    {
        return ThemeService::view('privacy');
    }

    public function login()
    {
        return ThemeService::view('login');
    }

    public function signup()
    {
        return ThemeService::view('signup');
    }

    public function forgotPassword()
    {
        return ThemeService::view('forgot-password');
    }
    
    public function buyBtc()
    {
        return ThemeService::view('buy-btc');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}