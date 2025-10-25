<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Carrer;

// Update all careers with salary ranges
$careers = Carrer::all();
foreach ($careers as $career) {
    $min_salary = rand(20000, 50000);
    $max_salary = rand(60000, 100000);
    if ($max_salary <= $min_salary) {
        $max_salary = $min_salary + 10000;
    }
    $career->update([
        'min_salary' => $min_salary,
        'max_salary' => $max_salary,
    ]);
}

echo "Salary ranges added to all careers successfully.\n";