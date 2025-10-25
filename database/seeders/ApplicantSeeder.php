<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Carrer;
use Carbon\Carbon;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing applicants
        Applicant::truncate();

        // Get users who have CVs with isAiValidate = true
        $userIds = DB::table('curriculum_vitaes')->where('isAiValidate', true)->pluck('user_id')->unique();

        if ($userIds->isEmpty()) {
            return;
        }

        $companies = Company::all();
        $careers = Carrer::all();
        $statuses = ['pending', 'approved', 'rejected'];

        // Monthly counts
        $monthlyCounts = [
            1 => 4,  // Jan
            2 => 7,  // Feb
            3 => 0,  // Mar
            4 => 5,  // Apr
            5 => 3,  // May
            6 => 8,  // Jun
            7 => 2,  // Jul
            8 => 6,  // Aug
            9 => 1,  // Sep
            10 => 9, // Oct
            11 => 0, // Nov
            12 => 0, // Dec
        ];

        foreach ($monthlyCounts as $month => $count) {
            for ($i = 0; $i < $count; $i++) {
                $userId = $userIds->random();
                $day = rand(1, 28);
                $date = Carbon::create(2025, $month, $day);

                Applicant::create([
                    'user_id' => $userId,
                    'company_id' => $companies->random()->id,
                    'career_id' => $careers->random()->id,
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
