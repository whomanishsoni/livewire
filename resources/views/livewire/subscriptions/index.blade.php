<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Subscriptions</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Subscriptions') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_subscriptions'))
            <flux:button wire:click="create" variant="primary" icon="plus">
                Create Subscription
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <!-- Search, Page Length, and Filters Toggle - All in One Row -->
        <div class="mb-6 flex gap-4 flex-wrap items-end">
            <div class="flex-1 min-w-64">
                <flux:input
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search subscriptions by school or plan..."
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
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Status Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Status</flux:label>
                                <flux:select wire:model.live="statusFilter">
                                    <option value="all">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="trial">Trial</option>
                                    <option value="expired">Expired</option>
                                    <option value="cancelled">Cancelled</option>
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- School Filter -->
                        <div>
                            <flux:field>
                                <flux:label>School</flux:label>
                                <flux:select wire:model.live="schoolFilter">
                                    <option value="all">All Schools</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" @if($schoolFilter == $school->id) selected @endif>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- Plan Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Plan</flux:label>
                                <flux:select wire:model.live="planFilter">
                                    <option value="all">All Plans</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" @if($planFilter == $plan->id) selected @endif>
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
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
                @if(auth()->user()->hasPermission('delete_subscriptions'))
                    <flux:table.column class="w-12">
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.column>
                @endif
                <flux:table.column>School</flux:table.column>
                <flux:table.column>Plan</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Price</flux:table.column>
                <flux:table.column>Period</flux:table.column>
                <flux:table.column>Start Date</flux:table.column>
                <flux:table.column>End Date</flux:table.column>
                <flux:table.column class="w-12">Actions</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($subscriptions as $subscription)
                    <flux:table.row>
                        @if(auth()->user()->hasPermission('delete_subscriptions'))
                            <flux:table.cell>
                                <flux:checkbox
                                    wire:model.live="selectedSubscriptions"
                                    value="{{ $subscription->id }}"
                                />
                            </flux:table.cell>
                        @endif
                        <flux:table.cell variant="strong">
                            <div>
                                <div>{{ $subscription->school->name }}</div>
                                <div class="text-sm text-gray-500">{{ $subscription->school->domain }}</div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div>
                                <div>{{ $subscription->plan->name }}</div>
                                <div class="text-sm text-gray-500">{{ $subscription->plan->slug }}</div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :color="$subscription->getStatusColor()">
                                {{ ucfirst($subscription->status) }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="font-semibold">{{ $subscription->formatted_price }}</div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="blue">{{ ucfirst($subscription->billing_period) }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $subscription->starts_at->format('M j, Y') }}</flux:table.cell>
                        <flux:table.cell>
                            @if($subscription->ends_at)
                                {{ $subscription->ends_at->format('M j, Y') }}
                                @if($subscription->getRemainingDays() !== null && $subscription->getRemainingDays() <= 30)
                                    <div class="text-sm text-orange-600 dark:text-orange-400">
                                        {{ $subscription->getRemainingDays() }} days left
                                    </div>
                                @endif
                            @else
                                <span class="text-gray-500">Never</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown position="bottom" align="end">
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" aria-label="Actions"></flux:button>

                                <flux:menu>
                                    @if(auth()->user()->hasPermission('edit_subscriptions'))
                                        <flux:menu.item wire:click="edit({{ $subscription->id }})">
                                            <flux:icon name="pencil" class="size-4 me-2" />
                                            Edit
                                        </flux:menu.item>
                                        @if($subscription->status !== 'active')
                                            <flux:menu.item wire:click="activateSubscription({{ $subscription->id }})">
                                                <flux:icon name="play" class="size-4 me-2" />
                                                Activate
                                            </flux:menu.item>
                                        @endif
                                        @if($subscription->status !== 'cancelled')
                                            <flux:menu.item wire:click="cancelSubscription({{ $subscription->id }})" class="text-orange-600 dark:text-orange-400">
                                                <flux:icon name="x-mark" class="size-4 me-2" />
                                                Cancel
                                            </flux:menu.item>
                                        @endif
                                    @endif
                                    @if(auth()->user()->hasPermission('view_schools'))
                                        <flux:menu.item href="{{ route('schools.index') }}?school_id={{ $subscription->school_id }}">
                                            <flux:icon name="building-office" class="size-4 me-2" />
                                            View School
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('view_subscription_plans'))
                                        <flux:menu.item href="{{ route('subscription_plans.index') }}?plan_id={{ $subscription->subscription_plan_id }}">
                                            <flux:icon name="credit-card" class="size-4 me-2" />
                                            View Plan
                                        </flux:menu.item>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_subscriptions'))
                                        <flux:menu.item wire:click="delete({{ $subscription->id }})" class="text-red-600 dark:text-red-400">
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

        @if (count($selectedSubscriptions) > 0 && auth()->user()->hasPermission('delete_subscriptions'))
            <div class="mt-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        {{ count($selectedSubscriptions) }} subscription{{ count($selectedSubscriptions) > 1 ? 's' : '' }} selected
                    </div>
                    <div class="flex gap-2">
                        <flux:button wire:click="$set('selectedSubscriptions', [])" variant="outline" size="sm">
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
                @if($subscriptions->total() > 0)
                    Showing {{ $subscriptions->firstItem() }} to {{ $subscriptions->lastItem() }} of {{ $subscriptions->total() }} results
                @else
                    No results found
                @endif
            </div>
            <x-pagination :paginator="$subscriptions" />
        </div>
    </div>

    <!-- Create Subscription Modal -->
    <flux:modal wire:model="showCreateModal" class="md:w-96">
        <form wire:submit="createSubscription" class="space-y-6">
            <div>
                <flux:heading size="lg">Create Subscription</flux:heading>
                <flux:subheading>Add a new subscription for a school</flux:subheading>
            </div>

            <flux:select
                wire:model="createSchoolId"
                label="School"
                required
            >
                <option value="">Select a school</option>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </flux:select>

            <flux:select
                wire:model="createPlanId"
                label="Subscription Plan"
                required
            >
                <option value="">Select a plan</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }} - {{ $plan->formatted_price }}</option>
                @endforeach
            </flux:select>

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="createStartsAt"
                    label="Start Date"
                    type="date"
                    required
                />

                <flux:input
                    wire:model="createEndsAt"
                    label="End Date (optional)"
                    type="date"
                    placeholder="Leave empty for lifetime"
                />
            </div>

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

            <flux:select
                wire:model="createStatus"
                label="Status"
                required
            >
                <option value="active">Active</option>
                <option value="trial">Trial</option>
                <option value="expired">Expired</option>
                <option value="cancelled">Cancelled</option>
            </flux:select>

            <flux:textarea
                wire:model="createMetadata"
                label="Metadata (JSON - optional)"
                placeholder='{"notes": "Custom notes"}'
                rows="3"
            />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create Subscription</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit Subscription Modal -->
    <flux:modal wire:model="showEditModal" class="md:w-96">
        <form wire:submit="updateSubscription" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Subscription</flux:heading>
                <flux:subheading>Update subscription details</flux:subheading>
            </div>

            <flux:select
                wire:model="editSchoolId"
                label="School"
                required
            >
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" @if($editSchoolId == $school->id) selected @endif>{{ $school->name }}</option>
                @endforeach
            </flux:select>

            <flux:select
                wire:model="editPlanId"
                label="Subscription Plan"
                required
            >
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}" @if($editPlanId == $plan->id) selected @endif>{{ $plan->name }} - {{ $plan->formatted_price }}</option>
                @endforeach
            </flux:select>

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="editStartsAt"
                    label="Start Date"
                    type="date"
                    required
                />

                <flux:input
                    wire:model="editEndsAt"
                    label="End Date (optional)"
                    type="date"
                    placeholder="Leave empty for lifetime"
                />
            </div>

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
                    <option value="monthly" @if($editBillingPeriod == 'monthly') selected @endif>Monthly</option>
                    <option value="yearly" @if($editBillingPeriod == 'yearly') selected @endif>Yearly</option>
                </flux:select>
            </div>

            <flux:select
                wire:model="editStatus"
                label="Status"
                required
            >
                <option value="active" @if($editStatus == 'active') selected @endif>Active</option>
                <option value="trial" @if($editStatus == 'trial') selected @endif>Trial</option>
                <option value="expired" @if($editStatus == 'expired') selected @endif>Expired</option>
                <option value="cancelled" @if($editStatus == 'cancelled') selected @endif>Cancelled</option>
            </flux:select>

            <flux:textarea
                wire:model="editMetadata"
                label="Metadata (JSON - optional)"
                placeholder='{"notes": "Custom notes"}'
                rows="3"
            />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update Subscription</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Delete Subscription Modal -->
    <flux:modal wire:model="showDeleteModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Subscription</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete the subscription for "{{ $deletingSubscription?->school->name }}"?
                    This action cannot be undone and will remove the school's access to the associated plan.
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="confirmDelete" variant="danger">Delete Subscription</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
