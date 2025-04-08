<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'referral_balance',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
