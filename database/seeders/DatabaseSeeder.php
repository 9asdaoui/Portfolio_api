<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'first_name' => 'Oussama',
            'last_name' => 'Qasdaoui',
            'email' => 'oussamaqasdaoui@gmail.com',
            'profile_image' => 'https://intranet.youcode.ma/storage/users/profile/1259-1727966548.JPG',
            'bio' => 'Full-stack developer with expertise in Laravel and Vue.js. Passionate about creating elegant solutions to complex problems.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Create tools
        $tools = [
            ['name' => 'Laravel', 'image_url' => 'https://example.com/laravel.png'],
            ['name' => 'ReactJS', 'image_url' => 'https://example.com/react.png'],
            ['name' => 'MySQL', 'image_url' => 'https://example.com/mysql.png'],
            ['name' => 'Tailwind CSS', 'image_url' => 'https://example.com/tailwind.png'],
            ['name' => 'Git', 'image_url' => 'https://example.com/git.png'],
        ];

        foreach ($tools as $tool) {
            \App\Models\Tool::create($tool);
        }

        // Create the HealthGate project
        $project = \App\Models\Project::create([
            'title' => 'HealthGate',
            'description' => 'A comprehensive healthcare platform that connects patients with doctors and facilitates online consultations, appointment scheduling, and medical record management.',
            'image_url' => 'https://example.com/healthgate.png',
            'project_url' => 'https://healthgate.example.com',
            'type' => 'Web Application',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attach tools to the project
        $toolIds = \App\Models\Tool::pluck('id')->toArray();
        $project->tools()->attach($toolIds);

    }
}