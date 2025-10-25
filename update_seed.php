<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Carrer;
use App\Models\Company;
use Carbon\Carbon;

$role_types = ['Full-time', 'Part-time', 'Contract'];
$locations = ['Manila', 'Cebu', 'Davao', 'Remote'];

// Update existing careers (assign random month in 2025)
$careers = Carrer::all();
foreach ($careers as $career) {
    $month = rand(1, 12);
    $year = 2025;
    $day = rand(1, 28);
    $date = Carbon::create($year, $month, $day);
    $career->update([
        'created_at' => $date,
        'updated_at' => $date,
    ]);
}

// Add 50 more careers per company (ensure months from Jan–Dec 2025 are covered)
$companies = Company::all();
foreach ($companies as $company) {
    for ($j = 1; $j <= 50; $j++) {
        // Cycle through months evenly so all months appear
        $month = (($j - 1) % 12) + 1; // 1–12 repeating pattern
        $year = 2025;
        $day = rand(1, 28);
        $date = Carbon::create($year, $month, $day);
        echo $date . PHP_EOL;
        $min_salary = rand(20000, 50000);
        $max_salary = rand(60000, 100000);
        if ($max_salary <= $min_salary) {
            $max_salary = $min_salary + 10000;
        }
        Carrer::create([
            'company_id' => $company->id,
            'title' => 'Additional Career ' . $j . ' - ' . $company->industry,
            'description' => 'Additional description for career ' . $j,
            'role_type' => $role_types[array_rand($role_types)],
            'location' => $locations[array_rand($locations)],
            'tags' => ['tag1', 'tag2'],
            'created_at' => $date,
            'updated_at' => $date,
            'isActive' => true,
            'isAdminVerified' => true,
            'min_salary' => $min_salary,
            'max_salary' => $max_salary,
        ]);
    }
}

echo "✅ Update and addition completed successfully. All months (Jan–Dec 2025) covered.\n";
