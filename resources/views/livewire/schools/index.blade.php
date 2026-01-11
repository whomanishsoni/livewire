<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Schools</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Schools') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_schools'))
            <flux:button wire:click="create" variant="primary" icon="plus">
                Create School
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <!-- Search, Page Length, and Filters Toggle - All in One Row -->
        <div class="mb-6 flex gap-4 flex-wrap items-end">
            <div class="flex-1 min-w-64">
                <flux:input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search schools by name, domain, or email..."
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Status Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Status</flux:label>
                                <flux:select wire:model.live="statusFilter">
                                    <option value="all">All Schools</option>
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
                @if(auth()->user()->hasPermission('delete_schools'))
                    <flux:table.column class="w-12">
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.column>
                @endif
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Domain</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Phone</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                <flux:table.column class="w-12">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($schools as $school)
                    <flux:table.row>
                        @if(auth()->user()->hasPermission('delete_schools'))
                            <flux:table.cell>
                                <flux:checkbox
                                    wire:model.live="selectedSchools"
                                    value="{{ $school->id }}"
                                />
                            </flux:table.cell>
                        @endif
                        <flux:table.cell variant="strong">{{ $school->name }}</flux:table.cell>
                        <flux:table.cell>
                            @if($school->domain)
                                <a href="{{ $school->getDomainUrl() }}" target="_blank" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $school->domain }}.test
                                </a>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $school->email ?? '-' }}</flux:table.cell>
                        <flux:table.cell>{{ $school->phone ?? '-' }}</flux:table.cell>
                        <flux:table.cell>
                            @if ($school->is_active)
                                <flux:badge color="green">Active</flux:badge>
                            @else
                                <flux:badge color="red">Inactive</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $school->created_at->format('M j, Y') }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" aria-label="Actions"></flux:button>

                                <flux:menu>
                                    @if(auth()->user()->hasPermission('edit_schools'))
                                        <flux:menu.item wire:click="edit('{{ $school->id }}')">
                                            <flux:icon name="pencil" class="size-4 me-2" />
                                            Edit
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('view_subscriptions'))
                                        <flux:menu.item href="{{ route('subscriptions.index') }}?school_id={{ $school->id }}">
                                            <flux:icon name="credit-card" class="size-4 me-2" />
                                            View Subscriptions
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_schools'))
                                        <flux:menu.item wire:click="delete('{{ $school->id }}')" class="text-red-600 dark:text-red-400">
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

        @if (count($selectedSchools) > 0 && auth()->user()->hasPermission('delete_schools'))
            <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        {{ count($selectedSchools) }} school{{ count($selectedSchools) > 1 ? 's' : '' }} selected
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="$set('selectedSchools', [])" variant="outline" size="sm">
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
                @if($schools->total() > 0)
                    Showing {{ $schools->firstItem() }} to {{ $schools->lastItem() }} of {{ $schools->total() }} results
                @else
                    No results found
                @endif
            </div>
            <x-pagination :paginator="$schools" />
        </div>
    </div>

    <!-- Create School Modal -->
    <flux:modal wire:model="showCreateModal" class="md:w-[42rem]">
        <form wire:submit="createSchool" class="space-y-6">
            <div>
                <flux:heading size="lg">Create School</flux:heading>
                <flux:subheading>Add a new school to the system</flux:subheading>
            </div>

            <flux:input
                wire:model="createName"
                label="School Name"
                type="text"
                required
            />

            <flux:input
                wire:model="createDomain"
                label="Domain (optional)"
                type="text"
                placeholder="e.g., myschool (becomes myschool.test)"
            />

            <flux:input
                wire:model="createEmail"
                label="Email (optional)"
                type="email"
            />

            <flux:input
                wire:model="createPhone"
                label="Phone (optional)"
                type="text"
            />

            <flux:textarea
                wire:model="createAddress"
                label="Address (optional)"
                placeholder="School address"
            />

            <flux:textarea
                wire:model="createDescription"
                label="Description (optional)"
                placeholder="Brief description of the school"
            />

            <flux:input
                wire:model="createLogo"
                label="Logo URL (optional)"
                type="url"
                placeholder="https://example.com/logo.png"
            />

            <flux:select
                wire:model="createStatus"
                label="Status"
                required
            >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create School</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit School Modal -->
    <flux:modal wire:model="showEditModal" class="md:w-[42rem]">
        <form wire:submit="updateSchool" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit School</flux:heading>
                <flux:subheading>Update school information</flux:subheading>
            </div>

            <flux:input
                wire:model="editName"
                label="School Name"
                type="text"
                required
            />

            <flux:input
                wire:model="editDomain"
                label="Domain (optional)"
                type="text"
                placeholder="e.g., myschool (becomes myschool.test)"
            />

            <flux:input
                wire:model="editEmail"
                label="Email (optional)"
                type="email"
            />

            <flux:input
                wire:model="editPhone"
                label="Phone (optional)"
                type="text"
            />

            <flux:textarea
                wire:model="editAddress"
                label="Address (optional)"
                placeholder="School address"
            />

            <flux:textarea
                wire:model="editDescription"
                label="Description (optional)"
                placeholder="Brief description of the school"
            />

            <flux:input
                wire:model="editLogo"
                label="Logo URL (optional)"
                type="url"
                placeholder="https://example.com/logo.png"
            />

            <flux:select
                wire:model="editStatus"
                label="Status"
                required
            >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update School</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Delete School Modal -->
    <flux:modal wire:model="showDeleteModal" class="md:w-[42rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete School</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete "{{ $deletingSchool?->name }}"?
                    This action cannot be undone and will also delete all associated subscriptions and users.
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirmDelete" variant="danger">Delete School</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
