<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Role Hierarchy Configuration
    |--------------------------------------------------------------------------
    |
    | Define the role hierarchy for your application. Each role has a priority
    | number where higher numbers indicate higher privilege levels.
    |
    | Users can only see and manage roles at or below their hierarchy level.
    | For example, a moderator (level 2) can see moderator and user roles,
    | but not admin roles (level 3).
    |
    */

    'hierarchy' => [
        'student' => 1,       // Lowest level - students
        'parent' => 2,        // Parents/guardians
        'teacher' => 3,       // Teaching staff
        'admin' => 4,         // School administrators (deputy principal, etc.)
        'super_admin' => 5,   // Highest level - principal/super administrator
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Role
    |--------------------------------------------------------------------------
    |
    | The default role assigned to new users if no role is specified.
    |
    */

    'default_role' => 'student',

    /*
    |--------------------------------------------------------------------------
    | Protected Roles
    |--------------------------------------------------------------------------
    |
    | Roles that cannot be deleted or modified by lower-level users.
    | These roles are protected from bulk operations and require special handling.
    |
    */

    'protected_roles' => ['super_admin', 'admin'],
];
