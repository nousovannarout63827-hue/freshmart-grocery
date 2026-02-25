<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewReply extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'review_id',
        'user_id',
        'comment',
    ];

    /**
     * Get the review that this reply belongs to.
     */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    /**
     * Get the user who wrote the reply.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted created date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('F j, Y');
    }

    /**
     * Get relative date (e.g., "2 hours ago").
     */
    public function getRelativeDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
