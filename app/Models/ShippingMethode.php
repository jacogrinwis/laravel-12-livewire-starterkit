<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\Format;

class ShippingMethode extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingMethodeFactory> */
    use HasFactory;

    protected $fillable = [
        'shipping_carrier_id',
        'name',
        'max_length',
        'max_width',
        'max_height',
        'weight',
        'price',
        'option',
        'insurance_value',
    ];

    protected $appends = [
        'shipping_zone_name',
        'shipping_carrier_name',
    ];

    protected function getShippingZoneNameAttribute()
    {
        return $this->shippingCarrier && $this->shippingCarrier->shippingZone 
            ? $this->shippingCarrier->shippingZone->name 
            : 'N/A';
    }

    protected function getShippingCarrierNameAttribute()
    {
        return $this->shippingCarrier ? $this->shippingCarrier->name : 'N/A';
    }

    protected function getFormattedMaxLengthAttribute()
    {
        return $this->max_length . ' cm';
    }

    protected function getFormattedMaxWidthAttribute()
    {
        return $this->max_width . ' cm';
    }

    protected function getFormattedMaxHeightAttribute()
    {
        return $this->max_height . ' cm';
    }

    protected function getFormattedMaxSizeAttribute()
    {
        $sizes = [
            Format::toComma($this->max_length),
            Format::toComma($this->max_width),
            Format::toComma($this->max_height),
        ];

        $sizes = array_filter($sizes, function($value) {
            return $value !== null && $value !== '';
        });

        if (empty($sizes)) {
            return '';
        }

        return implode(' x ', $sizes) . ' cm';
    }

    protected function getFormattedWeightAttribute()
    {
        return Format::toComma($this->weight) . ' g';
    }

    protected function getFormattedPriceAttribute()
    {
        return Format::toCurrency($this->price);
    }

    protected function getFormattedInsuranceValueAttribute()
    {
        if ($this->insurance_value) {
            return Format::toCurrency($this->insurance_value);
        }
    }

    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class);
    }

    public function shippingCarrier()
    {
        return $this->belongsTo(ShippingCarrier::class);
    }

}
