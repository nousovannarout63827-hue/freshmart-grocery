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
        Schema::table('reviews', function (Blueprint $table) {
            $table->boolean('is_flagged')->default(false)->after('is_approved');
            $table->boolean('is_banned')->default(false)->after('is_flagged');
            $table->text('ban_reason')->nullable()->after('is_banned');
            $table->foreignId('moderator_id')->nullable()->after('ban_reason')->constrained('users')->onDelete('set null');
            $table->timestamp('banned_at')->nullable()->after('moderator_id');
            
            // Index for moderation queries
            $table->index(['is_flagged', 'is_banned']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['is_flagged', 'is_banned']);
            $table->dropForeign(['moderator_id']);
            $table->dropColumn(['is_flagged', 'is_banned', 'ban_reason', 'moderator_id', 'banned_at']);
        });
    }
};
