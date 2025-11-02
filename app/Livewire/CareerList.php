<?php

namespace App\Livewire;

use App\Models\Carrer;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CareerList extends Component
{
    public $careers;
    public $selectedCareer;
    public $search = '';
    public $location_filter = '';
    public $role_type_filter = '';
    public $salary_range_filter = '';

    public function mount()
    {
        $this->loadCareers();
    }

    public function loadCareers()
    {
        $query = Carrer::with('company')
            ->whereHas('company', function ($q) {
                $q->where('isAdminVerified', true);
            });

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('company', function ($companyQuery) {
                        $companyQuery->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Apply location filter
        if ($this->location_filter) {
            $query->where('location', 'like', '%' . $this->location_filter . '%');
        }

        // Apply role type filter
        if ($this->role_type_filter) {
            $query->where('role_type', $this->role_type_filter);
        }

        // Apply salary range filter
        if ($this->salary_range_filter) {
            $ranges = [
                '5k-10k' => [5000, 10000],
                '11k-15k' => [11000, 15000],
                '16k-20k' => [16000, 20000],
                '21k-25k' => [21000, 25000],
                '26k-30k' => [26000, 30000],
                '31k-35k' => [31000, 35000],
                '36k-40k' => [36000, 40000],
                '41k-45k' => [41000, 45000],
                '46k-50k' => [46000, 50000],
                '51k-60k' => [51000, 60000],
                '61k-70k' => [61000, 70000],
                '71k-80k' => [71000, 80000],
                '81k-90k' => [81000, 90000],
                '91k-100k' => [91000, 100000],
                '101k-125k' => [101000, 125000],
                '126k-150k' => [126000, 150000],
                '151k-500k' => [151000, 500000],
            ];

            if (isset($ranges[$this->salary_range_filter])) {
                [$min, $max] = $ranges[$this->salary_range_filter];
                $query->where(function ($q) use ($min, $max) {
                    $q->where(function ($subQ) use ($min, $max) {
                        $subQ->where('min_salary', '>=', $min)
                            ->where('min_salary', '<=', $max);
                    })
                        ->orWhere(function ($subQ) use ($min, $max) {
                            $subQ->where('max_salary', '>=', $min)
                                ->where('max_salary', '<=', $max);
                        })
                        ->orWhere(function ($subQ) use ($min, $max) {
                            $subQ->where('min_salary', '<=', $min)
                                ->where('max_salary', '>=', $max);
                        });
                });
            }
        }

        $this->careers = $query->orderBy('created_at', 'desc')->get();

        // Check if user has saved or applied to each career
        $userId = \Illuminate\Support\Facades\Auth::id();
        if ($userId) {
            foreach ($this->careers as $career) {
                $career->is_saved = \App\Models\SaveCareer::where('user_id', $userId)->where('carrer_id', $career->id)->exists();
                $career->is_applied = \App\Models\Applicant::where('user_id', $userId)->where('carrer_id', $career->id)->exists();
            }
        }
    }

    public function openCareer($careerId)
    {
        return redirect()->route('career.details', $careerId);
    }
    public function openCampany($companyId)
    {
        Session::put('company_id', $companyId);
        return redirect('/Company%20Profile');
    }
    public function clearFilters()
    {
        $this->search = '';
        $this->location_filter = '';
        $this->role_type_filter = '';
        $this->salary_range_filter = '';
        $this->loadCareers();
    }

    public function updatedSearch()
    {
        $this->loadCareers();
    }

    public function updatedLocationFilter()
    {
        $this->loadCareers();
    }

    public function updatedRoleTypeFilter()
    {
        $this->loadCareers();
    }

    public function updatedSalaryRangeFilter()
    {
        $this->loadCareers();
    }

    public function render()
    {
        return view('livewire.career-list');
    }
}
