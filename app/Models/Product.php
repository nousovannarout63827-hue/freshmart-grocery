<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'unit',
        'stock',
        'image',
        'images',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
            'images' => 'array',
        ];
    }

    /**
     * Boot the model - auto-generate slug and SKU.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the image attribute (returns first image for backwards compatibility).
     */
    public function getImageAttribute(): ?string
    {
        // If images JSON array exists, return the first image
        if (!empty($this->images) && is_array($this->images)) {
            return $this->images[0];
        }
        // Check the old image column
        if (!empty($this->attributes['image'])) {
            return $this->attributes['image'];
        }
        // Fall back to the product_images table (primary image)
        $primaryImage = $this->primaryImage;
        if ($primaryImage && $primaryImage->image_path) {
            return $primaryImage->image_path;
        }
        return null;
    }

    /**
     * Set the image attribute.
     */
    public function setImageAttribute(?string $value): void
    {
        $this->attributes['image'] = $value;
        
        // Also update images array if value exists
        if ($value) {
            $this->images = [$value];
        }
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all images for the product (One-to-Many relationship).
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Alias for productImages (for backwards compatibility).
     */
    public function images(): HasMany
    {
        return $this->productImages();
    }

    /**
     * Get the primary/main image for display in lists.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->orderBy('sort_order');
    }
}
