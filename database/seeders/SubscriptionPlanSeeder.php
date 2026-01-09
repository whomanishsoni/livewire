<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'description' => 'Essential school management features for small schools',
                'price' => 29.99,
                'billing_period' => 'monthly',
                'max_users' => 50,
                'max_storage_gb' => 10,
                'features' => [
                    'Student Management',
                    'Teacher Management',
                    'Basic Reporting',
                    'Email Support'
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'description' => 'Advanced features for growing educational institutions',
                'price' => 79.99,
                'billing_period' => 'monthly',
                'max_users' => 200,
                'max_storage_gb' => 50,
                'features' => [
                    'All Basic features',
                    'Class Management',
                    'Subject Management',
                    'Examination Management',
                    'Attendance Tracking',
                    'Financial Management',
                    'Priority Support'
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'Complete solution for large educational organizations',
                'price' => 199.99,
                'billing_period' => 'monthly',
                'max_users' => 1000,
                'max_storage_gb' => 500,
                'features' => [
                    'All Professional features',
                    'Library Management',
                    'Transport Management',
                    'Hostel Management',
                    'Advanced Analytics',
                    'API Access',
                    '24/7 Phone Support',
                    'Custom Integrations'
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $planData) {
            $plan = \App\Models\SubscriptionPlan::firstOrCreate(
                ['slug' => $planData['slug']],
                $planData
            );

            // Assign modules based on plan
            $this->assignModulesToPlan($plan);
        }
    }

    /**
     * Assign appropriate modules to each plan.
     */
    private function assignModulesToPlan(\App\Models\SubscriptionPlan $plan): void
    {
        $moduleAssignments = [
            'basic' => ['students', 'teachers'],
            'professional' => ['students', 'teachers', 'classes', 'subjects', 'exams', 'attendance', 'finance'],
            'enterprise' => ['students', 'teachers', 'classes', 'subjects', 'exams', 'attendance', 'finance', 'library', 'transport', 'hostel'],
        ];

        $modules = $moduleAssignments[$plan->slug] ?? [];

        $moduleIds = \App\Models\Module::whereIn('slug', $modules)->pluck('id')->toArray();

        $plan->assignModules($moduleIds);
    }
}
