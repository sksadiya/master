<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all users
        $users = User::all();

        // Loop through each user and create 6-7 notes
        foreach ($users as $user) {
            // Create a random number between 6 and 7
            $noteCount = rand(11, 12);

            // Create the notes
            for ($i = 0; $i < $noteCount; $i++) {
                Note::create([
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph,
                    'is_starred' => $faker->boolean,
                    'user_id' => $user->id, // Associate the note with the current user
                ]);
            }
        }
    }
}
