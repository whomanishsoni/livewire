<?php

namespace App\Services;

use App\Models\School;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{
    /**
     * Subscribe a school to a plan.
     *
     * @param School $school
     * @param SubscriptionPlan $plan
     * @param array $options Additional subscription options
     * @return Subscription
     */
    public static function subscribeSchool(School $school, SubscriptionPlan $plan, array $options = []): Subscription
    {
        // Check if school already has an active subscription to this plan
        $existingSubscription = $school->subscriptions()
            ->where('subscription_plan_id', $plan->id)
            ->where('status', 'active')
            ->first();

        if ($existingSubscription) {
            throw new \Exception('School already has an active subscription to this plan');
        }

        // Calculate end date based on billing period
        $startsAt = Carbon::now();
        $endsAt = $options['ends_at'] ?? self::calculateEndDate($plan, $startsAt);

        return Subscription::create([
            'school_id' => $school->id,
            'subscription_plan_id' => $plan->id,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => $options['status'] ?? 'active',
            'price' => $plan->price,
            'billing_period' => $plan->billing_period,
            'metadata' => $options['metadata'] ?? [],
        ]);
    }

    /**
     * Cancel a school's subscription.
     *
     * @param Subscription $subscription
     * @return bool
     */
    public static function cancelSubscription(Subscription $subscription): bool
    {
        return $subscription->update(['status' => 'cancelled']);
    }

    /**
     * Renew a subscription.
     *
     * @param Subscription $subscription
     * @param array $options
     * @return Subscription
     */
    public static function renewSubscription(Subscription $subscription, array $options = []): Subscription
    {
        $newEndDate = self::calculateEndDate($subscription->plan, $subscription->ends_at ?? Carbon::now());

        $subscription->update([
            'ends_at' => $newEndDate,
            'status' => 'active',
        ]);

        return $subscription->fresh();
    }

    /**
     * Check if a school has an active subscription.
     *
     * @param School $school
     * @return bool
     */
    public static function hasActiveSubscription(School $school): bool
    {
        return $school->subscriptions()->active()->exists();
    }

    /**
     * Get the active subscription for a school.
     *
     * @param School $school
     * @return Subscription|null
     */
    public static function getActiveSubscription(School $school): ?Subscription
    {
        return $school->subscriptions()->active()->first();
    }

    /**
     * Check if a school can access a module.
     *
     * @param School $school
     * @param string $moduleSlug
     * @return bool
     */
    public static function canAccessModule(School $school, string $moduleSlug): bool
    {
        $subscription = self::getActiveSubscription($school);

        if (!$subscription) {
            return false;
        }

        return $subscription->plan->modules()->where('slug', $moduleSlug)->exists();
    }

    /**
     * Get all available modules for a school.
     *
     * @param School $school
     * @return \Illuminate\Support\Collection
     */
    public static function getAvailableModules(School $school)
    {
        $subscription = self::getActiveSubscription($school);

        if (!$subscription) {
            return collect();
        }

        return $subscription->plan->modules;
    }

    /**
     * Calculate the end date for a subscription.
     *
     * @param SubscriptionPlan $plan
     * @param Carbon $startDate
     * @return Carbon
     */
    private static function calculateEndDate(SubscriptionPlan $plan, Carbon $startDate): Carbon
    {
        return match($plan->billing_period) {
            'monthly' => $startDate->copy()->addMonth(),
            'yearly' => $startDate->copy()->addYear(),
            default => $startDate->copy()->addMonth(),
        };
    }

    /**
     * Get subscription statistics.
     *
     * @return array
     */
    public static function getSubscriptionStats(): array
    {
        return [
            'total_schools' => School::count(),
            'active_subscriptions' => Subscription::active()->count(),
            'total_revenue' => Subscription::active()->sum('price'),
            'plans' => SubscriptionPlan::active()->withCount('subscriptions')->get(),
        ];
    }

    /**
     * Check for expired subscriptions and update their status.
     *
     * @return int Number of subscriptions expired
     */
    public static function processExpiredSubscriptions(): int
    {
        $expiredSubscriptions = Subscription::where('status', 'active')
            ->where('ends_at', '<', Carbon::now())
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->expire();
        }

        return $expiredSubscriptions->count();
    }
}
