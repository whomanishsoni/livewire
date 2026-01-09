<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Transport</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Transport Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_transport'))
            <flux:button variant="primary" icon="plus">
                Add Route
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Transport Management module is under development. This feature will allow you to manage school transportation and routes.</p>
        </flux:callout>
    </div>
</div>
