<?php

namespace App\Http\Controllers\HomeLayout;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function faq(){
        return view('faq');
    }

    public function support(){
        return view('support');
    }

    public function privacy(){
        return view('privacy');
    }

    public function login(){
        return view('login');
    }
    public function signup(){
        return view('signup');
    }

    public function forgotPassword(){
        return view('forgot-password');
    }
    
    public function buyBtc(){
        return view('buy-btc');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success','Logged out successfully!');
    }
}