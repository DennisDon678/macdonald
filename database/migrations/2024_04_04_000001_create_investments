_table.php

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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->string('reference')->unique();
            $table->decimal('amount', 14, 2);
            $table->decimal('daily_profit', 14, 2);
            $table->decimal('total_profit', 14, 2)->default(0.00);
            $table->decimal('total_expected_return', 14, 2);
            $table->decimal('profit_to_date', 14, 2)->default(0.00);
            $table->integer('duration'); // Duration in days
            $table->integer('days_remaining'); // Days remaining
            $table->decimal('progress', 5, 2)->default(0.00); // Percentage complete
            $table->enum('status', ['pending', 'active', 'completed', 'terminated', 'rejected'])->default('pending');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('next_payout')->nullable();
            $table->decimal('interest_rate', 8, 2); // Interest rate in percentage
            $table->string('deposit_reference')->nullable();
            $table->string('deposit_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};