<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    /**
     * Display a listing of the deposits.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Transaction::deposits()->with('user');
        
        if ($status) {
            $query->status($status);
        }
        
        $deposits = $query->latest()->paginate(15);
        
        return view('admin.deposits.index', compact('deposits', 'status'));
    }

    /**
     * Show the specified deposit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deposit = Transaction::deposits()->with('cryptoWallet')->findOrFail($id);
        return view('admin.deposits.show', compact('deposit'));
    }
    
    /**
     * Approve a pending deposit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $deposit = Transaction::deposits()->pending()->findOrFail($id);
        
        DB::transaction(function() use ($deposit) {
            // Update deposit status
            $deposit->update([
                'status' => Transaction::STATUS_COMPLETED,
                'processed_at' => now(),
            ]);
            
            // // Update user's balance
            // $deposit->user->balances->increment('balance', $deposit->amount);
        });

        // get the investment
        $investment = $deposit->investment;
        // check if the investment is not null
        if($investment) {
            $investment->update([
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addDays($investment->duration),
                'next_payout' => now()->addHours(24),
            ]);
        }

        // Send email to user
        try {
            Mail::to($deposit->user->email)->send(new \App\Mail\Deposit\Approved($deposit));
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Please try again.');
        }
        
        return redirect()->back()->with('success', 'Deposit approved successfully.');
    }
    
    /**
     * Reject a pending deposit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejected_reason' => 'nullable|string|max:255',
        ]);
        
        $deposit = Transaction::deposits()->pending()->findOrFail($id);
        
        $deposit->update([
            'status' => Transaction::STATUS_REJECTED,
        ]);

        $investment = $deposit->investment;

        // delete the investment if it exists
        if($investment) {
            $investment->delete();
        }
        // Send email to user
        try {
            Mail::to($deposit->user->email)->send(new \App\Mail\Deposit\Rejected($deposit));
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Please try again.');
        }

        return redirect()->back()->with('success', 'Deposit rejected successfully.');
    }
}
