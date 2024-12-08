<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LocationsTableSeeder::class,
            DestinationsTableSeeder::class,
            HotelsTableSeeder::class,
            TransportationsTableSeeder::class,
            UsersTableSeeder::class,
            PackagesTableSeeder::class,
            PackageDestinationsTableSeeder::class,
            PackageHotelsTableSeeder::class,
        ]);
    }
}

