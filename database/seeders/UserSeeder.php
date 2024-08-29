<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "super_admin",
            "gender" => "male",
            "email" => "super_admin@gmail.com",
            "phone_number" => "0897654321",
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('super_admin');

        User::create([
            "name" => "Chandra Pablo",
            "gender" => "male",
            "email" => "chandra@gmail.com",
            "phone_number" => "089630382181719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Juhan Boy",
            "gender" => "male",
            "email" => "juhan@gmail.com",
            "phone_number" => "089630382182719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Ridoq Sumbung",
            "gender" => "male",
            "email" => "ridoq@gmail.com",
            "phone_number" => "089630382134719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Sano Yakuza",
            "gender" => "male",
            "email" => "sano@gmail.com",
            "phone_number" => "089630383534719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Dirwa Ustad",
            "gender" => "male",
            "email" => "dirwa@gmail.com",
            "phone_number" => "089630809320719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Mugni Santos",
            "gender" => "male",
            "email" => "mugni@gmail.com",
            "phone_number" => "089630298379719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Jovita",
            "gender" => "female",
            "email" => "jovita@gmail.com",
            "phone_number" => "089630229879719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');

        User::create([
            "name" => "Farah",
            "gender" => "female",
            "email" => "farah@gmail.com",
            "phone_number" => "089602298379719",
            "instance_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');
    }
}
