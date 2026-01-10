<?php

namespace App\Livewire\SubscriptionPlans;

use App\Models\Module;
use App\Models\SubscriptionPlan;
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

    // Filter properties
    public $statusFilter = 'all'; // all, active, inactive

    public $billingFilter = 'all'; // all, monthly, yearly

    // Selection properties
    public $selectAll = false;

    public $selectedPlans = [];

    // Modal state
    public $showCreateModal = false;

    public $showEditModal = false;

    public $showDeleteModal = false;

    public $showModulesModal = false;

    // Create modal properties
    public $createName = '';

    public $createSlug = '';

    public $createDescription = '';

    public $createPrice = '';

    public $createBillingPeriod = 'monthly';

    public $createMaxUsers = '';

    public $createMaxStorageGb = '';

    public $createIsActive = true;

    public $createSortOrder = 0;

    public $createFeatures = [];

    public $newFeature = '';

    public $createModuleIds = [];

    // Edit modal properties
    public $editingPlan = null;

    public $editName = '';

    public $editSlug = '';

    public $editDescription = '';

    public $editPrice = '';

    public $editBillingPeriod = 'monthly';

    public $editMaxUsers = '';

    public $editMaxStorageGb = '';

    public $editFeatures = [];

    public $editNewFeature = '';

    public $editIsActive = true;

    public $editSortOrder = 0;

    public $editModuleIds = [];

    // Delete confirmation
    public $deletingPlan = null;

    // Modules modal
    public $modulesPlan = null;

    public function updatingSearch()
    {
        $this->paginators['page'] = 1;
    }

    public function updatingStatusFilter()
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
        if (! auth()->user()->hasPermission('create_subscription_plans')) {
            abort(403, 'Unauthorized');
        }

        $this->resetCreateFields();
        $this->showCreateModal = true;
    }

    public function createPlan()
    {
        $this->validate([
            'createName' => 'required|string|max:255',
            'createSlug' => 'required|string|max:255|unique:subscription_plans,slug',
            'createDescription' => 'nullable|string|max:1000',
            'createPrice' => 'required|numeric|min:0',
            'createBillingPeriod' => 'required|in:monthly,yearly',
            'createMaxUsers' => 'nullable|integer|min:0',
            'createMaxStorageGb' => 'nullable|integer|min:0',
            'createIsActive' => 'boolean',
            'createSortOrder' => 'integer|min:0',
            'createModuleIds' => 'array',
        ]);

        $plan = SubscriptionPlan::create([
            'name' => $this->createName,
            'slug' => $this->createSlug,
            'description' => $this->createDescription,
            'price' => $this->createPrice,
            'billing_period' => $this->createBillingPeriod,
            'max_users' => $this->createMaxUsers ?: null,
            'max_storage_gb' => $this->createMaxStorageGb ?: null,
            'features' => $this->createFeatures,
            'is_active' => $this->createIsActive,
            'sort_order' => $this->createSortOrder,
        ]);

        if (! empty($this->createModuleIds)) {
            $plan->assignModules($this->createModuleIds);
        }

        $this->resetCreateFields();
        $this->showCreateModal = false;

        Flux::toast(
            heading: 'Plan created',
            text: 'The subscription plan has been successfully created.',
            duration: 3000
        );
    }

    public function addFeature()
    {
        if (!empty(trim($this->newFeature))) {
            $this->createFeatures[] = trim($this->newFeature);
            $this->newFeature = '';
        }
    }

    public function removeFeature($index)
    {
        if (isset($this->createFeatures[$index])) {
            unset($this->createFeatures[$index]);
            $this->createFeatures = array_values($this->createFeatures);
        }
    }

    public function addEditFeature()
    {
        if (!empty(trim($this->editNewFeature))) {
            $this->editFeatures[] = trim($this->editNewFeature);
            $this->editNewFeature = '';
        }
    }

    public function removeEditFeature($index)
    {
        if (isset($this->editFeatures[$index])) {
            unset($this->editFeatures[$index]);
            $this->editFeatures = array_values($this->editFeatures);
        }
    }

    public function edit($planId)
    {
        if (! auth()->user()->hasPermission('edit_subscription_plans')) {
            abort(403, 'Unauthorized');
        }

        $plan = SubscriptionPlan::with('modules')->find($planId);
        if ($plan) {
            $this->editingPlan = $plan;
            $this->editName = $plan->name;
            $this->editSlug = $plan->slug;
            $this->editDescription = $plan->description;
            $this->editPrice = $plan->price;
            $this->editBillingPeriod = $plan->billing_period;
            $this->editMaxUsers = $plan->max_users;
            $this->editMaxStorageGb = $plan->max_storage_gb;
            $this->editFeatures = $plan->features ?? [];
            $this->editIsActive = $plan->is_active;
            $this->editSortOrder = $plan->sort_order;
            $this->editModuleIds = $plan->modules->pluck('id')->toArray();
            $this->showEditModal = true;
        }
    }

    public function updatePlan()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editSlug' => 'required|string|max:255|unique:subscription_plans,slug,'.$this->editingPlan->id,
            'editDescription' => 'nullable|string|max:1000',
            'editPrice' => 'required|numeric|min:0',
            'editBillingPeriod' => 'required|in:monthly,yearly',
            'editMaxUsers' => 'nullable|integer|min:0',
            'editMaxStorageGb' => 'nullable|integer|min:0',
            'editIsActive' => 'boolean',
            'editSortOrder' => 'integer|min:0',
            'editModuleIds' => 'array',
        ]);

        $this->editingPlan->update([
            'name' => $this->editName,
            'slug' => $this->editSlug,
            'description' => $this->editDescription,
            'price' => $this->editPrice,
            'billing_period' => $this->editBillingPeriod,
            'max_users' => $this->editMaxUsers ?: null,
            'max_storage_gb' => $this->editMaxStorageGb ?: null,
            'features' => $this->editFeatures,
            'is_active' => $this->editIsActive,
            'sort_order' => $this->editSortOrder,
        ]);

        $this->editingPlan->assignModules($this->editModuleIds);

        $this->resetEditFields();
        $this->showEditModal = false;

        Flux::toast(
            heading: 'Plan updated',
            text: 'The subscription plan has been successfully updated.',
            duration: 3000
        );
    }

    public function delete($planId)
    {
        if (! auth()->user()->hasPermission('delete_subscription_plans')) {
            abort(403, 'Unauthorized');
        }

        $plan = SubscriptionPlan::find($planId);
        if ($plan) {
            $this->deletingPlan = $plan;
            $this->showDeleteModal = true;
        }
    }

    public function confirmDelete()
    {
        if ($this->deletingPlan) {
            if (! auth()->user()->hasPermission('delete_subscription_plans')) {
                abort(403, 'Unauthorized');
            }

            $this->deletingPlan->delete();
            $this->deletingPlan = null;
            $this->showDeleteModal = false;

            Flux::toast(
                heading: 'Plan deleted',
                text: 'The subscription plan has been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function cancelDelete()
    {
        $this->deletingPlan = null;
        $this->showDeleteModal = false;
    }

    public function bulkDelete()
    {
        if (! auth()->user()->hasPermission('delete_subscription_plans')) {
            abort(403, 'Unauthorized');
        }

        if (count($this->selectedPlans) > 0) {
            $deletedCount = count($this->selectedPlans);
            SubscriptionPlan::whereIn('id', $this->selectedPlans)->delete();
            $this->selectedPlans = [];
            $this->selectAll = false;

            Flux::toast(
                heading: 'Plans deleted',
                text: "{$deletedCount} plan".($deletedCount > 1 ? 's' : '').' have been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function showModules($planId)
    {
        $plan = SubscriptionPlan::with('modules')->find($planId);
        if ($plan) {
            $this->modulesPlan = $plan;
            $this->showModulesModal = true;
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $currentPage = $this->paginators['page'] ?? 1;
            $currentPagePlans = $this->buildPlanQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
            $this->selectedPlans = $currentPagePlans->pluck('id')->toArray();
        } else {
            $this->selectedPlans = [];
        }
    }

    public function updatedSelectedPlans()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $currentPagePlans = $this->buildPlanQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
        $totalCurrentPagePlans = $currentPagePlans->count();
        $this->selectAll = count($this->selectedPlans) === $totalCurrentPagePlans && $totalCurrentPagePlans > 0;
    }

    private function buildPlanQuery()
    {
        $currentUser = auth()->user();
        $currentUserRole = $currentUser->role;

        return SubscriptionPlan::when($this->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        })->when($this->statusFilter !== 'all', function ($query) {
            return $query->when($this->statusFilter === 'active', fn ($q) => $q->where('is_active', true))
                ->when($this->statusFilter === 'inactive', fn ($q) => $q->where('is_active', false));
        })->when($this->billingFilter !== 'all', function ($query) {
            return $query->where('billing_period', $this->billingFilter);
        })->when($currentUserRole && $currentUserRole->name, function ($query) use ($currentUserRole) {
            // Apply role-based filtering - subscription plans are global but access is restricted by permissions
            if ($currentUserRole->name === 'super_admin') {
                // Super admins can see all plans
                return $query;
            } else {
                // Other roles with subscription plan permissions can see all plans
                // (plans are global, not school-specific)
                return $query;
            }
        })->when(!$currentUserRole || !$currentUserRole->name, function ($query) {
            // Users without roles cannot access subscription plan management
            return $query->whereRaw('1 = 0'); // Return no results
        })->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    private function resetCreateFields()
    {
        $this->createName = '';
        $this->createSlug = '';
        $this->createDescription = '';
        $this->createPrice = '';
        $this->createBillingPeriod = 'monthly';
        $this->createMaxUsers = '';
        $this->createMaxStorageGb = '';
        $this->createFeatures = [];
        $this->newFeature = '';
        $this->createIsActive = true;
        $this->createSortOrder = 0;
        $this->createModuleIds = [];
    }

    private function resetEditFields()
    {
        $this->editingPlan = null;
        $this->editName = '';
        $this->editSlug = '';
        $this->editDescription = '';
        $this->editPrice = '';
        $this->editBillingPeriod = 'monthly';
        $this->editMaxUsers = '';
        $this->editMaxStorageGb = '';
        $this->editFeatures = [];
        $this->editNewFeature = '';
        $this->editIsActive = true;
        $this->editSortOrder = 0;
        $this->editModuleIds = [];
    }

    public function render()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $plans = $this->buildPlanQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
        $modules = Module::orderBy('name')->get();

        return view('livewire.subscription_plans.index', compact('plans', 'modules'));
    }
}
