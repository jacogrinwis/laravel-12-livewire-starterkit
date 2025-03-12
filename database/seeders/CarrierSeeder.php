<?php

namespace Database\Seeders;

use App\Models\Carrier;
use Illuminate\Database\Seeder;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carriers = [
            ['name' => 'PostNL'],
            ['name' => 'DHL Parcel'],
            ['name' => 'DPD'],
            ['name' => 'GLS'],
            ['name' => 'UPS'],
            ['name' => 'TNT/FedEx'],
            ['name' => 'TNT'],
            ['name' => 'ParcelParcel'],
            ['name' => 'Homerr'],
            ['name' => 'bpost'],
            ['name' => 'Deutsche Post'],
            ['name' => 'POST Luxembourg'],
        ];

        foreach ($carriers as $carrier) {
            Carrier::create([
                'name' => $carrier['name'],
            ]);
        }
    }
}
