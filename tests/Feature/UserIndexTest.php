<?php

use App\Models\User;

test('authenticated users can view users index', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/users');

    $response->assertStatus(200);
    $response->assertSee('Users');
});

test('unauthenticated users cannot view users index', function () {
    $response = $this->get('/users');

    $response->assertRedirect('/login');
});

test('users can be searched by name', function () {
    $user1 = User::factory()->create(['name' => 'John Doe']);
    $user2 = User::factory()->create(['name' => 'Jane Smith']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('search', 'John')
        ->assertSee('John Doe')
        ->assertDontSee('Jane Smith');
});

test('users can be searched by email', function () {
    $user1 = User::factory()->create(['email' => 'john@example.com']);
    $user2 = User::factory()->create(['email' => 'jane@example.com']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('search', 'john@example.com')
        ->assertSee('john@example.com')
        ->assertDontSee('jane@example.com');
});

test('search functionality works correctly', function () {
    $user1 = User::factory()->create(['name' => 'Test User']);
    $user2 = User::factory()->create(['name' => 'Regular User']);

    // Test that search returns correct results
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('search', 'Test')
        ->assertSee('Test User')
        ->assertDontSee('Regular User');

    // Test that clearing search shows all users
    Livewire::test(\App\Livewire\Users\Index::class)
        ->assertSee('Test User')
        ->assertSee('Regular User');
});

test('filter by verified users works correctly', function () {
    $verifiedUser = User::factory()->create(['email_verified_at' => now()]);
    $unverifiedUser = User::factory()->create(['email_verified_at' => null]);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('verificationFilter', 'verified')
        ->assertSee($verifiedUser->name)
        ->assertDontSee($unverifiedUser->name);
});

test('filter by unverified users works correctly', function () {
    $verifiedUser = User::factory()->create(['email_verified_at' => now()]);
    $unverifiedUser = User::factory()->create(['email_verified_at' => null]);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('verificationFilter', 'unverified')
        ->assertSee($unverifiedUser->name)
        ->assertDontSee($verifiedUser->name);
});

test('filter and search work together', function () {
    $verifiedUser = User::factory()->create([
        'name' => 'John Verified',
        'email_verified_at' => now()
    ]);
    $unverifiedUser = User::factory()->create([
        'name' => 'Jane Unverified',
        'email_verified_at' => null
    ]);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('verificationFilter', 'verified')
        ->set('search', 'John')
        ->assertSee('John Verified')
        ->assertDontSee('Jane Unverified');
});

test('user can be edited', function () {
    $user = User::factory()->create(['name' => 'Old Name', 'email' => 'old@example.com']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('edit', $user->id)
        ->assertSet('showEditModal', true)
        ->assertSet('editName', 'Old Name')
        ->assertSet('editEmail', 'old@example.com')
        ->set('editName', 'New Name')
        ->set('editEmail', 'new@example.com')
        ->call('updateUser')
        ->assertSet('showEditModal', false);

    $user->refresh();
    expect($user->name)->toBe('New Name');
    expect($user->email)->toBe('new@example.com');
});

test('user edit validation works', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('edit', $user->id)
        ->set('editEmail', 'existing@example.com')
        ->call('updateUser')
        ->assertHasErrors(['editEmail']);
});

test('user can be deleted', function () {
    $user = User::factory()->create();

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('delete', $user->id)
        ->assertSet('showDeleteModal', true)
        ->assertSet('deletingUser.id', $user->id)
        ->call('confirmDelete')
        ->assertSet('showDeleteModal', false);

    expect(User::find($user->id))->toBeNull();
});

test('user delete can be cancelled', function () {
    $user = User::factory()->create();

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('delete', $user->id)
        ->assertSet('showDeleteModal', true)
        ->call('cancelDelete')
        ->assertSet('showDeleteModal', false);

    expect(User::find($user->id))->not->toBeNull();
});

test('user can be created', function () {
    $role = \App\Models\Role::factory()->create(['name' => 'user', 'label' => 'User', 'color' => 'green']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('create')
        ->assertSet('showCreateModal', true)
        ->set('createName', 'New User')
        ->set('createEmail', 'new@example.com')
        ->set('createPassword', 'password123')
        ->set('createPasswordConfirmation', 'password123')
        ->set('createRoleId', $role->id)
        ->call('createUser')
        ->assertSet('showCreateModal', false);

    $user = User::where('email', 'new@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe('New User');
    expect($user->role_id)->toBe($role->id);
});

test('user creation validation works', function () {
    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('create')
        ->set('createName', '')
        ->set('createEmail', 'invalid-email')
        ->set('createPassword', 'short')
        ->call('createUser')
        ->assertHasErrors(['createName', 'createEmail', 'createPassword']);
});

test('user creation requires unique email', function () {
    $existingUser = User::factory()->create(['email' => 'existing@example.com']);

    Livewire::test(\App\Livewire\Users\Index::class)
        ->call('create')
        ->set('createName', 'New User')
        ->set('createEmail', 'existing@example.com')
        ->set('createPassword', 'password123')
        ->call('createUser')
        ->assertHasErrors(['createEmail']);
});

test('page length can be changed', function () {
    // Create more users than default page size
    User::factory(25)->create();

    $user = User::first();

    // Test default 10 per page
    Livewire::test(\App\Livewire\Users\Index::class)
        ->assertSet('perPage', 10);

    // Test changing to 25 per page
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('perPage', 25)
        ->assertSet('perPage', 25);
});

test('select all checkbox functionality works', function () {
    $users = User::factory(3)->create();

    // Test selecting all users
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectAll', true)
        ->assertSet('selectedUsers', $users->pluck('id')->toArray())
        ->assertSet('selectAll', true);

    // Test deselecting all users
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectAll', false)
        ->assertSet('selectedUsers', [])
        ->assertSet('selectAll', false);
});

test('individual user selection works', function () {
    $users = User::factory(3)->create();
    $firstUser = $users->first();
    $secondUser = $users->skip(1)->first();

    // Test selecting first user
    $component = Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectedUsers', [$firstUser->id]);

    expect($component->get('selectedUsers'))->toContain($firstUser->id);

    // Test selecting second user (should add to selection)
    $component = Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectedUsers', [$firstUser->id, $secondUser->id]);

    $selectedUsers = $component->get('selectedUsers');
    sort($selectedUsers);
    expect($selectedUsers)->toEqual([$firstUser->id, $secondUser->id]);

    // Test deselecting first user
    $component = Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectedUsers', [$secondUser->id]);

    $remainingUsers = $component->get('selectedUsers');
    expect($remainingUsers)->toContain($secondUser->id);
    expect($remainingUsers)->not->toContain($firstUser->id);
});

test('bulk delete selected users works', function () {
    $users = User::factory(3)->create();
    $userIds = $users->pluck('id')->toArray();

    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('selectedUsers', $userIds)
        ->call('bulkDelete')
        ->assertSet('selectedUsers', [])
        ->assertSet('selectAll', false);

    // Verify users were deleted
    foreach ($userIds as $id) {
        expect(User::find($id))->toBeNull();
    }
});

test('select all only selects users from current page with pagination', function () {
    // Create 25 users to ensure multiple pages (default perPage is 10)
    $users = User::factory(25)->create();

    // Get first 10 users (first page)
    $firstPageUsers = $users->take(10);
    $firstPageIds = $firstPageUsers->pluck('id')->toArray();

    // Test that select all on first page only selects first 10 users
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('perPage', 10)
        ->set('selectAll', true)
        ->assertSet('selectedUsers', $firstPageIds);

    // Get second page users (users 11-20)
    $secondPageUsers = $users->skip(10)->take(10);
    $secondPageIds = $secondPageUsers->pluck('id')->toArray();

    // Test that select all on second page only selects users 11-20
    Livewire::test(\App\Livewire\Users\Index::class)
        ->set('perPage', 10)
        ->set('paginators.page', 2) // Go to page 2
        ->set('selectAll', true)
        ->assertSet('selectedUsers', $secondPageIds);
});
