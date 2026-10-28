<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mail:test {email}', function (string $email) {
    $this->info("Attempting to send a test welcome email to: {$email}");
    $this->line("Mailer: " . config('mail.default'));
    $this->line("Host: " . config('mail.mailers.smtp.host') . ":" . config('mail.mailers.smtp.port'));
    $this->line("From: " . config('mail.from.address') . " (" . config('mail.from.name') . ")");

    try {
        $dummyUser = new \App\Models\User([
            'name' => 'Test Recipient',
            'email' => $email,
        ]);
        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\Welcome($dummyUser));
        $this->info("✓ Test email sent successfully!");
    } catch (\Throwable $e) {
        $this->error("✗ Failed to send email: " . $e->getMessage());
        $this->line("Stack trace:\n" . $e->getTraceAsString());
    }
})->purpose('Test mail configuration by sending a welcome email to an address');

Artisan::command('mail:test-withdrawal {email}', function (string $email) {
    $this->info("Attempting to send a test Withdrawal Approved email to: {$email}");
    $this->line("Mailer: " . config('mail.default'));
    $this->line("Host: " . config('mail.mailers.smtp.host') . ":" . config('mail.mailers.smtp.port'));

    try {
        $dummyUser = new \App\Models\User([
            'id' => 9999,
            'name' => 'Test Investor',
            'email' => $email,
        ]);
        $dummyWithdrawal = new \App\Models\Transaction([
            'user_id' => $dummyUser->id,
            'amount' => 250.00,
            'type' => 'withdrawal',
            'status' => 'completed',
            'currency' => 'btc',
            'wallet_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
            'reference' => 'WDTEST' . strtoupper(\Illuminate\Support\Str::random(6)),
            'processed_at' => now(),
        ]);
        $dummyWithdrawal->setRelation('user', $dummyUser);

        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\Withdrawal\Approved($dummyWithdrawal));
        $this->info("✓ Withdrawal Approved email successfully dispatched to {$email}!");
    } catch (\Throwable $e) {
        $this->error("✗ Failed to send withdrawal email: " . $e->getMessage());
        $this->line("Stack trace:\n" . $e->getTraceAsString());
    }
})->purpose('Test sending a withdrawal approved email to a given address');
