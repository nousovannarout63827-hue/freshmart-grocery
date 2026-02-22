<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
    ];

    /**
     * Get the user who performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Global Helper to easily log actions from any Controller.
     * Usage: ActivityLog::log('Created', 'Inventory', 'Added new product: Apple');
     */
    public static function log($action, $module, $description)
    {
        if (auth()->check()) {
            self::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'module' => $module,
                'description' => $description,
            ]);
        }
    }
}
