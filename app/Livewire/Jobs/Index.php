<?php

namespace App\Livewire\Jobs;

use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $jobs = [];
    public $loading = true;

    protected $listeners = ['jobsUpdated' => 'updateJobs'];

    public function mount()
    {
        $this->loadJobs();
    }

    public function updatedSearch()
    {
        // Search functionality will be handled by Alpine.js in the frontend
        $this->dispatch('searchUpdated', $this->search);
    }

    public function loadJobs()
    {
        $this->loading = true;
        // You can add server-side job loading logic here if needed
        $this->loading = false;
    }

    public function updateJobs($jobs)
    {
        $this->jobs = $jobs;
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.jobs.index');
    }
}