<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Hostel</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Hostel Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_hostel'))
            <flux:button variant="primary" icon="plus">
                Add Room
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Hostel Management module is under development. This feature will allow you to manage dormitory accommodations and residents.</p>
        </flux:callout>
    </div>
</div>
