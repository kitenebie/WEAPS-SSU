<?php

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\CurriculumVitae;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ListController;

Route::get('/cv/{id}', [App\Http\Controllers\CvController::class, 'show'])->name('cv.view');

// Route for serving private files with temporary signed URLs
Route::get('/private/{path}', [App\Http\Controllers\FileController::class, 'servePrivateFile'])
    ->where('path', '.*')->name('private.file');

// Social Auth Routes
Route::get('/auth/google', [App\Http\Controllers\SocialAuthController::class, 'redirectToGoogle'])->name('socialite.google');
Route::get('/auth/github', [App\Http\Controllers\SocialAuthController::class, 'redirectToGithub'])->name('socialite.github');
Route::get('/auth/linkedin', [App\Http\Controllers\SocialAuthController::class, 'redirectToLinkedIn'])->name('socialite.linkedin');
Route::get('/login/google/callback', [App\Http\Controllers\SocialAuthController::class, 'handleGoogleCallback'])->name('socialite.google.callback');
Route::get('/auth/github/callback', [App\Http\Controllers\SocialAuthController::class, 'handleGithubCallback'])->name('socialite.github.callback');
Route::get('/auth/linkedin/callback', [App\Http\Controllers\SocialAuthController::class, 'handleLinkedInCallback'])->name('socialite.linkedin.callback');

// Routes for registration forms
Route::get('/alumni/applicant-form', [App\Http\Controllers\RegistrationController::class, 'showApplicantForm'])->name('applicant.form');
Route::get('/alumni/alumni-verification-status', [App\Http\Controllers\RegistrationController::class, 'showAlumniVerificationStatus'])->name('alumni.verification.status');
Route::get('/employeer/company-form', [App\Http\Controllers\RegistrationController::class, 'showCompanyForm'])->name('company.form');
Route::post('/employeer/company-form', [App\Http\Controllers\RegistrationController::class, 'storeCompany'])->name('company.form.store');
Route::get('/employeer/company-verification-status', [App\Http\Controllers\RegistrationController::class, 'showCompanyVerificationStatus'])->name('company.verification.status');
Route::get('/employeer/company-verification-status/completed', [App\Http\Controllers\RegistrationController::class, 'companyActivited'])->name('company.verification.status.completed');
Route::get('/CheckUserVerifactionStatus', [App\Http\Controllers\RegistrationController::class, 'CheckUserVerifactionStatus'])->name('CheckUserVerifactionStatus');

// Routes for verification role updates
Route::post('/verification/update-role/{type}', [App\Http\Controllers\RegistrationController::class, 'updateRole'])->name('verification.update-role');

// API route for inactive resumes
Route::get('/inActiveResume', [App\Http\Controllers\ResumeController::class, 'inActiveResume'])
    ->name('inactive.resumes');

// API route for verification
Route::post('/api/a/i/varification', [App\Http\Controllers\ResumeController::class, 'apiVerification'])
    ->name('api.verification');

// Career details route
Route::get('/career/{id}', [App\Http\Controllers\CareerController::class, 'show'])->name('career.details');
Route::get('/career/{id}/details', [App\Http\Controllers\CareerController::class, 'getCareerDetails'])->name('career.details.api');

// Career save and apply routes
Route::middleware('auth')->group(function () {
    Route::post('/career/save', [App\Http\Controllers\CareerController::class, 'saveJob'])->name('career.save');
    Route::post('/career/apply', [App\Http\Controllers\CareerController::class, 'applyNow'])->name('career.apply');
    Route::get('/career/check-status/{careerId}', [App\Http\Controllers\CareerController::class, 'checkStatus'])->name('career.check-status');
    Route::post('/career/update-application-status', [App\Http\Controllers\CareerController::class, 'updateApplicationStatus'])->name('career.update-application-status');
});

// Company review routes
Route::middleware('auth')->group(function () {
    Route::post('/company/review/store', [App\Http\Controllers\CompanyReviewController::class, 'store'])->name('company.review.store');
    Route::get('/company/{companyId}/reviews', [App\Http\Controllers\CompanyReviewController::class, 'getReviews'])->name('company.reviews');
    Route::get('/company/{companyId}/can-review', [App\Http\Controllers\CompanyReviewController::class, 'canReview'])->name('company.can-review');
});

// Alternative route without middleware for testing
Route::post('/company/review/store-test', [App\Http\Controllers\CompanyReviewController::class, 'store'])->name('company.review.store.test');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');
Route::get('/alumni/list', [ListController::class, 'index'])->name('students.scrape');


Route::get('/profile', function(){
    return view('Resume.index');
});
Route::get('/support/{id}/', function($id){
    $alumni_id = $id;
    return view('Resume.support', compact('alumni_id'));
});
Route::get('/send-email', [App\Http\Controllers\CareerController::class, 'sendJobPostingsEmail']);