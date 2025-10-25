<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class CompanyReview extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'company_id',
        'user_id',
        'rating',
        'review_text',
        'is_anonymous',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_anonymous' => 'boolean',
    ];

    /**
     * Get the company that owns the review.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the average rating for a company.
     */
    public static function getAverageRating($companyId)
    {
        return static::where('company_id', $companyId)
            ->avg('rating');
    }

    /**
     * Get the total number of reviews for a company.
     */
    public static function getReviewCount($companyId)
    {
        return static::where('company_id', $companyId)->count();
    }

    /**
     * Get reviews for a company with pagination.
     */
    public static function getReviewsForCompany($companyId, $perPage = 10)
    {
        return static::where('company_id', $companyId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Check if a user has already reviewed a company.
     */
    public static function hasUserReviewed($companyId, $userId)
    {
        return static::where('company_id', $companyId)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Get rating distribution for a company.
     */
    public static function getRatingDistribution($companyId)
    {
        return static::where('company_id', $companyId)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
    }
}
