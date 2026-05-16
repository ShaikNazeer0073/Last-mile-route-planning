<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'delivery_center_id',
        'name',
        'email',
        'phone',
        'license_number',
        'vehicle_type',
        'status',
    ];

    public function deliveryCenter(): BelongsTo
    {
        return $this->belongsTo(DeliveryCenter::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }
}
