<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    public function run()
    {
        $bali = Location::where('city', 'Bali')->first();
        $jakarta = Location::where('city', 'Jakarta')->first();

        Destination::create([
            'name' => 'Kuta Beach',
            'location_id' => $bali->id,
            'description' => 'Beautiful sandy beach with great surf.',
            'img' => 'https://example.com/kuta.jpg',
        ]);

        Destination::create([
            'name' => 'Uluwatu Temple',
            'location_id' => $bali->id,
            'description' => 'Famous Hindu temple perched on a cliff.',
            'img' => 'https://example.com/uluwatu.jpg',
        ]);

        Destination::create([
            'name' => 'Monas',
            'location_id' => $jakarta->id,
            'description' => 'Iconic National Monument in Jakarta.',
            'img' => 'https://example.com/monas.jpg',
        ]);
    }
}

