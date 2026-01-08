<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Users</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Users') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_users'))
            <flux:button wire:click="create" variant="primary" icon="plus">
                Create User
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <!-- Search, Page Length, and Filters Toggle - All in One Row -->
        <div class="mb-6 flex gap-4 flex-wrap items-end">
            <div class="flex-1 min-w-64">
                <flux:input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search users by name or email..."
                    icon="magnifying-glass"
                />
            </div>
            <div class="w-32">
                <flux:select wire:model.live="perPage" placeholder="Per page">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </flux:select>
            </div>
            <div class="flex-shrink-0">
                <flux:button
                    wire:click="$toggle('showFilters')"
                    variant="outline"
                    icon="funnel"
                >
                    @if($showFilters)
                        Hide Filters
                    @else
                        Show Filters
                    @endif
                </flux:button>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="mb-6">

            @if($showFilters)
                <div class="p-4 rounded-lg border bg-gray-100 dark:bg-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Verification Status Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Verification Status</flux:label>
                                <flux:select wire:model.live="verificationFilter">
                                    <option value="all">All Users</option>
                                    <option value="verified">Verified Only</option>
                                    <option value="unverified">Unverified Only</option>
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- Role Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Role</flux:label>
                                <flux:select wire:model.live="roleFilter">
                                    <option value="all">All Roles</option>
                                    @php
                                        $currentUser = auth()->user();
                                        $currentUserRole = $currentUser->role;
                                        $allowedRoles = [];

                                        if ($currentUserRole) {
                                            // Get role hierarchy configuration
                                            $roleHierarchy = config('roles.hierarchy', [
                                                'user' => 1,      // Lowest level
                                                'moderator' => 2, // Medium level
                                                'admin' => 3,     // Highest level
                                            ]);

                                            // Find current user's role in hierarchy
                                            $currentRoleIndex = array_search($currentUserRole->name, array_keys($roleHierarchy));

                                            if ($currentRoleIndex !== false) {
                                                // Return all roles at or below current user's hierarchy level
                                                $allowedRoles = array_slice(array_keys($roleHierarchy), $currentRoleIndex);
                                            }
                                        }
                                    @endphp
                                    @foreach(\App\Models\Role::whereIn('name', $allowedRoles)->get() as $role)
                                        <option value="{{ $role->name }}">{{ $role->label }}</option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- Active/Inactive Filter (if needed) -->
                        <div>
                            <flux:field>
                                <flux:label>Status</flux:label>
                                <flux:select wire:model.live="statusFilter">
                                    <option value="all">All Status</option>
                                    <option value="active">Active Only</option>
                                    <option value="inactive">Inactive Only</option>
                                </flux:select>
                            </flux:field>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <flux:table>
            <flux:table.columns>
                @if(auth()->user()->hasPermission('delete_users'))
                    <flux:table.column class="w-12">
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.column>
                @endif
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Email Verified</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                <flux:table.column class="w-12">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($users as $user)
                    <flux:table.row>
                        @if(auth()->user()->hasPermission('delete_users'))
                            <flux:table.cell>
                                <flux:checkbox
                                    wire:model.live="selectedUsers"
                                    value="{{ $user->id }}"
                                />
                            </flux:table.cell>
                        @endif
                        <flux:table.cell variant="strong">{{ $user->name }}</flux:table.cell>
                        <flux:table.cell>{{ $user->email }}</flux:table.cell>
                        <flux:table.cell>
                            @if ($user->email_verified_at)
                                <flux:badge color="green">Verified</flux:badge>
                            @else
                                <flux:badge color="red">Unverified</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($user->role)
                                <flux:badge color="{{ $user->role->color }}">{{ $user->role->label }}</flux:badge>
                            @else
                                <flux:badge color="gray">No Role</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $user->created_at->format('M j, Y') }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" aria-label="Actions"></flux:button>

                                <flux:menu>
                                    @if(auth()->user()->hasPermission('edit_users'))
                                        <flux:menu.item wire:click="edit({{ $user->id }})">
                                            <flux:icon name="pencil" class="size-4 me-2" />
                                            Edit
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_users'))
                                        <flux:menu.item wire:click="delete({{ $user->id }})" class="text-red-600 dark:text-red-400">
                                            <flux:icon name="trash" class="size-4 me-2" />
                                            Delete
                                        </flux:menu.item>
                                    @endif
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        @if (count($selectedUsers) > 0 && auth()->user()->hasPermission('delete_users'))
            <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        {{ count($selectedUsers) }} user{{ count($selectedUsers) > 1 ? 's' : '' }} selected
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="$set('selectedUsers', [])" variant="outline" size="sm">
                            Clear Selection
                        </flux:button>
                        <flux:button variant="danger" size="sm" wire:click="bulkDelete">
                            Delete Selected
                        </flux:button>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">
                @if($users->total() > 0)
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                @else
                    No results found
                @endif
            </div>
            <x-pagination :paginator="$users" />
        </div>
    </div>

    <!-- Create User Modal -->
    <flux:modal wire:model="showCreateModal" class="md:w-96">
        <form wire:submit="createUser" class="space-y-6">
            <div>
                <flux:heading size="lg">Create User</flux:heading>
                <flux:subheading>Add a new user to the system</flux:subheading>
            </div>

            <flux:input
                wire:model="createName"
                :label="__('Name')"
                type="text"
                required
            />

            <flux:input
                wire:model="createEmail"
                :label="__('Email')"
                type="email"
                required
            />

            <flux:input
                wire:model="createPassword"
                :label="__('Password')"
                :type="$showCreatePassword ? 'text' : 'password'"
                required
            >
                <x-slot name="iconTrailing">
                    <flux:button
                        size="sm"
                        variant="subtle"
                        :icon="$showCreatePassword ? 'eye-slash' : 'eye'"
                        wire:click="$toggle('showCreatePassword')"
                        class="-mr-1"
                    />
                </x-slot>
            </flux:input>

            <flux:input
                wire:model="createPasswordConfirmation"
                :label="__('Confirm Password')"
                :type="$showCreatePasswordConfirmation ? 'text' : 'password'"
                required
            >
                <x-slot name="iconTrailing">
                    <flux:button
                        size="sm"
                        variant="subtle"
                        :icon="$showCreatePasswordConfirmation ? 'eye-slash' : 'eye'"
                        wire:click="$toggle('showCreatePasswordConfirmation')"
                        class="-mr-1"
                    />
                </x-slot>
            </flux:input>

            <flux:select
                wire:model="createRoleId"
                :label="__('Role')"
                required
            >
                @foreach(\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ $role->label }}</option>
                @endforeach
            </flux:select>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create User</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit User Modal -->
    <flux:modal wire:model="showEditModal" class="md:w-96">
        <form wire:submit="updateUser" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit User</flux:heading>
                <flux:subheading>Update user information</flux:subheading>
            </div>

            <flux:input
                wire:model="editName"
                :label="__('Name')"
                type="text"
                required
            />

            <flux:input
                wire:model="editEmail"
                :label="__('Email')"
                type="email"
                required
            />

            <flux:input
                wire:model="editPassword"
                :label="__('Password')"
                :type="$showEditPassword ? 'text' : 'password'"
                placeholder="Leave blank to keep current password"
            >
                <x-slot name="iconTrailing">
                    <flux:button
                        size="sm"
                        variant="subtle"
                        :icon="$showEditPassword ? 'eye-slash' : 'eye'"
                        wire:click="$toggle('showEditPassword')"
                        class="-mr-1"
                    />
                </x-slot>
            </flux:input>

            <flux:input
                wire:model="editPasswordConfirmation"
                :label="__('Confirm Password')"
                :type="$showEditPasswordConfirmation ? 'text' : 'password'"
                placeholder="Confirm new password"
            >
                <x-slot name="iconTrailing">
                    <flux:button
                        size="sm"
                        variant="subtle"
                        :icon="$showEditPasswordConfirmation ? 'eye-slash' : 'eye'"
                        wire:click="$toggle('showEditPasswordConfirmation')"
                        class="-mr-1"
                    />
                </x-slot>
            </flux:input>

            <flux:select
                wire:model="editRoleId"
                :label="__('Role')"
            >
                @foreach(\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ $role->label }}</option>
                @endforeach
            </flux:select>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update User</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Delete User Modal -->
    <flux:modal wire:model="showDeleteModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete User</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete "{{ $deletingUser?->name }}"?
                    This action cannot be undone.
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirmDelete" variant="danger">Delete User</flux:button>
            </div>
        </div>
    </flux:modal>


</div>
