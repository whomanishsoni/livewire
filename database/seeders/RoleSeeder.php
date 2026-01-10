<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure all permissions exist before assigning to roles
        $allPermissions = Permission::all()->pluck('name')->toArray();
        echo 'Total permissions available: '.count($allPermissions)."\n\n";

        $roles = [
            [
                'name' => 'super_admin',
                'label' => 'Super Administrator',
                'color' => 'red',
                'permissions' => [
                    // Dashboard
                    'view_dashboard',

                    // System administration
                    'view_users', 'create_users', 'edit_users', 'delete_users',
                    'view_roles', 'create_roles', 'edit_roles', 'delete_roles',
                    'view_schools', 'create_schools', 'edit_schools', 'delete_schools',
                    'view_subscriptions', 'create_subscriptions', 'edit_subscriptions', 'delete_subscriptions',
                    'view_subscription_plans', 'create_subscription_plans', 'edit_subscription_plans', 'delete_subscription_plans',

                    // All school modules
                    'view_students', 'create_students', 'edit_students', 'delete_students',
                    'view_teachers', 'create_teachers', 'edit_teachers', 'delete_teachers',
                    'view_classes', 'create_classes', 'edit_classes', 'delete_classes',
                    'view_subjects', 'create_subjects', 'edit_subjects', 'delete_subjects',
                    'view_exams', 'create_exams', 'edit_exams', 'delete_exams',
                    'view_attendance', 'create_attendance', 'edit_attendance', 'delete_attendance',
                    'view_finance', 'create_finance', 'edit_finance', 'delete_finance',
                    'view_library', 'create_library', 'edit_library', 'delete_library',
                    'view_transport', 'create_transport', 'edit_transport', 'delete_transport',
                    'view_hostel', 'create_hostel', 'edit_hostel', 'delete_hostel',

                    // Settings
                    'view_settings', 'edit_profile', 'change_password', 'manage_appearance', 'manage_two_factor',
                ],
            ],
            [
                'name' => 'admin',
                'label' => 'School Administrator',
                'color' => 'purple',
                'permissions' => [
                    // Dashboard
                    'view_dashboard',

                    // Limited user management
                    'view_users', 'create_users', 'edit_users',
                    'view_roles', 'edit_roles',

                    // All school modules
                    'view_students', 'create_students', 'edit_students', 'delete_students',
                    'view_teachers', 'create_teachers', 'edit_teachers', 'delete_teachers',
                    'view_classes', 'create_classes', 'edit_classes', 'delete_classes',
                    'view_subjects', 'create_subjects', 'edit_subjects', 'delete_subjects',
                    'view_exams', 'create_exams', 'edit_exams', 'delete_exams',
                    'view_attendance', 'create_attendance', 'edit_attendance', 'delete_attendance',
                    'view_finance', 'create_finance', 'edit_finance', 'delete_finance',
                    'view_library', 'create_library', 'edit_library', 'delete_library',
                    'view_transport', 'create_transport', 'edit_transport', 'delete_transport',
                    'view_hostel', 'create_hostel', 'edit_hostel', 'delete_hostel',

                    // Settings
                    'view_settings', 'edit_profile', 'change_password', 'manage_appearance',
                ],
            ],
            [
                'name' => 'teacher',
                'label' => 'Teacher',
                'color' => 'blue',
                'permissions' => [
                    // Dashboard
                    'view_dashboard',

                    // Limited student viewing
                    'view_students',
                    'view_classes',
                    'view_subjects',
                    'view_exams',
                    'view_attendance',

                    // Settings
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
            [
                'name' => 'parent',
                'label' => 'Parent',
                'color' => 'green',
                'permissions' => [
                    // Dashboard
                    'view_dashboard',

                    // Limited access to their child's information
                    'view_students', // Can view their child's info

                    // Settings
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
            [
                'name' => 'student',
                'label' => 'Student',
                'color' => 'orange',
                'permissions' => [
                    // Dashboard
                    'view_dashboard',

                    // Limited access to their own information
                    'view_students', // Can view their own profile

                    // Settings
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
        ];

        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);

            // Create or update role
            $role = Role::updateOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );

            // Get permission IDs only for permissions that actually exist in the database
            $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();

            // Debug: Log which permissions were found vs requested
            $existingPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();
            $missingPermissions = array_diff($permissions, $existingPermissions);

            echo "Role: {$roleData['label']} ({$roleData['name']})\n";
            echo '  - Requested: '.count($permissions).' permissions, Found: '.count($existingPermissions)." permissions\n";

            if (! empty($missingPermissions)) {
                // Log missing permissions for debugging
                echo '  - WARNING: Missing permissions: '.implode(', ', array_slice($missingPermissions, 0, 10)).(count($missingPermissions) > 10 ? '...' : '')."\n";
            }

            // Sync permissions to role
            $role->syncPermissions($permissionIds);
            echo '  - Assigned '.count($permissionIds)." permissions\n\n";
        }
    }
}
