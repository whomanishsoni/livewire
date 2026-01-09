<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'students',
                'slug' => 'students',
                'label' => 'Student Management',
                'description' => 'Manage student enrollment, profiles, and academic records',
                'icon' => 'fas fa-user-graduate',
                'route_prefix' => 'students',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'teachers',
                'slug' => 'teachers',
                'label' => 'Teacher Management',
                'description' => 'Manage teacher profiles, assignments, and performance',
                'icon' => 'fas fa-chalkboard-teacher',
                'route_prefix' => 'teachers',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'classes',
                'slug' => 'classes',
                'label' => 'Class Management',
                'description' => 'Manage class schedules, assignments, and student groupings',
                'icon' => 'fas fa-school',
                'route_prefix' => 'classes',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'subjects',
                'slug' => 'subjects',
                'label' => 'Subject Management',
                'description' => 'Manage curriculum subjects and course offerings',
                'icon' => 'fas fa-book',
                'route_prefix' => 'subjects',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'exams',
                'slug' => 'exams',
                'label' => 'Examination Management',
                'description' => 'Manage exams, grades, and academic assessments',
                'icon' => 'fas fa-clipboard-check',
                'route_prefix' => 'exams',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'attendance',
                'slug' => 'attendance',
                'label' => 'Attendance Tracking',
                'description' => 'Track student and teacher attendance records',
                'icon' => 'fas fa-calendar-check',
                'route_prefix' => 'attendance',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'finance',
                'slug' => 'finance',
                'label' => 'Financial Management',
                'description' => 'Manage fees, payments, and financial records',
                'icon' => 'fas fa-money-bill-wave',
                'route_prefix' => 'finance',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'library',
                'slug' => 'library',
                'label' => 'Library Management',
                'description' => 'Manage library resources and book circulation',
                'icon' => 'fas fa-book-open',
                'route_prefix' => 'library',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'transport',
                'slug' => 'transport',
                'label' => 'Transport Management',
                'description' => 'Manage school transportation and routes',
                'icon' => 'fas fa-bus',
                'route_prefix' => 'transport',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'hostel',
                'slug' => 'hostel',
                'label' => 'Hostel Management',
                'description' => 'Manage dormitory accommodations and residents',
                'icon' => 'fas fa-home',
                'route_prefix' => 'hostel',
                'is_active' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($modules as $module) {
            \App\Models\Module::firstOrCreate(
                ['slug' => $module['slug']],
                $module
            );
        }
    }
}
