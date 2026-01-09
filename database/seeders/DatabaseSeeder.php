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
        // Seed modules first (they create permissions automatically)
        $this->call(ModuleSeeder::class);

        // Then seed subscription plans
        $this->call(SubscriptionPlanSeeder::class);

        // Then seed schools
        $this->call(SchoolSeeder::class);

        // Truncate tables in correct order (due to foreign key constraints)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Role::query()->delete();
        User::query()->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed permissions (for existing modules not covered by ModuleSeeder)
        $this->call(PermissionSeeder::class);

        // Then seed roles
        $this->call(RoleSeeder::class);

        // Create global super admin
        $this->createSuperAdmin();

        // Create users for each school
        $this->createSchoolUsers();
    }

    /**
     * Create a global super admin user.
     */
    private function createSuperAdmin(): void
    {
        $superAdminRole = \App\Models\Role::where('name', 'super_admin')->first();

        if ($superAdminRole) {
            User::firstOrCreate(
                ['email' => 'superadmin@schoolsaas.com'],
                [
                    'name' => 'Super Administrator',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role_id' => $superAdminRole->id,
                    'school_id' => null, // Global admin - no school context
                ]
            );
        }
    }

    /**
     * Create users for each seeded school.
     */
    private function createSchoolUsers(): void
    {
        $schools = \App\Models\School::all();
        $roles = \App\Models\Role::all()->keyBy('name');

        foreach ($schools as $school) {
            $this->createUsersForSchool($school, $roles);
        }
    }

    /**
     * Create users for a specific school.
     */
    private function createUsersForSchool(\App\Models\School $school, $roles): void
    {
        $domain = $school->domain ?? 'default';

        // Create School Principal (highest school-level admin)
        User::create([
            'name' => 'Dr. Sarah Principal - ' . $school->name,
            'email' => 'principal@' . $domain . '.edu',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $roles['admin']->id, // School-level admin
            'school_id' => $school->id,
        ]);

        // Create School Administrators
        User::create([
            'name' => 'Mr. John Deputy - ' . $school->name,
            'email' => 'deputy@' . $domain . '.edu',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $roles['admin']->id,
            'school_id' => $school->id,
        ]);

        User::create([
            'name' => 'Mrs. Mary Admin - ' . $school->name,
            'email' => 'admin@' . $domain . '.edu',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => $roles['admin']->id,
            'school_id' => $school->id,
        ]);

        // Create Teachers
        $teachers = [
            ['Ms. Emily Johnson', 'emily.johnson'],
            ['Mr. David Smith', 'david.smith'],
            ['Mrs. Lisa Brown', 'lisa.brown'],
            ['Mr. Robert Wilson', 'robert.wilson'],
        ];

        foreach ($teachers as [$name, $emailPrefix]) {
            User::create([
                'name' => $name . ' - ' . $school->name,
                'email' => $emailPrefix . '@' . $domain . '.edu',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['teacher']->id,
                'school_id' => $school->id,
            ]);
        }

        // Create Parents
        $parents = [
            ['Mrs. Jennifer Davis', 'jennifer.davis'],
            ['Mr. Michael Garcia', 'michael.garcia'],
            ['Mrs. Patricia Lee', 'patricia.lee'],
        ];

        foreach ($parents as [$name, $emailPrefix]) {
            User::create([
                'name' => $name . ' - ' . $school->name,
                'email' => $emailPrefix . '@' . $domain . '.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['parent']->id,
                'school_id' => $school->id,
            ]);
        }

        // Create Students
        $students = [
            ['Emma Johnson', 'emma.johnson'],
            ['Noah Smith', 'noah.smith'],
            ['Olivia Brown', 'olivia.brown'],
            ['Liam Wilson', 'liam.wilson'],
            ['Sophia Davis', 'sophia.davis'],
            ['Mason Garcia', 'mason.garcia'],
            ['Isabella Lee', 'isabella.lee'],
            ['Ethan Martinez', 'ethan.martinez'],
        ];

        foreach ($students as [$name, $emailPrefix]) {
            User::create([
                'name' => $name . ' - ' . $school->name,
                'email' => $emailPrefix . '@' . $domain . '.edu',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['student']->id,
                'school_id' => $school->id,
            ]);
        }
    }
}
