<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Subscription Plans</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Subscription Plans') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_subscription_plans'))
            <flux:button wire:click="create" variant="primary" icon="plus">
                Create Plan
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <!-- Search, Page Length, and Filters Toggle - All in One Row -->
        <div class="mb-6 flex gap-4 flex-wrap items-end">
            <div class="flex-1 min-w-64">
                <flux:input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search plans by name, slug, or description..."
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
                        <!-- Status Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Status</flux:label>
                                <flux:select wire:model.live="statusFilter">
                                    <option value="all">All Plans</option>
                                    <option value="active">Active Only</option>
                                    <option value="inactive">Inactive Only</option>
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- Billing Period Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Billing Period</flux:label>
                                <flux:select wire:model.live="billingFilter">
                                    <option value="all">All Periods</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </flux:select>
                            </flux:field>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <flux:table>
            <flux:table.columns>
                @if(auth()->user()->hasPermission('delete_subscription_plans'))
                    <flux:table.column class="w-12">
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.column>
                @endif
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Price</flux:table.column>
                <flux:table.column>Billing</flux:table.column>
                <flux:table.column>Users</flux:table.column>
                <flux:table.column>Storage</flux:table.column>
                <flux:table.column>Modules</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                <flux:table.column class="w-12">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($plans as $plan)
                    <flux:table.row>
                        @if(auth()->user()->hasPermission('delete_subscription_plans'))
                            <flux:table.cell>
                                <flux:checkbox
                                    wire:model.live="selectedPlans"
                                    value="{{ $plan->id }}"
                                />
                            </flux:table.cell>
                        @endif
                        <flux:table.cell variant="strong">
                            <div>
                                <div>{{ $plan->name }}</div>
                                <div class="text-sm text-gray-500">{{ $plan->slug }}</div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="font-semibold">{{ $plan->formatted_price }}</div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="blue">{{ ucfirst($plan->billing_period) }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($plan->max_users)
                                {{ number_format($plan->max_users) }}
                            @else
                                <span class="text-gray-500">Unlimited</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($plan->max_storage_gb)
                                {{ $plan->max_storage_gb }} GB
                            @else
                                <span class="text-gray-500">Unlimited</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($plan->modules->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($plan->modules->take(3) as $module)
                                        <flux:badge size="sm" color="blue">{{ $module->name }}</flux:badge>
                                    @endforeach
                                    @if($plan->modules->count() > 3)
                                        <flux:badge size="sm" color="gray">+{{ $plan->modules->count() - 3 }} more</flux:badge>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-500">No modules</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($plan->is_active)
                                <flux:badge color="green">Active</flux:badge>
                            @else
                                <flux:badge color="red">Inactive</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $plan->created_at->format('M j, Y') }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" aria-label="Actions"></flux:button>

                                <flux:menu>
                                    @if(auth()->user()->hasPermission('edit_subscription_plans'))
                                        <flux:menu.item wire:click="edit({{ $plan->id }})">
                                            <flux:icon name="pencil" class="size-4 me-2" />
                                            Edit
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('view_subscriptions'))
                                        <flux:menu.item href="{{ route('subscriptions.index') }}?plan_id={{ $plan->id }}">
                                            <flux:icon name="credit-card" class="size-4 me-2" />
                                            View Subscriptions
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_subscription_plans'))
                                        <flux:menu.item wire:click="delete({{ $plan->id }})" class="text-red-600 dark:text-red-400">
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

        @if (count($selectedPlans) > 0 && auth()->user()->hasPermission('delete_subscription_plans'))
            <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        {{ count($selectedPlans) }} plan{{ count($selectedPlans) > 1 ? 's' : '' }} selected
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="$set('selectedPlans', [])" variant="outline" size="sm">
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
                @if($plans->total() > 0)
                    Showing {{ $plans->firstItem() }} to {{ $plans->lastItem() }} of {{ $plans->total() }} results
                @else
                    No results found
                @endif
            </div>
            <x-pagination :paginator="$plans" />
        </div>
    </div>

    <!-- Create Plan Modal -->
    <flux:modal wire:model="showCreateModal" class="md:w-[600px]">
        <form wire:submit="createPlan" class="space-y-6">
            <div>
                <flux:heading size="lg">Create Subscription Plan</flux:heading>
                <flux:subheading>Add a new subscription plan</flux:subheading>
            </div>

            <flux:input
                wire:model="createName"
                label="Plan Name"
                type="text"
                required
            />

            <flux:input
                wire:model="createSlug"
                label="Slug"
                type="text"
                required
                placeholder="unique-plan-slug"
            />

            <flux:textarea
                wire:model="createDescription"
                label="Description (optional)"
                placeholder="Brief description of the plan"
            />

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="createPrice"
                    label="Price"
                    type="number"
                    step="0.01"
                    min="0"
                    required
                />

                <flux:select
                    wire:model="createBillingPeriod"
                    label="Billing Period"
                    required
                >
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </flux:select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="createMaxUsers"
                    label="Max Users (optional)"
                    type="number"
                    min="0"
                    placeholder="Leave empty for unlimited"
                />

                <flux:input
                    wire:model="createMaxStorageGb"
                    label="Max Storage (GB) (optional)"
                    type="number"
                    min="0"
                    placeholder="Leave empty for unlimited"
                />
            </div>

            <flux:input
                wire:model="createSortOrder"
                label="Sort Order"
                type="number"
                min="0"
            />

            <flux:field>
                <flux:label>Features (optional)</flux:label>
                <div class="space-y-3">
                    <div class="flex gap-2">
                        <flux:input
                            wire:model="newFeature"
                            placeholder="Add a new feature..."
                            class="flex-1"
                        />
                        <flux:button
                            wire:click="addFeature"
                            variant="outline"
                            type="button"
                        >
                            Add
                        </flux:button>
                    </div>
                    @if(count($createFeatures) > 0)
                        <div class="border rounded p-3 bg-gray-50 dark:bg-gray-800">
                            <div class="space-y-2">
                                @foreach($createFeatures as $index => $feature)
                                    <div class="flex items-center gap-2">
                                        <span class="flex-1 text-sm">{{ $feature }}</span>
                                        <flux:button
                                            wire:click="removeFeature({{ $index }})"
                                            variant="ghost"
                                            size="sm"
                                            type="button"
                                            class="text-red-600 hover:text-red-700"
                                        >
                                            <flux:icon name="x-mark" class="size-4" />
                                        </flux:button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </flux:field>

            <flux:select
                wire:model="createStatus"
                label="Status"
                required
            >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>

            <flux:field>
                <flux:label>Modules</flux:label>
                <div class="border rounded p-4 bg-gray-50 dark:bg-gray-800">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-64 overflow-y-auto">
                        @foreach($modules as $module)
                            <div class="flex items-center space-x-2 p-2 rounded border bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <flux:checkbox
                                    wire:model="createModuleIds"
                                    value="{{ $module->id }}"
                                />
                                <span class="text-sm font-medium">{{ $module->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </flux:field>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create Plan</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit Plan Modal -->
    <flux:modal wire:model="showEditModal" class="md:w-[600px]">
        <form wire:submit="updatePlan" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Subscription Plan</flux:heading>
                <flux:subheading>Update plan information</flux:subheading>
            </div>

            <flux:input
                wire:model="editName"
                label="Plan Name"
                type="text"
                required
            />

            <flux:input
                wire:model="editSlug"
                label="Slug"
                type="text"
                required
            />

            <flux:textarea
                wire:model="editDescription"
                label="Description (optional)"
                placeholder="Brief description of the plan"
            />

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="editPrice"
                    label="Price"
                    type="number"
                    step="0.01"
                    min="0"
                    required
                />

                <flux:select
                    wire:model="editBillingPeriod"
                    label="Billing Period"
                    required
                >
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </flux:select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="editMaxUsers"
                    label="Max Users (optional)"
                    type="number"
                    min="0"
                    placeholder="Leave empty for unlimited"
                />

                <flux:input
                    wire:model="editMaxStorageGb"
                    label="Max Storage (GB) (optional)"
                    type="number"
                    min="0"
                    placeholder="Leave empty for unlimited"
                />
            </div>

            <flux:input
                wire:model="editSortOrder"
                label="Sort Order"
                type="number"
                min="0"
            />

            <flux:field>
                <flux:label>Features (optional)</flux:label>
                <div class="space-y-3">
                    <div class="flex gap-2">
                        <flux:input
                            wire:model="editNewFeature"
                            placeholder="Add a new feature..."
                            class="flex-1"
                        />
                        <flux:button
                            wire:click="addEditFeature"
                            variant="outline"
                            type="button"
                        >
                            Add
                        </flux:button>
                    </div>
                    @if(count($editFeatures) > 0)
                        <div class="border rounded p-3 bg-gray-50 dark:bg-gray-800">
                            <div class="space-y-2">
                                @foreach($editFeatures as $index => $feature)
                                    <div class="flex items-center gap-2">
                                        <span class="flex-1 text-sm">{{ $feature }}</span>
                                        <flux:button
                                            wire:click="removeEditFeature({{ $index }})"
                                            variant="ghost"
                                            size="sm"
                                            type="button"
                                            class="text-red-600 hover:text-red-700"
                                        >
                                            <flux:icon name="x-mark" class="size-4" />
                                        </flux:button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </flux:field>

            <flux:select
                wire:model="editStatus"
                label="Status"
                required
            >
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>

            <flux:field>
                <flux:label>Modules</flux:label>
                <div class="border rounded p-4 bg-gray-50 dark:bg-gray-800">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-64 overflow-y-auto">
                        @foreach($modules as $module)
                            <div class="flex items-center space-x-2 p-2 rounded border bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <flux:checkbox
                                    wire:model="editModuleIds"
                                    value="{{ $module->id }}"
                                />
                                <span class="text-sm font-medium">{{ $module->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </flux:field>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update Plan</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Plan Modal -->
    <flux:modal wire:model="showDeleteModal" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Subscription Plan</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete "{{ $deletingPlan?->name }}"?
                    This action cannot be undone and will affect all associated subscriptions.
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirmDelete" variant="danger">Delete Plan</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Modules Modal -->
    <flux:modal wire:model="showModulesModal" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Plan Modules</flux:heading>
                <flux:subheading>Modules included in {{ $modulesPlan?->name }}</flux:subheading>
            </div>

            @if($modulesPlan && $modulesPlan->modules->count() > 0)
                <div class="space-y-2">
                    @foreach($modulesPlan->modules as $module)
                        <div class="flex items-center justify-between p-3 border rounded">
                            <div>
                                <div class="font-medium">{{ $module->name }}</div>
                                <div class="text-sm text-gray-500">{{ $module->description }}</div>
                            </div>
                            <flux:badge color="green">Active</flux:badge>
                        </div>
                    @endforeach
                </div>
            @else
                <flux:callout>
                    <p>No modules assigned to this plan.</p>
                </flux:callout>
            @endif

            <div class="flex justify-end">
                <flux:modal.close>
                    <flux:button variant="outline">Close</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
