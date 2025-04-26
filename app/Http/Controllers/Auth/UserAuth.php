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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:255|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $request->username,
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'User registration failed!');
        }

        // create wallet for user
        $wallet = $user->wallets()->create([
            'btc_address' => $request->btc,
            'eth_address' => $request->eth,
            'usdt_address' => $request->usdt,
        ]);

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
                $referrer->referrals()->create([
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
}
