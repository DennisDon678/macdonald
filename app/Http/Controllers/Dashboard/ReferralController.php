<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\ThemeService;

class ReferralController extends Controller
{
    /**
     * Display the referral dashboard.
     */
    public function index()
    {
        // Placeholder user
        $user = User::with('referral_code')->find(Auth::id());

        // Placeholder referral statistics
        $stats = [
            'total_referrals' => $user->referral->count(),
            'total_earnings' => $user->referral->sum('earnings'),
        ];


        $recentReferrals = Referral::with('referredUser')->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($referral) {
                return [
                    'name' => $referral->referredUser->name,
                    'email' => $referral->referredUser->email,
                    'earnings' => $referral->earnings,
                    'date' => $referral->created_at,
                ];
            });

        return ThemeService::view('dashboard.referrals.index', compact('user', 'stats', 'recentReferrals'));
    }

    /**
     * Show marketing materials and promotion tools.
     */
    public function marketing()
    {
        $realUser = User::with('referral_code')->find(Auth::id());
        $referralCode = $realUser->referral_code->code ?? 'NOCODE';

        $user = (object) [
            'id' => $realUser->id,
            'name' => $realUser->name,
            'referral_code' => $referralCode,
            'referral_url' => route('register') . '?ref=' . $referralCode,
        ];

        // Placeholder for marketing materials
        $banners = [
            [
                'id' => 1,
                'title' => '300x250 Medium Rectangle',
                'image' => 'https://via.placeholder.com/300x250?text=Refer+and+Earn',
                'width' => 300,
                'height' => 250,
                'html_code' => '<a href="' . $user->referral_url . '"><img src="https://via.placeholder.com/300x250?text=Refer+and+Earn" alt="Investment Banner" width="300" height="250"></a>',
            ],
            [
                'id' => 2,
                'title' => '728x90 Leaderboard',
                'image' => 'https://via.placeholder.com/728x90?text=Join+Our+Investment+Platform',
                'width' => 728,
                'height' => 90,
                'html_code' => '<a href="' . $user->referral_url . '"><img src="https://via.placeholder.com/728x90?text=Join+Our+Investment+Platform" alt="Investment Banner" width="728" height="90"></a>',
            ],
            [
                'id' => 3,
                'title' => '160x600 Skyscraper',
                'image' => 'https://via.placeholder.com/160x600?text=Invest+Today',
                'width' => 160,
                'height' => 600,
                'html_code' => '<a href="' . $user->referral_url . '"><img src="https://via.placeholder.com/160x600?text=Invest+Today" alt="Investment Banner" width="160" height="600"></a>',
            ],
        ];

        // Placeholder for social media text templates
        $appName = config('app.name', 'MacDonald');
        $socialTemplates = [
            [
                'id' => 1,
                'title' => 'Facebook Post',
                'text' => "I've been investing with " . $appName . " Investment Platform and earning consistent returns. Join me using my referral link and get started on your investment journey today! [referral_link]",
            ],
            [
                'id' => 2,
                'title' => 'Twitter/X Tweet',
                'text' => "Earn passive income with " . $appName . " Investments! I've been getting great returns. Use my link to join: [referral_link] #investing #passiveincome #cryptoinvestment",
            ],
            [
                'id' => 3,
                'title' => 'Email Template',
                'text' => "Hi,\n\nI wanted to share an investment opportunity that's been working well for me. " . $appName . " Investment Platform offers great returns on investments, with daily payouts and a straightforward platform.\n\nIf you're interested, you can sign up using my referral link: [referral_link]\n\nLet me know if you have any questions!\n\nBest regards,\n[Your Name]",
            ],
        ];

        return ThemeService::view('dashboard.referrals.marketing', compact('user', 'banners', 'socialTemplates'));
    }
}
