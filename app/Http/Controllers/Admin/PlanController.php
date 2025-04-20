<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Placeholder data for plans
        $plans = Plan::all();

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Display the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Placeholder data for a single plan
        $plan = [
            'id' => $id,
            'name' => 'Gold Plan',
            'roi' => 20,
            'duration' => 30,
            'min_amount' => 1000,
            'max_amount' => 10000,
            'status' => 'active',
            'description' => 'Our premium investment plan with high returns. This plan offers consistent returns of 20% over 30 days with minimal risk. Suitable for investors looking for stable growth.',
            'features' => ['Daily profit distribution', '24/7 support', 'Early withdrawal option', 'Automatic reinvestment'],
            'created_at' => '2025-01-15',
            'updated_at' => '2025-02-10',
            'investments_count' => 24,
            'total_invested' => 120000,
            // Sample investments for this plan
            'investments' => [
                [
                    'id' => 1,
                    'reference' => 'INV-001',
                    'user' => ['id' => 1, 'name' => 'John Doe'],
                    'amount' => 5000,
                    'status' => 'active',
                    'created_at' => '2025-03-01',
                ],
                [
                    'id' => 2,
                    'reference' => 'INV-008',
                    'user' => ['id' => 3, 'name' => 'Robert Johnson'],
                    'amount' => 7500,
                    'status' => 'active',
                    'created_at' => '2025-03-05',
                ],
                [
                    'id' => 3,
                    'reference' => 'INV-012',
                    'user' => ['id' => 5, 'name' => 'Emily Davis'],
                    'amount' => 10000,
                    'status' => 'completed',
                    'created_at' => '2025-02-15',
                ],
            ]
        ];

        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Placeholder data for a single plan
        $plan = Plan::findOrFail($id);

        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'duration' => 'required|integer|min:1',
            'min_investment' => 'required|numeric|min:0',
            'max_investment' => 'required|numeric|min:0',
        ]);
        $plan = Plan::findOrFail($id);
        $plan->update([
            'name' => $validated['name'],
            'interest_rate' => $validated['interest_rate'],
            'duration' => $validated['duration'],
            'min_investment' => $validated['min_investment'],
            'max_investment' => $validated['max_investment'],
        ]);

        
        return redirect()->route('admin.plans.index')
            ->with('success', 'Investment plan updated successfully.');
    }

    /**
     * Toggle the status of the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus($id)
    {
        // Toggle status logic in a real application
        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan status updated successfully.');
    }

    /**
     * Remove the specified plan from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Delete logic in a real application
        return redirect()->route('admin.plans.index')
            ->with('success', 'Investment plan deleted successfully.');
    }
}
