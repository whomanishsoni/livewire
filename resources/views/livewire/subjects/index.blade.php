<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Subjects</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Subject Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_subjects'))
            <flux:button variant="primary" icon="plus">
                Create Subject
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Subject Management module is under development. This feature will allow you to manage curriculum subjects and course offerings.</p>
        </flux:callout>
    </div>
</div>
