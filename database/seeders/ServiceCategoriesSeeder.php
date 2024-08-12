<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ServiceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Prepare an array to store unique category names
        $categories = [];
        $uniqueNames = [];

        while (count($categories) < 20) {
            // Generate a random name using Faker
            $name = $faker->unique()->words($nb = 2, $asText = true);

            // Check if the name is already in the uniqueNames array
            if (!in_array($name, $uniqueNames)) {
                $uniqueNames[] = $name;
                $categories[] = [
                    'name' => $name,
                ];
            }
        }

        // Insert the data into the service_categories table
        DB::table('service_categories')->insert($categories);
        
    }
}
