<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get all updates for this activity
     */
    public function updates(): HasMany
    {
        return $this->hasMany(ActivityUpdate::class);
    }

    /**
     * Get the latest update for this activity
     */
    public function latestUpdate()
    {
        return $this->updates()->latest('updated_at_specific')->first();
    }
}
