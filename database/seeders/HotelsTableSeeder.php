<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Location;
use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    public function run()
    {
        $bali = Location::where('city', 'Bali')->first();
        $jakarta = Location::where('city', 'Jakarta')->first();

        Hotel::create([
            'name' => 'Grand Bali Hotel',
            'location_id' => $bali->id,
            'price_per_night' => 500000,
            'rating' => 4.5,
        ]);

        Hotel::create([
            'name' => 'Bali Beach Resort',
            'location_id' => $bali->id,
            'price_per_night' => 700000,
            'rating' => 4.8,
        ]);

        Hotel::create([
            'name' => 'Jakarta City Hotel',
            'location_id' => $jakarta->id,
            'price_per_night' => 350000,
            'rating' => 4.2,
        ]);
    }
}
