<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'delivery_center_id',
        'route_id',
        'driver_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'delivery_address',
        'items_summary',
        'status',
    ];

    public function deliveryCenter(): BelongsTo
    {
        return $this->belongsTo(DeliveryCenter::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }
}
