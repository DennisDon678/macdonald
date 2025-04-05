<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $investments = [
            [
                'id' => 1,
                'reference' => 'INV-001',
                'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                'plan' => ['name' => 'Gold Plan', 'roi' => 20, 'duration' => 30],
                'amount' => 5000,
                'return_amount' => 6000, // 20% ROI on $5000
                'status' => 'active',
                'created_at' => '2025-03-01',
            ],
            [
                'id' => 2,
                'reference' => 'INV-002',
                'user' => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
                'plan' => ['name' => 'Silver Plan', 'roi' => 15, 'duration' => 20],
                'amount' => 3000,
                'return_amount' => 3450, // 15% ROI on $3000
                'status' => 'pending',
                'created_at' => '2025-03-05',
            ],
            [
                'id' => 3,
                'reference' => 'INV-003',
                'user' => ['id' => 3, 'name' => 'Robert Johnson', 'email' => 'robert@example.com'],
                'plan' => ['name' => 'Bronze Plan', 'roi' => 10, 'duration' => 15],
                'amount' => 1500,
                'return_amount' => 1650, // 10% ROI on $1500
                'status' => 'completed',
                'created_at' => '2025-02-15',
            ],
            [
                'id' => 4,
                'reference' => 'INV-004',
                'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                'plan' => ['name' => 'Platinum Plan', 'roi' => 25, 'duration' => 45],
                'amount' => 10000,
                'return_amount' => 12500, // 25% ROI on $10000
                'status' => 'terminated',
                'created_at' => '2025-02-01',
            ],
            [
                'id' => 5,
                'reference' => 'INV-005',
                'user' => ['id' => 4, 'name' => 'Emily Davis', 'email' => 'emily@example.com'],
                'plan' => ['name' => 'Gold Plan', 'roi' => 20, 'duration' => 30],
                'amount' => 4000,
                'return_amount' => 4800, // 20% ROI on $4000
                'status' => 'rejected',
                'created_at' => '2025-03-10',
            ],
        ];

        // Placeholder data for plans (needed for the filter dropdown)
        $plans = [
            ['id' => 1, 'name' => 'Gold Plan', 'roi' => 20, 'duration' => 30, 'min_amount' => 1000, 'max_amount' => 10000],
            ['id' => 2, 'name' => 'Silver Plan', 'roi' => 15, 'duration' => 20, 'min_amount' => 500, 'max_amount' => 5000],
            ['id' => 3, 'name' => 'Bronze Plan', 'roi' => 10, 'duration' => 15, 'min_amount' => 250, 'max_amount' => 2500],
            ['id' => 4, 'name' => 'Platinum Plan', 'roi' => 25, 'duration' => 45, 'min_amount' => 5000, 'max_amount' => 50000],
        ];

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
        $investment = [
            'id' => $id,
            'reference' => 'INV-001',
            'user' => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            'plan' => ['name' => 'Gold Plan', 'roi' => 20, 'duration' => 30],
            'amount' => 5000,
            'return_amount' => 6000, // 20% ROI on $5000
            'status' => 'active',
            'created_at' => '2025-03-01',
            'start_date' => '2025-03-02',
            'end_date' => '2025-04-01',
            'notes' => 'This is a sample investment.',
            'progress' => 40, // Percentage of completion
            'days_passed' => 12, // Number of days since the investment started
            'progress_percentage' => 40, // Progress percentage (days_passed / duration * 100)
            // Add transaction history
            'transactions' => [
                [
                    'id' => 1,
                    'type' => 'investment',
                    'amount' => 5000,
                    'description' => 'Initial investment',
                    'date' => '2025-03-02',
                ],
                [
                    'id' => 2,
                    'type' => 'profit',
                    'amount' => 200,
                    'description' => 'Profit day 10',
                    'date' => '2025-03-12',
                ],
                [
                    'id' => 3,
                    'type' => 'profit',
                    'amount' => 200,
                    'description' => 'Profit day 20',
                    'date' => '2025-03-22',
                ]
            ],
            // Add activity log
            'activities' => [
                [
                    'id' => 1,
                    'user' => ['name' => 'System', 'role' => 'system'],
                    'action' => 'Created Investment',
                    'description' => 'Investment was created in the system',
                    'date' => '2025-03-01 14:25:33',
                    'icon' => 'plus-circle',
                    'color' => 'blue'
                ],
                [
                    'id' => 2,
                    'user' => ['name' => 'Admin', 'role' => 'admin'],
                    'action' => 'Approved Investment',
                    'description' => 'Investment was approved and funds allocated',
                    'date' => '2025-03-02 09:15:21',
                    'icon' => 'check-circle',
                    'color' => 'green'
                ],
                [
                    'id' => 3,
                    'user' => ['name' => 'System', 'role' => 'system'],
                    'action' => 'Profit Distribution',
                    'description' => 'Profit credited: $200',
                    'date' => '2025-03-12 00:00:05',
                    'icon' => 'trending-up',
                    'color' => 'emerald'
                ],
                [
                    'id' => 4,
                    'user' => ['name' => 'John Doe', 'role' => 'user'],
                    'action' => 'Viewed Investment',
                    'description' => 'User viewed investment details',
                    'date' => '2025-03-15 16:42:11',
                    'icon' => 'eye',
                    'color' => 'indigo'
                ]
            ]
        ];

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
