<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Finance</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Financial Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_finance'))
            <flux:button variant="primary" icon="plus">
                Add Transaction
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Financial Management module is under development. This feature will allow you to manage fees, payments, and financial records.</p>
        </flux:callout>
    </div>
</div>
