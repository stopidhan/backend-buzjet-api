<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'city' => 'Denpasar',
            'province' => 'Bali',
        ]);

        Location::create([
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
        ]);

        Location::create([
            'city' => 'Sleman',
            'province' => 'DIY',
        ]);

        Location::create([
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
        ]);
    }
}

