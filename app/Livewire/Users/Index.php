<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Flux;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginators = [];

    public $search = '';

    public $perPage = 10;

    public $showFilters = false;

    // Separate filter properties
    public $verificationFilter = 'all'; // all, verified, unverified

    public $roleFilter = 'all'; // all, admin, moderator, user

    public $statusFilter = 'all'; // all, active, inactive

    // Legacy filter for backward compatibility (can be removed later)
    public $filter = 'all';

    // Selection properties
    public $selectAll = false;

    public $selectedUsers = [];

    // Modal state
    public $showCreateModal = false;

    public $showEditModal = false;

    public $showDeleteModal = false;

    // Create modal properties
    public $createName = '';

    public $createEmail = '';

    public $createPassword = '';

    public $createPasswordConfirmation = '';

    public $createRoleId = '';

    public $showCreatePassword = false;

    public $showCreatePasswordConfirmation = false;

    // Edit modal properties
    public $editingUser = null;

    public $editName = '';

    public $editEmail = '';

    public $editPassword = '';

    public $editPasswordConfirmation = '';

    public $editRoleId = '';

    public $showEditPassword = false;

    public $showEditPasswordConfirmation = false;

    // Delete confirmation
    public $deletingUser = null;

    public function updatingSearch()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingVerificationFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingRoleFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingStatusFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingPerPage()
    {
        $this->paginators['page'] = 1;
    }

    public function setPage($page)
    {
        $this->paginators['page'] = $page;
    }

    public function create()
    {
        if (! auth()->user()->hasPermission('create_users')) {
            abort(403, 'Unauthorized');
        }

        $this->createName = '';
        $this->createEmail = '';
        $this->createPassword = '';
        $this->createPasswordConfirmation = '';
        // Set default role to 'user' if it exists, otherwise first available role
        $defaultRole = \App\Models\Role::where('name', 'user')->first() ?? \App\Models\Role::first();
        $this->createRoleId = $defaultRole ? $defaultRole->id : '';
        $this->showCreateModal = true;
    }

    public function createUser()
    {
        $this->validate([
            'createName' => 'required|string|max:255',
            'createEmail' => 'required|email|max:255|unique:users,email',
            'createPassword' => 'required|string|min:8',
            'createPasswordConfirmation' => 'required|string|same:createPassword',
            'createRoleId' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $this->createName,
            'email' => $this->createEmail,
            'password' => bcrypt($this->createPassword),
            'role_id' => $this->createRoleId,
        ]);

        $this->createName = '';
        $this->createEmail = '';
        $this->createPassword = '';
        $this->createPasswordConfirmation = '';
        $this->createRoleId = '';
        $this->showCreateModal = false;

        Flux::toast(
            heading: 'User created',
            text: 'The user has been successfully created.',
            duration: 3000
        );
    }

    public function edit($userId)
    {
        if (! auth()->user()->hasPermission('edit_users')) {
            abort(403, 'Unauthorized');
        }

        $user = User::find($userId);
        if ($user) {
            // Additional check: moderators can't edit admin users
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator' && $user->role && $user->role->name === 'admin') {
                abort(403, 'You cannot edit admin users');
            }

            $this->editingUser = $user;
            $this->editName = $user->name;
            $this->editEmail = $user->email;
            // Set default role to 'user' if user has no role, otherwise use existing role
            $this->editRoleId = $user->role_id ?? (\App\Models\Role::where('name', 'user')->first() ?? \App\Models\Role::first())?->id ?? '';
            $this->showEditModal = true;
        }
    }

    public function updateUser()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editEmail' => 'required|email|max:255|unique:users,email,'.$this->editingUser->id,
            'editPassword' => 'nullable|string|min:8',
            'editPasswordConfirmation' => 'nullable|string|same:editPassword',
            'editRoleId' => 'nullable|exists:roles,id',
        ]);

        // Prepare update data
        $updateData = [
            'name' => $this->editName,
            'email' => $this->editEmail,
            'role_id' => $this->editRoleId === '' ? null : $this->editRoleId,
        ];

        // Only update password if it's provided
        if (! empty($this->editPassword)) {
            $updateData['password'] = bcrypt($this->editPassword);
        }

        $this->editingUser->update($updateData);

        $this->editingUser = null;
        $this->editName = '';
        $this->editEmail = '';
        $this->editPassword = '';
        $this->editPasswordConfirmation = '';
        $this->editRoleId = '';
        $this->showEditModal = false;

        Flux::toast(
            heading: 'User updated',
            text: 'The user information has been successfully updated.',
            duration: 3000
        );
    }

    public function delete($userId)
    {
        if (! auth()->user()->hasPermission('delete_users')) {
            abort(403, 'Unauthorized');
        }

        $user = User::find($userId);
        if ($user) {
            // Additional check: moderators can't delete admin users
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator' && $user->role && $user->role->name === 'admin') {
                abort(403, 'You cannot delete admin users');
            }

            $this->deletingUser = $user;
            $this->showDeleteModal = true;
        }
    }

    public function confirmDelete()
    {
        if ($this->deletingUser) {
            // Double-check permissions before deletion
            if (! auth()->user()->hasPermission('delete_users')) {
                abort(403, 'Unauthorized');
            }

            $this->deletingUser->delete();
            $this->deletingUser = null;
            $this->showDeleteModal = false;

            Flux::toast(
                heading: 'User deleted',
                text: 'The user has been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function cancelDelete()
    {
        $this->deletingUser = null;
        $this->showDeleteModal = false;
    }

    public function bulkDelete()
    {
        if (! auth()->user()->hasPermission('delete_users')) {
            abort(403, 'Unauthorized');
        }

        if (count($this->selectedUsers) > 0) {
            // Additional check: moderators can't delete admin users
            $currentUser = auth()->user();
            if ($currentUser->role->name === 'moderator') {
                $adminUsers = User::whereIn('id', $this->selectedUsers)
                    ->whereHas('role', function ($query) {
                        $query->where('name', 'admin');
                    })->count();

                if ($adminUsers > 0) {
                    abort(403, 'You cannot delete admin users');
                }
            }

            $deletedCount = count($this->selectedUsers);
            User::whereIn('id', $this->selectedUsers)->delete();
            $this->selectedUsers = [];
            $this->selectAll = false;

            Flux::toast(
                heading: 'Users deleted',
                text: "{$deletedCount} user".($deletedCount > 1 ? 's' : '').' have been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            // Only select users from the current page, not all matching users
            $currentPage = $this->paginators['page'] ?? 1;
            $currentPageUsers = $this->buildUserQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);

            $this->selectedUsers = $currentPageUsers->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        // Only check selectAll if all users on current page are selected
        $currentPage = $this->paginators['page'] ?? 1;
        $currentPageUsers = $this->buildUserQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);

        $totalCurrentPageUsers = $currentPageUsers->count();
        $this->selectAll = count($this->selectedUsers) === $totalCurrentPageUsers && $totalCurrentPageUsers > 0;
    }

    private function buildUserQuery()
    {
        $currentUser = auth()->user();
        $currentUserRole = $currentUser->role;

        return User::when($this->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        })->when($this->verificationFilter !== 'all', function ($query) {
            return $query->when($this->verificationFilter === 'verified', fn ($q) => $q->whereNotNull('email_verified_at'))
                ->when($this->verificationFilter === 'unverified', fn ($q) => $q->whereNull('email_verified_at'));
        })->when($this->roleFilter !== 'all', function ($query) use ($currentUserRole) {
            // Apply role filter but respect user's permissions
            $allowedRoles = $this->getAllowedRoleFilters($currentUserRole);
            if (in_array($this->roleFilter, $allowedRoles)) {
                return $query->whereHas('role', fn ($roleQuery) => $roleQuery->where('name', $this->roleFilter));
            }

            return $query;
        })->when($this->statusFilter !== 'all', function ($query) {
            // For now, active/inactive could be based on email_verified_at or other criteria
            // You can customize this logic based on your requirements
            return $query->when($this->statusFilter === 'active', fn ($q) => $q->whereNotNull('email_verified_at'))
                ->when($this->statusFilter === 'inactive', fn ($q) => $q->whereNull('email_verified_at'));
        })->when($currentUserRole && $currentUserRole->name, function ($query) use ($currentUserRole, $currentUser) {
            // Apply role-based filtering with school scoping
            if ($currentUserRole->name === 'super_admin') {
                // Super admins can see all users (no school restriction)
                return $query;
            } elseif ($currentUserRole->name === 'admin') {
                // School admins can only see users within their own school
                return $query->where('school_id', $currentUser->school_id);
            } elseif ($currentUserRole->name === 'moderator') {
                // Moderators can see users and moderators within their school, but not admins
                return $query->where('school_id', $currentUser->school_id)
                    ->whereHas('role', function ($roleQuery) {
                        $roleQuery->whereIn('name', ['student', 'parent', 'teacher', 'moderator']);
                    });
            } elseif ($currentUserRole->name === 'teacher') {
                // Teachers can see students and parents within their school
                return $query->where('school_id', $currentUser->school_id)
                    ->whereHas('role', function ($roleQuery) {
                        $roleQuery->whereIn('name', ['student', 'parent']);
                    });
            } elseif ($currentUserRole->name === 'parent') {
                // Parents can only see their own children (for now, simplified to see all students in school)
                return $query->where('school_id', $currentUser->school_id)
                    ->whereHas('role', function ($roleQuery) {
                        $roleQuery->where('name', 'student');
                    });
            } elseif ($currentUserRole->name === 'student') {
                // Students can only see themselves
                return $query->where('id', $currentUser->id);
            }

            // Default fallback - restrict to user's school if they have one
            if ($currentUser->school_id) {
                return $query->where('school_id', $currentUser->school_id);
            }

            return $query;
        })->when(!$currentUserRole || !$currentUserRole->name, function ($query) use ($currentUser) {
            // Handle users without roles - restrict to their school if they have one
            if ($currentUser->school_id) {
                return $query->where('school_id', $currentUser->school_id);
            }

            // Users without roles and without school can only see themselves
            return $query->where('id', $currentUser->id);
        });
    }

    private function getAllowedRoleFilters($currentUserRole)
    {
        if (! $currentUserRole || ! $currentUserRole->name) {
            return [];
        }

        // Super admin can see all roles
        if ($currentUserRole->name === 'super_admin') {
            return array_keys($this->getRoleHierarchy());
        }

        // Get role hierarchy configuration
        $roleHierarchy = $this->getRoleHierarchy();

        // Find current user's role in hierarchy
        $currentRoleIndex = array_search($currentUserRole->name, array_keys($roleHierarchy));

        if ($currentRoleIndex === false) {
            return [];
        }

        // Return all roles at or below current user's hierarchy level
        $allowedRoleNames = array_slice(array_keys($roleHierarchy), $currentRoleIndex);

        return $allowedRoleNames;
    }

    private function getRoleHierarchy(): array
    {
        return config('roles.hierarchy', [
            'student' => 1,   // Lowest level
            'parent' => 2,    // Parents
            'teacher' => 3,   // Teaching staff
            'admin' => 4,     // School administrators
            'super_admin' => 5, // Highest level - system administrators
        ]);
    }

    private function getUsers()
    {
        return $this->buildUserQuery()->get();
    }

    public function render()
    {
        $currentPage = $this->paginators['page'] ?? 1;

        $users = $this->buildUserQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);

        return view('livewire.users.index', compact('users'));
    }
}
