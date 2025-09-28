<?php

namespace Database\Seeders;

use App\Models\CurriculumVitae;
use Illuminate\Database\Seeder;

class CurriculumVitaeSeeder extends Seeder
{
    public function run(): void
    {
        $degrees = [
            'BS in Computer Science' => 31,
            'BS in Information Technology' => 164,
            'BS in Information System' => 74,
            'BS in Accountancy' => 22,
            'BS in Accounting Information System' => 56,
            'BS in Entrepreneurship (BS Entrep)' => 84,
            'Bachelor of Public Administration' => 78,
        ];

        foreach ($degrees as $degree => $count) {
            CurriculumVitae::factory()->count($count)->create([
                'highest_degree' => $degree,
                'university' => 'Sorsogon State University',
            ]);
        }
    }
}