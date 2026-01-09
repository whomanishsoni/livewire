<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\PermissionService;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'label',
        'description',
        'icon',
        'route_prefix',
        'is_active',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically create permissions when a module is created
        static::created(function ($module) {
            PermissionService::registerCrudModule($module->name, $module->label);
        });

        // Clean up permissions when a module is deleted
        static::deleting(function ($module) {
            PermissionService::removeModulePermissions($module->name);
        });
    }

    /**
     * Get the plans that include this module.
     */
    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(SubscriptionPlan::class, 'plan_module', 'module_id', 'subscription_plan_id');
    }

    /**
     * Get the permissions for this module.
     */
    public function getPermissions()
    {
        return PermissionService::getModulePermissions($this->name);
    }

    /**
     * Get the CRUD permissions for this module.
     */
    public function getCrudPermissions(): array
    {
        return [
            "view_{$this->name}" => "View {$this->label}",
            "create_{$this->name}" => "Create {$this->label}",
            "edit_{$this->name}" => "Edit {$this->label}",
            "delete_{$this->name}" => "Delete {$this->label}",
        ];
    }

    /**
     * Check if the module is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get active modules ordered by sort order.
     */
    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Find a module by slug.
     */
    public static function findBySlug(string $slug)
    {
        return static::where('slug', $slug)->first();
    }

    /**
     * Get the module's route URL.
     */
    public function getRouteUrl(): string
    {
        return $this->route_prefix ? route($this->route_prefix . '.index') : '#';
    }

    /**
     * Get the module's icon HTML.
     */
    public function getIconHtml(): string
    {
        return $this->icon ? "<i class=\"{$this->icon}\"></i>" : '';
    }
}
