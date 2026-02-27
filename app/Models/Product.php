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
            'name' => 'array',
            'description' => 'array',
        ];
    }

    /**
     * Boot the model - auto-generate slug and SKU.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Generate slug from English name or name array
            if (empty($product->slug)) {
                $name = is_array($product->name) ? ($product->name['en'] ?? '') : $product->name;
                $product->slug = Str::slug($name);
            }
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Get the translated name based on current locale.
     * Falls back to English if translation is missing.
     */
    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();
        
        // If name is an array (multi-language)
        if (is_array($this->name)) {
            return $this->name[$locale] ?? $this->name['en'] ?? $this->name['km'] ?? $this->name['zh'] ?? 'Unknown Product';
        }
        
        // If name is a string (legacy), return as-is
        return (string) $this->name;
    }

    /**
     * Get the translated description based on current locale.
     * Falls back to English if translation is missing.
     */
    public function getTranslatedDescriptionAttribute(): ?string
    {
        if (!$this->description || !is_array($this->description)) {
            return $this->description;
        }
        
        $locale = app()->getLocale();
        
        // Return the active language description.
        // If it's empty, fallback to English. If English is empty, show a default message.
        return $this->description[$locale] 
            ?? $this->description['en'] 
            ?? $this->description['km'] 
            ?? $this->description['zh'] 
            ?? 'No description available for this product.';
    }

    /**
     * Get the image attribute (returns first image for backwards compatibility).
     */
    public function getImageAttribute(): ?string
    {
        // If images JSON array exists, return the first image
        if (!empty($this->attributes['images']) && is_array($this->attributes['images'])) {
            return $this->attributes['images'][0];
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
        return $this->belongsTo(Category::class)->withDefault();
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

    /**
     * Get all reviews for the product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get only approved reviews for the product.
     */
    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    /**
     * Get the average rating for the product.
     */
    public function getAverageRatingAttribute(): float
    {
        // Use cached value from Review model
        return Review::calculateAverageRating($this->id);
    }

    /**
     * Get the total number of approved reviews.
     */
    public function getReviewsCountAttribute(): int
    {
        // Cache the reviews count for 5 minutes
        return \Cache::remember("product_{$this->id}_reviews_count", 300, function () {
            return $this->approvedReviews()->count();
        });
    }

    /**
     * Get the rating distribution for the product.
     */
    public function getRatingDistributionAttribute(): array
    {
        // Use cached value from Review model
        return Review::getRatingDistribution($this->id);
    }
}
