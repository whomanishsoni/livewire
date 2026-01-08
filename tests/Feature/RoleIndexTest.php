<?php

use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;

test('permissions modal opens for role', function () {
    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrator',
        'color' => 'red',
        'permissions' => ['view_users', 'create_users', 'view_roles']
    ]);

    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Livewire\Roles\Index::class)
        ->call('showPermissions', $role->id)
        ->assertSet('showPermissionsModal', true)
        ->assertSet('editingPermissionsRole.id', $role->id)
        ->assertSet('selectedPermissions', ['view_users', 'create_users', 'view_roles'])
        ->assertCount('availablePermissions', 4); // 4 modules (users, roles, content, reports)
});

test('permissions can be updated for role', function () {
    $role = Role::create([
        'name' => 'moderator',
        'label' => 'Moderator',
        'color' => 'orange',
        'permissions' => ['view_content', 'create_content']
    ]);

    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Livewire\Roles\Index::class)
        ->call('showPermissions', $role->id)
        ->set('selectedPermissions', ['view_reports', 'edit_content'])
        ->call('updatePermissions')
        ->assertSet('showPermissionsModal', false);

    $role->refresh();
    expect($role->permissions)->toEqual(['view_reports', 'edit_content']);
});

test('permissions modal can be closed', function () {
    $role = Role::create([
        'name' => 'user',
        'label' => 'User',
        'color' => 'green',
        'permissions' => ['view_content']
    ]);

    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Livewire\Roles\Index::class)
        ->call('showPermissions', $role->id)
        ->assertSet('showPermissionsModal', true)
        ->call('closePermissionsModal')
        ->assertSet('showPermissionsModal', false)
        ->assertSet('editingPermissionsRole', null)
        ->assertSet('availablePermissions', [])
        ->assertSet('selectedPermissions', []);
});
