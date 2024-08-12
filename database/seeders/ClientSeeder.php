<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $contactNumber = $faker->numerify('##########'); // 10 digits

            Client::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'business' => $faker->company,
                'email' => $faker->unique()->userName . '@example.com', // Pattern-matched email
                'contact' => $contactNumber,
                'website' => $faker->url,
            ]);
        }
    }
}
