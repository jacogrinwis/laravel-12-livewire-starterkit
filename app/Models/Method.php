<?php

namespace App\Models;

use App\Support\Format;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Method extends Model
{
    /** @use HasFactory<\Database\Factories\MethodFactory> */
    use HasFactory;

    protected $fillable = [
        'carrier_id',
        'zone_id',
        'name', 
        'min_length', 
        'max_length', 
        'min_width', 
        'max_width', 
        'min_height',
        'max_height',
        'min_weight', 
        'max_weight', 
        'price',
        'options', 
        'insurance_value'
    ];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function getCarrierNameAttribute()
    {
        return $this->carrier ? $this->carrier->name : '';
    }

    public function getZoneNameAttribute()
    {
        return $this->zone ? $this->zone->name : '';
    }

    protected function getFormattedMinSizeAttribute()
    {
        $sizes = [
            Format::toComma($this->min_length),
            Format::toComma($this->min_width),
            Format::toComma($this->min_height),
        ];

        $sizes = array_filter($sizes, function($value) {
            return $value !== null && $value !== '';
        });

        if (empty($sizes)) {
            return '';
        }

        return implode(' x ', $sizes) . ' cm';
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
}


