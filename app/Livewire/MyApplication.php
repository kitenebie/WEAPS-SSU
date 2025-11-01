<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SaveCareer;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;

class MyApplication extends Component
{
    use WithPagination;

    public $savedSearch = '';
    public $appliedSearch = '';
    public $activeTab = 'saved';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        // Initialize component
    }

    public function removeSavedCareer($saveCareerId)
    {
        $saveCareer = SaveCareer::find($saveCareerId);

        if ($saveCareer && $saveCareer->user_id === Auth::id()) {
            $saveCareer->delete();
            session()->flash('message', 'Career removed from saved list.');
        }
    }

    public function viewSavedCareer($careerId)
    {
        // Redirect to career details page
        return redirect()->route('career.details', $careerId);
    }

    public function viewAppliedCareer($careerId)
    {
        // Redirect to career details page
        return redirect()->route('career.details', $careerId);
    }

    public function getSavedCareersProperty()
    {
        return SaveCareer::where('user_id', Auth::id())
            ->with(['career.company'])
            ->whereHas('career', function ($query) {
                $query->where('title', 'like', '%' . $this->savedSearch . '%')
                      ->orWhere('description', 'like', '%' . $this->savedSearch . '%');
            })
            ->paginate(10, ['*'], 'saved_page');
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function getAppliedCareersProperty()
    {
        return Applicant::where('user_id', Auth::id())
            ->with(['career.company'])
            ->whereHas('career', function ($query) {
                $query->where('title', 'like', '%' . $this->appliedSearch . '%')
                      ->orWhere('description', 'like', '%' . $this->appliedSearch . '%');
            })
            ->paginate(10, ['*'], 'applied_page');
    }

    public function render()
    {
        return view('livewire.my-application', [
            'savedCareers' => $this->savedCareers,
            'appliedCareers' => $this->appliedCareers,
        ]);
    }
}