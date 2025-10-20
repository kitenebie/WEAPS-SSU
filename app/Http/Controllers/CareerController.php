<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Carrer;
use App\Models\SaveCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    public function show($id)
    {
        $career = Carrer::with('company')->findOrFail($id);

        $userId = Auth::id();
        $alreadySaved = false;
        $alreadyApplied = false;

        if ($userId) {
            $alreadySaved = SaveCareer::where('user_id', $userId)
                ->where('career_id', $id)
                ->exists();

            $alreadyApplied = Applicant::where('user_id', $userId)
                ->where('career_id', $id)
                ->exists();
        }

        return view('carrerDetails', compact('career', 'alreadySaved', 'alreadyApplied'));
    }

    public function saveJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_id' => 'required|exists:carrers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid career ID.',
            ], 400);
        }

        $userId = Auth::id();
        $careerId = $request->career_id;

        // Check if already saved
        $existingSave = SaveCareer::where('user_id', $userId)
            ->where('career_id', $careerId)
            ->first();

        if ($existingSave) {
            return response()->json([
                'success' => false,
                'message' => 'Job already saved.',
            ], 409);
        }

        // Save the job
        SaveCareer::create([
            'user_id' => $userId,
            'career_id' => $careerId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job saved successfully!',
        ]);
    }

    public function applyNow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_id' => 'required|exists:carrers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid career ID.',
            ], 400);
        }

        $userId = Auth::id();
        $careerId = $request->career_id;

        // Check if already applied
        $existingApplication = Applicant::where('user_id', $userId)
            ->where('career_id', $careerId)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this job.',
            ], 409);
        }

        // Get the company ID from the career
        $career = Carrer::find($careerId);
        if (!$career) {
            return response()->json([
                'success' => false,
                'message' => 'Career not found.',
            ], 404);
        }

        // Create application
        Applicant::create([
            'user_id' => $userId,
            'company_id' => $career->company_id,
            'career_id' => $careerId,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!',
        ]);
    }

    public function checkStatus($careerId)
    {
        $userId = Auth::id();

        // Check if job is already saved
        $alreadySaved = SaveCareer::where('user_id', $userId)
            ->where('career_id', $careerId)
            ->exists();

        // Check if already applied
        $alreadyApplied = Applicant::where('user_id', $userId)
            ->where('career_id', $careerId)
            ->exists();

        return response()->json([
            'already_saved' => $alreadySaved,
            'already_applied' => $alreadyApplied,
        ]);
    }

    public function updateApplicationStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'applicant_id' => 'required|exists:applicants,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid applicant ID or status.',
            ], 400);
        }

        $applicant = Applicant::find($request->applicant_id);

        // Check if the applicant belongs to a career of this user's company
        $userCompanyId = Auth::user()->companies()->first()->id ?? null;

        if (!$userCompanyId || $applicant->company_id !== $userCompanyId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update this application.',
            ], 403);
        }

        $applicant->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application status updated successfully!',
        ]);
    }
}