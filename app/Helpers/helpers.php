<?php

if (! function_exists('formatPrice')) {
    /**
     * Convert a price amount to the European currency format
     * 
     * @param int $price
     * @return string
     */
    function formatPrice($price)
    {
        return '€ ' . number_format($price / 100, 2, ',', '.');
    }
}

if (!function_exists('toPoint')) {
    /**
     * Convert a comma decimal separator to a point
     * 
     * @param string|float|null $value
     * @return string|float|null
     */
    function toPoint($value)
    {
        if (is_null($value)) {
            return null;
        }
        
        if (is_numeric($value)) {
            return $value;
        }
        
        return str_replace(',', '.', $value);
    }
}

if (!function_exists('toComma')) {
    /**
     * Convert a point decimal separator to a comma
     * 
     * @param string|float|null $value
     * @return string|null
     */
    function toComma($value)
    {
        if (is_null($value)) {
            return null;
        }
        
        return str_replace('.', ',', (string)$value);
    }
}