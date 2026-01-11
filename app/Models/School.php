<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class School extends BaseTenant
{
    use HasFactory, HasDomains;

    protected $table = 'schools';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        // 'domain', // Handled by HasDomains
        'address',
        'phone',
        'email',
        'description',
        'logo',
        'is_active',
        'settings',
        'data',
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
            'settings' => 'array',
            'data' => 'array',
        ];
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'address',
            'phone',
            'email',
            'description',
            'logo',
            'is_active',
            'settings',
        ];
    }

    /**
     * Get the users that belong to this school.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the subscriptions for this school.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the active subscription for this school.
     */
    public function activeSubscription()
    {
        return $this->subscriptions()->where('status', 'active')->first();
    }

    /**
     * Get the available modules for this school based on their active subscription.
     */
    public function getAvailableModules()
    {
        $subscription = $this->activeSubscription();

        if (!$subscription) {
            return collect();
        }

        return $subscription->plan->modules ?? collect();
    }

    /**
     * Check if the school has access to a specific module.
     */
    public function hasModule(string $moduleSlug): bool
    {
        return $this->getAvailableModules()->contains('slug', $moduleSlug);
    }

    /**
     * Get the school's domain URL for routing.
     */
    public function getDomainUrl(): ?string
    {
        $domain = $this->domains->first();
        if (!$domain) {
            return null;
        }

        $appUrl = config('app.url', 'http://localhost');
        $parsedUrl = parse_url($appUrl);
        $scheme = $parsedUrl['scheme'] ?? 'http';
        $baseDomain = $parsedUrl['host'] ?? 'localhost';

        if ($baseDomain === 'localhost' || filter_var($baseDomain, FILTER_VALIDATE_IP)) {
            $baseDomain = 'livewire.test';
        }

        return "{$scheme}://{$domain->domain}.{$baseDomain}";
    }

    /**
     * Get the school's setting value.
     */
    public function getSetting(string $key, $default = null)
    {
        return data_get($this->settings, $key, $default);
    }

    /**
     * Set a school setting.
     */
    public function setSetting(string $key, $value): void
    {
        $settings = $this->settings ?? [];
        data_set($settings, $key, $value);
        $this->settings = $settings;
        $this->save();
    }
}
