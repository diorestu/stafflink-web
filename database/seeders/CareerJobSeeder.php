<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class CareerJobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Customer Support Specialist',
                'description' => 'Provide friendly and accurate support to clients via chat and email while maintaining excellent service standards.',
                'location' => 'Bali, Indonesia',
                'type' => 'full-time',
                'salary_range' => 'IDR 6,000,000 - 8,000,000',
            ],
            [
                'title' => 'Virtual Assistant',
                'description' => 'Support daily operations, scheduling, inbox management, and documentation for onshore teams.',
                'location' => 'Remote',
                'type' => 'full-time',
                'salary_range' => 'IDR 5,500,000 - 7,500,000',
            ],
            [
                'title' => 'Social Media Manager',
                'description' => 'Plan and execute social content calendars, engagement strategy, and monthly campaign reporting.',
                'location' => 'Jakarta, Indonesia',
                'type' => 'contract',
                'salary_range' => 'IDR 7,000,000 - 10,000,000',
            ],
            [
                'title' => 'Bookkeeper',
                'description' => 'Manage reconciliations, monthly bookkeeping, and reporting support with high attention to detail.',
                'location' => 'Surabaya, Indonesia',
                'type' => 'part-time',
                'salary_range' => 'IDR 4,500,000 - 6,500,000',
            ],
            [
                'title' => 'Graphic Designer',
                'description' => 'Create digital creatives for web, social, and campaigns aligned with brand guidelines and deadlines.',
                'location' => 'Remote',
                'type' => 'contract',
                'salary_range' => 'IDR 6,500,000 - 9,000,000',
            ],
            [
                'title' => 'Call Center Agent',
                'description' => 'Handle inbound and outbound calls, resolve customer issues, and maintain accurate CRM records.',
                'location' => 'Denpasar, Bali',
                'type' => 'full-time',
                'salary_range' => 'IDR 5,000,000 - 7,000,000',
            ],
            [
                'title' => 'Remote IT Support',
                'description' => 'Provide first-level technical support, troubleshooting, and escalation for remote client teams.',
                'location' => 'Remote',
                'type' => 'full-time',
                'salary_range' => 'IDR 8,000,000 - 11,000,000',
            ],
            [
                'title' => 'Copywriter',
                'description' => 'Write compelling website, campaign, and product copy with consistent tone and conversion focus.',
                'location' => 'Bandung, Indonesia',
                'type' => 'part-time',
                'salary_range' => 'IDR 5,500,000 - 8,000,000',
            ],
        ];

        foreach ($jobs as $index => $job) {
            Job::updateOrCreate(
                ['title' => $job['title']],
                [
                    'description' => $job['description'],
                    'location' => $job['location'],
                    'type' => $job['type'],
                    'salary_range' => $job['salary_range'],
                    'status' => 'published',
                    'published_at' => now()->subDays(7 - $index),
                ]
            );
        }
    }
}
