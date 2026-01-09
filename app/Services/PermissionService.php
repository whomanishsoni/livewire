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

    /**
     * Check if a user has permission in their school context.
     * This considers both role permissions and school module access.
     *
     * @param \App\Models\User $user
     * @param string $permission
     * @return bool
     */
    public static function userHasPermissionInSchoolContext($user, string $permission): bool
    {
        // First check if user has the permission via their role
        if (!$user->role?->hasPermission($permission)) {
            return false;
        }

        // If user has school context, check if their school has access to the module
        if ($user->school_id) {
            $module = self::extractModuleFromPermission($permission);
            if ($module && !$user->school->hasModule($module)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get permissions available to a user in their school context.
     *
     * @param \App\Models\User $user
     * @return array
     */
    public static function getUserPermissionsInSchoolContext($user): array
    {
        $rolePermissions = $user->role?->getPermissionNames() ?? [];

        if (!$user->school_id) {
            return $rolePermissions;
        }

        $availableModules = $user->school->getAvailableModules()->pluck('name')->toArray();

        return array_filter($rolePermissions, function ($permission) use ($availableModules) {
            $module = self::extractModuleFromPermission($permission);
            return !$module || in_array($module, $availableModules);
        });
    }

    /**
     * Get modules that a user can access based on their school subscription.
     *
     * @param \App\Models\User $user
     * @return array
     */
    public static function getUserAccessibleModules($user): array
    {
        if (!$user->school) {
            return [];
        }

        return $user->school->getAvailableModules()->pluck('slug')->toArray();
    }

    /**
     * Check if a module is accessible to a user's school.
     *
     * @param \App\Models\User $user
     * @param string $moduleSlug
     * @return bool
     */
    public static function canUserAccessModule($user, string $moduleSlug): bool
    {
        if (!$user->school) {
            return false;
        }

        return $user->school->hasModule($moduleSlug);
    }

    /**
     * Extract module name from permission string.
     * e.g., "view_users" -> "users", "create_students" -> "students"
     *
     * @param string $permission
     * @return string|null
     */
    public static function extractModuleFromPermission(string $permission): ?string
    {
        // Remove common prefixes
        $module = preg_replace('/^(view_|create_|edit_|delete_|manage_)/', '', $permission);

        // If it's a known module, return it
        if (\App\Models\Module::where('name', $module)->exists()) {
            return $module;
        }

        return null;
    }

    /**
     * Get permissions grouped by module for school context.
     * Only includes modules that the user's school has access to.
     *
     * @param \App\Models\User $user
     * @return array
     */
    public static function getPermissionsGroupedByModuleForUser($user): array
    {
        $allPermissions = self::getAllPermissionsGrouped();
        $accessibleModules = self::getUserAccessibleModules($user);

        if (empty($accessibleModules)) {
            return [];
        }

        return array_filter($allPermissions, function ($module) use ($accessibleModules) {
            return in_array($module, $accessibleModules);
        }, ARRAY_FILTER_USE_KEY);
    }
}
