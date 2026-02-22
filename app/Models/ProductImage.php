<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image_path',
        'sort_order',
    ];

    /**
     * Get the image path attribute (alias for backwards compatibility).
     */
    public function getImageAttribute(): ?string
    {
        return $this->image_path;
    }

    /**
     * Set the image path attribute.
     */
    public function setImageAttribute(string $value): void
    {
        $this->image_path = $value;
    }

    /**
     * Get the product that owns this image.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
