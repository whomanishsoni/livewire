<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;



// Routes that work on both main domain and subdomains
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::middleware(['auth', 'verified', \App\Http\Middleware\RedirectSchoolUsers::class])->group(function () {
            Route::view('dashboard', 'dashboard')
                ->name('dashboard');

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
        });
    });
}
