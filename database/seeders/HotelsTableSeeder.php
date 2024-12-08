<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Location;
use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    public function run()
    {
        $Denpasar = Location::where('city', 'Denpasar')->first();
        $jakarta = Location::where('city', 'Jakarta pusat')->first();

        Hotel::create([
            'name' => 'Grand Denpasar Hotel',
            'location_id' => $Denpasar->id,
            'price_per_night' => 500000,
            'rating' => 4.5,
        ]);

        Hotel::create([
            'name' => 'Denpasar Beach Resort',
            'location_id' => $Denpasar->id,
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
