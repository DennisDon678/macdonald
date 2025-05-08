<?php


// import layout Routes

use App\Mail\Welcome;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/HomeRoutes.php';

// import dashboard Routes
require_once __DIR__ . '/DashboardRoutes.php';

// import admin Routes
require_once __DIR__ . '/AdminRoutes.php';

Route::prefix('command')->group(function () {
    Route::get('/storage', function () {
        Artisan::call('storage:link');
        return 'Storage link created';
    });
    Route::get('/migrate', function () {
        Artisan::call('migrate');
        return 'Migrations run';
    });
});

Route::get('/calculate_interest', function () {

    // check last update is not today
    $activeInvestment = \App\Models\Investment::where('status', 'active')->where('updated_at', '!=', today())->where('next_payout', '<=', today())->get();


    foreach ($activeInvestment as $investment) {
        // make sure last update is 24 hours ago
        if ($investment->updated_at->diffInHours(now()) >= 24) {


            // get the number of days since last payout
            $days = $investment->next_payout->diffInDays(today());

            // calculate interest
            $interest = ($investment->amount * $investment->interest_rate / 100) * $days;

            // update the investment
            $investment->profit_to_date += $interest;
            $investment->next_payout = today()->addDays(1);
            $investment->total_profit += $interest;
            $investment->days_remaining = $investment->days_remaining - $days;

            // update the user's balance
            $user = \App\Models\User::find($investment->user_id);
            $user->balances->balance += $interest;

            // check if today is the last day of the investment
            if ($investment->days_remaining <= 0) {
                $investment->status = 'completed';
                $investment->days_remaining = 0;
                $investment->next_payout = null;

                // send email to  user
                try {
                    Mail::to($user->email)->send(new \App\Mail\Investment\Ended($investment));
                } catch (\Exception $e) {
                    Log::error('Email sending failed: ' . $e->getMessage());
                    return back()->with('error', 'Failed to send email. Please try again.');
                }
            }
            $investment->save();

            $user->balances->save();
        }
    }

    return 'Interest calculated and emails sent';
});
