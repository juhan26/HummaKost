<?php

namespace Database\Seeders;

use App\Models\Instance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instance::create([
            'name'=> 'SMK Al Azhar',
            'address' => 'Banyuwangi',
            'description' => 'SMK HEBAT',
        ]);
    }
}
