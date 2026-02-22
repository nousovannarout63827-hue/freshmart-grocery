<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates role_histories table for audit trail of staff role changes.
     * Tracks who was changed, old/new roles, and which admin made the change.
     */
    public function up(): void
    {
        Schema::create('role_histories', function (Blueprint $table) {
            $table->id();
            
            // The staff member whose role was changed
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // The admin who made the change
            $table->foreignId('changed_by')->constrained('users');
            
            $table->string('old_role');
            $table->string('new_role');
            $table->text('reason')->nullable(); // Optional reason for the change
            
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
        Schema::dropIfExists('role_histories');
    }
};
