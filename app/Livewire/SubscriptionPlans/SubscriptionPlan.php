<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
            'features' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'max_users' => 'integer',
            'max_storage_gb' => 'integer',
        ];
    }

    /**
     * Get the modules included in this plan.
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'plan_module', 'subscription_plan_id', 'module_id');
    }

    /**
     * Assign modules to the plan.
     */
    public function assignModules(array $moduleIds): void
    {
        $this->modules()->sync($moduleIds);
    }
}
