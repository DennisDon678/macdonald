<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    /**
     * Show the withdrawal creation form.
     */
    public function create()
    {
        // Placeholder for available balance
        $availableBalance = 5250.75;
        $pendingWithdrawals = 250.00;
        
        // Define available cryptocurrencies for withdrawal
        $cryptocurrencies = [
            'btc' => [
                'name' => 'Bitcoin',
                'code' => 'BTC',
                'icon' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.svg',
                'network' => null,
                'min_withdrawal' => 0.0005,
                'withdrawal_fee' => 0.0001,
            ],
            'eth' => [
                'name' => 'Ethereum',
                'code' => 'ETH',
                'icon' => 'https://cryptologos.cc/logos/ethereum-eth-logo.svg',
                'network' => null,
                'min_withdrawal' => 0.01,
                'withdrawal_fee' => 0.005,
            ],
            'usdt' => [
                'name' => 'Tether',
                'code' => 'USDT',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.svg',
                'network' => 'TRC20',
                'min_withdrawal' => 20,
                'withdrawal_fee' => 1,
            ],
            'usdc' => [
                'name' => 'USD Coin',
                'code' => 'USDC',
                'icon' => 'https://cryptologos.cc/logos/usd-coin-usdc-logo.svg',
                'network' => 'ERC20',
                'min_withdrawal' => 20,
                'withdrawal_fee' => 5,
            ],
        ];
        
        // Get user's saved wallets (placeholder)
        $savedWallets = [
            [
                'id' => 1,
                'name' => 'My Bitcoin Wallet',
                'currency' => 'btc',
                'address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            ],
            [
                'id' => 2,
                'name' => 'Binance USDT',
                'currency' => 'usdt',
                'address' => 'TJcQK873JzPKRRPiZERVUwvPLQNsCnMTES',
            ],
        ];
        
        return view('dashboard.withdrawals.create', compact('availableBalance', 'pendingWithdrawals', 'cryptocurrencies', 'savedWallets'));
    }
    
    /**
     * Store a newly created withdrawal request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:20',
            'crypto' => 'required|string|in:btc,eth,usdt,usdc',
            'wallet_address' => 'required|string|max:255',
            'wallet_name' => 'nullable|string|max:50',
            'save_wallet' => 'nullable|boolean',
        ]);
        
        // Placeholder validation for available balance
        $availableBalance = 5250.75;
        
        if ($request->amount > $availableBalance) {
            return back()->withErrors([
                'amount' => 'Insufficient balance. Your available balance is $' . number_format($availableBalance, 2)
            ])->withInput();
        }
        
        // Generate a unique reference
        $reference = 'WD' . strtoupper(Str::random(10));
        
        // Since we don't have a database yet, we'll simulate a successful withdrawal request
        // and store the transaction details in the session for display purposes
        
        $transaction = [
            'id' => rand(1000, 9999),
            'user_id' => 1, // Placeholder user ID
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'description' => 'Withdrawal request',
            'status' => 'pending',
            'reference' => $reference,
            'currency' => $request->crypto,
            'wallet_address' => $request->wallet_address,
            'created_at' => now(),
        ];
        
        // Store transaction in session
        session(['pending_withdrawal' => $transaction]);
        
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
        $pendingWithdrawal = session('pending_withdrawal');
        
        // Placeholder for withdrawal history
        $transactions = collect([
            [
                'id' => 2001,
                'reference' => 'WD' . strtoupper(Str::random(8)),
                'amount' => 100.00,
                'currency' => 'btc',
                'status' => 'completed',
                'created_at' => now()->subDays(3),
                'wallet_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            ],
            [
                'id' => 2002,
                'reference' => 'WD' . strtoupper(Str::random(8)),
                'amount' => 500.00,
                'currency' => 'usdt',
                'status' => 'pending',
                'created_at' => now()->subDays(1),
                'wallet_address' => 'TJcQK873JzPKRRPiZERVUwvPLQNsCnMTES',
            ],
            [
                'id' => 2003,
                'reference' => 'WD' . strtoupper(Str::random(8)),
                'amount' => 250.00,
                'currency' => 'eth',
                'status' => 'rejected',
                'created_at' => now()->subDays(7),
                'wallet_address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            ],
        ]);
        
        // Add the pending withdrawal from session to the collection if it exists
        if ($pendingWithdrawal) {
            $transactions->prepend($pendingWithdrawal);
        }
        
        // Add pagination methods to the collection
        $transactions = new \Illuminate\Pagination\LengthAwarePaginator(
            $transactions,
            $transactions->count(),
            10,
            1,
            ['path' => request()->url()]
        );
            
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
            'usdc' => 'USD Coin (USDC)',
        ];
        
        $statuses = [
            'pending' => 'Pending Approval',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'rejected' => 'Rejected',
        ];
        
        // Select a random status for demonstration
        $statusKeys = array_keys($statuses);
        $randomStatus = $statusKeys[array_rand($statusKeys)];
        
        // Select a random currency for demonstration
        $currencyKeys = array_keys($cryptocurrencies);
        $randomCurrency = $currencyKeys[array_rand($currencyKeys)];
        
        $transaction = [
            'id' => $id,
            'reference' => 'WD' . strtoupper(Str::random(8)),
            'amount' => rand(100, 1000) . '.' . rand(0, 99),
            'currency' => $randomCurrency,
            'status' => $randomStatus,
            'created_at' => now()->subDays(rand(1, 10)),
            'wallet_address' => $randomCurrency == 'btc' ? 
                'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh' : 
                ($randomCurrency == 'eth' || $randomCurrency == 'usdc' ? 
                    '0x71C7656EC7ab88b098defB751B7401B5f6d8976F' : 
                    'TJcQK873JzPKRRPiZERVUwvPLQNsCnMTES'),
            'processed_at' => $randomStatus == 'completed' ? now()->subDays(rand(1, 3)) : null,
            'rejected_reason' => $randomStatus == 'rejected' ? 'Suspicious activity detected' : null,
        ];
        
        // Convert to object to match expected behavior in template
        $transaction = (object)$transaction;
        
        return view('dashboard.withdrawals.show', compact('transaction', 'cryptocurrencies'));
    }
}
