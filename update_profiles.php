<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\CurriculumVitae;

$records = CurriculumVitae::all();
$updated = 0;

foreach ($records as $cv) {
    $fullname = strtolower($cv->fullname);
    $isFemale = str_ends_with($fullname, 'a') || str_contains($fullname, 'maria');
    $gender = $isFemale ? 'women' : 'men';
    $url = "https://randomuser.me/api/portraits/{$gender}/{$cv->id}.jpg";
    $cv->update(['profile_picture' => $url]);
    $updated++;
}

echo "Updated {$updated} records.\n";