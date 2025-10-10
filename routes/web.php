<?php

use Illuminate\Support\Facades\Route;
use App\Models\CurriculumVitae;

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

