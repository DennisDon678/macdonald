<?php
// filepath: c:\Users\DENIS DON\Desktop\Laravel_works\macdonald\app\Http\Controllers\Admin\AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Placeholder stats data (normally would be fetched from database)
        $stats = [
            'total_users' => User::count(),
            'new_users_today' => User::whereDate('created_at', now())->count(),
            'total_invested' => Investment::where('status', 'completed')->orWhere('status','active')->sum('amount'),
            'invested_today' => Investment::whereDate('created_at', now())->where('status','active')->sum('amount'),
            'total_deposits' => Transaction::where('type', 'deposit')->where('status','completed')->sum('amount'),
            'deposited_today' => Transaction::where('type', 'deposit')->where('status','completed')->whereDate('created_at', now())->sum('amount'),
            'total_withdrawals' => Transaction::where('type', 'withdrawal')->where('status','completed')->sum('amount'),
            'total_withdrawals' => Transaction::where('type', 'withdrawal')->where('status','completed')->sum('amount'),
            'withdrawn_today' => Transaction::where('type', 'withdrawal')->where('status','completed')->whereDate('created_at', now())->sum('amount'),
        ];

        // Pending items counts
        $pendingDeposits = Transaction::where('type', 'deposit')->where('status', 'pending')->count();
        $pendingWithdrawals = Transaction::where('type', 'withdrawal')->where('status', 'pending')->count();
        $pendingInvestments = Investment::where('status', 'pending')->count();

        // Sample recent activities
        $recentActivities = [
            [
                'type' => 'deposit',
                'user' => 'John Smith',
                'details' => 'Deposited $2,500.00 via Bitcoin',
                'time' => '25 minutes ago'
            ],
            [
                'type' => 'withdrawal',
                'user' => 'Sarah Johnson',
                'details' => 'Withdrew $1,200.00 to Bank Transfer',
                'time' => '1 hour ago'
            ],
            [
                'type' => 'investment',
                'user' => 'Michael Williams',
                'details' => 'Invested $5,000.00 in Gold Plan',
                'time' => '3 hours ago'
            ],
            [
                'type' => 'registration',
                'user' => 'Emma Davis',
                'details' => 'New user registration',
                'time' => '5 hours ago'
            ],
            [
                'type' => 'deposit',
                'user' => 'Robert Wilson',
                'details' => 'Deposited $1,800.00 via Ethereum',
                'time' => '8 hours ago'
            ],
            [
                'type' => 'investment',
                'user' => 'Lisa Brown',
                'details' => 'Invested $3,200.00 in Silver Plan',
                'time' => '10 hours ago'
            ],
            [
                'type' => 'withdrawal',
                'user' => 'James Miller',
                'details' => 'Withdrew $950.00 to PayPal',
                'time' => '12 hours ago'
            ],
            [
                'type' => 'registration',
                'user' => 'David Martinez',
                'details' => 'New user registration',
                'time' => '1 day ago'
            ],
        ];
        
        return view('admin.dashboard', compact(
            'stats',
            'pendingDeposits',
            'pendingWithdrawals',
            'pendingInvestments',
            'recentActivities'
        ));
    }
    
    /**
     * Show admin profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // In a real application, we would fetch the admin user
        // $admin = Auth::guard('admin')->user();
        
        // For now, create a placeholder admin object
        $user = Admin::find(Auth::guard('admin')->id());
        
        return view('admin.profile.index', compact('user'));
    }
    

    /**
     * Show list of activity logs.
     *
     * @return \Illuminate\View\View
     */
    public function activityLogs()
    {
        // In a real application, we would fetch activity logs from the database
        $activityLogs = [];
        
        return view('admin.activity-logs', compact('activityLogs'));
    }
    
    /**
     * Process logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}