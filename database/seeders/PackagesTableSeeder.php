<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('role', 'admin')->first();

        $package1 = Package::create([
            'name' => 'Bali Getaway',
            'description' => 'A beautiful 5-day tour in Bali.',
            'price' => 1200000,
            'duration' => 5,
            'night' => 4,
            'capacity' => 20,
            'created_by' => $admin->id,
        ]);

        $package2 = Package::create([
            'name' => 'Mountain Adventure',
            'description' => 'Explore the mountains of West Java.',
            'price' => 850000,
            'duration' => 3,
            'night' => 2,
            'capacity' => 15,
            'created_by' => $admin->id,
        ]);
    }
}

