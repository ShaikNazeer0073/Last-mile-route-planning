<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Order extends Model
{
    public const UPDATED_AT = null;
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'delivery_center_id',
        'route_id',
        'driver_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'delivery_address',
        'city',
        'pincode',
        'items_summary',
        'ordered_items',
        'total_price',
        'status',
        'user_id',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
