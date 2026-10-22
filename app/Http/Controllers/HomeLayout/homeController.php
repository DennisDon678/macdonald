<?php

namespace App\Http\Controllers\HomeLayout;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    private function getThemeView($viewName)
    {
        $theme = env('ACTIVE_THEME', 'theme1');
        if (view()->exists("{$theme}.{$viewName}")) {
            return "{$theme}.{$viewName}";
        }
        if ($theme === 'theme3') {
            return "theme3.{$viewName}";
        }
        if ($theme === 'theme2') {
            return "theme2.{$viewName}";
        }
        return $viewName;
    }

    public function index()
    {
        return view($this->getThemeView('welcome'));
    }

    public function about()
    {
        return view($this->getThemeView('about'));
    }

    public function faq(){
        return view($this->getThemeView('faq'));
    }

    public function support(){
        return view($this->getThemeView('support'));
    }

    public function privacy(){
        return view($this->getThemeView('privacy'));
    }

    public function login(){
        return view($this->getThemeView('login'));
    }
    public function signup(){
        return view($this->getThemeView('signup'));
    }

    public function forgotPassword(){
        return view($this->getThemeView('forgot-password'));
    }
    
    public function buyBtc(){
        return view($this->getThemeView('buy-btc'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success','Logged out successfully!');
    }
}