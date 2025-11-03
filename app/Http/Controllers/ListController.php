<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\User;
use App\Models\CurriculumVitae;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ListController extends Controller
{
    protected $url;

    public function __construct()
    {
        $this->url = 'https://weapssorsu-bc.site/list.html';
    }

    /**
     * Scrape and save students automatically
     */
    public function index(Request $request)
    {
        // Automatically scrape and save
        $result = $this->scrapeAndSave();
        
        // Return JSON if requested
        if ($request->expectsJson() || $request->has('json')) {
            return response()->json($result);
        }

        // Return view with results
        return response()->json([
            'result' => $result,
            'success' => $result['success'],
            'error' => $result['error'] ?? null,
            'stats' => $result['stats'] ?? [],
            'message' => $result['message'] ?? null
        ]);
    }

    /**
     * Scrape students data from the webpage using Guzzle
     */
    protected function scrapeStudents()
    {
        try {
            // Create Guzzle HTTP client
            $client = new Client([
                'timeout' => 30,
                'verify' => false, // Set to true in production with proper SSL
            ]);

            // Fetch the HTML content
            $response = $client->get($this->url);
            
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('Failed to fetch the webpage');
            }

            $html = $response->getBody()->getContents();

            // Extract JSON data from the script tag
            $students = $this->extractStudentsFromScript($html);

            return [
                'success' => true,
                'data' => $students,
                'count' => count($students)
            ];

        } catch (RequestException $e) {
            Log::error('Student scraping failed (Guzzle): ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => 'Failed to fetch data: ' . $e->getMessage(),
                'data' => [] 
            ];
        } catch (\Exception $e) {
            Log::error('Student scraping failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    /**
     * Extract students data from JavaScript in the HTML
     */
    protected function extractStudentsFromScript($html)
    {
        // Pattern to match the data object in the script
        $pattern = '/const data = ({[\s\S]*?});/';
        
        if (preg_match($pattern, $html, $matches)) {
            // Get the JSON string
            $jsonString = $matches[1];
            
            // Decode the JSON
            $data = json_decode($jsonString, true);
            
            if (isset($data['students'])) {
                return $data['students'];
            }
        }

        return [];
    }

    /**
     * Scrape and save students to database
     */
    protected function scrapeAndSave()
    {
        $result = $this->scrapeStudents();
        
        if (!$result['success']) {
            return [
                'success' => false,
                'error' => $result['error'],
                'stats' => [
                    'total' => 0,
                    'new_users' => 0,
                    'existing_users' => 0,
                    'new_cvs' => 0,
                    'existing_cvs' => 0,
                    'errors' => 0
                ]
            ];
        }

        $stats = [
            'total' => count($result['data']),
            'data' => $result['data'],
            'new_users' => 0,
            'existing_users' => 0,
            'new_cvs' => 0,
            'existing_cvs' => 0,
            'errors' => 0
        ];

        DB::beginTransaction();

        try {
            foreach ($result['data'] as $student) {
                try {
                    $this->saveStudent($student, $stats);
                } catch (\Exception $e) {
                    $stats['errors']++;
                    Log::error('Failed to save student: ' . $e->getMessage(), [
                        'student' => $student
                    ]);
                }
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Students scraped and saved successfully',
                'stats' => $stats
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'stats' => $stats
            ];
        }
    }

    /**
     * Save individual student to database
     */
    protected function saveStudent($student, &$stats)
    {
        // Parse the name
        $firstName = $student['firstname'];
        $middleName = $student['middleInitial'];
        $lastName = $student['lastname'];
        $Sex = $student['Sex'];
        $fullName = trim("{$firstName} {$middleName} {$lastName}");
        
        // Get other data
        $email = $student['email'];
        $address = $student['address'];
        $studentNumber = $student['StudentNumber']; // Get student number

        // Check if User already exists
        $existingUser = User::where('first_name', $firstName)
            ->where('middle_name', $middleName)
            ->where('last_name', $lastName)
            ->first();

        if (!$existingUser) {
            $existingUser = User::create([
                'name' => $fullName,
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'email' => $email,
                'gender' =>  $Sex,
                'password' => Hash::make($email),
                'School_id' => $studentNumber, // Save student number to school_id
            ]);
            $stats['new_users']++;
        } else {
            $stats['existing_users']++;
        }

        // Check if CV already exists
        $existingCv = CurriculumVitae::where('first_name', $firstName)
            ->where('middle_name', $middleName)
            ->where('last_name', $lastName)
            ->first();

        if (!$existingCv) {
            CurriculumVitae::create([
                'user_id' => $existingUser->id,
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'email' => $email,
                'address' => $address,
                'School_id' => $studentNumber, // Save student number to School_id
                'isActive' => false,
            ]);
            $stats['new_cvs']++;
        } else {
            $stats['existing_cvs']++;
        }
    }
}