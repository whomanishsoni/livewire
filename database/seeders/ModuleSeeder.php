<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing modules to start fresh
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Module::query()->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $modules = [
            // System modules (required for sidebar)
            [
                'name' => 'dashboard',
                'slug' => 'dashboard',
                'label' => 'Dashboard',
                'description' => 'Main dashboard and overview',
                'icon' => 'home',
                'route_prefix' => 'dashboard',
                'is_active' => true,
                'sort_order' => 0,
            ],
            [
                'name' => 'users',
                'slug' => 'users',
                'label' => 'User Management',
                'description' => 'Manage system users and accounts',
                'icon' => 'users',
                'route_prefix' => 'users',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'roles',
                'slug' => 'roles',
                'label' => 'Role Management',
                'description' => 'Manage roles and permissions',
                'icon' => 'shield-check',
                'route_prefix' => 'roles',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'schools',
                'slug' => 'schools',
                'label' => 'School Management',
                'description' => 'Manage schools and institutions',
                'icon' => 'building-office',
                'route_prefix' => 'schools',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'subscriptions',
                'slug' => 'subscriptions',
                'label' => 'Subscription Management',
                'description' => 'Manage school subscriptions',
                'icon' => 'credit-card',
                'route_prefix' => 'subscriptions',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'subscription_plans',
                'slug' => 'subscription-plans',
                'label' => 'Subscription Plan Management',
                'description' => 'Manage subscription plans and pricing',
                'icon' => 'document-duplicate',
                'route_prefix' => 'subscription_plans',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'settings',
                'slug' => 'settings',
                'label' => 'Settings',
                'description' => 'System and user settings',
                'icon' => 'cog-6-tooth',
                'route_prefix' => 'settings',
                'is_active' => true,
                'sort_order' => 6,
            ],
            // School management modules
            [
                'name' => 'students',
                'slug' => 'students',
                'label' => 'Student Management',
                'description' => 'Manage student enrollment, profiles, and academic records',
                'icon' => 'user',
                'route_prefix' => 'students',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'teachers',
                'slug' => 'teachers',
                'label' => 'Teacher Management',
                'description' => 'Manage teacher profiles, assignments, and performance',
                'icon' => 'academic-cap',
                'route_prefix' => 'teachers',
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'name' => 'classes',
                'slug' => 'classes',
                'label' => 'Class Management',
                'description' => 'Manage class schedules, assignments, and student groupings',
                'icon' => 'building-storefront',
                'route_prefix' => 'classes',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'name' => 'subjects',
                'slug' => 'subjects',
                'label' => 'Subject Management',
                'description' => 'Manage curriculum subjects and course offerings',
                'icon' => 'book-open',
                'route_prefix' => 'subjects',
                'is_active' => true,
                'sort_order' => 13,
            ],
            [
                'name' => 'exams',
                'slug' => 'exams',
                'label' => 'Examination Management',
                'description' => 'Manage exams, grades, and academic assessments',
                'icon' => 'clipboard-document-list',
                'route_prefix' => 'exams',
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'name' => 'attendance',
                'slug' => 'attendance',
                'label' => 'Attendance Tracking',
                'description' => 'Track student and teacher attendance records',
                'icon' => 'calendar',
                'route_prefix' => 'attendance',
                'is_active' => true,
                'sort_order' => 15,
            ],
            [
                'name' => 'finance',
                'slug' => 'finance',
                'label' => 'Financial Management',
                'description' => 'Manage fees, payments, and financial records',
                'icon' => 'banknotes',
                'route_prefix' => 'finance',
                'is_active' => true,
                'sort_order' => 16,
            ],
            [
                'name' => 'library',
                'slug' => 'library',
                'label' => 'Library Management',
                'description' => 'Manage library resources and book circulation',
                'icon' => 'book-open',
                'route_prefix' => 'library',
                'is_active' => true,
                'sort_order' => 17,
            ],
            [
                'name' => 'transport',
                'slug' => 'transport',
                'label' => 'Transport Management',
                'description' => 'Manage school transportation and routes',
                'icon' => 'truck',
                'route_prefix' => 'transport',
                'is_active' => true,
                'sort_order' => 18,
            ],
            [
                'name' => 'hostel',
                'slug' => 'hostel',
                'label' => 'Hostel Management',
                'description' => 'Manage dormitory accommodations and residents',
                'icon' => 'home-modern',
                'route_prefix' => 'hostel',
                'is_active' => true,
                'sort_order' => 19,
            ],
        ];

        foreach ($modules as $module) {
            $created = \App\Models\Module::firstOrCreate(
                ['slug' => $module['slug']],
                $module
            );
            echo "Created module: {$created->name} (ID: {$created->id})\n";
        }

        echo 'Total modules created: '.\App\Models\Module::count()."\n";
    }
}
