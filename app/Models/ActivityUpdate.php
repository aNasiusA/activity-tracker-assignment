<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityUpdate extends Model
{
    protected $fillable = [
        'activity_id',
        'user_id',
        'status',
        'remark',
        'updated_at_specific',
    ];

    protected $casts = [
        'updated_at_specific' => 'datetime',
    ];

    /**
     * Get the activity this update belongs to
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the user who made this update
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
