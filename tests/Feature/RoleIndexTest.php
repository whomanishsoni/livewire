<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Livewire\Livewire;

test('permissions modal opens for role', function () {
    // Create permissions first
    $viewUsersPermission = Permission::create([
        'name' => 'view_users',
        'label' => 'View Users',
        'module' => 'users',
        'description' => 'Can view users list and details'
    ]);

    $createUsersPermission = Permission::create([
        'name' => 'create_users',
        'label' => 'Create Users',
        'module' => 'users',
        'description' => 'Can create new users'
    ]);

    $viewRolesPermission = Permission::create([
        'name' => 'view_roles',
        'label' => 'View Roles',
        'module' => 'roles',
        'description' => 'Can view roles list and details'
    ]);

    $role = Role::create([
        'name' => 'admin',
        'label' => 'Administrator',
        'color' => 'red',
    ]);

    // Attach permissions to role
    $role->permissions()->attach([$viewUsersPermission->id, $createUsersPermission->id, $viewRolesPermission->id]);

    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Livewire\Roles\Index::class)
        ->call('showPermissions', $role->id)
        ->assertSet('showPermissionsModal', true)
        ->assertSet('editingPermissionsRole.id', $role->id)
        ->assertSet('selectedPermissions', [$viewUsersPermission->id, $createUsersPermission->id, $viewRolesPermission->id])
        ->assertCount('availablePermissions', 1); // 1 module (users) since we only created users module permissions
});

test('permissions can be updated for role', function () {
    // Create permissions
    $viewContentPermission = Permission::create([
        'name' => 'view_content',
        'label' => 'View Content',
        'module' => 'content',
        'description' => 'Can view content'
    ]);

    $createContentPermission = Permission::create([
        'name' => 'create_content',
        'label' => 'Create Content',
        'module' => 'content',
        'description' => 'Can create content'
    ]);

    $viewReportsPermission = Permission::create([
        'name' => 'view_reports',
        'label' => 'View Reports',
        'module' => 'reports',
        'description' => 'Can view reports'
    ]);

    $editContentPermission = Permission::create([
        'name' => 'edit_content',
        'label' => 'Edit Content',
        'module' => 'content',
        'description' => 'Can edit content'
    ]);

    $role = Role::create([
        'name' => 'moderator',
        'label' => 'Moderator',
        'color' => 'orange',
    ]);

    // Attach initial permissions
    $role->permissions()->attach([$viewContentPermission->id, $createContentPermission->id]);

    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(\App\Livewire\Roles\Index::class)
        ->call('showPermissions', $role->id)
        ->set('selectedPermissions', [$viewReportsPermission->id, $editContentPermission->id])
        ->call('updatePermissions')
        ->assertSet('showPermissionsModal', false);

    $role->refresh();
    expect($role->permissions->pluck('id')->toArray())->toEqual([$viewReportsPermission->id, $editContentPermission->id]);
});

test('permissions modal can be closed', function () {
    $viewContentPermission = Permission::create([
        'name' => 'view_content',
        'label' => 'View Content',
        'module' => 'content',
        'description' => 'Can view content'
    ]);

    $role = Role::create([
        'name' => 'user',
        'label' => 'User',
        'color' => 'green',
    ]);

    // Attach permission to role
    $role->permissions()->attach([$viewContentPermission->id]);

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
