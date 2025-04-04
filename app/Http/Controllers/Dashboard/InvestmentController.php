<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the user's investments.
     */
    public function index()
    {
        // Get user's active investments (placeholder data)
        $activeInvestments = collect([
            [
                'id' => 1,
                'plan_name' => 'Beginner Plan',
                'amount' => 500.00,
                'daily_profit' => 10.00, // 2% of 500
                'total_profit' => 300.00, // Accumulated so far
                'expected_total' => 800.00, // Original + Total expected profit
                'duration' => 30,
                'days_remaining' => 12,
                'progress' => 60, // Percentage complete
                'status' => 'active',
                'created_at' => now()->subDays(18),
                'next_payout' => now()->addDay(),
            ],
            [
                'id' => 2,
                'plan_name' => 'Advanced Plan',
                'amount' => 2000.00,
                'daily_profit' => 70.00, // 3.5% of 2000
                'total_profit' => 420.00, // Accumulated so far
                'expected_total' => 3150.00, // Original + Total expected profit
                'duration' => 45,
                'days_remaining' => 39,
                'progress' => 13, // Percentage complete
                'status' => 'active',
                'created_at' => now()->subDays(6),
                'next_payout' => now()->addDay(),
            ],
        ]);
        
        // Get user's completed investments (placeholder data)
        $completedInvestments = collect([
            [
                'id' => 3,
                'plan_name' => 'Beginner Plan',
                'amount' => 300.00,
                'daily_profit' => 6.00, // 2% of 300
                'total_profit' => 180.00, // Total profit earned
                'expected_total' => 480.00, // Original + Total profit
                'duration' => 30,
                'days_remaining' => 0,
                'progress' => 100, // Percentage complete
                'status' => 'completed',
                'created_at' => now()->subDays(45),
                'completed_at' => now()->subDays(15),
            ],
            [
                'id' => 4,
                'plan_name' => 'Premium Plan',
                'amount' => 5000.00,
                'daily_profit' => 250.00, // 5% of 5000
                'total_profit' => 15000.00, // Total profit earned
                'expected_total' => 20000.00, // Original + Total profit
                'duration' => 60,
                'days_remaining' => 0,
                'progress' => 100, // Percentage complete
                'status' => 'completed',
                'created_at' => now()->subDays(90),
                'completed_at' => now()->subDays(30),
            ],
        ]);
        
        // Calculate summary statistics
        $stats = [
            'active_investments' => $activeInvestments->count(),
            'completed_investments' => $completedInvestments->count(),
            'total_invested' => $activeInvestments->sum('amount') + $completedInvestments->sum('amount'),
            'total_earned' => $activeInvestments->sum('total_profit') + $completedInvestments->sum('total_profit'),
            'daily_earnings' => $activeInvestments->sum('daily_profit'),
        ];
        
        return view('dashboard.investments.index', compact('activeInvestments', 'completedInvestments', 'stats'));
    }
    
    /**
     * Display the specified investment.
     */
    public function show($id)
    {
        // Find the investment by ID (placeholder)
        // In a real implementation, we would fetch from database
        
        // Sample data for a single investment
        $investment = [
            'id' => $id,
            'plan_name' => 'Advanced Plan',
            'amount' => 2000.00,
            'daily_profit' => 70.00, // 3.5% of 2000
            'total_profit' => 420.00, // Accumulated so far
            'total_expected_return' => 3150.00,
            'profit_to_date' => 600.00,
            'duration' => 45,
            'days_remaining' => 39,
            'progress' => 13, // Percentage complete
            'status' => 'active',
            'created_at' => now()->subDays(6),
            'end_date' => now()->subDays(30)->addDays(60),
            'next_payout' => now()->addDay(),
            'interest_rate' => 3.5,
            'deposit_reference' => 'DEP' . strtoupper(Str::random(8)),
            'deposit_method' => 'Bitcoin',
        ];
        
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
        
        return view('dashboard.investments.show', compact('investment', 'transactions', 'chartData'));
    }
}
