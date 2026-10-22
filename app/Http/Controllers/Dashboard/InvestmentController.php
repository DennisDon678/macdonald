<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DepositWallet;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\ThemeService;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the user's investments.
     */
    public function index()
    {
        // Get user's active investments (placeholder data)
        $activeInvestments = Investment::where('user_id', Auth::id())
            ->where('status', 'active')
            ->get();
        
        // Get user's completed investments (placeholder data)
        $completedInvestments = Investment::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->get();
        
        // Calculate summary statistics
        $stats = [
            'active_investments' => $activeInvestments->count(),
            'completed_investments' => $completedInvestments->count(),
            'total_invested' => $activeInvestments->sum('amount') + $completedInvestments->sum('amount'),
            'total_earned' => $activeInvestments->sum('total_profit') + $completedInvestments->sum('total_profit'),
            'daily_earnings' => $activeInvestments->sum('daily_profit'),
        ];
        
        return ThemeService::view('dashboard.investments.index', compact('activeInvestments', 'completedInvestments', 'stats'));
    }
    
    /**
     * Display the specified investment.
     */
    public function show($id)
    {
        // Find the investment by ID (placeholder)
        // In a real implementation, we would fetch from database
        
        // Sample data for a single investment
        $investment = Investment::where('reference', $id)->first();

        // get deposit with reference
        $deposit = Transaction::where('reference', $id)
            ->where('type', 'deposit')
            ->first();

        //get the crypto currency
        $cryptoCurrency = DepositWallet::find($deposit->crypto);
        $coinName = $cryptoCurrency->name;
        
        // Sample transaction history for this investment
        $transactions = collect([
            [
                'id' => 101,
                'type' => 'deposit',
                'amount' => 2000.00,
                'description' => 'Initial investment deposit',
                'created_at' => now()->subDays(6),
            ],
            [
                'id' => 102,
                'type' => 'profit',
                'amount' => 70.00,
                'description' => 'Daily profit payment',
                'created_at' => now()->subDays(5),
            ],
            [
                'id' => 103,
                'type' => 'profit',
                'amount' => 70.00,
                'description' => 'Daily profit payment',
                'created_at' => now()->subDays(4),
            ],
            [
                'id' => 104,
                'type' => 'profit',
                'amount' => 70.00,
                'description' => 'Daily profit payment',
                'created_at' => now()->subDays(3),
            ],
            [
                'id' => 105,
                'type' => 'profit',
                'amount' => 70.00,
                'description' => 'Daily profit payment',
                'created_at' => now()->subDays(2),
            ],
            [
                'id' => 106,
                'type' => 'profit',
                'amount' => 70.00,
                'description' => 'Daily profit payment',
                'created_at' => now()->subDays(1),
            ],
        ]);
        
        // Daily profit chart data
        $chartData = [
            'dates' => [
                now()->subDays(6)->format('M d'),
                now()->subDays(5)->format('M d'),
                now()->subDays(4)->format('M d'),
                now()->subDays(3)->format('M d'),
                now()->subDays(2)->format('M d'),
                now()->subDays(1)->format('M d'),
                now()->format('M d'),
            ],
            'profits' => [0, 70, 70, 70, 70, 70, 70],
            'cumulative' => [0, 70, 140, 210, 280, 350, 420],
        ];
        
        return ThemeService::view('dashboard.investments.show', compact('investment', 'transactions', 'chartData', 'coinName'));
    }
}
