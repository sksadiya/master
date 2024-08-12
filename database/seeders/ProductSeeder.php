<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::pluck('id')->toArray();

        foreach (range(1, 20) as $index) {
            Product::create([
                'name' => $faker->word,
                'category_id' => $faker->randomElement($categories),
                'unit_price' => $faker->numberBetween(1, 2000),
                'description' => $faker->sentence,
            ]);
        }
    }
}
