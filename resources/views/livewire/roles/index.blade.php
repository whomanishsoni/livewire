<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Roles</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Roles') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_roles'))
            <flux:button wire:click="create" variant="primary" icon="plus">
                Create Role
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <div class="mb-6 flex gap-4 flex-wrap">
            <div class="flex-1 min-w-64">
                <flux:input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search roles by name or label..."
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
        </div>
        <flux:table>
            <flux:table.columns>
                @if(auth()->user()->hasPermission('delete_roles'))
                    <flux:table.column class="w-12">
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.column>
                @endif
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Label</flux:table.column>
                <flux:table.column>Color</flux:table.column>
                <flux:table.column>Permissions</flux:table.column>
                <flux:table.column>Users Count</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                @if(auth()->user()->hasPermission('edit_roles') || auth()->user()->hasPermission('delete_roles'))
                    <flux:table.column class="w-12">Actions</flux:table.column>
                @endif
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($roles as $role)
                    <flux:table.row>
                        <flux:table.cell>
                            @if(auth()->user()->hasPermission('delete_roles'))
                                <flux:checkbox
                                    wire:model.live="selectedRoles"
                                    value="{{ $role->id }}"
                                />
                            @endif
                        </flux:table.cell>
                        <flux:table.cell variant="strong">{{ $role->name }}</flux:table.cell>
                        <flux:table.cell>{{ $role->label }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="{{ $role->color }}">{{ ucfirst($role->color) }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($role->permissions && $role->permissions->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($role->permissions->take(3) as $permission)
                                        <flux:badge size="sm">{{ $permission->label }}</flux:badge>
                                    @endforeach
                                    @if($role->permissions->count() > 3)
                                        <flux:badge size="sm" color="gray">+{{ $role->permissions->count() - 3 }}</flux:badge>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">No permissions</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $role->users()->count() }}</flux:table.cell>
                        <flux:table.cell>{{ $role->created_at->format('M j, Y') }}</flux:table.cell>
                        @if(auth()->user()->hasPermission('edit_roles') || auth()->user()->hasPermission('delete_roles'))
                            @php
                                $canEditRole = auth()->user()->hasPermission('edit_roles') && !(auth()->user()->role->name === 'moderator' && $role->name === 'admin');
                                $canDeleteRole = auth()->user()->hasPermission('delete_roles') && !(auth()->user()->role->name === 'moderator' && $role->name === 'admin');
                            @endphp
                            @if($canEditRole || $canDeleteRole)
                                <flux:table.cell>
                                    <flux:dropdown position="bottom" align="end">
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" aria-label="Actions"></flux:button>

                                        <flux:menu>
                                            @if($canEditRole)
                                                <flux:menu.item wire:click="edit({{ $role->id }})">
                                                    <flux:icon name="pencil" class="size-4 me-2" />
                                                    Edit
                                                </flux:menu.item>
                                            @endif
                                            @if($canEditRole)
                                                <flux:menu.item wire:click="showPermissions({{ $role->id }})">
                                                    <flux:icon name="shield-check" class="size-4 me-2" />
                                                    Permissions
                                                </flux:menu.item>
                                            @endif
                                            @if($canDeleteRole)
                                                <flux:menu.item wire:click="delete({{ $role->id }})" class="text-red-600 dark:text-red-400">
                                                    <flux:icon name="trash" class="size-4 me-2" />
                                                    Delete
                                                </flux:menu.item>
                                            @endif
                                        </flux:menu>
                                    </flux:dropdown>
                                </flux:table.cell>
                            @else
                                <flux:table.cell>
                                    <span class="text-gray-400 text-sm">-</span>
                                </flux:table.cell>
                            @endif
                        @endif
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        @if (count($selectedRoles) > 0)
            <div class="mt-4 p-4 border border-white rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        {{ count($selectedRoles) }} role{{ count($selectedRoles) > 1 ? 's' : '' }} selected
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="$set('selectedRoles', [])" variant="outline" size="sm">
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
                @if($roles->total() > 0)
                    Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} results
                @else
                    No results found
                @endif
            </div>
            <x-pagination :paginator="$roles" />
        </div>
    </div>

    <!-- Create Role Modal -->
    <flux:modal wire:model="showCreateModal" class="md:w-96">
        <form wire:submit="createRole" class="space-y-6">
            <div>
                <flux:heading size="lg">Create Role</flux:heading>
                <flux:subheading>Add a new role to the system</flux:subheading>
            </div>

            <flux:input
                wire:model="createName"
                :label="__('Name')"
                type="text"
                required
                placeholder="e.g., editor, manager"
            />

            <flux:input
                wire:model="createLabel"
                :label="__('Label')"
                type="text"
                required
                placeholder="e.g., Editor, Manager"
            />

            <flux:select
                wire:model="createColor"
                :label="__('Color')"
                required
            >
                @foreach(\App\Models\Role::availableColors() as $colorKey => $colorLabel)
                    <option value="{{ $colorKey }}">{{ $colorLabel }}</option>
                @endforeach
            </flux:select>

            <flux:textarea
                wire:model="createPermissions"
                :label="__('Permissions')"
                placeholder="Enter permissions separated by commas (e.g., create_posts, edit_posts, delete_posts)"
                rows="3"
            />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create Role</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit Role Modal -->
    <flux:modal wire:model="showEditModal" class="md:w-96">
        <form wire:submit="updateRole" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Role</flux:heading>
                <flux:subheading>Update role information</flux:subheading>
            </div>

            <flux:input
                wire:model="editName"
                :label="__('Name')"
                type="text"
                required
                placeholder="e.g., editor, manager"
            />

            <flux:input
                wire:model="editLabel"
                :label="__('Label')"
                type="text"
                required
                placeholder="e.g., Editor, Manager"
            />

            <flux:select
                wire:model="editColor"
                :label="__('Color')"
                required
            >
                @foreach(\App\Models\Role::availableColors() as $colorKey => $colorLabel)
                    <option value="{{ $colorKey }}">{{ $colorLabel }}</option>
                @endforeach
            </flux:select>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update Role</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Role Modal -->
    <flux:modal wire:model="showDeleteModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Role</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete "{{ $deletingRole?->label }}"?
                    This will affect {{ $deletingRole?->users()->count() }} user{{ $deletingRole?->users()->count() !== 1 ? 's' : '' }}.
                    This action cannot be undone.
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirmDelete" variant="danger">Delete Role</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Permissions Modal -->
    <flux:modal wire:model="showPermissionsModal" class="md:w-6xl">
        <form wire:submit="updatePermissions" class="space-y-6">
            <!-- Header -->
            <div class="text-center">
                <flux:heading size="lg">Manage Permissions</flux:heading>
                <flux:subheading>Configure permissions for "{{ $editingPermissionsRole?->label }}"</flux:subheading>
            </div>

            <!-- Permissions Table -->
            <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">Module</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">View</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">Create</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">Edit</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">Delete</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700">All</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availablePermissions as $moduleKey => $module)
                            <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800" wire:key="permission-row-{{ $moduleKey }}-{{ $showPermissionsModal ? 'open' : 'closed' }}">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                    {{ $module['title'] }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $viewPermission = collect($module['permissions'])->first(function($perm) {
                                            return str_contains($perm['name'], 'view_');
                                        });
                                    @endphp
                                    @if($viewPermission)
                                        <flux:checkbox
                                            wire:model.live="selectedPermissions"
                                            value="{{ $viewPermission['id'] }}"
                                        />
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $createPermission = collect($module['permissions'])->first(function($perm) {
                                            return str_contains($perm['name'], 'create_');
                                        });
                                    @endphp
                                    @if($createPermission)
                                        <flux:checkbox
                                            wire:model.live="selectedPermissions"
                                            value="{{ $createPermission['id'] }}"
                                        />
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $editPermission = collect($module['permissions'])->first(function($perm) {
                                            return str_contains($perm['name'], 'edit_');
                                        });
                                    @endphp
                                    @if($editPermission)
                                        <flux:checkbox
                                            wire:model.live="selectedPermissions"
                                            value="{{ $editPermission['id'] }}"
                                        />
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $deletePermission = collect($module['permissions'])->first(function($perm) {
                                            return str_contains($perm['name'], 'delete_');
                                        });
                                    @endphp
                                    @if($deletePermission)
                                        <flux:checkbox
                                            wire:model.live="selectedPermissions"
                                            value="{{ $deletePermission['id'] }}"
                                        />
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <flux:checkbox
                                        wire:model.live="moduleSelectAll.{{ $moduleKey }}"
                                        wire:click="toggleModuleAll('{{ $moduleKey }}')"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions -->
            <div class="flex flex-wrap gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Select All:</span>
                <flux:checkbox wire:model.live="selectAllView" wire:click="toggleAllView" label="View" />
                <flux:checkbox wire:model.live="selectAllCreate" wire:click="toggleAllCreate" label="Create" />
                <flux:checkbox wire:model.live="selectAllEdit" wire:click="toggleAllEdit" label="Edit" />
                <flux:checkbox wire:model.live="selectAllDelete" wire:click="toggleAllDelete" label="Delete" />
                <flux:checkbox wire:model.live="selectAllModule" wire:click="toggleAllModule" label="All Permissions" />
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3">
                <flux:modal.close>
                    <flux:button wire:click="closePermissionsModal" variant="outline">
                        Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    Update Permissions
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>

