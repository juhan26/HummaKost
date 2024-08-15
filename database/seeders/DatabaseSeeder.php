<?php

namespace Database\Seeders;

use App\Models\DormInformation;
use App\Models\Facility;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RoleAndPermissionSeeder::class,
            InstanceSeeder::class,
            UserSeeder::class,
            FacilitySeeder::class,
            PropertiesSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
