<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();

        // Check if there are clients to assign projects to
        if ($clients->isEmpty()) {
            $this->command->info('No clients found in the database. Please seed clients first.');
            return;
        }

        // Define the project data (names are 2-3 words, and descriptions are concise)
        $projects = [
            // Web Development Projects
            ['name' => 'E-commerce Platform', 'description' => 'Online shopping platform.'],
            ['name' => 'Corporate Website', 'description' => 'Redesign of corporate site.'],
            ['name' => 'Designer Portfolio', 'description' => 'Personal portfolio site.'],
            ['name' => 'Laravel API', 'description' => 'RESTful API development.'],
            ['name' => 'Custom CMS', 'description' => 'Tailored CMS development.'],

            // iOS Development Projects
            ['name' => 'Shopping App', 'description' => 'iOS shopping app.'],
            ['name' => 'Health Tracker', 'description' => 'iOS health monitoring app.'],
            ['name' => 'Fitness App', 'description' => 'iOS workout tracking app.'],
            ['name' => 'Educational App', 'description' => 'iOS learning app.'],

            // Social Media Projects
            ['name' => 'Marketing Campaign', 'description' => 'Social media strategy.'],
            ['name' => 'Influencer Collaboration', 'description' => 'Instagram influencer campaign.'],
            ['name' => 'Ads Campaign', 'description' => 'Facebook ads management.'],
            ['name' => 'Automation Tool', 'description' => 'Social media automation tool.'],

            // Marketing Projects
            ['name' => 'SEO Optimization', 'description' => 'SEO for e-commerce.'],
            ['name' => 'Content Strategy', 'description' => 'Content marketing plan.'],
            ['name' => 'Email Campaign', 'description' => 'Email marketing setup.'],
            ['name' => 'Google Ads', 'description' => 'Google Ads management.'],
            ['name' => 'Influencer Strategy', 'description' => 'Influencer marketing plan.'],
        ];

        // Insert each project and assign a random client
        foreach ($projects as $project) {
            Project::create([
                'name' => $project['name'],
                'description' => $project['description'],
                'client_id' => $clients->random()->id, // Randomly assign a client
            ]);
        }
    }
}
