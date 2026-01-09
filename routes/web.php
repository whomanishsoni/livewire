<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    // Debug route to check permissions
    if (request()->has('debug_permissions')) {
        $permissions = \App\Models\Permission::all();
        $schools = \App\Models\Permission::where('module', 'schools')->get();
        $subscriptions = \App\Models\Permission::where('module', 'subscriptions')->get();
        $subscriptionPlans = \App\Models\Permission::where('module', 'subscription_plans')->get();

        return response()->json([
            'total_permissions' => $permissions->count(),
            'modules' => $permissions->pluck('module')->unique()->values(),
            'schools_count' => $schools->count(),
            'schools_names' => $schools->pluck('name'),
            'subscriptions_count' => $subscriptions->count(),
            'subscriptions_names' => $subscriptions->pluck('name'),
            'subscription_plans_count' => $subscriptionPlans->count(),
            'subscription_plans_names' => $subscriptionPlans->pluck('name'),
        ]);
    }

    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'school.context'])
    ->name('dashboard');

Route::middleware(['auth', 'school.context'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)
        ->middleware('permission:edit_profile')
        ->name('profile.edit');

    Route::get('settings/password', Password::class)
        ->middleware('permission:change_password')
        ->name('user-password.edit');

    Route::get('settings/appearance', Appearance::class)
        ->middleware('permission:manage_appearance')
        ->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware('permission:manage_two_factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('users', \App\Livewire\Users\Index::class)
        ->middleware('permission:view_users')
        ->name('users.index');

    Route::get('roles', \App\Livewire\Roles\Index::class)
        ->middleware('permission:view_roles')
        ->name('roles.index');

    // System routes
    Route::get('schools', \App\Livewire\Schools\Index::class)
        ->middleware('permission:view_schools')
        ->name('schools.index');

    Route::get('subscriptions', \App\Livewire\Subscriptions\Index::class)
        ->middleware('permission:view_subscriptions')
        ->name('subscriptions.index');

    Route::get('subscription-plans', \App\Livewire\SubscriptionPlans\Index::class)
        ->middleware('permission:view_subscription_plans')
        ->name('subscription_plans.index');

    // Module routes
    Route::get('students', \App\Livewire\Students\Index::class)
        ->middleware('permission:view_students')
        ->name('students.index');

    Route::get('teachers', \App\Livewire\Teachers\Index::class)
        ->middleware('permission:view_teachers')
        ->name('teachers.index');

    Route::get('classes', \App\Livewire\Classes\Index::class)
        ->middleware('permission:view_classes')
        ->name('classes.index');

    Route::get('subjects', \App\Livewire\Subjects\Index::class)
        ->middleware('permission:view_subjects')
        ->name('subjects.index');

    Route::get('exams', \App\Livewire\Exams\Index::class)
        ->middleware('permission:view_exams')
        ->name('exams.index');

    Route::get('attendance', \App\Livewire\Attendance\Index::class)
        ->middleware('permission:view_attendance')
        ->name('attendance.index');

    Route::get('finance', \App\Livewire\Finance\Index::class)
        ->middleware('permission:view_finance')
        ->name('finance.index');

    Route::get('library', \App\Livewire\Library\Index::class)
        ->middleware('permission:view_library')
        ->name('library.index');

    Route::get('transport', \App\Livewire\Transport\Index::class)
        ->middleware('permission:view_transport')
        ->name('transport.index');

    Route::get('hostel', \App\Livewire\Hostel\Index::class)
        ->middleware('permission:view_hostel')
        ->name('hostel.index');
});
