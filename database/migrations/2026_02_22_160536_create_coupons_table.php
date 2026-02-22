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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g., 'FRESH20'
            $table->enum('type', ['fixed', 'percent']); // Fixed amount ($5) or Percentage (20%)
            $table->decimal('value', 8, 2); // The actual discount number
            $table->decimal('min_purchase', 8, 2)->default(0); // Minimum purchase required
            $table->boolean('status')->default(true); // 1 = active, 0 = expired/disabled
            $table->timestamp('expires_at')->nullable(); // Optional expiration date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
