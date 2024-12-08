<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('email', 'dika@gmail.com')->first();
        $user2 = User::where('email', 'fael@gmail.com')->first();
        $package1 = Package::where('name', 'Bali Getaway')->first();
        $package2 = Package::where('name', 'Mountain Adventure')->first();

        Booking::create([
            'user_id' => $user1->id,
            'package_id' => $package1->id,
            'status' => 'confirmed',
            'total_price' => $package1->price,
        ]);

        Booking::create([
            'user_id' => $user2->id,
            'package_id' => $package2->id,
            'status' => 'pending',
            'total_price' => $package2->price,
        ]);
    }
}

