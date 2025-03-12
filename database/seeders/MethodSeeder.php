<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Brief of kaart',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => '14',
                'max_length' => '32.4',
                'min_width' => '9',
                'max_width' => '22.9',
                'min_height' => null,
                'max_height' => '3.2',
                'min_weight' => null,
                'max_weight' => '20',
                'price' => '1.21',
                'options' => 'none',
                'insurance_value' => null,
            ],
            [
                'name' => 'Brief groot formaat',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '38',
                'min_width' => null,
                'max_width' => 26.5,
                'min_height' => null,
                'max_height' => '3.2',
                'min_weight' => null,
                'max_weight' => '2000',
                'price' => '5.15',
                'options' => 'none',
                'insurance_value' => null,
            ],
            [
                'name' => 'Brief (verzekerd €500)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '38',
                'min_width' => null,
                'max_width' => '26.5',
                'min_height' => null,
                'max_height' => '3.2',
                'min_weight' => null,
                'max_weight' => '2000',
                'price' => '16',
                'options' => 'insurance',
                'insurance_value' => '500',
            ],
            [
                'name' => 'Brievenbuspakje (track&trace)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '38',
                'min_width' => null,
                'max_width' => '26.5',
                'min_height' => null,
                'max_height' => '3.2',
                'min_weight' => null,
                'max_weight' => '2000',
                'price' => '5.25',
                'options' => 'track&trace',
                'insurance_value' => null,
            ],
            [
                'name' => 'Klein pakket (track&trace)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '34',
                'min_width' => null,
                'max_width' => '26.5',
                'min_height' => null,
                'max_height' => '3.2',
                'min_weight' => null,
                'max_weight' => '1',
                'price' => '5.95',
                'options' => 'track&trace',
                'insurance_value' => null,
            ],
            [
                'name' => 'Gemiddeld pakket (track & trace)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '100',
                'min_width' => null,
                'max_width' => '50',
                'min_height' => null,
                'max_height' => '50',
                'min_weight' => null,
                'max_weight' => '1',
                'price' => '7.25',
                'options' => 'track&trace',
                'insurance_value' => null,
            ],
            [
                'name' => 'Gemiddeld pakket (aangetekend €500)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '100',
                'min_width' => null,
                'max_width' => '50',
                'min_height' => null,
                'max_height' => '50',
                'min_weight' => null,
                'max_weight' => '10000',
                'price' => '11.65',
                'options' => 'insurance',
                'insurance_value' => '500',
            ],
            [
                'name' => 'Gemiddeld pakket (verzekerd €5.500)',
                'zone_id' => 1,
                'carrier_id' => 1,
                'min_length' => null,
                'max_length' => '50',
                'min_width' => null,
                'max_width' => '50',
                'min_height' => null,
                'max_height' => '100',
                'min_weight' => null,
                'max_weight' => '30000',
                'price' => '16.5',
                'options' => 'insurance',
                'insurance_value' => '5500',
            ],
        ];

        foreach ($methods as $method) {
            Method::create([
                'name' => $method['name'],
                'zone_id' => $method['zone_id'],
                'carrier_id' => $method['carrier_id'],
                'min_length' => $method['min_length'],
                'max_length' => $method['max_length'],
                'min_width' => $method['min_width'],
                'max_width' => $method['max_width'],
                'min_height' => $method['min_height'],
                'max_height' => $method['max_height'],
                'min_weight' => $method['min_weight'],
                'max_weight' => $method['max_weight'],
                'price' => $method['price'],
                'options' => $method['options'],
                'insurance_value' => $method['insurance_value'],
            ]);
        }
    }
}
