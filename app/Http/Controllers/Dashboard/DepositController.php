<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Show the deposit creation form.
     */
    public function create()
    {
        // Placeholder plans until database is ready
        $plans = [
            (object)[
                'id' => 1,
                'name' => 'Beginner Plan',
                'min_deposit' => 100.00,
                'max_deposit' => 1000.00,
                'interest_rate' => 2.00, // 2% daily
                'duration' => 30, // 30 days
                'referral_bonus' => 5.00, // 5%
                'status' => 'active',
            ],
            (object)[
                'id' => 2,
                'name' => 'Advanced Plan',
                'min_deposit' => 1001.00,
                'max_deposit' => 10000.00,
                'interest_rate' => 3.50, // 3.5% daily
                'duration' => 45, // 45 days
                'referral_bonus' => 7.00, // 7%
                'status' => 'active',
            ],
            (object)[
                'id' => 3,
                'name' => 'Premium Plan',
                'min_deposit' => 10001.00,
                'max_deposit' => 100000.00,
                'interest_rate' => 5.00, // 5% daily
                'duration' => 60, // 60 days
                'referral_bonus' => 10.00, // 10%
                'status' => 'active',
            ],
        ];
        
        // Define available cryptocurrencies
        $cryptocurrencies = [
            'btc' => [
                'name' => 'Bitcoin',
                'code' => 'BTC',
                'icon' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.svg',
                'address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            ],
            'eth' => [
                'name' => 'Ethereum',
                'code' => 'ETH',
                'icon' => 'https://cryptologos.cc/logos/ethereum-eth-logo.svg',
                'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            ],
            'usdt' => [
                'name' => 'Tether',
                'code' => 'USDT',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.svg',
                'address' => 'TJcQK873JzPKRRPiZERVUwvPLQNsCnMTES',
                'network' => 'TRC20',
            ],
            'usdc' => [
                'name' => 'USD Coin',
                'code' => 'USDC',
                'icon' => 'https://cryptologos.cc/logos/usd-coin-usdc-logo.svg',
                'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
                'network' => 'ERC20',
            ],
        ];
        
        return view('dashboard.deposits.create', compact('plans', 'cryptocurrencies'));
    }
    
    /**
     * Store a newly created deposit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|min:1|max:3',
            'amount' => 'required|numeric|min:1',
            'crypto' => 'required|string|in:btc,eth,usdt,usdc',
        ]);
        
        // Placeholder plans for validation
        $plans = [
            1 => ['min_deposit' => 100, 'max_deposit' => 1000, 'name' => 'Beginner Plan'],
            2 => ['min_deposit' => 1001, 'max_deposit' => 10000, 'name' => 'Advanced Plan'],
            3 => ['min_deposit' => 10001, 'max_deposit' => 100000, 'name' => 'Premium Plan'],
        ];
        
        $planId = $request->plan_id;
        $plan = $plans[$planId] ?? null;
        
        if (!$plan) {
            return back()->withErrors(['plan_id' => 'Invalid plan selected'])->withInput();
        }
        
        // Validate minimum and maximum deposit
        if ($request->amount < $plan['min_deposit'] || $request->amount > $plan['max_deposit']) {
            return back()->withErrors([
                'amount' => "Investment amount must be between $" . number_format($plan['min_deposit'], 2) . 
                            " and $" . number_format($plan['max_deposit'], 2)
            ])->withInput();
        }
        
        // Generate a unique reference
        $reference = strtoupper(Str::random(12));
        
        // Since we don't have a database yet, we'll simulate a successful deposit
        // and store the transaction details in the session for the confirmation page
        
        $transaction = [
            'id' => rand(1000, 9999),
            'user_id' => 1, // Placeholder user ID
            'type' => 'deposit',
            'amount' => $request->amount,
            'description' => 'Deposit for ' . $plan['name'],
            'status' => 'pending',
            'reference' => $reference,
            'currency' => $request->crypto,
            'created_at' => now(),
        ];
        
        // Store transaction in session
        session(['pending_transaction' => $transaction]);
        session(['selected_plan' => [
            'id' => $planId,
            'name' => $plan['name'],
            'interest_rate' => $planId == 1 ? 2.00 : ($planId == 2 ? 3.50 : 5.00),
            'duration' => $planId == 1 ? 30 : ($planId == 2 ? 45 : 60),
        ]]);
        
        // Redirect to confirmation page
        return redirect()->route('dashboard.deposits.confirm', $reference)
            ->with('success', 'Your deposit has been initiated. Please complete the payment.');
    }
    
    /**
     * Display the confirmation page for a deposit.
     */
    public function confirm($reference)
    {
        $transaction = session('pending_transaction');
        
        // Check if transaction exists in session and matches the reference
        if (!$transaction || $transaction['reference'] !== $reference) {
            return redirect()->route('dashboard.deposits.create')
                ->with('error', 'Transaction not found. Please try again.');
        }
        
        $plan = session('selected_plan');
        
        // Define cryptocurrency details
        $cryptocurrencies = [
            'btc' => [
                'name' => 'Bitcoin',
                'code' => 'BTC',
                'icon' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.svg',
                'address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            ],
            'eth' => [
                'name' => 'Ethereum',
                'code' => 'ETH',
                'icon' => 'https://cryptologos.cc/logos/ethereum-eth-logo.svg',
                'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
            ],
            'usdt' => [
                'name' => 'Tether',
                'code' => 'USDT',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.svg',
                'address' => 'TJcQK873JzPKRRPiZERVUwvPLQNsCnMTES',
                'network' => 'TRC20',
            ],
            'usdc' => [
                'name' => 'USD Coin',
                'code' => 'USDC',
                'icon' => 'https://cryptologos.cc/logos/usd-coin-usdc-logo.svg',
                'address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
                'network' => 'ERC20',
            ],
        ];
        
        $crypto = $cryptocurrencies[$transaction['currency']];
        
        return view('dashboard.deposits.confirm', compact('transaction', 'plan', 'crypto'));
    }
    
    /**
     * Display the deposit history.
     */
    public function history()
    {
        // Placeholder for transaction history
        $transactions = collect([
            [
                'id' => 1001,
                'reference' => 'DEP' . strtoupper(Str::random(8)),
                'amount' => 500.00,
                'currency' => 'btc',
                'status' => 'completed',
                'created_at' => now()->subDays(5),
            ],
            [
                'id' => 1002,
                'reference' => 'DEP' . strtoupper(Str::random(8)),
                'amount' => 1500.00,
                'currency' => 'eth',
                'status' => 'pending',
                'created_at' => now()->subDays(2),
            ],
            [
                'id' => 1003,
                'reference' => 'DEP' . strtoupper(Str::random(8)),
                'amount' => 300.00,
                'currency' => 'usdt',
                'status' => 'completed',
                'created_at' => now()->subDays(10),
            ],
        ]);
        
        // Add pagination methods to the collection
        $transactions = new \Illuminate\Pagination\LengthAwarePaginator(
            $transactions,
            $transactions->count(),
            10,
            1,
            ['path' => request()->url()]
        );
            
        return view('dashboard.deposits.history', compact('transactions'));
    }
    
    /**
     * Display a specific deposit.
     */
    public function show($id)
    {
        // Placeholder for a single transaction
        $transaction = [
            'id' => $id,
            'reference' => 'DEP' . strtoupper(Str::random(8)),
            'amount' => 500.00,
            'currency' => 'btc',
            'status' => 'completed',
            'created_at' => now()->subDays(5),
        ];
        
        // Convert to object to match expected behavior in template
        $transaction = (object)$transaction;
        
        $investment = null; // Placeholder for investment details
            
        return view('dashboard.deposits.show', compact('transaction', 'investment'));
    }
    
    /**
     * Handle transaction receipt upload.
     */
    public function uploadReceipt(Request $request, $reference)
    {
        $request->validate([
            'receipt' => 'required|image|max:5120', // Max 5MB image file
            'transaction_id' => 'nullable|string|max:255',
            'comments' => 'nullable|string|max:1000',
        ]);
        
        // Since we don't have a database yet, let's just simulate a successful upload
        
        // In a real implementation, you would:
        // 1. Verify that the transaction reference exists
        // 2. Store the uploaded file (in storage/app/public/receipts or similar)
        // 3. Save the transaction ID and comments to the deposit record
        // 4. Update the transaction status to "verification_pending" or similar
        
        if ($request->hasFile('receipt')) {
            // Get filename with extension
            $filenameWithExt = $request->file('receipt')->getClientOriginalName();
            
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get extension
            $extension = $request->file('receipt')->getClientOriginalExtension();
            
            // Create unique filename with timestamp
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            
            // In a real implementation, you would store the file
            // $path = $request->file('receipt')->storeAs('public/receipts', $fileNameToStore);
            
            // For now, we'll just simulate that the file was successfully saved
            return redirect()->route('dashboard.deposits.history')
                ->with('success', 'Your transaction receipt has been uploaded successfully. Your deposit will be verified shortly.');
        }
        
        return redirect()->back()->with('error', 'Something went wrong with the file upload.');
    }
}
