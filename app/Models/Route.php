<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class Route extends Model
{
    public const UPDATED_AT = null;
    protected $connection = 'mongodb';
    protected $collection = 'routes';

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
