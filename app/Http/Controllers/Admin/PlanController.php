<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $plans = [
            [
                'id' => 1,
                'name' => 'Gold Plan',
                'roi' => 20,
                'duration' => 30,
                'min_amount' => 1000,
                'max_amount' => 10000,
                'status' => 'active',
                'description' => 'Our premium investment plan with high returns',
                'created_at' => '2025-01-15',
                'investments_count' => 24
            ],
            [
                'id' => 2,
                'name' => 'Silver Plan',
                'roi' => 15,
                'duration' => 20,
                'min_amount' => 500,
                'max_amount' => 5000,
                'status' => 'active',
                'description' => 'Medium-risk investment with good returns',
                'created_at' => '2025-01-20',
                'investments_count' => 45
            ],
            [
                'id' => 3,
                'name' => 'Bronze Plan',
                'roi' => 10,
                'duration' => 15,
                'min_amount' => 250,
                'max_amount' => 2500,
                'status' => 'active',
                'description' => 'Entry-level investment plan for beginners',
                'created_at' => '2025-01-25',
                'investments_count' => 78
            ],
            [
                'id' => 4,
                'name' => 'Platinum Plan',
                'roi' => 25,
                'duration' => 45,
                'min_amount' => 5000,
                'max_amount' => 50000,
                'status' => 'inactive',
                'description' => 'Exclusive high-value investment opportunity',
                'created_at' => '2025-02-01',
                'investments_count' => 12
            ],
        ];

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate and store in a real application
        return redirect()->route('admin.plans.index')
            ->with('success', 'Investment plan created successfully.');
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
        $plan = [
            'id' => $id,
            'name' => 'Gold Plan',
            'roi' => 20,
            'duration' => 30,
            'min_amount' => 1000,
            'max_amount' => 10000,
            'status' => 'active',
            'description' => 'Our premium investment plan with high returns',
            'features' => ['Daily profit distribution', '24/7 support', 'Early withdrawal option'],
        ];

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
        // Validate and update in a real application
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
