<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the investments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $investmentsRaw = Investment::with('user', 'plan')->orderby('start_date','DESC')->paginate(10);

        $investmentsRaw->getCollection()->transform(function($investment) {
            return $this->prepareInvestmentForView($investment);
        });

        $plans = Plan::all();

        return view('admin.investments.index', [
            'investments' => $investmentsRaw,
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new investment.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $plans = Plan::all()->map(function($plan) {
            return [
                'id' => $plan->id,
                'name' => $plan->name,
                'min_amount' => $plan->min_investment,
                'max_amount' => $plan->max_investment,
                'roi' => $plan->interest_rate,
                'duration' => $plan->duration,
            ];
        });

        $users = User::all()->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'balance' => $user->balances->balance ?? 0.00,
            ];
        });

        return view('admin.investments.create', compact('plans', 'users'));
    }

    /**
     * Store a newly created investment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:active,pending',
            'notes' => 'nullable|string|max:255',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        $dailyProfit = $validated['amount'] * ($plan->interest_rate / 100);
        $totalExpectedReturn = $validated['amount'] + ($dailyProfit * $plan->duration);
        $reference = 'INV' . strtoupper(Str::random(10));

        $investmentData = [
            'user_id' => $validated['user_id'],
            'plan_id' => $validated['plan_id'],
            'reference' => $reference,
            'amount' => $validated['amount'],
            'daily_profit' => $dailyProfit,
            'total_profit' => 0.00,
            'total_expected_return' => $totalExpectedReturn,
            'profit_to_date' => 0.00,
            'duration' => $plan->duration,
            'days_remaining' => $plan->duration,
            'progress' => 0.00,
            'status' => $validated['status'],
            'interest_rate' => $plan->interest_rate,
            'notes' => $validated['notes'],
        ];

        if ($validated['status'] === 'active') {
            $investmentData['start_date'] = now();
            $investmentData['end_date'] = now()->addDays($plan->duration);
            $investmentData['next_payout'] = now()->addHours(24);
        }

        Investment::create($investmentData);

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment created successfully.');
    }

    /**
     * Display the specified investment.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $investmentRaw = Investment::with(['user', 'plan', 'transactions'])->findOrFail($id);
        $investment = $this->prepareInvestmentForView($investmentRaw);

        return view('admin.investments.show', compact('investment'));
    }

    /**
     * Show the form for editing the specified investment.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $investmentRaw = Investment::with(['user', 'plan'])->findOrFail($id);
        $investment = $this->prepareInvestmentForView($investmentRaw);

        return view('admin.investments.edit', compact('investment'));
    }

    /**
     * Update the specified investment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:active,pending,completed,terminated,rejected',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
        ]);

        $investment = Investment::findOrFail($id);

        $updateData = [
            'amount' => $validated['amount'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? $validated['reason'] ?? $investment->notes,
        ];

        if ($validated['amount'] != $investment->amount) {
            $dailyProfit = $validated['amount'] * ($investment->interest_rate / 100);
            $updateData['daily_profit'] = $dailyProfit;
            $updateData['total_expected_return'] = $validated['amount'] + ($dailyProfit * $investment->duration);
        }

        if ($validated['status'] === 'active' && $investment->status !== 'active') {
            $updateData['start_date'] = now();
            $updateData['end_date'] = now()->addDays($investment->duration);
            $updateData['next_payout'] = now()->addHours(24);
        }

        $investment->update($updateData);

        return redirect()->route('admin.investments.show', $id)
            ->with('success', 'Investment updated successfully.');
    }

    /**
     * Remove the specified investment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Investment::destroy($id);

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment deleted successfully.');
    }

    /**
     * Approve the specified investment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->update([
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($investment->duration),
            'next_payout' => now()->addHours(24),
        ]);

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment approved successfully.');
    }

    /**
     * Reject the specified investment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment rejected successfully.');
    }

    /**
     * Terminate the specified investment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function terminate($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->update([
            'status' => 'terminated',
        ]);

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment terminated successfully.');
    }

    /**
     * Format Eloquent Investment model into the structure expected by the views.
     */
    private function prepareInvestmentForView($investment)
    {
        if (!$investment) {
            return null;
        }

        $interestRate = $investment->interest_rate ?? ($investment->plan->interest_rate ?? 0);
        $returnAmount = $investment->amount + ($investment->amount * ($interestRate / 100) * $investment->duration);

        $daysPassed = $investment->duration - $investment->days_remaining;
        $progressPercentage = $investment->duration > 0 
            ? round(($daysPassed / $investment->duration) * 100, 2) 
            : 0;

        $transactions = $investment->transactions ? $investment->transactions->map(function($t) {
            return [
                'type' => $t->type,
                'date' => $t->created_at->format('M d, Y H:i'),
                'amount' => $t->amount,
            ];
        })->toArray() : [];

        return [
            'id' => $investment->id,
            'reference' => $investment->reference,
            'status' => $investment->status,
            'created_at' => $investment->created_at ? $investment->created_at->format('M d, Y') : null,
            'amount' => $investment->amount,
            'duration' => $investment->duration,
            'days_remaining' => $investment->days_remaining,
            'days_passed' => $daysPassed,
            'progress_percentage' => $progressPercentage,
            'daily_profit' => $investment->daily_profit,
            'profit_to_date' => $investment->profit_to_date,
            'return_amount' => $returnAmount,
            'start_date' => $investment->start_date ? $investment->start_date->format('M d, Y') : null,
            'end_date' => $investment->end_date ? $investment->end_date->format('M d, Y') : null,
            'reason' => $investment->notes,
            'notes' => $investment->notes,
            'user' => [
                'id' => $investment->user->id ?? null,
                'name' => $investment->user->name ?? 'N/A',
                'email' => $investment->user->email ?? 'N/A',
            ],
            'plan' => [
                'name' => $investment->plan->name ?? 'N/A',
                'interest_rate' => $interestRate,
                'roi' => $interestRate,
                'duration' => $investment->duration,
                'min_amount' => $investment->plan->min_investment ?? 0,
                'max_amount' => $investment->plan->max_investment ?? 0,
            ],
            'transactions' => $transactions,
        ];
    }
}
