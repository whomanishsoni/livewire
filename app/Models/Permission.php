<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'label',
        'module',
        'description',
    ];

    /**
     * Get the roles that have this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    /**
     * Get permissions grouped by module.
     */
    public static function getGroupedByModule(): array
    {
        return static::orderBy('module')->orderBy('name')->get()->groupBy('module')->toArray();
    }

    /**
     * Get available modules.
     */
    public static function getAvailableModules(): array
    {
        return static::distinct('module')->pluck('module')->toArray();
    }

    /**
     * Get permissions for a specific module.
     */
    public static function getByModule(string $module): array
    {
        return static::where('module', $module)->orderBy('name')->get()->toArray();
    }
}
