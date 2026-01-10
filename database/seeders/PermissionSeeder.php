<?php

namespace Database\Seeders;

use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all modules from the database (created by ModuleSeeder)
        $modules = \App\Models\Module::orderBy('sort_order')->get();

        // First, remove old permissions that don't belong to any module
        $validModuleNames = $modules->pluck('name')->toArray();
        \App\Models\Permission::whereNotIn('module', $validModuleNames)->delete();

        // Register permissions for each module based on the Module model
        foreach ($modules as $module) {
            // Skip dashboard and settings - they have custom permissions
            if (in_array($module->name, ['dashboard', 'settings'])) {
                continue;
            }

            // Register CRUD permissions for standard modules
            PermissionService::registerCrudModule($module->name, $module->label);
        }

        // Register custom permissions for dashboard
        $dashboardModule = \App\Models\Module::where('name', 'dashboard')->first();
        if ($dashboardModule) {
            // Remove CRUD permissions created by boot method and create only view_dashboard
            \App\Models\Permission::where('module', 'dashboard')
                ->whereNotIn('name', ['view_dashboard'])
                ->delete();

            PermissionService::registerModulePermissions('dashboard', [
                'view_dashboard' => [
                    'label' => 'View Dashboard',
                    'description' => 'Can access the main dashboard',
                ],
            ]);
        }

        // Register custom permissions for settings
        $settingsModule = \App\Models\Module::where('name', 'settings')->first();
        if ($settingsModule) {
            // Remove CRUD permissions created by boot method
            \App\Models\Permission::where('module', 'settings')
                ->whereNotIn('name', ['view_settings', 'edit_profile', 'change_password', 'manage_appearance', 'manage_two_factor'])
                ->delete();

            PermissionService::registerModulePermissions('settings', [
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
            ]);
        }

        echo 'Permissions regenerated for '.$modules->count()." modules\n";

        // Example of how to add a new module dynamically in the future:
        // PermissionService::registerCrudModule('products', 'Products');
        // PermissionService::registerCrudModule('orders', 'Orders');
        // PermissionService::registerModulePermissions('reports', [
        //     'view_reports' => 'View Reports',
        //     'export_reports' => 'Export Reports',
        // ]);
    }
}
