<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $departmentIds = Department::pluck('id')->toArray();
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        foreach (range(1, 20) as $index) {
            $contactNumber = $faker->numerify('##########'); // 10 digits
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'contact' => $contactNumber,
                'region_code' => 91, 
                'role' => 2, 
                'password' => Hash::make('password123'),
            ]);
            $user->assignRole($superAdminRole);
            Employee::create([
                'user_id' => $user->id,
                'address' => $faker->address,
                'dept_id' => $faker->randomElement($departmentIds), // Assuming department IDs are between 1 and 10
                'alt_contact' => $contactNumber,
                'pincode' => $faker->postcode,
             
            ]);
        }
    }
}
