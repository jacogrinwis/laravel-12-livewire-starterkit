<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'Nederland', 'country_code' => 'NL'],
            ['name' => 'Belgie', 'country_code' => 'BE'],
            ['name' => 'Duidsland', 'country_code' => 'DE'],
            ['name' => 'Luxemburg', 'country_code' => 'LU'],
            ['name' => 'Frankrijk', 'country_code' => 'FR'],
            ['name' => 'Spanje', 'country_code' => 'ES'],
        ];

        foreach ($zones as $zone) {
            Zone::create([
                'name' => $zone['name'],
                'country_code' => $zone['country_code'],
            ]);
        }
    }
}
