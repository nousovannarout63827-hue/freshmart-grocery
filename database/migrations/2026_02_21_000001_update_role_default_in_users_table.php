<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Updates the role column default to 'staff' for new user creation.
     * Existing users will keep their current role values.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Change the default role to 'staff' for backward compatibility
            // Admin and Driver roles are explicitly set during user creation
            $table->string('role')->default('staff')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert to the original default
            $table->string('role')->default('customer')->change();
        });
    }
};
