<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    /**
     * Register permissions for a module.
     * This method automatically creates permissions in the database for the given module.
     *
     * @param string $module The module name (e.g., 'users', 'products', 'orders')
     * @param array $permissions Array of permissions with keys as permission names and values as labels
     * @return void
     */
    public static function registerModulePermissions(string $module, array $permissions): void
    {
        foreach ($permissions as $permissionName => $permissionData) {
            // Support both simple string labels and detailed arrays
            $label = is_array($permissionData) ? ($permissionData['label'] ?? $permissionName) : $permissionData;
            $description = is_array($permissionData) ? ($permissionData['description'] ?? null) : null;

            Permission::firstOrCreate(
                ['name' => $permissionName],
                [
                    'label' => $label,
                    'module' => $module,
                    'description' => $description,
                ]
            );
        }
    }

    /**
     * Register a complete module with standard CRUD permissions.
     * This creates view, create, edit, delete permissions automatically.
     *
     * @param string $module The module name
     * @param string $moduleLabel Human-readable module label
     * @return void
     */
    public static function registerCrudModule(string $module, string $moduleLabel = null): void
    {
        $moduleLabel = $moduleLabel ?? ucfirst($module);

        $permissions = [
            "view_{$module}" => [
                'label' => "View {$moduleLabel}",
                'description' => "Can view {$moduleLabel} list and details",
            ],
            "create_{$module}" => [
                'label' => "Create {$moduleLabel}",
                'description' => "Can create new {$moduleLabel}",
            ],
            "edit_{$module}" => [
                'label' => "Edit {$moduleLabel}",
                'description' => "Can edit existing {$moduleLabel}",
            ],
            "delete_{$module}" => [
                'label' => "Delete {$moduleLabel}",
                'description' => "Can delete {$moduleLabel}",
            ],
        ];

        self::registerModulePermissions($module, $permissions);
    }

    /**
     * Remove all permissions for a specific module.
     * Use with caution - this will remove permissions from all roles.
     *
     * @param string $module The module name
     * @return int Number of permissions deleted
     */
    public static function removeModulePermissions(string $module): int
    {
        return Permission::where('module', $module)->delete();
    }

    /**
     * Get all permissions grouped by module.
     *
     * @return array
     */
    public static function getAllPermissionsGrouped(): array
    {
        return Permission::orderBy('module')->orderBy('name')->get()->groupBy('module')->toArray();
    }

    /**
     * Get permissions for a specific module.
     *
     * @param string $module
     * @return array
     */
    public static function getModulePermissions(string $module): array
    {
        return Permission::where('module', $module)->orderBy('name')->get()->toArray();
    }

    /**
     * Check if a permission exists.
     *
     * @param string $permissionName
     * @return bool
     */
    public static function permissionExists(string $permissionName): bool
    {
        return Permission::where('name', $permissionName)->exists();
    }

    /**
     * Get all available modules.
     *
     * @return array
     */
    public static function getAvailableModules(): array
    {
        return Permission::distinct('module')->pluck('module')->toArray();
    }

    /**
     * Bulk register multiple modules at once.
     *
     * @param array $modules Array of modules with their permissions
     * @return void
     */
    public static function registerMultipleModules(array $modules): void
    {
        foreach ($modules as $module => $permissions) {
            if (is_string($permissions) && $permissions === 'crud') {
                // Auto-generate CRUD permissions
                self::registerCrudModule($module);
            } elseif (is_array($permissions)) {
                // Custom permissions
                self::registerModulePermissions($module, $permissions);
            }
        }
    }
}
