<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use App\Models\User; // Uncomment when you have your User model ready

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // This would normally query the database with filters
        // For now, let's create placeholder data
        
        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'balance' => 5250.00,
                'status' => 'active',
                'verified' => true,
                'created_at' => '2023-01-15',
                'last_login' => '2023-04-01 13:45:22',
                'investments' => [
                    ['id' => 101, 'plan' => 'Gold Plan', 'amount' => 2000.00, 'returns' => 2400.00, 'status' => 'active', 'created_at' => '2023-02-01']
                ]
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'balance' => 12750.00,
                'status' => 'active',
                'verified' => true,
                'created_at' => '2023-01-20',
                'last_login' => '2023-04-02 09:12:45',
                'investments' => [
                    ['id' => 102, 'plan' => 'Platinum Plan', 'amount' => 5000.00, 'returns' => 7500.00, 'status' => 'active', 'created_at' => '2023-02-05'],
                    ['id' => 105, 'plan' => 'Silver Plan', 'amount' => 1000.00, 'returns' => 1200.00, 'status' => 'active', 'created_at' => '2023-03-10']
                ]
            ],
            [
                'id' => 3,
                'name' => 'Robert Johnson',
                'email' => 'robert@example.com',
                'balance' => 800.00,
                'status' => 'inactive',
                'verified' => false,
                'created_at' => '2023-02-10',
                'last_login' => '2023-03-15 16:30:21',
                'investments' => []
            ],
            [
                'id' => 4,
                'name' => 'Sarah Williams',
                'email' => 'sarah@example.com',
                'balance' => 3200.00,
                'status' => 'active',
                'verified' => true,
                'created_at' => '2023-02-15',
                'last_login' => '2023-04-02 11:20:35',
                'investments' => [
                    ['id' => 110, 'plan' => 'Bronze Plan', 'amount' => 500.00, 'returns' => 550.00, 'status' => 'active', 'created_at' => '2023-03-01']
                ]
            ],
            [
                'id' => 5,
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'balance' => 9500.00,
                'status' => 'active',
                'verified' => true,
                'created_at' => '2023-03-05',
                'last_login' => '2023-04-01 14:50:12',
                'investments' => [
                    ['id' => 115, 'plan' => 'Gold Plan', 'amount' => 2000.00, 'returns' => 2400.00, 'status' => 'active', 'created_at' => '2023-03-15'],
                    ['id' => 118, 'plan' => 'Gold Plan', 'amount' => 2000.00, 'returns' => 2400.00, 'status' => 'active', 'created_at' => '2023-03-28']
                ]
            ]
        ];

        // Filters would be applied here in a real application
        // For now we'll just return all users
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive',
        ]);

        // In a real app, you would create the user in the database
        // User::create([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'password' => Hash::make($validated['password']),
        //     'status' => $validated['status'],
        //     'email_verified_at' => $request->has('verified') ? now() : null,
        // ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find user by id in a real application
        // For now, let's use placeholder data
        
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'balance' => 5250.00,
            'status' => 'active',
            'verified' => true,
            'created_at' => '2023-01-15',
            'last_login' => '2023-04-01 13:45:22',
            'referred_by' => 'Jane Smith',
            'referrals' => 3,
            'investments' => [
                ['id' => 101, 'plan' => 'Gold Plan', 'amount' => 2000.00, 'returns' => 2400.00, 'status' => 'active', 'created_at' => '2023-02-01'],
                ['id' => 105, 'plan' => 'Silver Plan', 'amount' => 1000.00, 'returns' => 1200.00, 'status' => 'completed', 'created_at' => '2023-01-05']
            ],
            'deposits' => [
                ['id' => 201, 'amount' => 2000.00, 'method' => 'Bitcoin', 'status' => 'completed', 'created_at' => '2023-01-20'],
                ['id' => 210, 'amount' => 1000.00, 'method' => 'Bank Transfer', 'status' => 'completed', 'created_at' => '2023-02-15'],
            ],
            'withdrawals' => [
                ['id' => 301, 'amount' => 500.00, 'method' => 'Bitcoin', 'status' => 'completed', 'created_at' => '2023-02-10'],
                ['id' => 305, 'amount' => 750.00, 'method' => 'Bank Transfer', 'status' => 'pending', 'created_at' => '2023-03-25'],
            ]
        ];

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find user by id in a real application
        // For now, let's use placeholder data
        
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'balance' => 5250.00,
            'status' => 'active',
            'verified' => true
        ];

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        // In a real app, you would update the user in the database
        // $user = User::findOrFail($id);
        // $user->update([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        //     'status' => $validated['status'],
        //     'email_verified_at' => $request->has('verified') ? 
        //         $user->email_verified_at ?? now() : 
        //         null,
        // ]);

        // if ($request->filled('password')) {
        //     $request->validate([
        //         'password' => 'string|min:8|confirmed',
        //     ]);
        //     $user->update([
        //         'password' => Hash::make($request->password),
        //     ]);
        // }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // In a real app, you would delete the user from the database
        // User::destroy($id);

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle the status of the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus($id)
    {
        // In a real app, you would toggle the user's status
        // $user = User::findOrFail($id);
        // $user->status = $user->status === 'active' ? 'inactive' : 'active';
        // $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User status updated successfully.');
    }

    /**
     * Display a list of users pending verification.
     *
     * @return \Illuminate\View\View
     */
    public function verificationRequests()
    {
        // In a real application, fetch users with pending verification
        $users = [
            [
                'id' => 6,
                'name' => 'David Wilson',
                'email' => 'david@example.com',
                'documents' => [
                    ['type' => 'ID', 'filename' => 'id_front.jpg', 'uploaded_at' => '2023-03-28'],
                    ['type' => 'ID', 'filename' => 'id_back.jpg', 'uploaded_at' => '2023-03-28'],
                    ['type' => 'Address', 'filename' => 'utility_bill.pdf', 'uploaded_at' => '2023-03-28']
                ]
            ],
            [
                'id' => 8,
                'name' => 'Emma Johnson',
                'email' => 'emma@example.com',
                'documents' => [
                    ['type' => 'Passport', 'filename' => 'passport.jpg', 'uploaded_at' => '2023-03-29'],
                    ['type' => 'Address', 'filename' => 'bank_statement.pdf', 'uploaded_at' => '2023-03-29']
                ]
            ]
        ];

        return view('admin.users.verification', compact('users'));
    }

    /**
     * Verify a specific user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser($id)
    {
        // This would verify the user in a real application
        
        return back()->with('success', 'User verified successfully.');
    }

    /**
     * Login as the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs($id)
    {
        // In a real app, you would impersonate the user
        // $user = User::findOrFail($id);
        // // Store the admin's ID in session to allow back
        // session()->put('admin_id', auth()->id());
        // auth()->login($user);

        // return redirect()->route('dashboard')
        //     ->with('success', 'You are now logged in as ' . $user->name);

        // For now, just redirect back
        return redirect()->route('admin.users.index')
            ->with('success', 'Login as user functionality will be implemented in production.');
    }

    /**
     * Adjust the user's balance (credit or debit).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adjustBalance(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'transaction_type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
        ]);
        
        // In a real application, we would update the user's balance
        // and create a transaction record
        
        // For now, let's just show a success message
        $transactionType = $validated['transaction_type'];
        $amount = number_format($validated['amount'], 2);
        
        $message = $transactionType === 'credit' 
            ? "Successfully credited \${$amount} to user's account." 
            : "Successfully debited \${$amount} from user's account.";
        
        return redirect()->route('admin.users.show', $id)
            ->with('success', $message);
    }
}
