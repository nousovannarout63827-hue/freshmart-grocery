<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'value',
        'scope',
        'product_ids',
        'category_ids',
        'target_type',
        'customer_ids',
        'valid_from',
        'valid_until',
        'usage_limit',
        'usage_count',
        'min_purchase_amount',
        'status',
        'auto_apply',
        'created_by',
        'min_purchase',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'min_purchase' => 'decimal:2',
            'min_purchase_amount' => 'decimal:2',
            'status' => 'boolean',
            'auto_apply' => 'boolean',
            'product_ids' => 'array',
            'category_ids' => 'array',
            'customer_ids' => 'array',
            'valid_from' => 'datetime',
            'valid_until' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Get the admin/staff who created the coupon.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if coupon is valid (active and not expired).
     */
    public function isValid(): bool
    {
        if (!$this->status) {
            return false;
        }

        // Check date range (support both old and new column names)
        $now = now();
        $validFrom = $this->valid_from ?? $this->created_at;
        $validUntil = $this->valid_until ?? $this->expires_at;
        
        if ($validFrom && $now->lt($validFrom)) {
            return false;
        }

        if ($validUntil && $now->gt($validUntil)) {
            return false;
        }

        // Check usage limit
        if ($this->usage_limit > 0 && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Check if coupon is applicable to a specific customer.
     */
    public function isApplicableToCustomer(User $customer): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        // Check if coupon is for specific customers only
        if ($this->target_type === 'specific_customers' && !empty($this->customer_ids)) {
            if (!in_array($customer->id, $this->customer_ids)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if coupon is applicable to a product.
     */
    public function isApplicableToProduct(int $productId, ?int $categoryId = null): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($this->scope === 'all_products') {
            return true;
        }

        if ($this->scope === 'specific_products' && !empty($this->product_ids)) {
            return in_array($productId, $this->product_ids);
        }

        if ($this->scope === 'specific_categories' && !empty($this->category_ids) && $categoryId) {
            return in_array($categoryId, $this->category_ids);
        }

        return false;
    }

    /**
     * Calculate discount amount based on subtotal.
     */
    public function calculateDiscount(float $subtotal, int $productId = null, ?int $categoryId = null): float
    {
        if (!$this->isValid()) {
            return 0;
        }

        // Check minimum purchase requirement
        if ($subtotal < $this->min_purchase_amount) {
            return 0;
        }

        // Check product applicability
        if ($productId && !$this->isApplicableToProduct($productId, $categoryId)) {
            return 0;
        }

        $discount = 0;

        if ($this->type === 'fixed') {
            $discount = $this->value;
        } elseif ($this->type === 'percentage') {
            $discount = ($subtotal * $this->value) / 100;
        } elseif ($this->type === 'free_delivery') {
            // Free delivery discount would be calculated based on delivery fee
            return $this->value; // Return the delivery fee amount
        }

        // Ensure discount doesn't exceed subtotal
        return min($discount, $subtotal);
    }

    /**
     * Increment usage count.
     */
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    /**
     * Get discount label for display.
     */
    public function getDiscountLabelAttribute(): string
    {
        if ($this->type === 'percentage') {
            return "{$this->value}% OFF";
        } elseif ($this->type === 'fixed') {
            return "\${$this->value} OFF";
        } elseif ($this->type === 'free_delivery') {
            return "FREE DELIVERY";
        }

        return "DISCOUNT";
    }
}
