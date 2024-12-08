<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    public function run()
    {
        $Denpasar = Location::where('city', 'Denpasar')->first();
        $Jakarta = Location::where('city', 'Jakarta Pusat')->first();

        Destination::create([
            'name' => 'Kuta Beach',
            'location_id' => $Denpasar->id,
            'description' => 'Beautiful sandy beach with great surf.',
            'img' => 'https://example.com/kuta.jpg',
        ]);

        Destination::create([
            'name' => 'Uluwatu Temple',
            'location_id' => $Denpasar->id,
            'description' => 'Famous Hindu temple perched on a cliff.',
            'img' => 'https://example.com/uluwatu.jpg',
        ]);

        Destination::create([
            'name' => 'Monas',
            'location_id' => $Jakarta->id,
            'description' => 'Iconic National Monument in Jakarta Pusat.',
            'img' => 'https://example.com/monas.jpg',
        ]);
    }
}

