<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use App\Models\User;
use App\Models\Company;
use App\Models\Carrer;

$industries = ['IT', 'Accounting', 'Business', 'BPO', 'Factory'];
$role_types = ['Full-time', 'Part-time', 'Contract'];
$locations = ['Manila', 'Cebu', 'Davao', 'Remote'];

for ($i = 1; $i <= 10; $i++) {
    $user = User::create([
        'name' => 'User ' . $i,
        'email' => 'user' . $i . '@example.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
    ]);

    $industry = $industries[array_rand($industries)];
    $company = Company::create([
        'user_id' => $user->id,
        'name' => $industry . ' Company ' . $i,
        'type' => 'Private',
        'location' => $locations[array_rand($locations)],
        'industry' => $industry,
        'description' => 'A company in ' . $industry,
    ]);
}

echo "Seeding completed successfully.\n";