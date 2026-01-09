<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Teachers</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Teacher Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_teachers'))
            <flux:button variant="primary" icon="plus">
                Create Teacher
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Teacher Management module is under development. This feature will allow you to manage teacher profiles, assignments, and performance.</p>
        </flux:callout>
    </div>
</div>
