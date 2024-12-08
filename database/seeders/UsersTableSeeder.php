<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Satria Dika',
                'email' => 'dika@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'user'
            ],
            [
                'name' => 'Satria Pambingkas',
                'email' => 'satpam@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'user'
            ],
            [
                'name' => 'Fael',
                'email' => 'fael@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'user'
            ]
        ];

        // Loop through the array and create users
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
