<x-layouts.app :title="__('Users')">
    <div>
        <flux:breadcrumbs class="mb-6">
            <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Users</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="flex justify-between items-center">
            <flux:heading size="xl">{{ __('Users') }}</flux:heading>
        </div>

        <div class="mt-6">
            <form method="GET" action="{{ route('users.index') }}" class="mb-6 flex gap-4 flex-wrap">
                <div class="flex-1 min-w-64">
                    <flux:input
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search users by name or email..."
                        icon="magnifying-glass"
                    />
                </div>
                <div class="w-48">
                    <flux:select name="filter">
                        <option value="all" {{ request('filter', 'all') === 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="verified" {{ request('filter') === 'verified' ? 'selected' : '' }}>Verified Only</option>
                        <option value="unverified" {{ request('filter') === 'unverified' ? 'selected' : '' }}>Unverified Only</option>
                    </flux:select>
                </div>
                <div class="w-32">
                    <flux:select name="per_page">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                    </flux:select>
                </div>
                <flux:button type="submit" variant="primary">Filter</flux:button>
            </form>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Name</flux:table.column>
                    <flux:table.column>Email</flux:table.column>
                    <flux:table.column>Email Verified</flux:table.column>
                    <flux:table.column>Created At</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($users as $user)
                        <flux:table.row>
                            <flux:table.cell variant="strong">{{ $user->name }}</flux:table.cell>
                            <flux:table.cell>{{ $user->email }}</flux:table.cell>
                            <flux:table.cell>
                                @if ($user->email_verified_at)
                                    <flux:badge color="green">Verified</flux:badge>
                                @else
                                    <flux:badge color="red">Unverified</flux:badge>
                                @endif
                            </flux:table.cell>
                            <flux:table.cell>{{ $user->created_at->format('M j, Y') }}</flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    @if($users->total() > 0)
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                    @else
                        No results found
                    @endif
                </div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
