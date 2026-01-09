<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
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
});
