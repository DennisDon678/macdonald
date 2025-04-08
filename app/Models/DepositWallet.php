<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositWallet extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address',
        'network',
        'icon',
    ];

}
