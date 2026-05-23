<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);

        // grab the user balance, and referral balance
        $balances = $user->balances;

        // grab the user transactions
        $transactions = $user->transactions()->latest()->take(5)->get();

        // grab interest
        $interest = Investment::where('user_id', $user->id)->sum('profit_to_date');

        // pending balance
        $deposit = Transaction::where('user_id', $user->id)->where('type','deposit')->where('status', 'pending')->sum('amount');

        $withdrawal = Transaction::where('user_id', $user->id)->where('type','withdrawal')->where('status', 'pending')->sum('amount');

        $pending = (object) [
            'deposit' => $deposit,
            'withdrawal' => $withdrawal,
        ];

        // active deposits
        $active_deposits = Investment::where('user_id', $user->id)->where('status', 'active')->sum('amount');

        return view('dashboard.index', compact('balances', 'transactions', 'interest', 'pending', 'active_deposits'));
    }
}
