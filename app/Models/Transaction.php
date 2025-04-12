<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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

}
