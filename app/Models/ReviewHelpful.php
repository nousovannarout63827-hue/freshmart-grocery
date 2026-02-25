<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewHelpful extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'review_helpful';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'review_id',
        'user_id',
    ];

    /**
     * Get the review that was marked helpful.
     */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    /**
     * Get the user who marked the review helpful.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
