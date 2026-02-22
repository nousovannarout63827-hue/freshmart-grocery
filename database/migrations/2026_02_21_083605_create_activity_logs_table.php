<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates activity_logs table for tracking all user actions in the system.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who did it
            $table->string('action'); // e.g., "Created", "Updated", "Deleted"
            $table->string('module'); // e.g., "Inventory", "Category", "Staff"
            $table->text('description'); // e.g., "Added a new product: Apple"
            $table->timestamps();
            
            // Index for faster lookups by user
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
