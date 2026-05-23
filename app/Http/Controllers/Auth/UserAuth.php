<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\Referral_code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserAuth extends Controller
{
    public function Register(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:255|unique:users',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->filled('name') && $this->isGibberish($request->name, 'name')) {
                $validator->errors()->add('name', 'The name provided appears to be invalid or gibberish.');
            }
            if ($request->filled('username') && $this->isGibberish($request->username, 'username')) {
                $validator->errors()->add('username', 'The username provided appears to be invalid or gibberish.');
            }
            if ($request->filled('phone') && $this->isGibberish($request->phone, 'phone')) {
                $validator->errors()->add('phone', 'The phone number provided appears to be invalid or gibberish.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $request->username,
            'country' => $request->country,
            'phone_number' => $request->phone,
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'User registration failed!');
        }

        // create finance record for user
        $finance = $user->balances()->create();
        
        // generate referral code
        $referralCode = strtoupper(substr($user->name, 0, 3) . substr($user->email, 0, 3) . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));
        $user->referral_code()->create([
            'code' => $referralCode,
        ]);

        // check if user is referred
        if($request->has('ref')) {
            $referrer = Referral_code::with('user')->where('code',$request->ref)->first();
            if ($referrer) {
                // create referral record
                Referral::create([
                    'user_id' => $referrer->user->id,
                    'referred_user_id' => $user->id,
                    'earnings' => 0,
                ]);
            }
        }

        // Welcome email preparation
        try {
            // email details and sending logic
            Mail::to($user->email)->send(new \App\Mail\Welcome($user));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send welcome email!');
        }

        // Login user
        Auth::attempt(['email' => $user->email, 'password' => $request->password]);

        // redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'User registered successfully!');
    }

    public function Login(Request $request){
        // Validate data
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        // Login users
        $auth = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if(!$auth){
            return redirect()->back()->with('error','Invalid Credentials');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Determine if the input text matches common gibberish/spam patterns.
     */
    private function isGibberish($text, $type)
    {
        $text = trim($text);
        
        if ($type === 'name') {
            // Must contain only letters, spaces, dots, apostrophes, and dashes
            if (!preg_match("/^[a-zA-Z\s\.\'\-]+$/", $text)) {
                return true;
            }
            
            // Should contain at least one vowel (a, e, i, o, u)
            if (!preg_match("/[aeiouAEIOU]/", $text)) {
                return true;
            }

            // No 4 consecutive identical characters (e.g. aaaa)
            if (preg_match("/(.)\\1{3,}/", $text)) {
                return true;
            }

            // No 5 consecutive consonants (highly unlikely in real names)
            if (preg_match("/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]{5,}/", $text)) {
                return true;
            }
        }

        if ($type === 'username') {
            // Must be alphanumeric, underscores, or dashes
            if (!preg_match("/^[a-zA-Z0-9_\-]+$/", $text)) {
                return true;
            }

            // No 4 consecutive identical characters
            if (preg_match("/(.)\\1{3,}/", $text)) {
                return true;
            }

            // No 6 consecutive consonants
            if (preg_match("/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]{6,}/", $text)) {
                return true;
            }
        }

        if ($type === 'phone') {
            // Only allow digits, plus, spaces, dashes, parentheses
            if (!preg_match("/^\+?[0-9\s\-()]{7,20}$/", $text)) {
                return true;
            }

            // No repeating single digit like 11111111
            if (preg_match("/^(\d)\1{5,}$/", preg_replace("/\D/", "", $text))) {
                return true;
            }

            // No sequential digits like 12345678 or 87654321
            $digits = preg_replace("/\D/", "", $text);
            if (strpos("01234567890123456789", $digits) !== false || strpos("98765432109876543210", $digits) !== false) {
                if (strlen($digits) >= 6) {
                    return true;
                }
            }
        }

        return false;
    }
}
