<?php

namespace Database\Seeders;

use App\Models\Furniture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Furniture::create([
            'name'=>'Kasur',
            'description'=>'120x80cm',
        ]);
        Furniture::create([
            'name'=>'Alat Makan',
            'description'=>'Sendok & Garpu',
        ]);
    }
}