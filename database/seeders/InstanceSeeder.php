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
            'name'=> 'SMKN Al Azhar',
            'address' => 'Banyuwangi',
            'description' => 'SMK HEBAT',
        ]);
        Instance::create([
            'name'=> 'SMKN 2 Kraksaan',
            'address' => 'Kraksaan',
            'description' => 'SMK HEBAT',
        ]);
        Instance::create([
            'name'=> 'SMKN 1 Kraksaan',
            'address' => 'Kraksaan',
            'description' => 'SMK HEBAT',
        ]);
        Instance::create([
            'name'=> 'SMKN 2 Mataram',
            'address' => 'Mataram',
            'description' => 'SMK HEBAT',
        ]);
    }
}
