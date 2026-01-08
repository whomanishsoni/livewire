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
        // Truncate tables in correct order (due to foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Role::query()->delete();
        User::query()->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed permissions first
        $this->call(PermissionSeeder::class);

        // Then seed roles
        $this->call(RoleSeeder::class);

        // Get role IDs for assignment
        $superAdminRole = \App\Models\Role::where('name', 'super_admin')->first();
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $teacherRole = \App\Models\Role::where('name', 'teacher')->first();
        $parentRole = \App\Models\Role::where('name', 'parent')->first();
        $studentRole = \App\Models\Role::where('name', 'student')->first();

        // Create Super Admin (Principal)
        User::create([
            'name' => 'Dr. Sarah Principal',
            'email' => 'principal@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $superAdminRole->id,
        ]);

        // Create School Administrators
        User::create([
            'name' => 'Mr. John Deputy',
            'email' => 'deputy@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'Mrs. Mary Admin',
            'email' => 'admin@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create Teachers
        User::create([
            'name' => 'Ms. Emily Johnson',
            'email' => 'emily.johnson@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $teacherRole->id,
        ]);

        User::create([
            'name' => 'Mr. David Smith',
            'email' => 'david.smith@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $teacherRole->id,
        ]);

        User::create([
            'name' => 'Mrs. Lisa Brown',
            'email' => 'lisa.brown@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $teacherRole->id,
        ]);

        User::create([
            'name' => 'Mr. Robert Wilson',
            'email' => 'robert.wilson@school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $teacherRole->id,
        ]);

        // Create Parents
        User::create([
            'name' => 'Mrs. Jennifer Davis',
            'email' => 'jennifer.davis@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $parentRole->id,
        ]);

        User::create([
            'name' => 'Mr. Michael Garcia',
            'email' => 'michael.garcia@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $parentRole->id,
        ]);

        User::create([
            'name' => 'Mrs. Patricia Lee',
            'email' => 'patricia.lee@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $parentRole->id,
        ]);

        // Create Students
        User::create([
            'name' => 'Emma Johnson',
            'email' => 'emma.johnson@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Noah Smith',
            'email' => 'noah.smith@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Olivia Brown',
            'email' => 'olivia.brown@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Liam Wilson',
            'email' => 'liam.wilson@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Sophia Davis',
            'email' => 'sophia.davis@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Mason Garcia',
            'email' => 'mason.garcia@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Isabella Lee',
            'email' => 'isabella.lee@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);

        User::create([
            'name' => 'Ethan Martinez',
            'email' => 'ethan.martinez@student.school.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $studentRole->id,
        ]);
    }
}
