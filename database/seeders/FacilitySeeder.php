<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'photo' => '',
            'name' => 'Kasur',
            'description' => '120x80cm',
        ]);
        Facility::create([
            'photo' => '',
            'name' => 'Alat Makan',
            'description' => 'Sendok & Garpu',
        ]);
    }
}
