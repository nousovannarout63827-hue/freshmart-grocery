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
        Schema::table('coupons', function (Blueprint $table) {
            $table->string('name')->nullable()->after('code');
            $table->text('description')->nullable()->after('name');
            $table->enum('scope', ['all_products', 'specific_products', 'specific_categories'])->default('all_products')->after('value');
            $table->json('product_ids')->nullable()->after('scope');
            $table->json('category_ids')->nullable()->after('product_ids');
            $table->enum('target_type', ['all_customers', 'specific_customers'])->default('all_customers')->after('category_ids');
            $table->json('customer_ids')->nullable()->after('target_type');
            $table->timestamp('valid_from')->nullable()->after('customer_ids');
            $table->timestamp('valid_until')->nullable()->after('valid_from');
            $table->integer('usage_limit')->default(0)->after('valid_until');
            $table->integer('usage_count')->default(0)->after('usage_limit');
            $table->boolean('auto_apply')->default(false)->after('status');
            $table->unsignedBigInteger('created_by')->nullable()->after('auto_apply');
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn([
                'name',
                'description',
                'scope',
                'product_ids',
                'category_ids',
                'target_type',
                'customer_ids',
                'valid_from',
                'valid_until',
                'usage_limit',
                'usage_count',
                'auto_apply',
                'created_by',
            ]);
        });
    }
};
