<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PermissionsSeeder::class);
        // \App\Models\User::factory(10)->create();
        // $this->call([
        //     ExpenseCategorySeeder::class,
        // ]);
        // $this->call([
        //     DepartmentSeeder::class,
        // ]);
        // $this->call(ProductSeeder::class);
        // $this->call(EmployeeSeeder::class);
        // $this->call([
        //     ClientSeeder::class,
        // ]);
        // $this->call([
        //     PaymentSeeder::class,
        // ]);
        $this->call(PermissionsTableSeeder::class);
    }
}
