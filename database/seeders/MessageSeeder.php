<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Message::insert([
            [
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'message' => 'I really love your portfolio website. The projects you\'ve worked on are impressive. Would you be available for a freelance project?',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Maria Garcia',
            'email' => 'maria.garcia@company.com',
            'message' => 'Job Opportunity: We have an open position at our company that would be perfect for your skills. Would you be interested in discussing it further?',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Ahmed Hassan',
            'email' => 'a.hassan@techfirm.com',
            'message' => 'Collaboration Request: I\'m working on an open-source project and your expertise would be valuable. Would you be interested in collaborating?',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Sarah Johnson',
            'email' => 'sjohnson@gmail.com',
            'message' => 'Question About Your Framework: I saw your project using Laravel and have some questions about your implementation. Could we schedule a quick call?',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'David Wong',
            'email' => 'dwong@startup.io',
            'message' => 'Speaking Opportunity: We\'re organizing a tech conference and would like to invite you to speak about your work. Please let me know if you\'re interested.',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        ]);
    }
}
