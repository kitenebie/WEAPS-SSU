<?php

namespace App\Console\Commands;

use App\Models\CurriculumVitae;
use Faker\Factory as Faker;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportGraduates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-graduates {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import graduates from Excel file and generate dummy CV data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file') ?? 'C:\Users\kenne\Downloads\PDFS\all_graduates.xlsx';

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        $this->info('Reading Excel file...');

        $data = Excel::toArray([], $filePath)[0]; // Assuming first sheet

        $faker = Faker::create();

        $count = 0;
        foreach ($data as $row) {
            $fullName = $row[0] ?? ''; // Assuming first column is full name
            if (empty($fullName)) continue;

            $parsedName = $this->parseName($fullName);

            $cvData = [
                'first_name' => $parsedName['first_name'],
                'last_name' => $parsedName['last_name'],
                'middle_name' => $parsedName['middle_name'],
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'job_title' => $faker->jobTitle,
                'summary' => $faker->paragraph,
                'highest_degree' => $faker->randomElement(['Bachelor', 'Master', 'PhD']),
                'university' => $faker->company . ' University',
                'graduation_year' => $faker->numberBetween(2000, 2023),
                'years_of_experience' => $faker->numberBetween(0, 30),
                'skills' => [$faker->word, $faker->word, $faker->word],
                'work_experience' => [$faker->sentence, $faker->sentence],
                'education' => [$faker->sentence, $faker->sentence],
                'certifications' => [$faker->word . ' Certification'],
                'awards' => [$faker->word . ' Award'],
                'affiliations' => [$faker->company],
                'publications' => [$faker->sentence],
                'volunteer_work' => [$faker->sentence],
                'references' => [$faker->name . ' - ' . $faker->phoneNumber],
                'linkedin_url' => 'https://linkedin.com/in/' . strtolower(str_replace(' ', '', $fullName)),
                'github_url' => 'https://github.com/' . strtolower(str_replace(' ', '', $parsedName['first_name'] . $parsedName['last_name'])),
                'portfolio_url' => 'https://portfolio.com/' . strtolower(str_replace(' ', '', $parsedName['first_name'] . $parsedName['last_name'])),
            ];

            CurriculumVitae::create($cvData);
            $count++;
        }

        $this->info("Imported {$count} graduates successfully.");
    }

    private function parseName(string $fullName): array
    {
        // Assuming format: "Lastname, Firstname Middlename"
        $parts = explode(',', $fullName);
        if (count($parts) !== 2) {
            return ['first_name' => '', 'last_name' => $fullName, 'middle_name' => ''];
        }

        $lastName = trim($parts[0]);
        $firstMiddle = trim($parts[1]);
        $nameParts = explode(' ', $firstMiddle);

        $firstName = $nameParts[0] ?? '';
        $middleName = implode(' ', array_slice($nameParts, 1));

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
        ];
    }
}
