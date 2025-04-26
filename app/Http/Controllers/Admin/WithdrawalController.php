<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the withdrawals.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Transaction::withdrawals()->with('user');
        
        if ($status) {
            $query->status($status);
        }
        
        $withdrawals = $query->latest()->paginate(15);
        
        return view('admin.withdrawals.index', compact('withdrawals', 'status'));
    }

    /**
     * Show the specified withdrawal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $withdrawal = Transaction::withdrawals()->findOrFail($id);
        
        return view('admin.withdrawals.show', compact('withdrawal'));
    }
    
    /**
     * Approve a pending withdrawal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $withdrawal = Transaction::withdrawals()->pending()->findOrFail($id);
        
        // Withdrawal was already set to pending when created, so we don't need to decrement the balance again
        $withdrawal->update([
            'status' => Transaction::STATUS_COMPLETED,
        ]);
        
        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }
    
    /**
     * Reject a pending withdrawal.
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
        
        $withdrawal = Transaction::withdrawals()->pending()->findOrFail($id);
        
        DB::transaction(function() use ($withdrawal, $request) {
            // Update withdrawal status
            $withdrawal->update([
                'status' => Transaction::STATUS_REJECTED,
                'rejected_reason' => $request->rejected_reason,
                'processed_at' => now(),
            ]);
            
            // Return the amount to user's balance since withdrawal is rejected
            $withdrawal->user->balances->increment('balance', $withdrawal->amount);
        });
        
        return redirect()->back()->with('success', 'Withdrawal rejected successfully.');
    }
}
