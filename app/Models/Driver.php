<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class Driver extends Model
{
    public const UPDATED_AT = null;
    protected $connection = 'mongodb';
    protected $collection = 'drivers';

    protected $fillable = [
        'delivery_center_id',
        'name',
        'email',
        'phone',
        'license_number',
        'vehicle_type',
        'status',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }
}
