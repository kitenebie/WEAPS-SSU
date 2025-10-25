<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\Carrer;

// Update all careers with salary ranges
$careers = Carrer::all();
foreach ($careers as $career) {
    $career->update([
        'isActive' =>true,
        'isAdminVerified' => true,
    ]);
}

echo "Company active added to all careers successfully.\n";