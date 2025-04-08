<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = User::find(Auth::user()->id);
    }
    public function index()
    {
        // grab the user balance, and referral balance
        $balances = $this->user->balances; 

        // grab the user transactions
        $transactions = $this->user->transactions()->latest()->take(5)->get();


        return view('dashboard.index', compact('balances', 'transactions'));
    }
}