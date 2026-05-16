<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'route_name',
        'driver_id',
        'start_location',
        'end_location',
        'start_lat',
        'start_lng',
        'end_lat',
        'end_lng',
        'estimated_distance',
        'estimated_time',
        'status',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
