<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CurriculumVitae;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function companyActivited()
    {
        $user = Auth::user();
        $user->syncRoles(['super_admin']);
        $user->syncRoles(['Not_Verified']);
        if ($user && $user->email_verified_at == null) {
            $user->syncRoles(env('USER_EMPLOYEER_ROLE'));
            $user->assignRole(env('USER_EMPLOYEER_ROLE'));
        }
        return redirect('/Company%20Profile');
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
        // $userCampany = Company::where('user_handle', Auth::id())->first();
        // // return $userCampany;
        // if (!Auth::check() || !$userCampany || !$userCampany->isActive) {
        //     return redirect()->back();
        // }
        return view('filament.employeer.pages.company-verification-status');
    }

    /**
     * Store company registration data
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCompany(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Authentication required');
        }

        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'company_size' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
            'business_permits' => 'required|array|min:1',
            'business_permits.*' => 'file|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB max each
        ], [
            'name.required' => 'Company name is required',
            'industry.required' => 'Industry is required',
            'company_size.required' => 'Company size is required',
            'location.required' => 'Location is required',
            'logo.required' => 'Company logo is required',
            'logo.image' => 'Logo must be an image file',
            'logo.mimes' => 'Logo must be jpeg, png, or jpg format',
            'logo.max' => 'Logo size must be less than 5MB',
            'business_permits.required' => 'At least one business permit is required',
            'business_permits.min' => 'At least one business permit is required',
            'business_permits.*.mimes' => 'Business permits must be jpeg, png, jpg, or pdf format',
            'business_permits.*.max' => 'Each business permit must be less than 5MB',
        ]);

        try {
            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('companies/' . Auth::id(), 'private');
            }

            // Handle multiple business permits upload
            $permitPaths = [];
            if ($request->hasFile('business_permits')) {
                foreach ($request->file('business_permits') as $file) {
                    $permitPath = $file->store('companies/' . Auth::id() . '/permits', 'private');
                    $permitPaths[] = $permitPath;
                }
            }

            // Prepare company data
            $companyData = [
                'user_handle' => Auth::id(),
                'user_id' => Auth::id(),
                'name' => $validatedData['name'],
                'industry' => $validatedData['industry'],
                'company_size' => $validatedData['company_size'],
                'location' => $validatedData['location'],
                'website' => $validatedData['website'],
                'phone' => $validatedData['phone'],
                'description' => $validatedData['description'],
                'logo' => $logoPath,
                'Document_Permit' => $permitPaths,
                'isActive' => false,
            ];

            // Create company record
            Company::create($companyData);

            return redirect()->route('company.verification.status')
                ->with('success', 'Company registration submitted successfully! Your application is being reviewed.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['system' => 'An error occurred while processing your registration. Please try again.'])
                ->with('error', $e->getMessage());
        }
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
                $logoPath = request()->file('logo')->store('companies/' . Auth::id(), 'private');
                $companyData['logo'] = $logoPath;
            }

            // Handle multiple business permits upload
            $permitPaths = [];
            if (request()->hasFile('business_permits')) {
                foreach (request()->file('business_permits') as $index => $file) {
                    $permitPath = $file->store('companies/' . Auth::id() . '/permits', 'private');
                    $permitPaths[] = $permitPath;
                }
                $companyData['Document_Permit'] = $permitPaths;
            }

            Company::create($companyData);
            // $redirectRoute = '/Company%20Profile';
            $redirectRoute = '/employeer/company-verification-status';
        } elseif ($type === 'applicant') {
            $roleName = env('USER_APPLICANT_ROLE', 'Applicant_Alumni');
            // Update user name fields
            $user->update([
                'first_name' => request('first_name'),
                'middle_name' => request('middle_name'),
                'last_name' => request('last_name'),
                'School_id' => request('School_id'),
            ]);

            // Create curriculum vitae
            $cvData = [
                'user_id' => Auth::user()->id,
                'first_name' => request('first_name'),
                'middle_name' => request('middle_name'),
                'last_name' => request('last_name'),
                'email' => $user->email,
                'School_id' => request('School_id'),
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
            // $redirectRoute = '/Applicants' . '/' . Auth::user()->id . 'edit';
            $redirectRoute = '/alumni/alumni-verification-status';
        } else {
            return redirect()->back()->with('error', 'Invalid registration type');
        }

        // Remove existing roles and assign new role
        $user->syncRoles([$roleName]);

        return redirect($redirectRoute);
    }

    public function CheckUserVerifactionStatus()
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        $is_Detected = Auth::user()->face_detection;
        $is_AI_Validated = Auth::user()->AI_result;
        if ($is_Detected && $is_AI_Validated) {
            return 1;
        }
        if ($is_Detected || $is_AI_Validated) {
            return 2;
        }
        return 0;
    }
}
