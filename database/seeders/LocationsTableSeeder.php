<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'city' => 'Bali',
            'country' => 'Indonesia',
        ]);

        Location::create([
            'city' => 'Jakarta',
            'country' => 'Indonesia',
        ]);

        Location::create([
            'city' => 'Yogyakarta',
            'country' => 'Indonesia',
        ]);

        Location::create([
            'city' => 'Bandung',
            'country' => 'Indonesia',
        ]);
    }
}

