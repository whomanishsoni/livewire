<?php

namespace Database\Seeders;

use App\Services\PermissionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Register modules with their permissions using the PermissionService
        $modules = [
            // Standard CRUD modules
            'users' => 'crud',
            'roles' => 'crud',

            // Custom modules with specific permissions
            'dashboard' => [
                'view_dashboard' => [
                    'label' => 'View Dashboard',
                    'description' => 'Can access the main dashboard',
                ],
            ],
            'settings' => [
                'view_settings' => [
                    'label' => 'View Settings',
                    'description' => 'Can access settings page',
                ],
                'edit_profile' => [
                    'label' => 'Edit Profile',
                    'description' => 'Can edit their profile',
                ],
                'change_password' => [
                    'label' => 'Change Password',
                    'description' => 'Can change password',
                ],
                'manage_appearance' => [
                    'label' => 'Manage Appearance',
                    'description' => 'Can change appearance settings',
                ],
                'manage_two_factor' => [
                    'label' => 'Manage Two-Factor Auth',
                    'description' => 'Can manage two-factor authentication',
                ],
            ],
        ];

        // Use the PermissionService to register all modules
        PermissionService::registerMultipleModules($modules);

        // Example of how to add a new module dynamically in the future:
        // PermissionService::registerCrudModule('products', 'Products');
        // PermissionService::registerCrudModule('orders', 'Orders');
        // PermissionService::registerModulePermissions('reports', [
        //     'view_reports' => 'View Reports',
        //     'export_reports' => 'Export Reports',
        // ]);
    }
}
