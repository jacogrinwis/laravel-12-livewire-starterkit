<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingZone extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingZoneFactory> */
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function shippingCarrier(): HasMany
    {
        return $this->hasMany(ShippingCarrier::class);
    }
}
