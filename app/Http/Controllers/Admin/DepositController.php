<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            
            // Update user's balance
            $deposit->user->balances->increment('balance', $deposit->amount);
        });
        
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
        
        return redirect()->back()->with('success', 'Deposit rejected successfully.');
    }
}
