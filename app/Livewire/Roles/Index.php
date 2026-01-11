<?php

namespace App\Livewire\Roles;

use App\Models\Permission;
use App\Models\Role;
use Flux;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $perPage = 10;

    // Selection properties
    public $selectAll = false;

    public $selectedRoles = [];

    // Create modal properties
    public $createName = '';

    public $createLabel = '';

    public $createColor = 'gray';

    public $createSelectedPermissions = [];

    // Edit modal properties
    public $editingRole = null;

    public $editName = '';

    public $editLabel = '';

    public $editColor = 'gray';

    // Delete confirmation
    public $deletingRole = null;

    // Modal state
    public $showCreateModal = false;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $showPermissionsModal = false;

    public $editingPermissionsRole = null;

    public $availablePermissions = [];

    public $selectedPermissions = [];

    // Permission select all properties
    public $selectAllView = false;

    public $selectAllCreate = false;

    public $selectAllEdit = false;

    public $selectAllDelete = false;

    public $selectAllModule = false;

    public $moduleSelectAll = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function create()
    {
        if (! auth()->user()->hasPermission('create_roles')) {
            abort(403, 'Unauthorized');
        }

        $this->createName = '';
        $this->createLabel = '';
        $this->createColor = 'gray';
        $this->createSelectedPermissions = [];
        $this->showCreateModal = true;
    }

    public function createRole()
    {
        $this->validate([
            'createName' => 'required|string|max:255|unique:roles,name',
            'createLabel' => 'required|string|max:255',
            'createColor' => 'required|string|in:'.implode(',', array_keys(Role::availableColors())),
        ]);

        $role = Role::create([
            'name' => $this->createName,
            'label' => $this->createLabel,
            'color' => $this->createColor,
        ]);

        // Sync permissions if any were selected
        if (! empty($this->createSelectedPermissions)) {
            $role->syncPermissions($this->createSelectedPermissions);
        }

        $this->createName = '';
        $this->createLabel = '';
        $this->createColor = 'gray';
        $this->createSelectedPermissions = [];
        $this->showCreateModal = false;

        Flux::toast(
            heading: 'Role created',
            text: 'The role has been successfully created.',
            duration: 3000
        );
    }

    public function edit($roleId)
    {
        if (! auth()->user()->hasPermission('edit_roles')) {
            abort(403, 'Unauthorized');
        }

        $role = Role::find($roleId);
        if ($role) {
            // Additional check: moderators cannot edit admin role
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator' && $role->name === 'admin') {
                abort(403, 'You cannot edit the admin role');
            }

            $this->editingRole = $role;
            $this->editName = $role->name;
            $this->editLabel = $role->label;
            $this->editColor = $role->color;
            $this->showEditModal = true;
        }
    }

    public function updateRole()
    {
        $this->validate([
            'editName' => 'required|string|max:255|unique:roles,name,'.$this->editingRole->id,
            'editLabel' => 'required|string|max:255',
            'editColor' => 'required|string|in:'.implode(',', array_keys(Role::availableColors())),
        ]);

        $this->editingRole->update([
            'name' => $this->editName,
            'label' => $this->editLabel,
            'color' => $this->editColor,
        ]);

        $this->editingRole = null;
        $this->editName = '';
        $this->editLabel = '';
        $this->editColor = 'gray';
        $this->showEditModal = false;

        Flux::toast(
            heading: 'Role updated',
            text: 'The role has been successfully updated.',
            duration: 3000
        );
    }

    public function delete($roleId)
    {
        $this->deletingRole = Role::find($roleId);
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        if ($this->deletingRole) {
            $this->deletingRole->delete();
            $this->deletingRole = null;
            $this->showDeleteModal = false;

            Flux::toast(
                heading: 'Role deleted',
                text: 'The role has been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function cancelDelete()
    {
        $this->deletingRole = null;
        $this->showDeleteModal = false;
    }

    public function bulkDelete()
    {
        if (! auth()->user()->hasPermission('delete_roles')) {
            abort(403, 'Unauthorized');
        }

        if (count($this->selectedRoles) > 0) {
            // Additional check: moderators cannot delete admin role
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator') {
                $adminRole = Role::where('name', 'admin')->first();
                if ($adminRole && in_array($adminRole->id, $this->selectedRoles)) {
                    abort(403, 'You cannot delete the admin role');
                }
            }

            $deletedCount = count($this->selectedRoles);
            Role::whereIn('id', $this->selectedRoles)->delete();
            $this->selectedRoles = [];
            $this->selectAll = false;

            Flux::toast(
                heading: 'Roles deleted',
                text: "{$deletedCount} role".($deletedCount > 1 ? 's' : '').' have been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $allowedRoles = $this->getAllowedRolesForCurrentUser();
            $currentPageRoles = Role::when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('label', 'like', '%'.$this->search.'%');
                });
            })->whereIn('name', $allowedRoles)->paginate($this->perPage);

            $this->selectedRoles = $currentPageRoles->pluck('id')->toArray();
        } else {
            $this->selectedRoles = [];
        }
    }

    public function updatedSelectedRoles()
    {
        $allowedRoles = $this->getAllowedRolesForCurrentUser();
        $currentPageRoles = Role::when($this->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('label', 'like', '%'.$this->search.'%');
            });
        })->whereIn('name', $allowedRoles)->paginate($this->perPage);

        $totalCurrentPageRoles = $currentPageRoles->count();
        $this->selectAll = count($this->selectedRoles) === $totalCurrentPageRoles && $totalCurrentPageRoles > 0;
    }

    public function showPermissions($roleId)
    {
        if (! auth()->user()->hasPermission('edit_roles')) {
            abort(403, 'Unauthorized');
        }

        $role = Role::with('permissions')->find($roleId);
        if ($role) {
            // Additional check: moderators cannot manage admin role permissions
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator' && $role->name === 'admin') {
                abort(403, 'You cannot manage admin role permissions');
            }

            $this->editingPermissionsRole = $role;
            $this->availablePermissions = $this->getAvailablePermissions();

            // Debug: Check permissions loading
            $totalPermissionsInDB = Permission::count();
            $rolePermissionsCount = $role->permissions ? $role->permissions->count() : 0;
            $availablePermissionsCount = count($this->availablePermissions);

            \Log::info("Permissions Debug - Role: {$role->name}", [
                'total_permissions_in_db' => $totalPermissionsInDB,
                'role_permissions_count' => $rolePermissionsCount,
                'available_permissions_modules' => $availablePermissionsCount,
                'role_permissions' => $role->permissions ? $role->permissions->pluck('name')->toArray() : [],
                'selected_permission_ids' => $role->permissions ? $role->permissions->pluck('id')->toArray() : [],
            ]);

            $this->selectedPermissions = $role->permissions ? $role->permissions->pluck('id')->toArray() : [];

            $this->showPermissionsModal = true;

            // Initialize bulk checkbox states after modal is shown
            $this->updateBulkCheckboxStates();
        }
    }

    public function updatePermissions()
    {
        if ($this->editingPermissionsRole) {
            $this->editingPermissionsRole->syncPermissions($this->selectedPermissions);

            $this->showPermissionsModal = false;
            $this->editingPermissionsRole = null;
            $this->availablePermissions = [];
            $this->selectedPermissions = [];

            Flux::toast(
                heading: 'Permissions updated',
                text: 'The role permissions have been successfully updated.',
                duration: 3000
            );
        }
    }

    public function closePermissionsModal()
    {
        $this->showPermissionsModal = false;
        $this->editingPermissionsRole = null;
        $this->availablePermissions = [];
        $this->selectedPermissions = [];
    }

    public function toggleAllView()
    {
        $allViewPermissions = [];
        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                if (str_contains($permission['name'], 'view_')) {
                    $allViewPermissions[] = $permission['id'];
                }
            }
        }

        if ($this->selectAllView) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $allViewPermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $allViewPermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function toggleAllCreate()
    {
        $allCreatePermissions = [];
        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                if (str_contains($permission['name'], 'create_')) {
                    $allCreatePermissions[] = $permission['id'];
                }
            }
        }

        if ($this->selectAllCreate) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $allCreatePermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $allCreatePermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function toggleAllEdit()
    {
        $allEditPermissions = [];
        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                if (str_contains($permission['name'], 'edit_')) {
                    $allEditPermissions[] = $permission['id'];
                }
            }
        }

        if ($this->selectAllEdit) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $allEditPermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $allEditPermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function toggleAllDelete()
    {
        $allDeletePermissions = [];
        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                if (str_contains($permission['name'], 'delete_')) {
                    $allDeletePermissions[] = $permission['id'];
                }
            }
        }

        if ($this->selectAllDelete) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $allDeletePermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $allDeletePermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function toggleAllModule()
    {
        $allPermissions = [];
        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                $allPermissions[] = $permission['id'];
            }
        }

        if ($this->selectAllModule) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $allPermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $allPermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function toggleModuleAll($moduleKey)
    {
        $modulePermissions = [];
        foreach ($this->availablePermissions[$moduleKey]['permissions'] as $permission) {
            $modulePermissions[] = $permission['id'];
        }

        if ($this->moduleSelectAll[$moduleKey] ?? false) {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $modulePermissions));
        } else {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $modulePermissions);
        }
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function updatedSelectAllView()
    {
        $this->toggleAllView();
    }

    public function updatedSelectAllCreate()
    {
        $this->toggleAllCreate();
    }

    public function updatedSelectAllEdit()
    {
        $this->toggleAllEdit();
    }

    public function updatedSelectAllDelete()
    {
        $this->toggleAllDelete();
    }

    public function updatedSelectAllModule()
    {
        $this->toggleAllModule();
    }

    public function updatedSelectedPermissions()
    {
        // Update the state of bulk checkboxes based on current selections
        $this->updateBulkCheckboxStates();
    }

    private function updateBulkCheckboxStates()
    {
        $allPermissions = [];
        $viewPermissions = [];
        $createPermissions = [];
        $editPermissions = [];
        $deletePermissions = [];

        foreach ($this->availablePermissions as $module) {
            foreach ($module['permissions'] as $permission) {
                $allPermissions[] = $permission['id'];

                if (str_contains($permission['name'], 'view_')) {
                    $viewPermissions[] = $permission['id'];
                } elseif (str_contains($permission['name'], 'create_')) {
                    $createPermissions[] = $permission['id'];
                } elseif (str_contains($permission['name'], 'edit_')) {
                    $editPermissions[] = $permission['id'];
                } elseif (str_contains($permission['name'], 'delete_')) {
                    $deletePermissions[] = $permission['id'];
                }
            }
        }

        // Update bulk checkbox states
        $this->selectAllView = ! empty($viewPermissions) && empty(array_diff($viewPermissions, $this->selectedPermissions));
        $this->selectAllCreate = ! empty($createPermissions) && empty(array_diff($createPermissions, $this->selectedPermissions));
        $this->selectAllEdit = ! empty($editPermissions) && empty(array_diff($editPermissions, $this->selectedPermissions));
        $this->selectAllDelete = ! empty($deletePermissions) && empty(array_diff($deletePermissions, $this->selectedPermissions));
        $this->selectAllModule = ! empty($allPermissions) && empty(array_diff($allPermissions, $this->selectedPermissions));
    }

    public function updatedModuleSelectAll()
    {
        // This will be triggered when individual module select all checkboxes are updated
    }

    private function getAvailablePermissions(): array
    {
        $currentUser = auth()->user();

        if (! $currentUser || ! $currentUser->role) {
            return [];
        }

        if ($currentUser->hasRole('super_admin')) {
            $permissions = Permission::orderBy('module')->orderBy('name')->get();
        } else {
            $permissions = $currentUser->role->permissions()
                ->orderBy('module')
                ->orderBy('name')
                ->get();
        }

        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            $module = $permission->module;
            if (! isset($groupedPermissions[$module])) {
                $groupedPermissions[$module] = [
                    'title' => ucfirst($module),
                    'permissions' => [],
                ];
            }
            $groupedPermissions[$module]['permissions'][$permission->id] = [
                'id' => $permission->id,
                'name' => $permission->name,
                'label' => $permission->label,
            ];
        }

        return $groupedPermissions;
    }

    private function getAllowedRolesForCurrentUser()
    {
        $currentUser = auth()->user();

        // If no user or no role, return empty
        if (! $currentUser || ! $currentUser->role) {
            return [];
        }

        $userRole = $currentUser->role->name;

        // Super admin can see ALL roles - return all role names from database
        if ($userRole === 'super_admin') {
            return Role::pluck('name')->toArray();
        }

        // For school admins, return roles they can manage
        if ($userRole === 'admin') {
            return ['student', 'parent', 'teacher', 'admin'];
        }

        // For teachers, return roles they can manage
        if ($userRole === 'teacher') {
            return ['student', 'parent', 'teacher'];
        }

        // For parents, return roles they can see
        if ($userRole === 'parent') {
            return ['student', 'parent'];
        }

        // For students, only their own role
        if ($userRole === 'student') {
            return ['student'];
        }

        // Default fallback - return empty array
        return [];
    }

    private function getRoleHierarchy(): array
    {
        return config('roles.hierarchy', [
            'student' => 1,   // Lowest level
            'parent' => 2,    // Parent level
            'teacher' => 3,   // Teacher level
            'admin' => 4,     // School admin level
            'super_admin' => 5, // Global admin - highest level
        ]);
    }

    public function render()
    {
        $allowedRoles = $this->getAllowedRolesForCurrentUser();

        $roles = Role::with('permissions')->when($this->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('label', 'like', '%'.$this->search.'%');
            });
        })->whereIn('name', $allowedRoles)->paginate($this->perPage);

        return view('livewire.roles.index', compact('roles'));
    }
}
