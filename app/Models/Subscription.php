<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'school_id',
        'subscription_plan_id',
        'starts_at',
        'ends_at',
        'status',
        'price',
        'billing_period',
        'metadata',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'price' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the school that owns this subscription.
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the subscription plan.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    /**
     * Check if the subscription is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active' &&
               (!$this->ends_at || $this->ends_at->isFuture());
    }

    /**
     * Check if the subscription is expired.
     */
    public function isExpired(): bool
    {
        return $this->status === 'expired' ||
               ($this->ends_at && $this->ends_at->isPast());
    }

    /**
     * Check if the subscription is in trial period.
     */
    public function isTrial(): bool
    {
        return $this->status === 'trial';
    }

    /**
     * Get the remaining days in the subscription.
     */
    public function getRemainingDays(): ?int
    {
        if (!$this->ends_at) {
            return null;
        }

        return max(0, Carbon::now()->diffInDays($this->ends_at, false));
    }

    /**
     * Activate the subscription.
     */
    public function activate(): void
    {
        $this->update(['status' => 'active']);
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(): void
    {
        $this->update(['status' => 'cancelled']);
    }

    /**
     * Expire the subscription.
     */
    public function expire(): void
    {
        $this->update(['status' => 'expired']);
    }

    /**
     * Get the subscription status badge color.
     */
    public function getStatusColor(): string
    {
        return match($this->status) {
            'active' => 'green',
            'trial' => 'blue',
            'expired' => 'red',
            'cancelled' => 'gray',
            default => 'gray',
        };
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->price ? '$' . number_format($this->price, 2) : 'Free';
    }

    /**
     * Scope for active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where(function ($q) {
                        $q->whereNull('ends_at')
                          ->orWhere('ends_at', '>', now());
                    });
    }

    /**
     * Scope for expired subscriptions.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
                    ->orWhere('ends_at', '<=', now());
    }
}
