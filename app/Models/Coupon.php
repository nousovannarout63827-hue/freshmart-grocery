<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_purchase',
        'status',
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
            'status' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Check if coupon is valid (active and not expired).
     */
    public function isValid(): bool
    {
        if (!$this->status) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount based on subtotal.
     */
    public function calculateDiscount(float $subtotal): float
    {
        if (!$this->isValid()) {
            return 0;
        }

        // Check minimum purchase requirement
        if ($subtotal < $this->min_purchase) {
            return 0;
        }

        $discount = 0;

        if ($this->type === 'fixed') {
            $discount = $this->value;
        } elseif ($this->type === 'percent') {
            $discount = ($subtotal * $this->value) / 100;
        }

        // Ensure discount doesn't exceed subtotal
        return min($discount, $subtotal);
    }
}
