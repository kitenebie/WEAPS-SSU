<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Carrer;
use App\Models\Company;
use App\Models\Email;
use App\Models\SaveCareer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPostingEmail;

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

    public function getCareerDetails($id)
    {
        $career = Carrer::with('company')->findOrFail($id);

        return response()->json([
            'success' => true,
            'career' => $career,
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
        $userCompanyId = Company::where('user_id', Auth::id())->first()->id ?? null;

        if (!$userCompanyId || $applicant->company_id !== $userCompanyId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update this application.' . $userCompanyId . "-" . $applicant->company_id,
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

    public function sendJobPostingsEmail()
    {
        // Get careers created today
        $careers = Carrer::with('company')->whereDate('created_at', today())->get();

        if ($careers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No new careers created today.',
            ]);
        }

        $totalEmailsSent = 0;

        // For each career, send to users who haven't received email for this career
        foreach ($careers as $career) {
            // Get users who have CurriculumVitae but no Company and haven't received email for this career
            $usersToNotify = User::whereHas('curriculumVitae')
                ->whereDoesntHave('companies')
                ->whereDoesntHave('emails', function($query) use ($career) {
                    $query->where('career_id', $career->id);
                })
                ->get();

            // Send email to each user
            foreach ($usersToNotify as $user) {
                try {
                    Mail::to($user->email)->send(new JobPostingEmail($user, collect([$career])));
                    // Save record to prevent future sends
                    Email::create([
                        'user_id' => $user->id,
                        'career_id' => $career->id,
                    ]);
                    $totalEmailsSent++;
                } catch (\Throwable $th) {
                    continue;
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job posting emails sent successfully. Total emails sent: ' . $totalEmailsSent,
        ]);
    }
}
