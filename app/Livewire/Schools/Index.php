<?php

namespace App\Livewire\Schools;

use App\Models\School;
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

    // Selection properties
    public $selectAll = false;

    public $selectedSchools = [];

    // Modal state
    public $showCreateModal = false;

    public $showEditModal = false;

    public $showDeleteModal = false;

    // Create modal properties
    public $createName = '';

    public $createDomain = '';

    public $createAddress = '';

    public $createPhone = '';

    public $createEmail = '';

    public $createDescription = '';

    public $createLogo = '';

    public $createIsActive = true;

    public $createSettings = '';

    // Edit modal properties
    public $editingSchool = null;

    public $editName = '';

    public $editDomain = '';

    public $editAddress = '';

    public $editPhone = '';

    public $editEmail = '';

    public $editDescription = '';

    public $editLogo = '';

    public $editIsActive = true;

    public $editSettings = '';

    // Delete confirmation
    public $deletingSchool = null;

    public $schoolId = null;

    public function mount()
    {
        // Check URL parameters for pre-filtering
        $this->schoolId = request()->query('school_id');

        if ($this->schoolId) {
            // If a specific school is requested, we can filter by ID
            // Since we don't have a direct ID filter in the UI (only search),
            // we can either add one or just use the ID to find the school and set the search
            $school = School::find($this->schoolId);
            if ($school) {
                $this->search = $school->name;
            }
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
        if (! auth()->user()->hasPermission('create_schools')) {
            abort(403, 'Unauthorized');
        }

        $this->createName = '';
        $this->createDomain = '';
        $this->createAddress = '';
        $this->createPhone = '';
        $this->createEmail = '';
        $this->createDescription = '';
        $this->createLogo = '';
        $this->createIsActive = true;
        $this->createSettings = '';
        $this->showCreateModal = true;
    }

    public function createSchool()
    {
        $this->validate([
            'createName' => 'required|string|max:255',
            'createDomain' => 'nullable|string|max:255|unique:schools,domain',
            'createAddress' => 'nullable|string|max:500',
            'createPhone' => 'nullable|string|max:20',
            'createEmail' => 'nullable|email|max:255',
            'createDescription' => 'nullable|string|max:1000',
            'createLogo' => 'nullable|url|max:500',
            'createIsActive' => 'boolean',
            'createSettings' => 'nullable|string',
        ]);

        $settings = $this->createSettings ? json_decode($this->createSettings, true) : [];

        School::create([
            'name' => $this->createName,
            'domain' => $this->createDomain,
            'address' => $this->createAddress,
            'phone' => $this->createPhone,
            'email' => $this->createEmail,
            'description' => $this->createDescription,
            'logo' => $this->createLogo,
            'is_active' => $this->createIsActive,
            'settings' => $settings,
        ]);

        $this->resetCreateFields();
        $this->showCreateModal = false;

        Flux::toast(
            heading: 'School created',
            text: 'The school has been successfully created.',
            duration: 3000
        );
    }

    public function edit($schoolId)
    {
        if (! auth()->user()->hasPermission('edit_schools')) {
            abort(403, 'Unauthorized');
        }

        $school = School::find($schoolId);
        if ($school) {
            $this->editingSchool = $school;
            $this->editName = $school->name;
            $this->editDomain = $school->domain;
            $this->editAddress = $school->address;
            $this->editPhone = $school->phone;
            $this->editEmail = $school->email;
            $this->editDescription = $school->description;
            $this->editLogo = $school->logo;
            $this->editIsActive = (bool) $school->is_active; // Cast to bool for checkbox
            $this->editSettings = $school->settings ? json_encode($school->settings, JSON_PRETTY_PRINT) : '';
            $this->showEditModal = true;
        }
    }

    public function updateSchool()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editDomain' => 'nullable|string|max:255|unique:schools,domain,'.$this->editingSchool->id,
            'editAddress' => 'nullable|string|max:500',
            'editPhone' => 'nullable|string|max:20',
            'editEmail' => 'nullable|email|max:255',
            'editDescription' => 'nullable|string|max:1000',
            'editLogo' => 'nullable|url|max:500',
            'editIsActive' => 'boolean',
            'editSettings' => 'nullable|string',
        ]);

        $settings = $this->editSettings ? json_decode($this->editSettings, true) : [];

        $this->editingSchool->update([
            'name' => $this->editName,
            'domain' => $this->editDomain,
            'address' => $this->editAddress,
            'phone' => $this->editPhone,
            'email' => $this->editEmail,
            'description' => $this->editDescription,
            'logo' => $this->editLogo,
            'is_active' => $this->editIsActive,
            'settings' => $settings,
        ]);

        $this->resetEditFields();
        $this->showEditModal = false;

        Flux::toast(
            heading: 'School updated',
            text: 'The school information has been successfully updated.',
            duration: 3000
        );
    }

    public function delete($schoolId)
    {
        if (! auth()->user()->hasPermission('delete_schools')) {
            abort(403, 'Unauthorized');
        }

        $school = School::find($schoolId);
        if ($school) {
            $this->deletingSchool = $school;
            $this->showDeleteModal = true;
        }
    }

    public function confirmDelete()
    {
        if ($this->deletingSchool) {
            if (! auth()->user()->hasPermission('delete_schools')) {
                abort(403, 'Unauthorized');
            }

            $this->deletingSchool->delete();
            $this->deletingSchool = null;
            $this->showDeleteModal = false;

            Flux::toast(
                heading: 'School deleted',
                text: 'The school has been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function cancelDelete()
    {
        $this->deletingSchool = null;
        $this->showDeleteModal = false;
    }

    public function bulkDelete()
    {
        if (! auth()->user()->hasPermission('delete_schools')) {
            abort(403, 'Unauthorized');
        }

        if (count($this->selectedSchools) > 0) {
            $deletedCount = count($this->selectedSchools);
            School::whereIn('id', $this->selectedSchools)->delete();
            $this->selectedSchools = [];
            $this->selectAll = false;

            Flux::toast(
                heading: 'Schools deleted',
                text: "{$deletedCount} school".($deletedCount > 1 ? 's' : '').' have been successfully deleted.',
                duration: 3000
            );
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $currentPage = $this->paginators['page'] ?? 1;
            $currentPageSchools = $this->buildSchoolQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
            $this->selectedSchools = $currentPageSchools->pluck('id')->toArray();
        } else {
            $this->selectedSchools = [];
        }
    }

    public function updatedSelectedSchools()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $currentPageSchools = $this->buildSchoolQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);
        $totalCurrentPageSchools = $currentPageSchools->count();
        $this->selectAll = count($this->selectedSchools) === $totalCurrentPageSchools && $totalCurrentPageSchools > 0;
    }

    private function buildSchoolQuery()
    {
        $currentUser = auth()->user();
        $currentUserRole = $currentUser->role;

        return School::when($this->search, function ($query) {
            return $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        })->when($this->statusFilter !== 'all', function ($query) {
            return $query->when($this->statusFilter === 'active', fn ($q) => $q->where('is_active', true))
                ->when($this->statusFilter === 'inactive', fn ($q) => $q->where('is_active', false));
        })->when($currentUserRole && $currentUserRole->name, function ($query) use ($currentUserRole, $currentUser) {
            // Apply role-based filtering with school scoping
            if ($currentUserRole->name === 'super_admin') {
                // Super admins can see all schools (no school restriction)
                return $query;
            } elseif ($currentUserRole->name === 'admin') {
                // School admins can only see their own school
                return $query->where('id', $currentUser->school_id);
            } else {
                // Other roles cannot access schools management
                return $query->whereRaw('1 = 0'); // Return no results
            }
        })->when(!$currentUserRole || !$currentUserRole->name, function ($query) {
            // Users without roles cannot access schools management
            return $query->whereRaw('1 = 0'); // Return no results
        });
    }

    private function resetCreateFields()
    {
        $this->createName = '';
        $this->createDomain = '';
        $this->createAddress = '';
        $this->createPhone = '';
        $this->createEmail = '';
        $this->createDescription = '';
        $this->createLogo = '';
        $this->createIsActive = true;
        $this->createSettings = '';
    }

    private function resetEditFields()
    {
        $this->editingSchool = null;
        $this->editName = '';
        $this->editDomain = '';
        $this->editAddress = '';
        $this->editPhone = '';
        $this->editEmail = '';
        $this->editDescription = '';
        $this->editLogo = '';
        $this->editIsActive = true;
        $this->editSettings = '';
    }

    public function render()
    {
        $currentPage = $this->paginators['page'] ?? 1;
        $schools = $this->buildSchoolQuery()->paginate($this->perPage, ['*'], 'page', $currentPage);

        return view('livewire.schools.index', compact('schools'));
    }
}
