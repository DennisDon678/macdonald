<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'status',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
