<?php

namespace App\Models;

use App\Support\Format;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'length',
        'width',
        'height',
        'weight',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getFormattedPriceAttribute()
    {
        return Format::toCurrency($this->price);
    }

    protected function getFormattedWeightAttribute()
    {
        return Format::toComma($this->weight);
    }

    protected function getFormattedSizeAttribute()
    {
        $sizes = [
            Format::toComma($this->length),
            Format::toComma($this->width),
            Format::toComma($this->height),
        ];

        $sizes = array_filter($sizes, function ($value) {
            return $value !== null && $value !== '';
        });

        if (empty($sizes)) {
            return '';
        }

        return implode(' x ', $sizes).' cm';
    }
}
