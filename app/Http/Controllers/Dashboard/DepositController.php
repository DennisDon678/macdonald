<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DepositWallet;
use App\Models\Plan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Show the deposit creation form.
     */
    public function create()
    {
        $plans = Plan::all();

        // Define available cryptocurrencies
        $cryptocurrencies = DepositWallet::all();

        return view('dashboard.deposits.create', compact('plans', 'cryptocurrencies'));
    }

    /**
     * Store a newly created deposit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|min:1|max:3',
            'amount' => 'required|numeric|min:1',
            'crypto' => 'required',
        ]);

        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return back()->withErrors(['plan_id' => 'Invalid plan selected'])->withInput();
        }

        // Validate minimum and maximum deposit
        if ($request->amount < $plan->min_investment || $request->amount > $plan->max_investment) {
            return back()->withErrors([
                'amount' => "Investment amount must be between $" . number_format($plan->min_investment, 2) .
                    " and $" . number_format($plan->max_investment, 2)
            ])->withInput();
        }

        // Generate a unique reference
        $reference = strtoupper(Str::random(12));

        // create a new transaction
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'status' => 'pending',
            'reference' => $reference,
            'crypto' => $request->crypto,
        ]);

        // Store transaction in session
        session(['pending_transaction' => $transaction]);
        session(['selected_plan' => [
            'id' => $plan->id,
            'name' => $plan->name,
            'interest_rate' => $plan->interest_rate,
            'duration' => $plan->duration,
        ]]);


        // Redirect to confirmation page
        return redirect()->route('dashboard.deposits.confirm', $reference)
            ->with('success', 'Your deposit has been initiated. Please complete the payment.');
    }

    /**
     * Display the confirmation page for a deposit.
     */
    public function confirm($reference)
    {
        $transaction = Transaction::where('reference', $reference)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Check if transaction exists in session and matches the reference
        if (!$transaction || $transaction['reference'] !== $reference) {
            return redirect()->route('dashboard.deposits.create')
                ->with('error', 'Transaction not found. Please try again.');
        }

        $plan = session('selected_plan');

        $crypto = DepositWallet::find($transaction->crypto);

        return view('dashboard.deposits.confirm', compact('transaction', 'plan', 'crypto'));
    }

    /**
     * Display the deposit history.
     */
    public function history()
    {
        // Placeholder for transaction history
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->where('type', 'deposit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.deposits.history', compact('transactions'));
    }

    /**
     * Display a specific deposit.
     */
    public function show($id)
    {
        // Placeholder for a single transaction
        $transaction = [
            'id' => $id,
            'reference' => 'DEP' . strtoupper(Str::random(8)),
            'amount' => 500.00,
            'currency' => 'btc',
            'status' => 'completed',
            'created_at' => now()->subDays(5),
        ];

        // Convert to object to match expected behavior in template
        $transaction = (object)$transaction;

        $investment = null; // Placeholder for investment details

        return view('dashboard.deposits.show', compact('transaction', 'investment'));
    }

    /**
     * Handle transaction receipt upload.
     */
    public function uploadReceipt(Request $request, $reference)
    {
        $request->validate([
            'receipt' => 'required|image|max:5120', // Max 5MB image file
        ]);

        // Check if the transaction exists in the session
        $transaction = Transaction::find($reference);
        if (!$transaction) {
            return redirect()->route('dashboard.deposits.history')
                ->with('error', 'Transaction not found. Please try again.');
        }

        if ($request->hasFile('receipt')) {
            // Get filename with extension
            $filenameWithExt = $request->file('receipt')->getClientOriginalName();

            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get extension
            $extension = $request->file('receipt')->getClientOriginalExtension();

            // Create unique filename with timestamp
            $fileNameToStore = 'DEP_' . time() . '.' . $extension;

            $path = $request->file('receipt')->storeAs('public/receipts', $fileNameToStore);

            // Save the file path to the transaction
            $transaction->screenshot = $fileNameToStore;
            $transaction->save();

            // send email to user
            try {
            } catch (\Exception $e) {
            }

            // For now, we'll just simulate that the file was successfully saved
            return redirect()->route('dashboard.deposits.history')
                ->with('success', 'Your transaction receipt has been uploaded successfully. Your deposit will be verified shortly.');
        }

        return redirect()->back()->with('error', 'Something went wrong with the file upload.');
    }
}
