<?php

namespace App\Http\Controllers;

// Import the User model to interact with the users table
use App\Models\User;
use App\Models\CurriculumVitae;
// Import Hash facade to hash passwords securely
use Illuminate\Support\Facades\Hash;


class ListController extends Controller
{
    /**
     * Handle the scraping of student data from the remote URL and saving to CurriculumVitae model.
     * This method is triggered when accessing the /list.html route.
     */
    public function index()
    {
        // Define the URL to fetch the data from
        $web_page = 'https://weapssorsu-bc.site/list.html';
        // Read the entire content of the file into a string
        $content = file_get_contents($web_page);

        // Use regex to extract student data from HTML paragraphs
        // Extract each field using preg_match_all
        preg_match_all('/<p><strong>Student Number:</strong> (.*?)<\/p>/', $content, $studentNumberMatches);
        preg_match_all('/<p><strong>Sex:</strong> (.*?)<\/p>/', $content, $sexMatches);
        preg_match_all('/<p><strong>Lastname:</strong> (.*?)<\/p>/', $content, $lastnameMatches);
        preg_match_all('/<p><strong>Firstname:</strong> (.*?)<\/p>/', $content, $firstnameMatches);
        preg_match_all('/<p><strong>Middle Initial:</strong> (.*?)<\/p>/', $content, $middleInitialMatches);
        preg_match_all('/<p><strong>Address:</strong> (.*?)<\/p>/', $content, $addressMatches);
        preg_match_all('/<p><strong>Email:</strong> (.*?)<\/p>/', $content, $emailMatches);

        $studentNumbers = $studentNumberMatches[1];
        $sexes = $sexMatches[1];
        $lastnames = $lastnameMatches[1];
        $firstnames = $firstnameMatches[1];
        $middleInitials = $middleInitialMatches[1];
        $addresses = $addressMatches[1];
        $emails = $emailMatches[1];

        // Loop through each student based on the number of student numbers
        $numStudents = count($studentNumbers);

        if ($numStudents > 0) {
            // Loop through each student
            for ($i = 0; $i < $numStudents; $i++) {
                // Map the student data fields to variables
                $firstName = $firstnames[$i]; // Extract first name
                $middleName = $middleInitials[$i]; // Extract middle initial
                $lastName = $lastnames[$i]; // Extract last name
                $email = $emails[$i]; // Extract email address
                $schoolId = $studentNumbers[$i]; // Extract student number as school ID
                $address = $addresses[$i]; // Extract address
                $sex = $sexes[$i]; // Extract sex
                // Construct the full name by concatenating first, middle, and last names, then trim whitespace
                $fullName = trim("$firstName $middleName $lastName");

                // Check if a user already exists with the same first_name, middle_name, last_name, and school_id
                // This prevents duplicate entries based on these unique combinations
                $existingUser = User::where('first_name', $firstName)
                    ->where('middle_name', $middleName)
                    ->where('last_name', $lastName)
                    ->where('school_id', $schoolId)
                    ->first();

                // If no existing user is found, create a new one
                if (!$existingUser) {
                    $existingUser = User::create([
                        'name' => $fullName, // Full name for display
                        'first_name' => $firstName, // First name
                        'middle_name' => $middleName, // Middle name
                        'last_name' => $lastName, // Last name
                        'email' => $email, // Email address
                        'password' => Hash::make($email), // Hash the email as password for security
                        'school_id' => $schoolId, // Student number as school ID
                    ]);
                }

                // Check if a CV already exists with the same first_name, middle_name, last_name, and School_id
                $existingCv = CurriculumVitae::where('first_name', $firstName)
                    ->where('middle_name', $middleName)
                    ->where('last_name', $lastName)
                    ->where('School_id', $schoolId)
                    ->first();

                // If no existing CV is found, create a new one linked to the user
                if (!$existingCv) {
                    CurriculumVitae::create([
                        'user_id' => $existingUser->id, // Link to the user
                        'first_name' => $firstName, // First name
                        'middle_name' => $middleName, // Middle name
                        'last_name' => $lastName, // Last name
                        'email' => $email, // Email address
                        'address' => $address, // Address
                        'School_id' => $schoolId, // Student number as School ID
                        'isActive' => true, // Set as active
                    ]);
                }
                // If existing CV is found, skip creation (no action needed)
            }
        }
        // If no students found, no data is processed (could add error handling if needed)

        // Return a simple response to confirm the operation
        return response('Data scraped and saved.');
    }
}