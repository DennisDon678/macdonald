<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        // Create placeholder user for testing
        $user = User::find(Auth::user()->id);

        return view('dashboard.profile.index', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'country' => $request->country,
        ]);

        return redirect()->route('dashboard.profile')
            ->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Show form for changing password.
     */
    public function showChangePasswordForm()
    {
        return view('dashboard.profile.change-password');
    }

    /**
     * Handle password change.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // and update with the new one if correct
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard.profile')
            ->with('success', 'Your password has been changed successfully.');
    }

    /**
     * Show form for configuring two-factor authentication.
     */
    public function showWalletForm()
    {
        $wallets = Wallet::where('user_id', Auth::id())->first();

        return view('dashboard.profile.two-factor', compact('wallets'));
    }

    /**
     * Handle wallet update.
     */
    public function updateWallet(Request $request)
    {
        $request->validate([
            'btc_address' => 'nullable|string|max:255',
            'eth_address' => 'nullable|string|max:255',
            'usdt_address' => 'nullable|string|max:255',
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();
        if ($wallet) {
            $wallet->btc_address = $request->btc_address;
            $wallet->eth_address = $request->eth_address;
            $wallet->usdt_address = $request->usdt_address;
            $wallet->save();
        } else {
            Wallet::create([
                'user_id' => Auth::id(),
                'btc_address' => $request->btc_address,
                'eth_address' => $request->eth_address,
                'usdt_address' => $request->usdt_address,
            ]);
        }
        return redirect()->route('dashboard.profile.wallet')
            ->with('success', 'Your wallet addresses have been updated successfully.');
    }
}
