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
            'bio' => 'I m Oussama. a full stack developer skilled in building web applications from end-to-end. I am proficient in multiple programming languages and frameworks, with experience in both front-end and back-end technologies. I have strong communication and collaboration skills, and am passionate about creating high-quality web experiences. I am always eager to learn and improve',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Create tools
        $tools = [
            ['name' => 'Laravel', 'image_url' => 'https://img.icons8.com/?size=100&id=hUvxmdu7Rloj&format=png&color=000000'],
            ['name' => 'ReactJS', 'image_url' => 'https://img.icons8.com/?size=100&id=25Sjy8fKExYA&format=png&color=000000'],
            ['name' => 'MySQL', 'image_url' => 'https://img.icons8.com/?size=100&id=qGUfLiYi1bRN&format=png&color=000000'],
            ['name' => 'Tailwind CSS', 'image_url' => 'https://img.icons8.com/?size=100&id=WoopfRcDj3RF&format=png&color=000000'],
            ['name' => 'Git', 'image_url' => 'https://img.icons8.com/?size=100&id=j6tO4jtQBisT&format=png&color=000000'],
            ['name' => 'Docker', 'image_url' => 'https://img.icons8.com/?size=100&id=GOHWqwnSE8Sv&format=png&color=000000'],
            ['name' => 'Figma', 'image_url' => 'https://img.icons8.com/?size=100&id=W0YEwBDDfTeu&format=png&color=000000'],
            ['name' => 'Postman', 'image_url' => 'https://img.icons8.com/?size=100&id=QEQQKirln6Tf&format=png&color=000000'],
            ['name' => 'PHP', 'image_url' => 'https://img.icons8.com/?size=100&id=ccVoLBEjtDV7&format=png&color=000000'],
            ['name' => 'JavaScript', 'image_url' => 'https://img.icons8.com/?size=100&id=39854&format=png&color=000000'],
            ['name' => 'HTML5', 'image_url' => 'https://img.icons8.com/?size=100&id=23028&format=png&color=000000'],
            ['name' => 'CSS3', 'image_url' => 'https://img.icons8.com/?size=100&id=38272&format=png&color=000000'],

            ['name' => 'VueJS', 'image_url' => 'https://img.icons8.com/?size=100&id=BUnExfsRs3CW&format=png&color=000000'],
            ['name' => 'Bootstrap', 'image_url' => 'https://img.icons8.com/?size=100&id=84710&format=png&color=000000'],
            ['name' => 'Apache', 'image_url' => 'https://img.icons8.com/?size=100&id=5WlbIEHi0tFQ&format=png&color=000000'],
            ['name' => 'GraphQL', 'image_url' => 'https://img.icons8.com/?size=100&id=o415ZlFwYWYe&format=png&color=000000'],
            ['name' => 'REST API', 'image_url' => 'https://img.icons8.com/?size=100&id=55497&format=png&color=000000'],
            ['name' => 'WebSockets', 'image_url' => 'https://img.icons8.com/?size=100&id=106729&format=png&color=000000'],
                

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