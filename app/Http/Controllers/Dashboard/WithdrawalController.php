<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;

class WithdrawalController extends Controller
{
    /**
     * Show the withdrawal creation form.
     */
    public function create()
    {
        // Placeholder for available balance
        $availableBalance = Auth::user()->balances->balance;
        $pendingWithdrawals = Transaction::where('user_id', Auth::id())
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->sum('amount');

        // Get user's saved wallets (placeholder)
        $wallets = Wallet::where('user_id', Auth::id())->first();
        $savedWallets = [
            [
                'id' => 1,
                'name' => 'Bitcoin Wallet',
                'currency' => 'btc',
                'address' => $wallets->btc_address,
            ],
            [
                'id' => 2,
                'name' => 'ETH Wallet',
                'currency' => 'eth',
                'address' => $wallets->eth_address,
            ],
            [
                'id' => 3,
                'name' => 'USDT Wallet',
                'currency' => 'usdt',
                'address' => $wallets->usdt_address,
            ],
           
        ];

        return view('dashboard.withdrawals.create', compact('availableBalance', 'pendingWithdrawals',  'savedWallets'));
    }

    /**
     * Store a newly created withdrawal request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:20',
            'crypto' => 'required|string|in:btc,eth,usdt',
            'wallet_address' => 'required|string|max:255',
            'wallet_name' => 'nullable|string|max:50',
            'save_wallet' => 'nullable|boolean',
        ]);

        // Placeholder validation for available balance
        $availableBalance = Auth::user()->balances->balance;

        if ($request->amount >= $availableBalance) {
            return back()->withErrors([
                'amount' => 'Insufficient balance. Your available balance is $' . number_format($availableBalance, 2)
            ])->withInput();
        }

        // Generate a unique reference
        $reference = 'WD' . strtoupper(Str::random(10));

        $transaction = [
            'user_id' => Auth::user()->id,
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'reference' => $reference,
            'currency' => $request->crypto,
            'wallet_address' => $request->wallet_address,
        ];

        // create a new transaction
        $create = Transaction::create($transaction);
        if (!$create) {
            return back()->withErrors(['error' => 'Failed to create withdrawal request.']);
        }

        // debit the user's balance
        $user = User::find(Auth::id());
        $user->balances->decrement('balance', $request->amount);

        // Send email to user
        try {
            Mail::to($create->user->email)->send(new \App\Mail\Withdrawal\Init($create));
        } catch (\Exception $e) {
            FacadesLog::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Please try again.');
        }

        // Redirect to withdrawal history with success message
        return redirect()->route('dashboard.withdrawals.history')
            ->with('success', 'Your withdrawal request has been submitted and is pending approval.');
    }

    /**
     * Display the withdrawal history.
     */
    public function history()
    {
        // Add the pending withdrawal from session if it exists
        $transactions = Transaction::where('user_id', Auth::id())
            ->where('type', 'withdrawal')
            ->paginate(10);

        return view('dashboard.withdrawals.history', compact('transactions'));
    }

    /**
     * Display a specific withdrawal.
     */
    public function show($id)
    {
        // Placeholder for a specific withdrawal
        $cryptocurrencies = [
            'btc' => 'Bitcoin (BTC)',
            'eth' => 'Ethereum (ETH)',
            'usdt' => 'Tether (USDT)',
        ];

        $transaction = Transaction::where('user_id', Auth::id())
        ->where('type', 'withdrawal')
        ->where('reference', $id)
        ->first();

        // Convert to object to match expected behavior in template
        $transaction = (object)$transaction;

        return view('dashboard.withdrawals.show', compact('transaction', 'cryptocurrencies'));
    }
}
