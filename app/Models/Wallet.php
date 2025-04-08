<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'btc_address',
        'eth_address',
        'usdt_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
