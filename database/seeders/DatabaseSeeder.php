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
        echo "=== STARTING FRESH SEED ===\n\n";

        // Truncate all tables in correct order (due to foreign key constraints)
        echo "Truncating all tables...\n";
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear all pivot tables first
        \DB::table('permission_role')->truncate();
        \DB::table('plan_module')->truncate();

        // Clear main tables (order matters due to foreign keys)
        \DB::table('subscriptions')->truncate();
        \DB::table('users')->truncate();
        \DB::table('schools')->truncate();
        \DB::table('roles')->truncate();
        \DB::table('permissions')->truncate();
        \DB::table('modules')->truncate();
        \DB::table('subscription_plans')->truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        echo "All tables truncated successfully.\n\n";

        // Step 1: Seed modules first (they create permissions automatically via boot method)
        echo "Step 1: Seeding modules...\n";
        $this->call(ModuleSeeder::class);
        echo "\n";

        // Step 2: Regenerate all permissions based on modules
        echo "Step 2: Regenerating permissions...\n";
        $this->call(PermissionSeeder::class);
        echo "\n";

        // Step 3: Seed subscription plans (before schools since schools might reference plans)
        echo "Step 3: Seeding subscription plans...\n";
        $this->call(SubscriptionPlanSeeder::class);
        echo "\n";

        // Step 4: Seed schools
        echo "Step 4: Seeding schools...\n";
        $this->call(SchoolSeeder::class);
        echo "\n";

        // Step 5: Seed roles with permissions
        echo "Step 5: Seeding roles with permissions...\n";
        $this->call(RoleSeeder::class);
        echo "\n";

        // Step 6: Create global super admin
        echo "Step 6: Creating super admin user...\n";
        $this->createSuperAdmin();
        echo "\n";

        // Step 7: Create users for each school
        echo "Step 7: Creating school users...\n";
        $this->createSchoolUsers();
        echo "\n";

        // Final summary
        echo "=== SEEDING COMPLETE ===\n";
        echo 'Modules: '.\App\Models\Module::count()."\n";
        echo 'Permissions: '.\App\Models\Permission::count()."\n";
        echo 'Roles: '.\App\Models\Role::count()."\n";
        echo 'Schools: '.\App\Models\School::count()."\n";
        echo 'Users: '.User::count()."\n";
        echo 'Subscription Plans: '.\App\Models\SubscriptionPlan::count()."\n";
    }

    /**
     * Create a global super admin user.
     */
    private function createSuperAdmin(): void
    {
        $superAdminRole = \App\Models\Role::where('name', 'super_admin')->first();

        if (! $superAdminRole) {
            echo "ERROR: Super admin role not found!\n";

            return;
        }

        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $superAdminRole->id,
                'school_id' => null, // Global admin, not tied to any school
            ]
        );

        echo "Created super admin: superadmin@example.com (password: password)\n";
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
        if (! isset($roles['admin'], $roles['teacher'], $roles['parent'], $roles['student'])) {
            echo "ERROR: Required roles not found for school: {$school->name}\n";

            return;
        }

        $domain = $school->domain ?? 'default';

        // Create School Principal (highest school-level admin)
        User::updateOrCreate(
            ['email' => 'principal@'.$domain.'.edu'],
            [
                'name' => 'Dr. Sarah Principal - '.$school->name,
                'email' => 'principal@'.$domain.'.edu',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['admin']->id,
                'school_id' => $school->id,
            ]
        );

        // Create School Administrators
        User::updateOrCreate(
            ['email' => 'deputy@'.$domain.'.edu'],
            [
                'name' => 'Mr. John Deputy - '.$school->name,
                'email' => 'deputy@'.$domain.'.edu',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['admin']->id,
                'school_id' => $school->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@'.$domain.'.edu'],
            [
                'name' => 'Mrs. Mary Admin - '.$school->name,
                'email' => 'admin@'.$domain.'.edu',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role_id' => $roles['admin']->id,
                'school_id' => $school->id,
            ]
        );

        // Create Teachers
        $teachers = [
            ['Ms. Emily Johnson', 'emily.johnson'],
            ['Mr. David Smith', 'david.smith'],
            ['Mrs. Lisa Brown', 'lisa.brown'],
            ['Mr. Robert Wilson', 'robert.wilson'],
        ];

        foreach ($teachers as [$name, $emailPrefix]) {
            User::updateOrCreate(
                ['email' => $emailPrefix.'@'.$domain.'.edu'],
                [
                    'name' => $name.' - '.$school->name,
                    'email' => $emailPrefix.'@'.$domain.'.edu',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role_id' => $roles['teacher']->id,
                    'school_id' => $school->id,
                ]
            );
        }

        // Create Parents
        $parents = [
            ['Mrs. Jennifer Davis', 'jennifer.davis'],
            ['Mr. Michael Garcia', 'michael.garcia'],
            ['Mrs. Patricia Lee', 'patricia.lee'],
        ];

        foreach ($parents as [$name, $emailPrefix]) {
            User::updateOrCreate(
                ['email' => $emailPrefix.'@'.$domain.'.com'],
                [
                    'name' => $name.' - '.$school->name,
                    'email' => $emailPrefix.'@'.$domain.'.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role_id' => $roles['parent']->id,
                    'school_id' => $school->id,
                ]
            );
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
            User::updateOrCreate(
                ['email' => $emailPrefix.'@'.$domain.'.edu'],
                [
                    'name' => $name.' - '.$school->name,
                    'email' => $emailPrefix.'@'.$domain.'.edu',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'role_id' => $roles['student']->id,
                    'school_id' => $school->id,
                ]
            );
        }

        echo "Created users for school: {$school->name} ({$domain}.edu)\n";
    }
}
