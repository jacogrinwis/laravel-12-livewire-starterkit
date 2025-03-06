<?php

namespace Database\Seeders;

use App\Models\ShippingCarrier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingCarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carriers = [
            ['name' => 'PostNL', 'shipping_zone_id' => '1'],
            ['name' => 'DHL', 'shipping_zone_id' => '1'],
            ['name' => 'DPD', 'shipping_zone_id' => '1'],
            ['name' => 'UPS', 'shipping_zone_id' => '1'],
            ['name' => 'Homerr', 'shipping_zone_id' => '1'],
            ['name' => 'bpost', 'shipping_zone_id' => '2'],
            ['name' => 'Deutsche Post', 'shipping_zone_id' => '3'],
            ['name' => 'POST Luxembourg', 'shipping_zone_id' => '4'],
        ];

        foreach ($carriers as $carrier) {
            ShippingCarrier::create([
                'name' => $carrier['name'],
                'code' => $carrier['shipping_zone_id'],
            ]);
        }
    }
}
