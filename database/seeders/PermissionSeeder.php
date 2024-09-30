<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Add project',
            'Edit project',
            'Delete project',
            'View project',
            ];
    
            // Create permissions
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
    }
}
