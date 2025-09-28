<?php

use Illuminate\Support\Facades\Route;
use App\Models\CurriculumVitae;

Route::get('/cv/{id}', function ($id) {
    $cv = CurriculumVitae::findOrFail($id);
    return view('filament.employeer.pages.recruiting', compact('cv'));
    // return view('curriculum-vitae', compact('cv'));

})->name('cv.view');

