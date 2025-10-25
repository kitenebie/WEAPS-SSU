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
     * Seed career records with specific monthly counts for 2025.
     * Creates career postings distributed across months with varying counts.
     */
    public function run(): void
    {
        // Clear existing career records (avoiding foreign key issues)
        Carrer::query()->delete();

        // Monthly counts for 2025
        $monthlyCounts = [
             1 => 55, // Jan
             2 => 45, // Feb
             3 => 26, // Mar
             5 => 33, // May
             6 => 12, // Jun
             7 => 35, // Jul
             8 => 10, // Aug
             9 => 40, // Sep
             10 => 18, // Oct
             11 => 4, // Nov
             12 => 0, // Dec
         ];

        $role_types = ['Full-time', 'Part-time', 'Contract'];
        $locations = ['Manila', 'Cebu', 'Davao', 'Remote'];
        $companies = Company::all();

        foreach ($monthlyCounts as $month => $count) {
             if ($count == 0) continue; // Skip months with 0 count

             for ($i = 0; $i < $count; $i++) {
                 $company = $companies->random();
                 // Adjust max days based on month
                 $maxDay = match ($month) {
                     2 => 28, // February
                     4, 6, 9, 11 => 30, // April, June, September, November
                     default => 31,
                 };
                 $day = rand(1, $maxDay);
                 $date = Carbon::create(2025, $month, $day);

                Carrer::create([
                    'company_id' => $company->id,
                    'title' => 'Career Position ' . ($i + 1) . ' - ' . Carbon::create(2025, $month, 1)->format('M Y'),
                    'description' => 'Job opportunity in ' . Carbon::create(2025, $month, 1)->format('F Y') . ' for ' . $company->name,
                    'role_type' => $role_types[array_rand($role_types)],
                    'location' => $locations[array_rand($locations)],
                    'tags' => json_encode(['php', 'laravel', 'web-development']),
                    'min_salary' => rand(25000, 60000),
                    'max_salary' => rand(70000, 120000),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
