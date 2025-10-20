<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyReviewController extends Controller
{

    /**
     * Store a new review for a company.
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // For testing purposes, allow unauthenticated requests
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Authentication required to submit reviews.',
            // ], 401);
            $userId = 1; // Use a default user ID for testing
        } else {
            $userId = Auth::id();
        }

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
            'is_anonymous' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $userId = Auth::id();
        $companyId = $request->company_id;

        // Debug logging
        Log::info('Review submission attempt', [
            'user_id' => $userId,
            'company_id' => $companyId,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'is_anonymous' => $request->is_anonymous
        ]);

        // Check if user has already reviewed this company
        if (CompanyReview::hasUserReviewed($companyId, $userId)) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this company.',
            ], 409);
        }

        // Verify the company exists
        $company = Company::find($companyId);
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found.',
            ], 404);
        }

        // Create the review
        $review = CompanyReview::create([
            'company_id' => $companyId,
            'user_id' => $userId,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'is_anonymous' => $request->has('is_anonymous') ? ($request->is_anonymous === 'true' || $request->is_anonymous === '1') : false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully!',
            'review' => $review->load('user'),
        ]);
    }

    /**
     * Get reviews for a company.
     */
    public function getReviews($companyId)
    {
        $company = Company::findOrFail($companyId);

        $reviews = CompanyReview::getReviewsForCompany($companyId);
        $averageRating = CompanyReview::getAverageRating($companyId);
        $reviewCount = CompanyReview::getReviewCount($companyId);
        $ratingDistribution = CompanyReview::getRatingDistribution($companyId);

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'average_rating' => round($averageRating, 1),
            'review_count' => $reviewCount,
            'rating_distribution' => $ratingDistribution,
        ]);
    }

    /**
     * Check if current user can review a company.
     */
    public function canReview($companyId)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'can_review' => false,
                'message' => 'Authentication required.',
            ]);
        }

        $hasReviewed = CompanyReview::hasUserReviewed($companyId, $userId);

        return response()->json([
            'can_review' => !$hasReviewed,
            'has_reviewed' => $hasReviewed,
        ]);
    }
}
