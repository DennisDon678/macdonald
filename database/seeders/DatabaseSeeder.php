<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Models\Plan;
use App\Models\DepositWallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'password' => bcrypt('123456789'),
            'phone' => '1234567890',
        ]);

        // Seed default investment plans
        Plan::create([
            'name' => 'Silver Plan',
            'min_investment' => 100.00,
            'max_investment' => 999.00,
            'interest_rate' => 2.50, // 2.5% daily
            'duration' => 30, // 30 days
        ]);

        Plan::create([
            'name' => 'Gold Plan',
            'min_investment' => 1000.00,
            'max_investment' => 9999.00,
            'interest_rate' => 5.00, // 5% daily
            'duration' => 30, // 30 days
        ]);

        Plan::create([
            'name' => 'Platinum Plan',
            'min_investment' => 10000.00,
            'max_investment' => 100000.00,
            'interest_rate' => 7.50, // 7.5% daily
            'duration' => 30, // 30 days
        ]);

        // Seed default cryptocurrency deposit wallets
        DepositWallet::create([
            'name' => 'Bitcoin',
            'code' => 'btc',
            'address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'icon' => 'cf cf-btc',
        ]);

        DepositWallet::create([
            'name' => 'Ethereum',
            'code' => 'eth',
            'address' => '0x742d35Cc6634C0532925a3b844Bc454e4438f44e',
            'network' => 'ERC20',
            'icon' => 'cf cf-eth',
        ]);

        DepositWallet::create([
            'name' => 'Tether USDT',
            'code' => 'usdt',
            'address' => '0x742d35Cc6634C0532925a3b844Bc454e4438f44e',
            'network' => 'TRC20',
            'icon' => 'cf cf-usdt',
        ]);
    }
}
