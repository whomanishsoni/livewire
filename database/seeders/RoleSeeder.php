<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing roles and their permissions
        \App\Models\Role::query()->delete();

        $roles = [
            [
                'name' => 'super_admin',
                'label' => 'Super Administrator',
                'color' => 'red',
                'permissions' => [
                    'view_dashboard',
                    'view_users', 'create_users', 'edit_users', 'delete_users',
                    'view_roles', 'create_roles', 'edit_roles', 'delete_roles',
                    'view_settings', 'edit_profile', 'change_password', 'manage_appearance', 'manage_two_factor',
                ],
            ],
            [
                'name' => 'admin',
                'label' => 'School Administrator',
                'color' => 'purple',
                'permissions' => [
                    'view_dashboard',
                    'view_users', 'create_users', 'edit_users',
                    'view_roles', 'edit_roles',
                    'view_settings', 'edit_profile', 'change_password', 'manage_appearance',
                ],
            ],
            [
                'name' => 'teacher',
                'label' => 'Teacher',
                'color' => 'blue',
                'permissions' => [
                    'view_dashboard',
                    'view_users', // Can view student info
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
            [
                'name' => 'parent',
                'label' => 'Parent',
                'color' => 'green',
                'permissions' => [
                    'view_dashboard',
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
            [
                'name' => 'student',
                'label' => 'Student',
                'color' => 'orange',
                'permissions' => [
                    'view_dashboard',
                    'view_settings', 'edit_profile', 'change_password',
                ],
            ],
        ];

        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);

            $role = Role::firstOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );

            // Get permission IDs and sync them
            $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            $role->syncPermissions($permissionIds);
        }
    }
}
