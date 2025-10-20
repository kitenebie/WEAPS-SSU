<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CurriculumVitae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Show applicant registration form
     *
     * @return \Illuminate\View\View
     */
    public function showApplicantForm()
    {
        return view('filament.employeer.pages.applicant-form');
    }

    /**
     * Show alumni verification status
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showAlumniVerificationStatus()
    {
        $userCV = CurriculumVitae::where('user_id', Auth::id())->first();
        if (!Auth::check() || !$userCV || $userCV->isActive) {
            return redirect()->back();
        }

        return view('filament.employeer.pages.alumni-verification-status');
    }

    /**
     * Show company registration form
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCompanyForm()
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        return view('filament.employeer.pages.company-form');
    }

    /**
     * Show company verification status
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showCompanyVerificationStatus()
    {
        $userCampany = Company::where('user_id', Auth::id())->first();
        if (!Auth::check() || !$userCampany || $userCampany->isVerified) {
            return redirect()->back();
        }
        return view('filament.employeer.pages.company-verification-status');
    }

    /**
     * Update user role for verification
     *
     * @param string $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole($type)
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        $user = Auth::user();

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
            $redirectRoute = '/Applicants' . '/' . Auth::user()->id . 'edit';
        } else {
            return redirect()->back()->with('error', 'Invalid registration type');
        }

        // Remove existing roles and assign new role
        $user->syncRoles([$roleName]);

        return redirect($redirectRoute);
    }
}