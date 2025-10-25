<?php

namespace App\Http\Controllers;

// Import the User model to interact with the users table
use App\Models\User;
// Import Hash facade to hash passwords securely
use Illuminate\Support\Facades\Hash;

class ListController extends Controller
{
    /**
     * Handle the scraping of student data from public/list.html and saving to User model.
     * This method is triggered when accessing the /list.html route.
     */
    public function index()
    {
        // Define the path to the public/list.html file using Laravel's public_path helper
        $filePath = public_path('list.html');
        // Read the entire content of the file into a string
        $content = file_get_contents($filePath);

        // Use regex to extract the JSON data from the script tag in the HTML
        // The pattern matches 'const data = { ... };' and captures the JSON object
        if (preg_match('/const data = ({.*?});/', $content, $matches)) {
            // Extract the JSON string from the matches
            $json = $matches[1];
            // Decode the JSON string into a PHP associative array
            $data = json_decode($json, true);
            // Get the array of students from the decoded data
            $students = $data['students'];

            // Loop through each student in the array
            foreach ($students as $student) {
                // Map the student data fields to variables
                $firstName = $student['firstname']; // Extract first name
                $middleName = $student['middleInitial']; // Extract middle initial
                $lastName = $student['lastname']; // Extract last name
                $email = $student['email']; // Extract email address
                $schoolId = $student['Student Number']; // Extract student number as school ID
                // Construct the full name by concatenating first, middle, and last names, then trim whitespace
                $fullName = trim("$firstName $middleName $lastName");

                // Check if a user already exists with the same first_name, middle_name, last_name, and school_id
                // This prevents duplicate entries based on these unique combinations
                $existingUser = User::where('first_name', $firstName)
                    ->where('middle_name', $middleName)
                    ->where('last_name', $lastName)
                    ->where('school_id', $schoolId)
                    ->first();

                // If no existing user is found, proceed to create a new one
                if (!$existingUser) {
                    // Create a new User record with the mapped data
                    User::create([
                        'name' => $fullName, // Full name for display
                        'first_name' => $firstName, // First name
                        'middle_name' => $middleName, // Middle name
                        'last_name' => $lastName, // Last name
                        'email' => $email, // Email address
                        'password' => Hash::make($email), // Hash the email as password for security
                        'school_id' => $schoolId, // Student number as school ID
                    ]);
                }
                // If existing user is found, skip creation (no action needed)
            }
        }
        // If JSON extraction fails, no data is processed (could add error handling if needed)

        // Return a simple response to confirm the operation
        return response('Data scraped and saved.');
    }
}