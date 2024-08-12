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
        Property::create([
            'name' => 'Los Santos',
            'rental_price' => '300000',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam explicabo delectus, animi inventore nihil cum accusantium ullam labore laudantium rerum sequi dolore ad adipisci quia beatae asperiores. Aliquid voluptates laboriosam dignissimos, dolore earum quos! Molestiae, animi ex quibusdam itaque porro quae doloribus. Odit officia quibusdam debitis magnam nesciunt sunt saepe, suscipit, quam ipsam delectus similique eius, accusantium repellendus vero facere? Ea ullam recusandae doloribus molestias culpa amet numquam dolore, libero ad ducimus cupiditate enim voluptates, hic fugit mollitia officiis, explicabo commodi exercitationem quisquam deserunt. Placeat sit veritatis dolore. Magnam ratione eveniet non exercitationem nihil corrupti ullam quod beatae ab rerum!',
            'address' => 'Jl. Giok No.13, Perun Gpa, Ngijo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65152',
            'capacity' => '12',
            'gender_target' => 'male',
            'langtitude' => '-7.8930955',
            'longtitude' => '112.6097331',
        ]);
    }
}
