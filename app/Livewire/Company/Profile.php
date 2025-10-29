<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;
    public $isMe = false;

    // Position form properties
    public $jobTitle;
    public $jobLocation;
    public $jobType;
    public $jobDescription;
    public $minSalary;
    public $maxSalary;
    public $jobTags = []; // array
    public $newTag = '';
    public $startDate;
    public $endDate;
    public $showAddPositionModal = false;
    public $showAddPostModal = false;
    public $postContent = '';
    public $searchTerm = '';

    public function isAllCompanyInformationNotNUll()
    {
        $company = null;

        if (Session::get('company_id')) {
            $company = Company::find(Session::get('company_id'));
        } else {
            $company = Company::where('user_id', Auth::user()->id)->first();
        }

        if (!$company) {
            return false;
        }

        // Define essential company information fields that should not be null
        $essentialFields = [
            'name',
            'type',
            'location',
            'founded_year',
            'employee_count',
            'description',
            'industry',
            'company_size',
            'specialties',
            'website',
            'phone',
            'email',
            'cover_photo',
            'logo',
            'about',
            'Document_Permit',
        ];

        // Check if all essential fields are not null and not empty
        foreach ($essentialFields as $field) {
            if (empty($company->$field)) {
                return false;
            }
        }

        return true;
    }
    public function render()
    {
        if (Session::get('company_id')) {
            $company = Company::find(Session::get('company_id'));
        } else {
            $company = Company::where('user_id', Auth::user()->id)->first();
            $this->isMe = true;
        }

        // Track visitor if not the company owner
        if ($company && Auth::check() && Auth::user()->id !== $company->user_id) {
            \App\Models\RecentVisitor::updateOrCreate(
                [
                    'visitor_id' => Auth::user()->id,
                    'profile_id' => $company->user_id,
                ],
                [
                    'visited_at' => now(),
                ]
            );
        }

        // Get careers with search filter
        $careers = \App\Models\Carrer::where('company_id', $company->id)
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('location', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('role_type', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->get();

        return view('livewire.company.profile', [
            'company' => $company,
            'careers' => $careers,
        ]);
    }

    public function savePosition()
    {
        try {
            // Validate the form data
            $this->validate([
                'jobTitle' => 'required|string|max:255',
                'jobLocation' => 'required|string|max:255',
                'jobType' => 'required|string|in:Full-time,Part-time,Contract,Internship',
                'jobDescription' => 'required|string',
                'minSalary' => 'nullable|numeric|min:0',
                'maxSalary' => 'nullable|numeric|min:0',
                'jobTags' => 'nullable|array',
                'jobTags.*' => 'string',
                'startDate' => 'nullable|date',
                'endDate' => 'nullable|date|after_or_equal:startDate',
            ]);

            // Get the company
            $company = null;
            if (Session::get('company_id')) {
                $company = Company::find(Session::get('company_id'));
            } else {
                $company = Company::where('user_id', Auth::user()->id)->first();
            }

            if (!$company) {
                $this->addError('general', 'Company not found.');
                return;
            }

            // Prepare tags array
            $tags = $this->jobTags ?? [];

            // Create the career
            \App\Models\Carrer::create([
                'company_id' => $company->id,
                'title' => $this->jobTitle,
                'description' => $this->jobDescription,
                'role_type' => $this->jobType,
                'location' => $this->jobLocation,
                'min_salary' => $this->minSalary,
                'max_salary' => $this->maxSalary,
                'tags' => $tags,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
            ]);

            // Reset form fields
            $this->reset(['jobTitle', 'jobLocation', 'jobType', 'jobDescription', 'minSalary', 'maxSalary', 'jobTags', 'newTag', 'startDate', 'endDate']);

            // Dispatch success event for SweetAlert
            $this->dispatch('position-saved', 'Position added successfully!');

            // Close modal
            $this->showAddPositionModal = false;
        } catch (\Exception $e) {
            $this->addError('general', 'An error occurred while saving the position: ' . $e->getMessage());
        }
    }

    public function addTag()
    {
        if (!empty($this->newTag) && !in_array($this->newTag, $this->jobTags)) {
            $this->jobTags[] = $this->newTag;
            $this->newTag = '';
        }
    }

    public function removeTag($index)
    {
        unset($this->jobTags[$index]);
        $this->jobTags = array_values($this->jobTags);
    }

    public function savePost()
    {
        try {
            // Validate the form data
            $this->validate([
                'postContent' => 'required|string|max:1000',
            ]);

            // Get the company
            $company = null;
            if (Session::get('company_id')) {
                $company = Company::find(Session::get('company_id'));
            } else {
                $company = Company::where('user_id', Auth::user()->id)->first();
            }

            if (!$company) {
                $this->addError('general', 'Company not found.');
                return;
            }

            // Create the post
            \App\Models\CompanyPost::create([
                'company_id' => $company->id,
                'content' => $this->postContent,
            ]);

            // Reset form fields
            $this->reset(['postContent']);

            // Dispatch success event for SweetAlert
            $this->dispatch('post-saved', 'Post added successfully!');

            // Close modal
            $this->showAddPostModal = false;
        } catch (\Exception $e) {
            $this->addError('general', 'An error occurred while saving the post: ' . $e->getMessage());
        }
    }
}
