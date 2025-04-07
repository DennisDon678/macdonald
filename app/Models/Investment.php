<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Investment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'reference',
        'amount',
        'daily_profit',
        'total_profit',
        'total_expected_return',
        'profit_to_date',
        'duration',
        'days_remaining',
        'progress',
        'status',
        'start_date',
        'end_date',
        'next_payout',
        'interest_rate',
        'deposit_reference',
        'deposit_method',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'daily_profit' => 'decimal:2',
        'total_profit' => 'decimal:2',
        'total_expected_return' => 'decimal:2',
        'profit_to_date' => 'decimal:2',
        'progress' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'next_payout' => 'date',
    ];

    /**
     * Get the user that owns the investment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the plan associated with the investment.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the transactions associated with the investment.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the activity logs associated with the investment.
     */
    public function activities()
    {
        return $this->hasMany(ActivityLog::class);
    }

}