<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user's role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the user's school.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Check if the user has a specific permission.
     * Enhanced to consider school context and module access.
     */
    public function hasPermission(string $permission): bool
    {
        // First check if user has the permission via their role
        if (! $this->role?->hasPermission($permission)) {
            return false;
        }

        // System-level modules that don't require school subscription
        $systemModules = ['dashboard', 'users', 'roles', 'schools', 'subscriptions', 'subscription_plans', 'settings'];

        // If user has school context, check if their school has access to the module
        // But skip check for system-level modules
        if ($this->school_id) {
            $module = $this->extractModuleFromPermission($permission);
            if ($module && ! in_array($module, $systemModules) && ! $this->school->hasModule($module)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role?->name === $roleName;
    }

    /**
     * Check if the user belongs to a specific school.
     */
    public function belongsToSchool(int $schoolId): bool
    {
        return $this->school_id === $schoolId;
    }

    /**
     * Get the available modules for this user's school.
     */
    public function getAvailableModules()
    {
        return $this->school?->getAvailableModules() ?? collect();
    }

    /**
     * Check if the user can access a specific module.
     */
    public function canAccessModule(string $moduleSlug): bool
    {
        if (! $this->school) {
            return false;
        }

        return $this->school->hasModule($moduleSlug);
    }

    /**
     * Extract module name from permission string.
     * e.g., "view_users" -> "users", "create_students" -> "students"
     */
    private function extractModuleFromPermission(string $permission): ?string
    {
        // Remove common prefixes
        $module = preg_replace('/^(view_|create_|edit_|delete_|manage_)/', '', $permission);

        // If it's a known module, return it
        if (\App\Models\Module::where('name', $module)->exists()) {
            return $module;
        }

        return null;
    }

    /**
     * Generate a temporary authentication token for cross-domain login.
     */
    public function generateAuthToken(): string
    {
        $token = \Illuminate\Support\Str::random(64);
        \Cache::put('auth_token_'.$token, $this->id, now()->addMinutes(5));

        return $token;
    }

    /**
     * Validate and consume an authentication token.
     */
    public static function validateAuthToken(string $token): ?self
    {
        $userId = \Cache::get('auth_token_'.$token);

        if ($userId) {
            \Cache::forget('auth_token_'.$token);

            return self::find($userId);
        }

        return null;
    }
}
