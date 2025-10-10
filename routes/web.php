<?php

use Illuminate\Support\Facades\Route;
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

