<?php

namespace App\Support;

class Format
{
    /**
     * Convert a comma decimal separator to a point
     *
     * @param  string|float|null  $value
     * @return string|float|null
     */
    public static function toPoint($value)
    {
        if (is_null($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return $value;
        }

        return str_replace(',', '.', $value);
    }

    /**
     * Convert a point decimal separator to a comma
     *
     * @param  string|float|null  $value
     * @return string|null
     */
    public static function toComma($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        return str_replace('.', ',', (string) $value);
        // return number_format((float)$value, 2, ',', '');
    }

    /**
     * Format currency with Euro symbol and comma
     *
     * @param  string|float|null  $value
     * @return string
     */
    public static function euro($value)
    {
        if (is_null($value) || $value === '') {
            return '';
        }

        return '€ '.self::toComma($value);
    }

    /**
     * Format a number with a specific number of decimal places using comma as decimal separator
     *
     * @param  float|string|null  $value  The value to format
     * @param  int  $decimals  Number of decimal places (default: 2)
     * @return string|null Formatted number
     */
    public static function toDecimal($value, $decimals = 2)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        return number_format((float) $value, $decimals, ',', '');
    }

    /**
     * Format a number as currency with Euro symbol and specific decimal places
     *
     * @param  float|string|null  $value  The value to format
     * @param  int  $decimals  Number of decimal places (default: 2)
     * @return string Formatted currency
     */
    public static function toCurrency($value, $decimals = 2)
    {
        if (is_null($value) || $value === '') {
            return '';
        }

        return '€ '.self::toDecimal($value, $decimals);
    }
}
