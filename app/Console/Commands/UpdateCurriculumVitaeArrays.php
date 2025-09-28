<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateCurriculumVitaeArrays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-curriculum-vitae-arrays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all CurriculumVitae records to ensure array fields are properly cast and initialized';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting update of CurriculumVitae records...');

        \App\Models\CurriculumVitae::all()->each(function ($cv) {
            // Ensure array fields are initialized as arrays
            $cv->skills = $cv->skills ?: [];
            $cv->work_experience = $cv->work_experience ?: [];
            $cv->education = $cv->education ?: [];
            $cv->certifications = $cv->certifications ?: [];
            $cv->awards = $cv->awards ?: [];
            $cv->affiliations = $cv->affiliations ?: [];
            $cv->publications = $cv->publications ?: [];
            $cv->volunteer_work = $cv->volunteer_work ?: [];
            $cv->references = $cv->references ?: [];
            $cv->languages = $cv->languages ?: [];
            $cv->projects = $cv->projects ?: [];

            // Ensure profile_picture is set
            if (!$cv->profile_picture) {
                $cv->profile_picture = 'https://randomuser.me/api/portraits/' . collect(['men', 'women'])->random() . '/' . rand(1, 99) . '.jpg';
            }

            $cv->save();
        });

        $this->info('All CurriculumVitae records have been updated.');
    }
}
