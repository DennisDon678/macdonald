<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral_code extends Model
{
    protected $fillable = [
        'user_id',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'user_id');
    }
}
