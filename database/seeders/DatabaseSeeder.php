<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed permissions first
        $this->call(PermissionSeeder::class);

        // Then seed roles
        $this->call(RoleSeeder::class);

        // Create a test admin user
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create additional sample users
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        User::factory()->create([
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
        ]);

        User::factory()->create([
            'name' => 'Alice Brown',
            'email' => 'alice@example.com',
        ]);

        User::factory()->create([
            'name' => 'Charlie Wilson',
            'email' => 'charlie@example.com',
        ]);

        User::factory()->create([
            'name' => 'Diana Davis',
            'email' => 'diana@example.com',
        ]);

        User::factory()->create([
            'name' => 'Edward Miller',
            'email' => 'edward@example.com',
        ]);

        // Create more users to demonstrate pagination
        User::factory()->create([
            'name' => 'Frank Garcia',
            'email' => 'frank@example.com',
        ]);

        User::factory()->create([
            'name' => 'Grace Lee',
            'email' => 'grace@example.com',
        ]);

        User::factory()->create([
            'name' => 'Henry Taylor',
            'email' => 'henry@example.com',
        ]);

        User::factory()->create([
            'name' => 'Ivy Chen',
            'email' => 'ivy@example.com',
        ]);

        User::factory()->create([
            'name' => 'Jack Rodriguez',
            'email' => 'jack@example.com',
        ]);

        User::factory()->create([
            'name' => 'Kelly Martinez',
            'email' => 'kelly@example.com',
        ]);

        User::factory()->create([
            'name' => 'Liam Anderson',
            'email' => 'liam@example.com',
        ]);
    }
}
