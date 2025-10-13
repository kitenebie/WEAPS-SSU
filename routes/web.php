<?php

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\CurriculumVitae;
use Laravel\Socialite\Facades\Socialite;

Route::get('/cv/{id}', function ($id) {
    $cv = CurriculumVitae::findOrFail($id);
    return view('filament.employeer.pages.recruiting', compact('cv'));
    // return view('curriculum-vitae', compact('cv'));

})->name('cv.view');

// Route for serving private files with temporary signed URLs
Route::get('/private/{path}', function ($path) {
    // Validate the signed URL
    if (!request()->hasValidSignature()) {
        abort(403, 'Unauthorized access to private file');
    }

    // Construct the full file path
    $filePath = storage_path('app/private/' . $path);

    // Check if file exists
    if (!file_exists($filePath)) {
        abort(404, 'File not found');
    }

    // Return the file with appropriate headers
    return response()->file($filePath);

})->where('path', '.*')->name('private.file');

// Social Auth Routes
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('socialite.google');

Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('socialite.github');

Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('socialite.facebook');

Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    // Handle user creation/login logic here
    return redirect('/employeer/login');
})->name('socialite.google.callback');

Route::get('/auth/github/callback', function () {
    $user = Socialite::driver('github')->user();
    // Handle user creation/login logic here
    return redirect('/employeer/login');
})->name('socialite.github.callback');

Route::get('/auth/facebook/callback', function () {
    $user = Socialite::driver('facebook')->user();
    // Handle user creation/login logic here
    return redirect('/employeer/login');
})->name('socialite.facebook.callback');

// Routes for registration forms
Route::get('/employeer/applicant-form', function () {
    return view('filament.employeer.pages.applicant-form');
})->name('applicant.form');

Route::get('/employeer/company-form', function () {
    return view('filament.employeer.pages.company-form');
})->name('company.form');

// Routes for verification role updates
Route::post('/verification/update-role/{type}', function ($type) {
    $user = Auth::user();

    if (!$user) {
        return redirect('/employeer/login');
    }

    // Update user role based on type
    if ($type === 'employeer') {
        $roleName = env('USER_EMPLOYEER_ROLE', 'Employeer');

        // Handle company form data
        $companyData = [
            'user_id' => Auth::user()->id,
            'name' => request('name'),
            'industry' => request('industry'),
            'company_size' => request('company_size'),
            'location' => request('location'),
            'website' => request('website'),
            'phone' => request('phone'),
            'description' => request('description'),
        ];

        // Handle logo upload
        if (request()->hasFile('logo')) {
            $logoPath = request()->file('logo')->store('companies/' . Auth::id(), 'public');
            $companyData['logo'] = $logoPath;
        }

        // Handle multiple business permits upload
        $permitPaths = [];
        if (request()->hasFile('business_permits')) {
            foreach (request()->file('business_permits') as $index => $file) {
                $permitPath = $file->store('companies/' . Auth::id() . '/permits', 'public');
                $permitPaths[] = $permitPath;
            }
            $companyData['Document_Permit'] = $permitPaths;
        }

        Company::create($companyData);
        $redirectRoute = '/Company%20Profile';
    } elseif ($type === 'applicant') {
        $roleName = env('USER_APPLICANT_ROLE', 'Applicant_Alumni');

        // Update user name fields
        $user->update([
            'first_name' => request('first_name'),
            'middle_name' => request('middle_name'),
            'last_name' => request('last_name'),
        ]);

        // Create curriculum vitae
        $cvData = [
            'user_id' => Auth::user()->id,
            'first_name' => request('first_name'),
            'middle_name' => request('middle_name'),
            'last_name' => request('last_name'),
            'email' => $user->email,
        ];

        // Handle profile image upload
        if (request()->hasFile('profile_image')) {
            $profilePath = request()->file('profile_image')->store('applicants/' . Auth::id() . '/profile', 'private');
            $cvData['profile_picture'] = $profilePath;
        }

        // Handle ID uploads
        if (request()->hasFile('front_id')) {
            $frontIdPath = request()->file('front_id')->store('applicants/' . Auth::id() . '/front-id', 'private');
            $cvData['front_id'] = $frontIdPath;
        }

        if (request()->hasFile('back_id')) {
            $backIdPath = request()->file('back_id')->store('applicants/' . Auth::id() . '/back-id', 'private');
            $cvData['back_id'] = $backIdPath;
        }

        CurriculumVitae::create($cvData);
        $redirectRoute = '/Applicants'. '/'. Auth::user()->id.'edit';
    } else {
        return redirect()->back()->with('error', 'Invalid registration type');
    }

    // Remove existing roles and assign new role
    $user->syncRoles([$roleName]);

    return redirect($redirectRoute);
})->name('verification.update-role');

// API route for inactive resumes
Route::get('/inActiveResume', [App\Http\Controllers\ResumeController::class, 'inActiveResume'])
    ->name('inactive.resumes');

// API route for verification
Route::post('/api/a/i/varification/', [App\Http\Controllers\ResumeController::class, 'apiVerification'])
    ->name('api.verification');

