<?php

namespace Database\Seeders;

use App\Models\ShippingZone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'Nederland', 'code' => 'NL'],
            ['name' => 'Belgie', 'code' => 'BE'],
            ['name' => 'Duidsland', 'code' => 'DE'],
            ['name' => 'Luxemburg', 'code' => 'LU'],
            ['name' => 'Frankrijk', 'code' => 'FR'],
            ['name' => 'Spanje', 'code' => 'ES'],
        ];

        foreach ($zones as $zone) {
            ShippingZone::create([
                'name' => $zone['name'],
                'code' => $zone['code'],
            ]);
        }
    }
}
