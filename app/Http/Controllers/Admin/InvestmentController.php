<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the investments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Placeholder data for investments
        $investments = Investment::with('user', 'plan')->orderby('start_date','DESC')->paginate(10);

        // Placeholder data for plans (needed for the filter dropdown)
        $plans = Plan::all();

        return view('admin.investments.index', compact('investments', 'plans'));
    }

    /**
     * Show the form for creating a new investment.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Placeholder data for plans
        $plans = [
            ['id' => 1, 'name' => 'Gold Plan', 'roi' => 20, 'duration' => 30, 'min_amount' => 1000, 'max_amount' => 10000],
            ['id' => 2, 'name' => 'Silver Plan', 'roi' => 15, 'duration' => 20, 'min_amount' => 500, 'max_amount' => 5000],
        ];

        return view('admin.investments.create', compact('plans'));
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
        ]);

        // Logic to create a new investment in the database

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
        // Placeholder data for a single investment
        $investment = Investment::find($id);

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
        // Placeholder data for a single investment
        $investment = [
            'id' => $id,
            'reference' => 'INV-001',
            'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            'plan' => ['name' => 'Gold Plan', 'roi' => 20, 'duration' => 30, 'min_amount' => 1000, 'max_amount' => 10000],
            'amount' => 5000,
            'status' => 'active',
            'notes' => 'This is a sample investment.',
        ];

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

        // Logic to update the investment in the database

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
        // Logic to delete the investment from the database

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
        // Logic to approve the investment

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
        // Logic to reject the investment

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
        // Logic to terminate the investment

        return redirect()->route('admin.investments.index')
            ->with('success', 'Investment terminated successfully.');
    }
}
