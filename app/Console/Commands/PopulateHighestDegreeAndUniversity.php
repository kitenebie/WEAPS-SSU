<?php

namespace App\Console\Commands;

use App\Models\CurriculumVitae;
use Illuminate\Console\Command;

class PopulateHighestDegreeAndUniversity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-highest-degree-and-university';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate highest_degree and university columns for existing curriculum vitae records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to populate highest_degree and university columns...');

        CurriculumVitae::chunk(100, function ($cvs) {
            foreach ($cvs as $cv) {
                $highestDegree = $this->computeHighestDegree($cv);
                $university = $this->computeUniversity($cv);

                $cv->update([
                    'highest_degree' => $highestDegree,
                    'university' => $university,
                ]);
            }
        });

        $this->info('Population completed.');
    }

    private function computeHighestDegree(CurriculumVitae $cv)
    {
        if (!$cv->education || !is_array($cv->education)) {
            return null;
        }

        $bachelorDegrees = array_filter($cv->education, function($edu) {
            return isset($edu['degree']) && stripos($edu['degree'], 'bachelor') !== false;
        });

        if (empty($bachelorDegrees)) {
            return null;
        }

        // Sort by year_graduated descending to get the most recent
        usort($bachelorDegrees, function($a, $b) {
            return ($b['year_graduated'] ?? 0) <=> ($a['year_graduated'] ?? 0);
        });

        return $bachelorDegrees[0]['degree'] ?? null;
    }

    private function computeUniversity(CurriculumVitae $cv)
    {
        if (!$cv->education || !is_array($cv->education)) {
            return null;
        }

        $bachelorDegrees = array_filter($cv->education, function($edu) {
            return isset($edu['degree']) && stripos($edu['degree'], 'bachelor') !== false;
        });

        if (empty($bachelorDegrees)) {
            return null;
        }

        // Sort by year_graduated descending to get the most recent
        usort($bachelorDegrees, function($a, $b) {
            return ($b['year_graduated'] ?? 0) <=> ($a['year_graduated'] ?? 0);
        });

        return $bachelorDegrees[0]['school_name'] ?? null;
    }
}
