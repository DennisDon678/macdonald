<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // add new columns to hold withdrawal
            $table->string('currency')->nullable()->after('type');
            $table->string('wallet_address')->nullable()->after('currency');
            $table->string('processed_at')->nullable()->after('wallet_address');
            $table->text('rejected_reason')->nullable()->after('processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
