<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class DeliveryCenter extends Model
{
    public const UPDATED_AT = null;
    protected $connection = 'mongodb';
    protected $collection = 'delivery_centers';

    protected $fillable = [
        'name',
        'location',
        'phone',
        'email',
        'type',
        'status',
        'latitude',
        'longitude',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    /**
     * Get a display label for the center type (Blinkit-style).
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'dark_store'    => '🏪 Dark Store',
            'warehouse'     => '📦 Warehouse',
            'grocery_store' => '🛒 Grocery Store',
            default         => $this->type,
        };
    }
}
