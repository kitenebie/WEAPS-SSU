<?php

namespace App\Http\Controllers;

use App\Models\CurriculumVitae;
use App\Models\User;
use Illuminate\Http\Request;

class CvController extends Controller
{
    /**
     * Display a specific CV or user profile
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // First try to find as CV ID
        $cv = CurriculumVitae::find($id);

        if ($cv) {
            return view('filament.employeer.pages.recruiting', compact('cv'));
        }

        // If not found as CV, try to find as User ID and get their CV
        $user = User::find($id);
        if ($user && $user->curriculumVitae) {
            $cv = $user->curriculumVitae;
            return view('filament.employeer.pages.recruiting', compact('cv'));
        }

        // If neither found, show 404
        abort(404, 'CV or User not found');
    }
}