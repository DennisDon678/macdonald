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
