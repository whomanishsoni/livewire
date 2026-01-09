<div>
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="/">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Exams</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between items-center">
        <flux:heading size="xl">{{ __('Examination Management') }}</flux:heading>
        @if(auth()->user()->hasPermission('create_exams'))
            <flux:button variant="primary" icon="plus">
                Create Exam
            </flux:button>
        @endif
    </div>

    <div class="mt-6">
        <flux:callout>
            <flux:subheading>Coming Soon</flux:subheading>
            <p>The Examination Management module is under development. This feature will allow you to manage exams, grades, and academic assessments.</p>
        </flux:callout>
    </div>
</div>
