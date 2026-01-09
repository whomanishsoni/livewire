<?php

namespace App\Livewire\Subscriptions;

use App\Models\School;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Flux;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginators = [];

    public $search = '';

    public $perPage = 10;

    public $showFilters = false;

    // URL parameters for filtering
    public $schoolId = null;

    public $planId = null;

    // Filter properties
    public $statusFilter = 'all'; // all, active, trial, expired, cancelled

    public $schoolFilter = 'all';

    public $planFilter = 'all';

    public $billingFilter = 'all'; // all, monthly, yearly

    // Selection properties
    public $selectAll = false;

    public $selectedSubscriptions = [];

    // Modal state
    public $showCreateModal = false;

    public $showEditModal = false;

    public $showDeleteModal = false;

    // Create modal properties
    public $createSchoolId = '';

    public $createPlanId = '';

    public $createStartsAt = '';

    public $createEndsAt = '';

    public $createPrice = '';

    public $createBillingPeriod = 'monthly';

    public $createStatus = 'active';

    public $createMetadata = '';

    // Edit modal properties
    public $editingSubscription = null;

    public $editSchoolId = '';

    public $editPlanId = '';

    public $editStartsAt = '';

    public $editEndsAt = '';

    public $editPrice = '';

    public $editBillingPeriod = 'monthly';

    public $editStatus = 'active';

    public $editMetadata = '';

    // Delete confirmation
    public $deletingSubscription = null;

    public function mount()
    {
        // Check URL parameters for pre-filtering
        $this->schoolId = request()->get('school_id');
        $this->planId = request()->get('plan_id');

        if ($this->schoolId) {
            $this->schoolFilter = $this->schoolId;
        }
        if ($this->planId) {
            $this->planFilter = $this->planId;
        }
    }

    public function updatingSearch()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingStatusFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingSchoolFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingPlanFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingBillingFilter()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingPerPage()
    {
        $this->paginators['page'] = 1;
    }

    public function setPage($page)
    {
        $this->paginators['page'] = $page;
    }

    public function create()
    {
        if (! auth()->user()->hasPermission('create_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        $this->resetCreateFields();
        $this->showCreateModal = true;
    }

    public function createSubscription()
    {
        $this->validate([
            'createSchoolId' => 'required|exists:schools,id',
            'createPlanId' => 'required|exists:subscription_plans,id',
            'createStartsAt' => 'required|date|before:createEndsAt',
            'createEndsAt' => 'nullable|date|after:createStartsAt',
            'createPrice' => 'required|numeric|min:0',
            'createBillingPeriod' => 'required|in:monthly,yearly',
            'createStatus' => 'required|in:active,trial,expired,cancelled',
            'createMetadata' => 'nullable|string',
        ]);

        $metadata = $this->createMetadata ? json_decode($this->createMetadata, true) : [];

        Subscription::create([
            'school_id' => $this->createSchoolId,
            'subscription_plan_id' => $this->createPlanId,
            'starts_at' => $this->createStartsAt,
            'ends_at' => $this->createEndsAt ?: null,
            'price' => $this->createPrice,
            'billing_period' => $this->createBillingPeriod,
            'status' => $this->createStatus,
            'metadata' => $metadata,
        ]);

        $this->resetCreateFields();
        $this->showCreateModal = false;

        Flux::toast(
            heading: 'Subscription created',
            text: 'The subscription has been successfully created.',
            duration: 3000
        );
    }

    public function edit($subscriptionId)
    {
        if (! auth()->user()->hasPermission('edit_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        $subscription = Subscription::find($subscriptionId);
        if ($subscription) {
            $this->editingSubscription = $subscription;
            $this->editSchoolId = $subscription->school_id;
            $this->editPlanId = $subscription->subscription_plan_id;
            $this->editStartsAt = $subscription->starts_at?->format('Y-m-d');
            $this->editEndsAt = $subscription->ends_at?->format('Y-m-d');
            $this->editPrice = $subscription->price;
            $this->editBillingPeriod = $subscription->billing_period;
            $this->editStatus = $subscription->status;
            $this->editMetadata = $subscription->metadata ? json_encode($subscription->metadata, JSON_PRETTY_PRINT) : '';
            $this->showEditModal = true;
        }
    }

    public function updateSubscription()
    {
        $this->validate([
            'editSchoolId' => 'required|exists:schools,id',
            'editPlanId' => 'required|exists:subscription_plans,id',
            'editStartsAt' => 'required|date|before:editEndsAt',
            'editEndsAt' => 'nullable|date|after:editStartsAt',
            'editPrice' => 'required|numeric|min:0',
            'editBillingPeriod' => 'required|in:monthly,yearly',
            'editStatus' => 'required|in:active,trial,expired,cancelled',
            'editMetadata' => 'nullable|string',
        ]);

        $metadata = $this->editMetadata ? json_decode($this->editMetadata, true) : [];

        $this->editingSubscription->update([
            'school_id' => $this->editSchoolId,
            'subscription_plan_id' => $this->editPlanId,
            'starts_at' => $this->editStartsAt,
            'ends_at' => $this->editEndsAt ?: null,
            'price' => $this->editPrice,
            'billing_period' => $this->editBillingPeriod,
            'status' => $this->editStatus,
            'metadata' => $metadata,
        ]);

        $this->resetEditFields();
        $this->showEditModal = false;

        Flux::toast(
            heading: 'Subscription updated',
            text: 'The subscription has been successfully updated.',
            duration: 3000
        );
    }

    public function delete($subscriptionId)
    {
        if (! auth()->user()->hasPermission('delete_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        $subscription = Subscription::find($subscriptionId);
        if ($subscription) {
            $this->deletingSubscription = $subscription;
            $this->showDeleteModal = true;
        }
    }

    public function confirmDelete()
    {
        if ($this->deletingSubscription) {
            if (! auth()->user()->hasPermission('delete_subscriptions')) {
                abort(403, 'Unauthorized');
            }

            $this->deletingSubscription->delete();
            $this->deletingSubscription = null;
            $this->showDeleteModal = false;

            Flux::toast(
                heading: 'Subscription deleted',
                text: 'The subscription has been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function cancelDelete()
    {
        $this->deletingSubscription = null;
        $this->showDeleteModal = false;
    }

    public function activateSubscription($subscriptionId)
    {
        if (! auth()->user()->hasPermission('edit_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        $subscription = Subscription::find($subscriptionId);
        if ($subscription) {
            $subscription->activate();

            Flux::toast(
                heading: 'Subscription activated',
                text: 'The subscription has been activated.',
                duration: 3000
            );
        }
    }

    public function cancelSubscription($subscriptionId)
    {
        if (! auth()->user()->hasPermission('edit_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        $subscription = Subscription::find($subscriptionId);
        if ($subscription) {
            $subscription->cancel();

            Flux::toast(
                heading: 'Subscription cancelled',
                text: 'The subscription has been cancelled.',
                duration: 3000
            );
        }
    }

    public function bulkDelete()
    {
        if (! auth()->user()->hasPermission('delete_subscriptions')) {
            abort(403, 'Unauthorized');
        }

        if (count($this->selectedSubscriptions) > 0) {
            $deletedCount = count($this->selectedSubscriptions);
            Subscription::whereIn('id', $this->selectedSubscriptions)->delete();
            $this->selectedSubscriptions = [];
            $this->selectAll = false;

            Flux::toast(
                heading: 'Subscriptions deleted',
                text: "{$deletedCount} subscription".($deletedCount > 1 ? 's' : '').' have been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $currentPage = $this->paginators['page'] ?? 1;
            $currentPageSubscriptions = $this->buildSubscriptionQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
            $this->selectedSubscriptions = $currentPageSubscriptions->pluck('id')->toArray();
        } else {
            $this->selectedSubscriptions = [];
        }
    }

    public function updatedSelectedSubscriptions()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $currentPageSubscriptions = $this->buildSubscriptionQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
        $totalCurrentPageSubscriptions = $currentPageSubscriptions->count();
        $this->selectAll = count($this->selectedSubscriptions) === $totalCurrentPageSubscriptions && $totalCurrentPageSubscriptions > 0;
    }

    private function buildSubscriptionQuery()
    {
        return Subscription::with(['school', 'plan'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->whereHas('school', fn ($sq) => $sq->where('name', 'like', '%'.$this->search.'%'))
                        ->orWhereHas('plan', fn ($pq) => $pq->where('name', 'like', '%'.$this->search.'%'));
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->when($this->schoolFilter !== 'all', function ($query) {
                return $query->where('school_id', $this->schoolFilter);
            })
            ->when($this->planFilter !== 'all', function ($query) {
                return $query->where('subscription_plan_id', $this->planFilter);
            })
            ->when($this->billingFilter !== 'all', function ($query) {
                return $query->where('billing_period', $this->billingFilter);
            });
    }

    private function resetCreateFields()
    {
        $this->createSchoolId = '';
        $this->createPlanId = '';
        $this->createStartsAt = Carbon::now()->format('Y-m-d');
        $this->createEndsAt = Carbon::now()->addMonth()->format('Y-m-d');
        $this->createPrice = '';
        $this->createBillingPeriod = 'monthly';
        $this->createStatus = 'active';
        $this->createMetadata = '';
    }

    private function resetEditFields()
    {
        $this->editingSubscription = null;
        $this->editSchoolId = '';
        $this->editPlanId = '';
        $this->editStartsAt = '';
        $this->editEndsAt = '';
        $this->editPrice = '';
        $this->editBillingPeriod = 'monthly';
        $this->editStatus = 'active';
        $this->editMetadata = '';
    }

    public function render()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $subscriptions = $this->buildSubscriptionQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);

        $schools = School::orderBy('name')->get();
        $plans = SubscriptionPlan::active()->orderBy('name')->get();

        return view('livewire.subscriptions.index', compact('subscriptions', 'schools', 'plans'));
    }
}
