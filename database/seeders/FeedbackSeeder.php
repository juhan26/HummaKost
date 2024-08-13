<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Feedback::truncate();  // Optional: Clear the table first

        Feedback::create([
            'user_id' => null,  // Assuming a user with ID 1 exists
            'message' => 'Great place, very comfortable!',
            'rating' => 5,
        ]);

        Feedback::create([
            'user_id' => null,  // Assuming a user with ID 2 exists
            'message' => 'Good value for money.',
            'rating' => 4,
        ]);

        Feedback::create([
            'user_id' => null,  // Anonymous feedback
            'message' => 'Could improve the cleanliness.',
            'rating' => 3,
        ]);
    }
}
