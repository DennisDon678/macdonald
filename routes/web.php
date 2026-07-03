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
    $activeInvestment = \App\Models\Investment::where('status', 'active')
        ->whereDate('updated_at', '!=', today())
        ->where(function($query) {
            $query->where('next_payout', '<=', today())
                  ->orWhereNull('next_payout');
        })
        ->get();


    foreach ($activeInvestment as $investment) {
        // make sure last update is 24 hours ago
        if ($investment->updated_at->diffInHours(now()) >= 24) {

            // get the number of days since last payout. If next_payout is null, assume it's due today.
            $days = $investment->next_payout ? $investment->next_payout->diffInDays(today()) + 1 : 1;

            // calculate interest
            $interest = ($investment->amount * $investment->interest_rate / 100) * $days;

            \Illuminate\Support\Facades\DB::transaction(function() use ($investment, $days, $interest) {
                // update the investment
                $investment->profit_to_date += $interest;
                $investment->next_payout = today()->addDays(1);
                $investment->total_profit += $interest;
                $investment->days_remaining = max(0, $investment->days_remaining - $days);
                
                if ($investment->duration > 0) {
                    $investment->progress = (($investment->duration - $investment->days_remaining) / $investment->duration) * 100;
                }

                // update the user's balance
                $user = \App\Models\User::find($investment->user_id);
                if ($user && $user->balances) {
                    $user->balances->balance += $interest;
                    $user->balances->save();
                }

                // create transaction history for the profit
                if ($interest > 0) {
                    \App\Models\Transaction::create([
                        'user_id' => $investment->user_id,
                        'type' => 'profit',
                        'amount' => $interest,
                        'status' => 'completed',
                        'reference' => 'PRF' . strtoupper(\Illuminate\Support\Str::random(10)),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // check if today is the last day of the investment
                if ($investment->days_remaining <= 0) {
                    $investment->status = 'completed';
                    $investment->days_remaining = 0;
                    $investment->next_payout = null;

                    // return capital to user
                    if ($user && $user->balances) {
                        $user->balances->balance += $investment->amount;
                        $user->balances->save();

                        \App\Models\Transaction::create([
                            'user_id' => $investment->user_id,
                            'type' => 'capital_return',
                            'amount' => $investment->amount,
                            'status' => 'completed',
                            'reference' => 'CAP' . strtoupper(\Illuminate\Support\Str::random(10)),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    // send email to  user
                    try {
                        Mail::to($user->email)->send(new \App\Mail\Investment\Ended($investment));
                    } catch (\Exception $e) {
                        Log::error('Email sending failed: ' . $e->getMessage());
                    }
                }
                $investment->save();
            });
        }
    }

    return 'Interest calculated and emails sent';
});
