<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Library</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Library Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_library'))
            <flux:button variant="primary" icon="plus">
                Add Book
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Library Management module is under development. This feature will allow you to manage library resources and book circulation.</p>
        </flux:callout>
    </div>
</div>
