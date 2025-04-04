<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    /**
     * Display the referral dashboard.
     */
    public function index()
    {
        // Placeholder user
        $user = (object) [
            'id' => 1,
            'name' => 'Test User',
            'email' => 'user@example.com',
            'referral_code' => 'USERREF123456',
            'referral_url' => route('register') . '?ref=USERREF123456',
        ];
        
        // Placeholder referral statistics
        $stats = [
            'total_referrals' => 12,
            'active_referrals' => 8,
            'pending_referrals' => 4,
            'total_earnings' => 350.25,
            'pending_earnings' => 75.50,
            'paid_earnings' => 274.75,
        ];
        
        
        // Placeholder for recent referral activities
        $recentReferrals = collect([
            [
                'id' => 101,
                'name' => 'John Smith',
                'email' => 'j***h@gmail.com',
                'date' => now()->subDays(2),
                'status' => 'active',
                'investments' => 1200.00,
                'earnings' => 120.00,
            ],
            [
                'id' => 102,
                'name' => 'Emma Johnson',
                'email' => 'e***n@outlook.com',
                'date' => now()->subDays(5),
                'status' => 'active',
                'investments' => 800.00,
                'earnings' => 80.00,
            ],
            [
                'id' => 103,
                'name' => 'Michael Davis',
                'email' => 'm***s@yahoo.com',
                'date' => now()->subDays(9),
                'status' => 'pending',
                'investments' => 0,
                'earnings' => 0,
            ],
            [
                'id' => 104,
                'name' => 'Sarah Wilson',
                'email' => 's***n@gmail.com',
                'date' => now()->subDays(12),
                'status' => 'active',
                'investments' => 500.00,
                'earnings' => 50.00,
            ],
        ]);
        
        return view('dashboard.referrals.index', compact('user', 'stats', 'recentReferrals'));
    }
    
    /**
     * Show marketing materials and promotion tools.
     */
    public function marketing()
    {
        // Placeholder user
        $user = (object) [
            'id' => 1,
            'name' => 'Test User',
            'referral_code' => 'USERREF123456',
            'referral_url' => route('register') . '?ref=USERREF123456',
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
        $socialTemplates = [
            [
                'id' => 1,
                'title' => 'Facebook Post',
                'text' => "I've been investing with MacDonald Investment Platform and earning consistent returns. Join me using my referral link and get started on your investment journey today! [referral_link]",
            ],
            [
                'id' => 2,
                'title' => 'Twitter/X Tweet',
                'text' => "Earn passive income with MacDonald Investments! I've been getting great returns. Use my link to join: [referral_link] #investing #passiveincome #cryptoinvestment",
            ],
            [
                'id' => 3,
                'title' => 'Email Template',
                'text' => "Hi,\n\nI wanted to share an investment opportunity that's been working well for me. MacDonald Investment Platform offers great returns on investments, with daily payouts and a straightforward platform.\n\nIf you're interested, you can sign up using my referral link: [referral_link]\n\nLet me know if you have any questions!\n\nBest regards,\n[Your Name]",
            ],
        ];
        
        return view('dashboard.referrals.marketing', compact('user', 'banners', 'socialTemplates'));
    }
}
