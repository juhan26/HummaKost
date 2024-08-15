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
            "gender" => "other",
            "email" => "super_admin@gmail.com",
            "phone_number" => "0897654321",
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('super_admin');

        User::create([

            "name" => "admin",
            "gender" => "male",
            "email" => "admin@gmail.com",
            "phone_number" => "0896384719",
            "school_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('admin');

        User::create([
            "name" => "member3",
            "gender" => "male",
            "email" => "member3@gmail.com",
            "phone_number" => "089630382184719",
            "school_id" => 1,
            "status" => "accepted",
            "password" => "12345678",
        ])->assignRole('tenant');
    }
}
