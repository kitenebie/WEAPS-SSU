<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;

// Update all careers with salary ranges
$careers = User::all();
foreach ($careers as $career) {
    $career->update([
        'email_verified_at' =>now(),
    ]);
}

echo "Company active added to all careers successfully.\n";