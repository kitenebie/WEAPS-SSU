<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CurriculumVitae;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    /**
     * Get inactive resumes with specific fields
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function inActiveResume(Request $request): JsonResponse
    {
        try {
            // Check if user is authenticated
            // if (!Auth::check()) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Unauthorized. Please log in to access this resource.',
            //         'error' => 'authentication_required'
            //     ], 401);
            // }

            // Validate request parameters if needed
            $validator = Validator::make($request->all(), [
                // Add any additional validation rules here if needed
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid request parameters.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Query inactive resumes with specific fields, filtering out null images
            $inactiveResumes = CurriculumVitae::where('isActive', false)
                ->where(function ($query) {
                    $query->whereNotNull('profile_picture')
                          ->orWhereNotNull('front_id')
                          ->orWhereNotNull('back_id');
                })
                ->select([
                    'user_id',
                    'first_name',
                    'last_name',
                    'middle_name',
                    'profile_picture',
                    'front_id',
                    'back_id'
                ])
                ->get();

            // Check if any inactive resumes found
            if ($inactiveResumes->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No inactive resumes found.',
                    'data' => [],
                    'count' => 0
                ], 200);
            }

            // Generate internet-accessible image URLs
            $processedResumes = $inactiveResumes->map(function ($resume) {
                $processed = $resume->toArray();

                // Generate signed URL for profile picture if exists (30 days expiration)
                if (!empty($resume->profile_picture)) {
                    $processed['profile_picture'] = URL::signedRoute('private.file', ['path' => $resume->profile_picture], now()->addDays(30));
                }

                // Generate signed URL for front ID if exists (30 days expiration)
                if (!empty($resume->front_id)) {
                    $processed['front_id'] = URL::signedRoute('private.file', ['path' => $resume->front_id], now()->addDays(30));
                }

                // Generate signed URL for back ID if exists (30 days expiration)
                if (!empty($resume->back_id)) {
                    $processed['back_id'] = URL::signedRoute('private.file', ['path' => $resume->back_id], now()->addDays(30));
                }

                return $processed;
            });

            return response()->json([
                'success' => true,
                'message' => 'Inactive resumes retrieved successfully.',
                'data' => $processedResumes,
                'count' => $processedResumes->count()
            ], 200);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error retrieving inactive resumes: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving inactive resumes.',
                'error' => 'internal_server_error'
            ], 500);
        }
    }

    /**
     * Handle API verification requests
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function apiVerification(Request $request): JsonResponse
    {
        try {
            Log::info('Verification', $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Verification logged successfully.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error in API verification: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred during verification.',
                'error' => 'internal_server_error'
            ], 500);
        }
    }

}