<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'name'=>'Las Vegas',
            'rental_price'=>'300000',
            'description'=>'lorem2',
            'address'=>'alamat',
            'capacity'=>'12',
            'gender_target'=>'male',
            'langtitude'=>'-1',
            'longtitude'=>'2',
        ]);
    }
}
