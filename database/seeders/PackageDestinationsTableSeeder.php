<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Support\Facades\DB;

class PackageDestinationsTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua paket dan destinasi
        $packages = Package::all();
        $destinations = Destination::all();

        // Asosiasikan setiap paket dengan 1-3 destinasi
        foreach ($packages as $package) {
            $assignedDestinations = $destinations->random(rand(1, 3))->pluck('id');
            foreach ($assignedDestinations as $destinationId) {
                DB::table('package_destinations')->insert([
                    'package_id' => $package->id,
                    'destination_id' => $destinationId,
                ]);
            }
        }
    }
}

