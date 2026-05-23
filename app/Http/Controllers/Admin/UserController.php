<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('verified')) {
            if ($request->input('verified') === 'yes') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        $query->orderBy('created_at', 'desc');

        $users = $query->paginate(10);

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

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'],
            'email_verified_at' => $request->has('verified') ? now() : null,
        ]);

        if ($user) {
            // create finance record for user
            $user->balances()->create([
                'balance' => $request->input('balance', 0.00),
            ]);

            // generate referral code
            $referralCode = strtoupper(substr($user->name, 0, 3) . substr($user->email, 0, 3) . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));
            $user->referral_code()->create([
                'code' => $referralCode,
            ]);
        }

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
        $user = User::with(['investments', 'deposits', 'withdrawals', 'referrer', 'referrals'])
            ->findOrFail($id);

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
        $user = User::findOrFail($id);

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

        $user = User::findOrFail($id);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'email_verified_at' => $request->has('verified') ?
                $user->email_verified_at ?? now() :
                null,
        ];

        $user->update($userData);

        if ($request->filled('balance')) {
            $user->balances()->update([
                'balance' => $request->input('balance'),
            ]);
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

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
        User::destroy($id);

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Login as the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs($id)
    {
        $user = User::findOrFail($id);
        session()->put('admin_id', Auth::guard('admin')->user()->id);
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'You are now logged in as ' . $user->name);
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
        $validated = $request->validate([
            'transaction_type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $amount = $validated['amount'];

        if ($validated['transaction_type'] === 'credit') {
            $user->balances->balance += $amount;
            $message = "Successfully credited \${$amount} to user's account.";
        } else {
            if ($user->balances->balance < $amount) {
                return back()->with('error', 'Insufficient balance for this debit.');
            }
            $user->balances->balance -= $amount;
            $message = "Successfully debited \${$amount} from user's account.";
        }

        $user->balances->save();

        $user->transactions()->create([
            'amount' => $amount,
            'type' => 'deposit',
            'status' => 'completed',
            'reference' => strtoupper(Str::random(12))
        ]);



        return redirect()->route('admin.users.show', $id)
            ->with('success', $message);
    }

    public function editPassword(User $user)
    {
        return view('admin.users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.show',$user->id)->with('success', 'Password updated successfully.');
    }
}
