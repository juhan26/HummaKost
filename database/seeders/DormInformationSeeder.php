<?php

namespace Database\Seeders;

use App\Models\DormInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DormInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DormInformation::create([
            'banner_image' => '/assets/img/images/banner_img.png',
            'subtitle' => 'Juhan Jo',
            'title' => 'Las Vegas',
            'capacity' => '15',
        ]);
    }
}
