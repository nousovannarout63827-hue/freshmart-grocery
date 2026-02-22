<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds comprehensive demographic fields to users table for HR management.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // We make them nullable so existing accounts don't break
            $table->string('phone_number')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone_number');
            $table->date('dob')->nullable()->after('gender');
            $table->string('pob')->nullable()->after('dob');
            $table->text('current_address')->nullable()->after('pob');
            $table->text('bio')->nullable()->after('current_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'gender', 'dob', 'pob', 'current_address', 'bio']);
        });
    }
};
