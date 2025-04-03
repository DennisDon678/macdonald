<?php

namespace App\Http\Controllers\HomeLayout;

use App\Http\Controllers\Controller;


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
}