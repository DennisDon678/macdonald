<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        // Placeholder user data
        $user = (object) [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+1 (555) 123-4567',
            'country' => 'United States',
            'city' => 'New York',
            'address' => '123 Main Street',
            'postal_code' => '10001',
            'created_at' => now()->subMonths(3),
            'email_verified' => true,
            'phone_verified' => false,
            'two_factor_enabled' => false,
            'kyc_status' => 'pending', // none, pending, verified, rejected
        ];
        
        // Placeholder for countries list
        $countries = [
            'US' => 'United States',
            'UK' => 'United Kingdom',
            'CA' => 'Canada',
            'AU' => 'Australia',
            'DE' => 'Germany',
            'FR' => 'France',
            'IT' => 'Italy',
            'ES' => 'Spain',
            'JP' => 'Japan',
            'CN' => 'China',
            'IN' => 'India',
            'BR' => 'Brazil',
            'ZA' => 'South Africa',
            'NG' => 'Nigeria',
            'KE' => 'Kenya',
        ];
        
        return view('dashboard.profile.index', compact('user', 'countries'));
    }
    
    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
        ]);
        
        // Since we don't have a database yet, we'll just show a success message
        return back()->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        // Since we don't have a database yet, we'll just simulate password validation
        // In a real app, we would verify the current password against the database
        if ($request->current_password === 'password123') {
            return back()->with('success', 'Password updated successfully.');
        }
        
        return back()->withErrors([
            'current_password' => 'The provided password does not match your current password.',
        ]);
    }
    
    /**
     * Update the user's security settings.
     */
    public function updateSecurity(Request $request)
    {
        $request->validate([
            'two_factor_auth' => ['nullable', 'boolean'],
            'login_notifications' => ['nullable', 'boolean'],
        ]);
        
        // Since we don't have a database yet, we'll just show a success message
        return back()->with('success', 'Security settings updated successfully.');
    }
    
    /**
     * Show the KYC verification form.
     */
    public function kyc()
    {
        // Placeholder user data
        $user = (object) [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'kyc_status' => 'pending', // none, pending, verified, rejected
            'kyc_rejected_reason' => null,
        ];
        
        // KYC document types
        $documentTypes = [
            'passport' => 'Passport',
            'national_id' => 'National ID',
            'drivers_license' => 'Driver\'s License',
        ];
        
        return view('dashboard.profile.kyc', compact('user', 'documentTypes'));
    }
    
    /**
     * Submit KYC verification.
     */
    public function submitKyc(Request $request)
    {
        $request->validate([
            'document_type' => ['required', 'string', 'in:passport,national_id,drivers_license'],
            'id_number' => ['required', 'string', 'max:50'],
            'id_front' => ['required', 'image', 'max:5120'], // 5MB max
            'id_back' => ['required', 'image', 'max:5120'],
            'selfie' => ['required', 'image', 'max:5120'],
        ]);
        
        // Since we don't have a database yet, we'll just show a success message
        return redirect()->route('dashboard.profile')->with('success', 'KYC verification submitted successfully. Your documents will be reviewed shortly.');
    }
    
    /**
     * Show the user's activity log.
     */
    public function activity()
    {
        // Placeholder for user activity log
        $activities = collect([
            [
                'id' => 1,
                'type' => 'login',
                'description' => 'Successful login',
                'ip_address' => '192.168.1.1',
                'location' => 'New York, US',
                'device' => 'Chrome on Windows',
                'created_at' => now()->subHours(2),
            ],
            [
                'id' => 2,
                'type' => 'profile_update',
                'description' => 'Updated profile information',
                'ip_address' => '192.168.1.1',
                'location' => 'New York, US',
                'device' => 'Chrome on Windows',
                'created_at' => now()->subDays(1),
            ],
            [
                'id' => 3,
                'type' => 'password_change',
                'description' => 'Changed account password',
                'ip_address' => '192.168.1.1',
                'location' => 'New York, US',
                'device' => 'Chrome on Windows',
                'created_at' => now()->subDays(3),
            ],
            [
                'id' => 4,
                'type' => 'login',
                'description' => 'Successful login',
                'ip_address' => '192.168.1.2',
                'location' => 'Los Angeles, US',
                'device' => 'Safari on iOS',
                'created_at' => now()->subDays(5),
            ],
            [
                'id' => 5,
                'type' => 'withdrawal',
                'description' => 'Requested withdrawal of $1,000',
                'ip_address' => '192.168.1.1',
                'location' => 'New York, US',
                'device' => 'Chrome on Windows',
                'created_at' => now()->subDays(7),
            ],
        ]);
        
        // Add pagination methods to the collection
        $activities = new \Illuminate\Pagination\LengthAwarePaginator(
            $activities,
            $activities->count(),
            10,
            1,
            ['path' => request()->url()]
        );
        
        return view('dashboard.profile.activity', compact('activities'));
    }
}
