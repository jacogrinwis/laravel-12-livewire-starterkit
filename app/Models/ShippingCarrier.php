<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingCarrier extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingCarrierFactory> */
    use HasFactory;

    protected $fillable = ['name', 'shipping_zone_id'];

    protected function getShippingZoneNameAttribute()
    {
        return $this->shippingZone ? $this->shippingZone->name : 'N/A';
    }

    protected function getShippingZoneCodeAttribute()
    {
        return $this->shippingZone ? $this->shippingZone->code : 'N/A';
    }

    public function shippingZone(): BelongsTo
    {
        return $this->belongsTo(ShippingZone::class);
    }
}
