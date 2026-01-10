<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    @if(auth()->user()->hasPermission('view_dashboard'))
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    @endif

                    {{-- Show all menus for super admin and admin --}}
                    @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                        {{-- Debug: Show user role and permissions --}}
                        {{-- Current User: {{ auth()->user()->name }} ({{ auth()->user()->role->name ?? 'No Role' }}) --}}
                        {{-- Has view_schools: {{ auth()->user()->hasPermission('view_schools') ? 'YES' : 'NO' }} --}}
                        {{-- Has view_subscriptions: {{ auth()->user()->hasPermission('view_subscriptions') ? 'YES' : 'NO' }} --}}
                        {{-- Has view_subscription_plans: {{ auth()->user()->hasPermission('view_subscription_plans') ? 'YES' : 'NO' }} --}}

                        {{-- User Management --}}
                        <flux:navlist.group heading="User Management" class="mb-2">
                            @if(auth()->user()->hasPermission('view_users'))
                                <flux:navlist.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.*')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                            @endif
                            @if(auth()->user()->hasPermission('view_roles'))
                                <flux:navlist.item icon="user-group" :href="route('roles.index')" :current="request()->routeIs('roles.*')" wire:navigate>{{ __('Roles') }}</flux:navlist.item>
                            @endif
                        </flux:navlist.group>

                        {{-- System Management --}}
                        <flux:navlist.group heading="System Management" class="mb-2">
                            @if(auth()->user()->hasPermission('view_schools'))
                                <flux:navlist.item icon="building-office" :href="route('schools.index')" :current="request()->routeIs('schools.*')" wire:navigate>{{ __('Schools') }}</flux:navlist.item>
                            @endif
                            @if(auth()->user()->hasPermission('view_subscriptions'))
                                <flux:navlist.item icon="credit-card" :href="route('subscriptions.index')" :current="request()->routeIs('subscriptions.*')" wire:navigate>{{ __('Subscriptions') }}</flux:navlist.item>
                            @endif
                            @if(auth()->user()->hasPermission('view_subscription_plans'))
                                <flux:navlist.item icon="document-text" :href="route('subscription_plans.index')" :current="request()->routeIs('subscription_plans.*')" wire:navigate>{{ __('Subscription Plans') }}</flux:navlist.item>
                            @endif
                        </flux:navlist.group>

                        {{-- School Management Modules --}}
                        <flux:navlist.group heading="Modules" class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4">
                            @php
                                // Exclude dashboard and settings from modules list (shown elsewhere)
                                $excludedModules = ['dashboard', 'settings'];
                                $allModules = \App\Models\Module::active()
                                    ->whereNotIn('name', $excludedModules)
                                    ->orderBy('sort_order')
                                    ->get();
                            @endphp
                            @foreach($allModules as $module)
                                @if(auth()->user()->hasPermission("view_{$module->name}"))
                                    @php
                                        // Handle special route names
                                        if ($module->name === 'subscription_plans') {
                                            // Subscription plans route uses underscore not hyphen
                                            $routeHref = route('subscription_plans.index');
                                            $routePattern = 'subscription_plans.*';
                                        } elseif ($module->route_prefix) {
                                            // Standard route pattern: route_prefix.index
                                            $routeHref = route($module->route_prefix . '.index');
                                            $routePattern = $module->route_prefix . '.*';
                                        } else {
                                            $routeHref = '#';
                                            $routePattern = null;
                                        }
                                    @endphp
                                    <flux:navlist.item
                                        icon="cube"
                                        :href="$routeHref"
                                        :current="$routePattern ? request()->routeIs($routePattern) : false"
                                        wire:navigate
                                    >
                                        {{ $module->label }}
                                    </flux:navlist.item>
                                @endif
                            @endforeach
                        </flux:navlist.group>
                    @elseif(auth()->user()->hasRole('teacher'))
                        {{-- Teacher specific modules --}}
                        @php
                            $teacherModules = ['students', 'classes', 'subjects', 'exams', 'attendance'];
                            $modules = \App\Models\Module::active()->whereIn('name', $teacherModules)->get();
                        @endphp
                        @foreach($modules as $module)
                            @if(auth()->user()->hasPermission("view_{$module->name}"))
                                <flux:navlist.item
                                    icon="cube"
                                    :href="$module->route_prefix ? route($module->route_prefix . '.index') : '#'"
                                    :current="request()->routeIs($module->route_prefix . '.*')"
                                    wire:navigate
                                >
                                    {{ $module->label }}
                                </flux:navlist.item>
                            @endif
                        @endforeach
                    @else
                        {{-- For other roles (parent, student), only show dashboard and settings --}}
                        {{-- No additional menu items for basic users --}}
                    @endif
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        <flux:toast />

        @fluxScripts
    </body>
</html>
