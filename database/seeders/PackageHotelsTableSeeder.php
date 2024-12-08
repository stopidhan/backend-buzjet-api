<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class PackageHotelsTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua paket dan hotel
        $packages = Package::all();
        $hotels = Hotel::all();

        // Asosiasikan setiap paket dengan 1-2 hotel (berdasarkan lokasi terkait)
        foreach ($packages as $package) {
            $relatedHotels = $hotels->whereIn('location_id', $package->destinations->pluck('location_id'))->random(rand(1, 2))->pluck('id');
            foreach ($relatedHotels as $hotelId) {
                DB::table('package_hotels')->insert([
                    'package_id' => $package->id,
                    'hotel_id' => $hotelId,
                ]);
            }
        }
    }
}

