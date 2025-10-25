<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrer;
use App\Models\Company;
use Carbon\Carbon;

class CarrerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all careers except id=4
        Carrer::where('id', '!=', 4)->delete();

        // Monthly counts
        $monthlyCounts = [
            1 => 21, // Jan
            2 => 34, // Feb
            3 => 45, // Mar
            4 => 8,  // Apr
            5 => 46, // May
            6 => 27, // Jun
            7 => 10, // Jul
            8 => 47, // Aug
            9 => 3,  // Sep
            10 => 29, // Oct
        ];

        $role_types = ['Full-time', 'Part-time', 'Contract'];
        $locations = ['Manila', 'Cebu', 'Davao', 'Remote'];
        $companies = Company::all();

        foreach ($monthlyCounts as $month => $count) {
            for ($i = 0; $i < $count; $i++) {
                $company = $companies->random();
                $day = rand(1, 28);
                $date = Carbon::create(2025, $month, $day);

                Carrer::create([
                    'company_id' => $company->id,
                    'title' => 'Career ' . ($i + 1) . ' - ' . $company->industry,
                    'description' => 'Description for career in ' . Carbon::create(2025, $month, 1)->format('F'),
                    'role_type' => $role_types[array_rand($role_types)],
                    'location' => $locations[array_rand($locations)],
                    'tags' => json_encode(['tag1', 'tag2']),
                    'min_salary' => rand(20000, 50000),
                    'max_salary' => rand(60000, 100000),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
