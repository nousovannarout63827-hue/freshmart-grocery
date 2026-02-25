<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'comment',
        'images',
        'is_approved',
        'helpful_count',
        'is_flagged',
        'is_banned',
        'ban_reason',
        'moderator_id',
        'banned_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'images' => 'array',
            'is_approved' => 'boolean',
            'is_flagged' => 'boolean',
            'is_banned' => 'boolean',
            'helpful_count' => 'integer',
            'banned_at' => 'datetime',
        ];
    }

    /**
     * Get the product that owns the review.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who wrote the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order associated with the review.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the moderator who banned the review.
     */
    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    /**
     * Get the helpful votes for this review.
     */
    public function helpfulVotes(): HasMany
    {
        return $this->hasMany(ReviewHelpful::class);
    }

    /**
     * Get the first image for display.
     */
    public function getFirstImageAttribute(): ?string
    {
        if (!empty($this->images) && is_array($this->images)) {
            return $this->images[0];
        }
        return null;
    }

    /**
     * Get formatted created date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('F j, Y');
    }

    /**
     * Get formatted created date (relative).
     */
    public function getRelativeDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Check if a user has marked this review as helpful.
     */
    public function isMarkedHelpfulBy($userId): bool
    {
        if (!$userId) {
            return false;
        }
        return $this->hasMany(ReviewHelpful::class, 'review_id', 'id')
                    ->where('user_id', $userId)
                    ->exists();
    }

    /**
     * Scope to get only approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope to get reviews with a specific rating.
     */
    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope to get reviews with images.
     */
    public function scopeWithImages($query)
    {
        return $query->whereNotNull('images');
    }

    /**
     * Scope to get flagged reviews.
     */
    public function scopeFlagged($query)
    {
        return $query->where('is_flagged', true);
    }

    /**
     * Scope to get banned reviews.
     */
    public function scopeBanned($query)
    {
        return $query->where('is_banned', true);
    }

    /**
     * Scope to get reviews that need moderation.
     */
    public function scopeNeedsModeration($query)
    {
        return $query->where('is_flagged', true)
                    ->where('is_banned', false);
    }

    /**
     * Flag a review for moderation.
     */
    public function flag()
    {
        $this->update(['is_flagged' => true]);
    }

    /**
     * Unflag a review.
     */
    public function unflag()
    {
        $this->update(['is_flagged' => false]);
    }

    /**
     * Ban a review with optional reason.
     */
    public function ban($reason = null)
    {
        $this->update([
            'is_banned' => true,
            'is_approved' => false,
            'ban_reason' => $reason,
            'moderator_id' => auth()->id(),
            'banned_at' => now(),
        ]);
    }

    /**
     * Unban a review.
     */
    public function unban()
    {
        $this->update([
            'is_banned' => false,
            'ban_reason' => null,
            'moderator_id' => null,
            'banned_at' => null,
        ]);
    }

    /**
     * Approve a review.
     */
    public function approve()
    {
        $this->update(['is_approved' => true]);
    }

    /**
     * Reject a review.
     */
    public function reject()
    {
        $this->update(['is_approved' => false]);
    }

    /**
     * Check if review is banned.
     */
    public function isBanned(): bool
    {
        return $this->is_banned;
    }

    /**
     * Check if review is flagged.
     */
    public function isFlagged(): bool
    {
        return $this->is_flagged;
    }

    /**
     * Calculate average rating for a product.
     */
    public static function calculateAverageRating($productId): float
    {
        $avg = static::where('product_id', $productId)
            ->where('is_approved', true)
            ->where('is_banned', false)
            ->avg('rating');

        return round($avg ?? 0, 1);
    }

    /**
     * Get rating distribution for a product.
     */
    public static function getRatingDistribution($productId): array
    {
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $distribution[$i] = static::where('product_id', $productId)
                ->where('rating', $i)
                ->where('is_approved', true)
                ->count();
        }
        return $distribution;
    }
}
