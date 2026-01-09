<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Attendance</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Attendance Tracking') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_attendance'))
            <flux:button variant="primary" icon="plus">
                Mark Attendance
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Attendance Tracking module is under development. This feature will allow you to track student and teacher attendance records.</p>
        </flux:callout>
    </div>
</div>
