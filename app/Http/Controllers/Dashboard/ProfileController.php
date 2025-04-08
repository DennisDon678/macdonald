<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        
        // In a real implementation, you would update the user record
        // For now, just simulate a successful update
        
        if ($request->hasFile('profile_photo')) {
            // Handle file upload in a real implementation
            // $path = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        
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
        
        // In a real implementation, you would validate the current password
        // and update with the new one if correct
        
        return redirect()->route('dashboard.profile')
            ->with('success', 'Your password has been changed successfully.');
    }
    
    /**
     * Show form for configuring two-factor authentication.
     */
    public function showTwoFactorForm()
    {
        // Create placeholder 2FA status for testing
        $twoFactorStatus = (object) [
            'enabled' => false,
            'verified' => false,
            'recovery_codes' => null
        ];

        // generate a new secret key for 2FA
        $twoFactorSecret = 'ABC123'; 
        return view('dashboard.profile.two-factor', compact('twoFactorStatus','twoFactorSecret'));
    }
}
