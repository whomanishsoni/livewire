<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Green Valley High School',
                'domain' => 'greenvalley',
                'address' => '123 Education Street, Springfield, IL 62701',
                'phone' => '+1-555-0123',
                'email' => 'admin@greenvalley.edu',
                'description' => 'A premier high school focused on academic excellence and student development.',
                'is_active' => true,
                'settings' => [
                    'timezone' => 'America/Chicago',
                    'currency' => 'USD',
                    'academic_year_start' => '08-15',
                    'academic_year_end' => '05-30',
                ],
            ],
            [
                'name' => 'Riverside Elementary School',
                'domain' => 'riverside',
                'address' => '456 Learning Avenue, Riverside, CA 92501',
                'phone' => '+1-555-0456',
                'email' => 'contact@riverside.edu',
                'description' => 'Nurturing young minds through innovative teaching methods.',
                'is_active' => true,
                'settings' => [
                    'timezone' => 'America/Los_Angeles',
                    'currency' => 'USD',
                    'academic_year_start' => '09-01',
                    'academic_year_end' => '06-15',
                ],
            ],
            [
                'name' => 'Mountain View Academy',
                'domain' => 'mountainview',
                'address' => '789 Knowledge Boulevard, Denver, CO 80201',
                'phone' => '+1-555-0789',
                'email' => 'info@mountainview.edu',
                'description' => 'Specialized education for gifted students with advanced curriculum.',
                'is_active' => true,
                'settings' => [
                    'timezone' => 'America/Denver',
                    'currency' => 'USD',
                    'academic_year_start' => '08-20',
                    'academic_year_end' => '05-25',
                ],
            ],
        ];

        foreach ($schools as $schoolData) {
            $school = \App\Models\School::firstOrCreate(
                ['domain' => $schoolData['domain']],
                $schoolData
            );

            // Subscribe each school to a plan (only if not already subscribed)
            $existingSubscription = $school->subscriptions()->where('status', 'active')->first();
            if (!$existingSubscription) {
                $this->subscribeSchoolToPlan($school);
            }
        }
    }

    /**
     * Subscribe a school to an appropriate plan.
     */
    private function subscribeSchoolToPlan(\App\Models\School $school): void
    {
        $plans = [
            'Green Valley High School' => 'professional',
            'Riverside Elementary School' => 'basic',
            'Mountain View Academy' => 'enterprise',
        ];

        $planSlug = $plans[$school->name] ?? 'basic';
        $plan = \App\Models\SubscriptionPlan::where('slug', $planSlug)->first();

        if ($plan) {
            \App\Services\SubscriptionService::subscribeSchool($school, $plan, [
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addYear(),
            ]);
        }
    }
}
