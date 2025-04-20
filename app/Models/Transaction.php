<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Transaction types
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAWAL = 'withdrawal';
    const TYPE_INVESTMENT = 'investment';
    const TYPE_PROFIT = 'profit';

    // Transaction statuses
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'failed';

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'reference',
        'crypto',
        'currency',
        'wallet_address',
        'processed_at',
        'rejected_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class, 'reference', 'reference');
    }

    // Scope to get deposits
    public function scopeDeposits($query)
    {
        return $query->where('type', self::TYPE_DEPOSIT);
    }

    // Scope to get withdrawals
    public function scopeWithdrawals($query)
    {
        return $query->where('type', self::TYPE_WITHDRAWAL);
    }

    // Scope to filter by status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope to get pending transactions
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // Helper method to check if transaction is pending
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    // Helper method to check if transaction is completed
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    // Helper method to check if transaction is rejected
    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function cryptoWallet()
    {
        return $this->hasMany(DepositWallet::class, 'id', 'crypto');
    }
}
