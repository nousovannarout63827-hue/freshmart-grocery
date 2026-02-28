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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount_percent', 5, 2)->default(0)->after('price'); // Discount percentage (0-100)
            $table->decimal('discount_price', 10, 2)->nullable()->after('discount_percent'); // Calculated discounted price
            $table->dateTime('discount_start')->nullable()->after('discount_price'); // Discount start date
            $table->dateTime('discount_end')->nullable()->after('discount_start'); // Discount end date
            $table->boolean('is_on_sale')->default(false)->after('discount_end'); // Flag for active sale
            $table->string('sale_label')->nullable()->after('is_on_sale'); // Custom sale label (e.g., "Flash Sale", "50% OFF")
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['discount_percent', 'discount_price', 'discount_start', 'discount_end', 'is_on_sale', 'sale_label']);
        });
    }
};
