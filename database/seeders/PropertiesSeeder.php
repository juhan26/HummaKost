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
            'name' => 'Las Vegas',
            'rental_price' => '300000',
            'description' => 'Kosan Programmer.',
            'address' => 'Jl. Giok No.13, Perun Gpa, Ngijo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152',
            'capacity' => '12',
            'gender_target' => 'male',
            'langtitude' => '-7.8930955',
            'longtitude' => '112.6097331',
        ]);
    }
}
