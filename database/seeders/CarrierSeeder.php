<?php

namespace Database\Seeders;

use App\Models\Carrier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carriers = [
            ['name' => 'PostNL'],
            ['name' => 'DHL'],
            ['name' => 'DPD'],
            ['name' => 'UPS'],
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
