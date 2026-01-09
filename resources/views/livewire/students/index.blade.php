<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Students</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Student Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_students'))
            <flux:button variant="primary" icon="plus">
                Create Student
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Student Management module is under development. This feature will allow you to manage student enrollment, profiles, and academic records.</p>
        </flux:callout>
    </div>
</div>
