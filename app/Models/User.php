<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function balances()
    {
        return $this->hasOne(Finance::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function referral_code()
    {
        return $this->hasOne(Referral_code::class);
    }
    public function referral()
    {
        return $this->hasMany(Referral::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
    public function deposits()
    {
        return $this->hasMany(Transaction::class)->where('type', 'deposit');
    }
    public function withdrawals()
    {
        return $this->hasMany(Transaction::class)->where('type', 'withdrawal');
    }

    public function referrer()
    {
        return $this->hasOne(Referral::class, 'referred_user_id')->join('users', 'referrals.user_id', '=', 'users.id')
            ->select('referrals.*', 'users.name as referrer_name', 'users.email as referrer_email');
    }
    
    public function referrals()
    {
        return $this->hasMany(Referral::class, 'user_id');
    }}