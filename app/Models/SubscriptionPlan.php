<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubscriptionPlan extends Model
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
        'description',
        'price',
        'billing_period',
        'max_users',
        'max_storage_gb',
        'features',
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
            'price' => 'decimal:2',
            'max_users' => 'integer',
            'max_storage_gb' => 'integer',
            'features' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the subscriptions for this plan.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the modules assigned to this plan.
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'plan_module', 'subscription_plan_id', 'module_id');
    }

    /**
     * Assign modules to this plan.
     */
    public function assignModules(array $moduleIds): void
    {
        $this->modules()->sync($moduleIds);
    }

    /**
     * Get the plan's formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2) . '/' . $this->billing_period;
    }

    /**
     * Check if the plan is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get active plans ordered by sort order.
     */
    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Get a plan by slug.
     */
    public static function findBySlug(string $slug)
    {
        return static::where('slug', $slug)->first();
    }

    /**
     * Get the plan's feature list as a formatted array.
     */
    public function getFeatureList(): array
    {
        return $this->features ?? [];
    }
}
