<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Applicant Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Header with Back Button -->
    <header class="bg-white shadow-sm border-b border-slate-200">
        <div class="container-full mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()"
                            class="inline-flex items-center px-4 py-2 bg-emerald-100 hover:bg-emerald-200 text-slate-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </button>
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">Alumni Registration</h1>
                        <p class="text-sm text-slate-600">Complete your profile verification</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-emerald-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-emerald-700 font-medium">Secure Registration</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-emerald-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-emerald-700 font-medium">AI Verification</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-blue-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-blue-700 font-medium">Verified Process</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-emerald-50">
        <div class="container-full mx-auto px-4 py-8">
            <div class="max-w-full mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-slate-900 mb-4">Alumni Registration</h1>
                    <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                        Complete your profile with personal information and document verification to start applying for job opportunities.
                    </p>
                </div>

                <div class="w-full grid grid-cols-1 lg:grid-cols-9 gap-2">
                    <!-- Left Side Instruction Panel -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-6 sticky top-6">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl mb-3 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-900">Registration Guide</h2>
                                <p class="text-sm text-slate-600 mt-1">Follow these steps</p>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="flex items-start group">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200">1</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Personal Details</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Enter your legal information</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-2">2</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Profile Photo</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Upload a recent headshot</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-3">3</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">ID Verification</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Upload School ID images</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-4">4</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">AI Verification</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Automated verification process</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <h3 class="font-semibold text-blue-900 mb-2 text-sm">Document Requirements:</h3>
                                <ul class="text-xs text-blue-800 space-y-1">
                                    <li>• Current School-issued ID</li>
                                    <li>• Recent professional photo</li>
                                    <li>• Clear, high-resolution images</li>
                                    <li>• All details must match exactly</li>
                                    <li>• AI verification required</li>
                                </ul>
                            </div>

                            <div class="mt-4 p-4 bg-emerald-50 rounded-lg">
                                <h3 class="font-semibold text-emerald-900 mb-2 flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Quality Guidelines:
                                </h3>
                                <ul class="text-xs text-emerald-800 space-y-1">
                                    <li>• High-resolution images (300+ DPI)</li>
                                    <li>• Good lighting and clear focus</li>
                                    <li>• All text must be readable</li>
                                    <li>• No glare or shadows</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Form Content -->
                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8">
                            <!-- Progress Header -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Complete Your Profile</h2>
                                        <p class="text-slate-600">Fill in your details and upload documents below</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-emerald-600 mb-1" id="progress-percentage">0%</div>
                                        <div class="text-sm text-slate-500">Complete</div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-3 rounded-full transition-all duration-500 ease-out" id="progress-bar" style="width: 0%"></div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('verification.update-role', 'applicant') }}" enctype="multipart/form-data" onsubmit="return validateApplicantForm()">
                                @csrf

                                <!-- Personal Information Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex items-center">
                                            <div class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl mr-4 shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-slate-900">Personal Information</h3>
                                                <p class="text-slate-600">Your legal information as shown on your ID</p>
                                            </div>
                                        </div>
                                        <div class="hidden md:flex items-center space-x-2 text-sm bg-slate-100 px-4 py-2 rounded-full">
                                            <span class="text-slate-600">Step</span>
                                            <span class="font-bold text-emerald-600" id="current-step">1</span>
                                            <span class="text-slate-600">of 4</span>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8">
                                        <div class="flex items-start">
                                            <div class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 rounded-lg mr-4 flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-blue-900 font-semibold mb-1">Verification Requirements</p>
                                                <p class="text-blue-800 text-sm leading-relaxed">All personal information must exactly match your School-issued ID. AI verification will cross-check all details for accuracy and consistency.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <label for="first_name" class="block text-sm font-semibold text-slate-800 mb-3">
                                                First Name *
                                                <span class="text-xs font-normal text-slate-600">(As shown on ID)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="first_name" name="first_name" required
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 bg-slate-50 focus:bg-white"
                                                       placeholder="Enter your first name">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-xs text-slate-500 mt-2">Must match ID exactly</div>
                                        </div>

                                        <div>
                                            <label for="middle_name" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Middle Name
                                                <span class="text-xs font-normal text-slate-600">(Optional)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="middle_name" name="middle_name"
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 bg-slate-50 focus:bg-white"
                                                       placeholder="Enter your middle name">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="last_name" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Last Name *
                                                <span class="text-xs font-normal text-slate-600">(As shown on ID)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="last_name" name="last_name" required
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 bg-slate-50 focus:bg-white"
                                                       placeholder="Enter your last name">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-xs text-slate-500 mt-2">Must match ID exactly</div>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <label for="School_id" class="block text-sm font-semibold text-slate-800 mb-3">
                                            School ID *
                                            <span class="text-xs font-normal text-slate-600">(Student/School ID Number)</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="School_id" name="School_id" required
                                                   class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 bg-slate-50 focus:bg-white"
                                                   placeholder="Enter your school ID number">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-xs text-slate-500 mt-2">Enter your valid school identification number</div>
                                    </div>
                                </div>

                                <!-- Document Upload Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-xl font-semibold text-slate-900 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                            </svg>
                                            Document Uploads
                                        </h2>
                                        <div class="text-sm text-slate-500">
                                            <span id="documents-uploaded-count">0</span> of 3 documents uploaded
                                        </div>
                                    </div>

                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-yellow-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-yellow-800 font-medium">Document Requirements</p>
                                                <p class="text-yellow-700 text-sm">Upload clear, high-resolution images of your profile photo and School ID. All documents must be current and clearly legible.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Profile Image -->
                                        <div>
                                            <label for="profile_image" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Profile Image *
                                                <span class="text-xs font-normal text-slate-600">(Recent professional photo)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="file" id="profile_image" name="profile_image" accept="image/*" required
                                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewApplicantImage(this, 'profile')">
                                                <div class="w-full h-48 border-2 border-dashed border-slate-300 rounded-xl flex items-center justify-center bg-slate-50 hover:bg-slate-100 transition-colors relative cursor-pointer">
                                                    <div class="text-center" id="profile-upload-area">
                                                        <!-- Re-upload button (shown when image is uploaded) -->
                                                        <button type="button" onclick="allowReupload('profile')"
                                                                class="absolute top-2 right-2 bg-slate-700 hover:bg-slate-600 text-white text-xs px-2 py-1 rounded hidden"
                                                                id="profile-reupload-btn" title="Change image">
                                                            Change
                                                        </button>
                                                        <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span class="text-sm text-slate-500">Click to upload profile image</span>
                                                        <p class="text-xs text-slate-400 mt-1">JPG, PNG up to 5MB</p>
                                                    </div>
                                                    <img id="profile-preview" class="w-full h-full object-cover rounded-xl p-4 hidden" alt="Profile preview">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Front ID -->
                                        <div>
                                            <label for="front_id" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Front ID *
                                                <span class="text-xs font-normal text-slate-600">(School ID front)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="file" id="front_id" name="front_id" accept="image/*" required
                                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewApplicantImage(this, 'front_id')">
                                                <div class="w-full h-48 border-2 border-dashed border-slate-300 rounded-xl flex items-center justify-center bg-slate-50 hover:bg-slate-100 transition-colors relative cursor-pointer">
                                                    <div class="text-center" id="front_id-upload-area">
                                                        <!-- Re-upload button (shown when image is uploaded) -->
                                                        <button type="button" onclick="allowReupload('front_id')"
                                                                class="absolute top-2 right-2 bg-slate-700 hover:bg-slate-600 text-white text-xs px-2 py-1 rounded hidden"
                                                                id="front_id-reupload-btn" title="Change image">
                                                            Change
                                                        </button>
                                                        <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <span class="text-sm text-slate-500">Click to upload front ID</span>
                                                        <p class="text-xs text-slate-400 mt-1">High resolution required</p>
                                                    </div>
                                                    <img id="front-id-preview" class="w-full h-full object-cover rounded-xl p-4 hidden" alt="Front ID preview">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Back ID -->
                                        <div>
                                            <label for="back_id" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Back ID *
                                                <span class="text-xs font-normal text-slate-600">(School ID back)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="file" id="back_id" name="back_id" accept="image/*" required
                                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewApplicantImage(this, 'back_id')">
                                                <div class="w-full h-48 border-2 border-dashed border-slate-300 rounded-xl flex items-center justify-center bg-slate-50 hover:bg-slate-100 transition-colors relative cursor-pointer">
                                                    <div class="text-center" id="back_id-upload-area">
                                                        <!-- Re-upload button (shown when image is uploaded) -->
                                                        <button type="button" onclick="allowReupload('back_id')"
                                                                class="absolute top-2 right-2 bg-slate-700 hover:bg-slate-600 text-white text-xs px-2 py-1 rounded hidden"
                                                                id="back_id-reupload-btn" title="Change image">
                                                            Change
                                                        </button>
                                                        <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <span class="text-sm text-slate-500">Click to upload back ID</span>
                                                        <p class="text-xs text-slate-400 mt-1">High resolution required</p>
                                                    </div>
                                                    <img id="back-id-preview" class="w-full h-full object-cover rounded-xl p-4 hidden" alt="Back ID preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-center pt-6 border-t border-slate-200">
                                    <button type="submit"
                                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 disabled:from-slate-400 disabled:to-slate-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-all duration-200 text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                            id="applicant-submit-btn"
                                            disabled>
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span id="applicant-submit-text">Complete Registration (0%)</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right Side Preview Panel -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-6 sticky top-6">
                            <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Document Preview
                            </h2>

                            <!-- Profile Image Preview -->
                            <div class="mb-6">
                                <h3 class="text-sm font-semibold text-slate-700 mb-3">Profile Image</h3>
                                <div class="bg-slate-100 rounded-lg p-6 text-center min-h-[120px] flex items-center justify-center" id="preview-profile-container">
                                    <div>
                                        <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-xs text-slate-500">Profile preview will appear here</p>
                                    </div>
                                </div>
                            </div>

                            <!-- ID Documents Preview -->
                            <div>
                                <h3 class="text-sm font-semibold text-slate-700 mb-3">ID Documents</h3>
                                <div class="space-y-3 max-h-96 overflow-y-auto" id="preview-documents-container">
                                    <div class="bg-slate-100 rounded-lg p-4 text-center">
                                        <svg class="w-6 h-6 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-xs text-slate-500">ID previews will appear here</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-3 bg-emerald-50 rounded-lg">
                                <p class="text-xs text-emerald-800">
                                    <strong>Preview Notice:</strong><br>
                                    All uploaded documents will be verified for clarity and authenticity.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let uploadedDocuments = 0;
        let profileImageUploaded = false;
        let frontIdUploaded = false;
        let backIdUploaded = false;

        function previewApplicantImage(input, type) {
            const file = input.files[0];
            let previewId = '';

            // Map the type to correct preview ID
            if (type === 'profile') {
                previewId = 'profile-preview';
            } else if (type === 'front_id') {
                previewId = 'front-id-preview';
            } else if (type === 'back_id') {
                previewId = 'back-id-preview';
            }

            const preview = document.getElementById(previewId);
            const uploadArea = document.getElementById(type.replace('_', '-') + '-upload-area');

            console.log(`Attempting to preview ${type} with preview ID: ${previewId}`);

            if (file) {
                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        console.log(`Successfully set preview for ${type}`);
                    } else {
                        console.error(`Preview element not found for ${type} with ID: ${previewId}`);
                    }

                    if (uploadArea) {
                        uploadArea.classList.add('hidden');
                        console.log(`Hid upload area for ${type}`);
                    }

                    // Update upload status
                    if (type === 'profile') {
                        profileImageUploaded = true;
                    } else if (type === 'front_id') {
                        frontIdUploaded = true;
                    } else if (type === 'back_id') {
                        backIdUploaded = true;
                    }

                    uploadedDocuments++;
                    updateApplicantProgress();
                    updateDocumentPreviews();
                    updateUploadAreaVisibility();

                    // Debug log
                    console.log(`Preview updated for ${type}:`, preview ? preview.src.substring(0, 50) + '...' : 'Preview element not found');
                };
                reader.onerror = function(e) {
                    console.error('FileReader error:', e);
                    alert('Error reading file. Please try again.');
                };
                reader.readAsDataURL(file);
            }
        }

        function updateApplicantProgress() {
            const firstName = document.getElementById('first_name').value.trim();
            const middleName = document.getElementById('middle_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const schoolId = document.getElementById('School_id').value.trim();

            let progress = 0;
            let currentStep = 1;

            // Personal information (50%)
            if (firstName) progress += 15;
            if (lastName) progress += 15;
            if (schoolId) progress += 20;

            if (progress >= 30) currentStep = 2;

            // Profile image (20%)
            if (profileImageUploaded) {
                progress += 20;
                currentStep = 3;
            }

            // ID documents (40%)
            if (frontIdUploaded) progress += 20;
            if (backIdUploaded) progress += 20;

            if (progress >= 80) currentStep = 4;

            // Update UI
            document.getElementById('progress-percentage').textContent = Math.round(progress) + '%';
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('current-step').textContent = currentStep;

            // Update guide step indicators
            for (let i = 2; i <= 4; i++) {
                const stepEl = document.getElementById('guide-step-' + i);
                if (stepEl) {
                    if (i <= currentStep) {
                        stepEl.classList.remove('bg-slate-300');
                        stepEl.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-teal-600');
                    } else {
                        stepEl.classList.add('bg-slate-300');
                        stepEl.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-teal-600');
                    }
                }
            }

            // Update submit button
            const submitBtn = document.getElementById('applicant-submit-btn');
            const submitText = document.getElementById('applicant-submit-text');

            if (progress >= 80 && firstName && lastName && profileImageUploaded && frontIdUploaded && backIdUploaded) {
                submitBtn.disabled = false;
                submitText.textContent = 'Complete Registration';
            } else {
                submitBtn.disabled = true;
                submitText.textContent = `Complete Registration (${Math.round(progress)}%)`;
            }
        }

        function updateUploadAreaVisibility() {
            // Hide upload areas if corresponding images are uploaded
            if (profileImageUploaded) {
                const profileUploadArea = document.getElementById('profile-upload-area');
                if (profileUploadArea) {
                    profileUploadArea.classList.add('hidden');
                }
                // Show re-upload button
                const profileReuploadBtn = document.getElementById('profile-reupload-btn');
                if (profileReuploadBtn) {
                    profileReuploadBtn.classList.remove('hidden');
                }
            }

            if (frontIdUploaded) {
                const frontIdUploadArea = document.getElementById('front_id-upload-area');
                if (frontIdUploadArea) {
                    frontIdUploadArea.classList.add('hidden');
                }
                // Show re-upload button
                const frontIdReuploadBtn = document.getElementById('front_id-reupload-btn');
                if (frontIdReuploadBtn) {
                    frontIdReuploadBtn.classList.remove('hidden');
                }
            }

            if (backIdUploaded) {
                const backIdUploadArea = document.getElementById('back_id-upload-area');
                if (backIdUploadArea) {
                    backIdUploadArea.classList.add('hidden');
                }
                // Show re-upload button
                const backIdReuploadBtn = document.getElementById('back_id-reupload-btn');
                if (backIdReuploadBtn) {
                    backIdReuploadBtn.classList.remove('hidden');
                }
            }

            console.log(`Upload area visibility updated - Profile: ${!profileImageUploaded}, Front ID: ${!frontIdUploaded}, Back ID: ${!backIdUploaded}`);
        }

        function updateDocumentPreviews() {
            // Update profile preview
            const profilePreview = document.getElementById('profile-preview');
            const profileContainer = document.getElementById('preview-profile-container');

            if (profilePreview && profileContainer) {
                if (profilePreview.src && profilePreview.src !== '' && profileImageUploaded) {
                    profileContainer.innerHTML = `<img src="${profilePreview.src}" class="w-full h-32 object-cover rounded-lg" alt="Profile Image">`;
                } else {
                    profileContainer.innerHTML = `
                        <div>
                            <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs text-slate-500">Profile preview will appear here</p>
                        </div>
                    `;
                }
            }

            // Update documents preview
            const documentsContainer = document.getElementById('preview-documents-container');
            if (documentsContainer) {
                documentsContainer.innerHTML = '';

                // Add front ID preview if uploaded
                if (frontIdUploaded) {
                    const frontIdPreview = document.getElementById('front-id-preview');
                    if (frontIdPreview && frontIdPreview.src && frontIdPreview.src !== '') {
                        const frontDiv = document.createElement('div');
                        frontDiv.className = 'bg-slate-100 rounded-lg p-2 text-center';
                        frontDiv.innerHTML = `
                            <img src="${frontIdPreview.src}" class="w-full h-24 object-cover rounded mb-1" alt="Front ID">
                            <p class="text-xs text-slate-600">Front ID</p>
                        `;
                        documentsContainer.appendChild(frontDiv);
                        console.log('Added front ID preview to documents container');
                    } else {
                        console.log('Front ID preview element not found or empty');
                    }
                }

                // Add back ID preview if uploaded
                if (backIdUploaded) {
                    const backIdPreview = document.getElementById('back-id-preview');
                    if (backIdPreview && backIdPreview.src && backIdPreview.src !== '') {
                        const backDiv = document.createElement('div');
                        backDiv.className = 'bg-slate-100 rounded-lg p-2 text-center';
                        backDiv.innerHTML = `
                            <img src="${backIdPreview.src}" class="w-full h-24 object-cover rounded mb-1" alt="Back ID">
                            <p class="text-xs text-slate-600">Back ID</p>
                        `;
                        documentsContainer.appendChild(backDiv);
                        console.log('Added back ID preview to documents container');
                    } else {
                        console.log('Back ID preview element not found or empty');
                    }
                }

                // Show placeholder if no documents uploaded
                if (!frontIdUploaded && !backIdUploaded) {
                    documentsContainer.innerHTML = `
                        <div class="bg-slate-100 rounded-lg p-4 text-center">
                            <svg class="w-6 h-6 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-xs text-slate-500">ID previews will appear here</p>
                        </div>
                    `;
                }
            }

            // Update uploaded count
            const countElement = document.getElementById('documents-uploaded-count');
            if (countElement) {
                countElement.textContent = uploadedDocuments;
            }

            // Debug log
            console.log(`Document previews updated. Profile: ${profileImageUploaded}, Front ID: ${frontIdUploaded}, Back ID: ${backIdUploaded}`);
        }

        function validateApplicantForm() {
            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const schoolId = document.getElementById('School_id').value.trim();

            if (!firstName || !lastName) {
                alert('Please fill in all required personal information fields.');
                return false;
            }

            if (!schoolId) {
                alert('Please enter your School ID.');
                return false;
            }

            if (!profileImageUploaded) {
                alert('Please upload your profile image.');
                return false;
            }

            if (!frontIdUploaded || !backIdUploaded) {
                alert('Please upload both sides of your ID.');
                return false;
            }

            // Show loading state
            document.getElementById('applicant-submit-text').textContent = 'Processing...';
            document.getElementById('applicant-submit-btn').disabled = true;

            return true;
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['first_name', 'middle_name', 'last_name', 'School_id'];
            inputs.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', updateApplicantProgress);
                    element.addEventListener('change', updateApplicantProgress);
                }
            });

            // Add click event listeners to upload areas for debugging
            const uploadAreas = ['profile-upload-area', 'front_id-upload-area', 'back_id-upload-area'];
            uploadAreas.forEach(areaId => {
                const element = document.getElementById(areaId);
                if (element) {
                    element.addEventListener('click', function() {
                        console.log(`Upload area clicked: ${areaId}`);
                    });
                }
            });

            // Test function for debugging
            window.testFileInputs = function() {
                const fileInputs = ['profile_image', 'front_id', 'back_id'];
                fileInputs.forEach(inputId => {
                    const input = document.getElementById(inputId);
                    console.log(`${inputId}:`, {
                        exists: !!input,
                        visible: input ? input.offsetWidth > 0 || input.offsetHeight > 0 : false,
                        disabled: input ? input.disabled : 'N/A',
                        accept: input ? input.accept : 'N/A'
                    });
                });
            };

            // Function to allow re-uploading (show upload area again)
            window.allowReupload = function(type) {
                const uploadArea = document.getElementById(type.replace('_', '-') + '-upload-area');
                const preview = document.getElementById(type + '-preview');
                const reuploadBtn = document.getElementById(type + '-reupload-btn');

                if (uploadArea) {
                    uploadArea.classList.remove('hidden');
                    console.log(`Re-upload enabled for ${type}`);
                }

                if (preview) {
                    preview.classList.add('hidden');
                    preview.src = '';
                }

                // Hide re-upload button
                if (type === 'front_id') {
                    const frontReuploadBtn = document.getElementById('front_id-reupload-btn');
                    if (frontReuploadBtn) {
                        frontReuploadBtn.classList.add('hidden');
                    }
                } else if (type === 'back_id') {
                    const backReuploadBtn = document.getElementById('back_id-reupload-btn');
                    if (backReuploadBtn) {
                        backReuploadBtn.classList.add('hidden');
                    }
                } else if (type === 'profile') {
                    const profileReuploadBtn = document.getElementById('profile-reupload-btn');
                    if (profileReuploadBtn) {
                        profileReuploadBtn.classList.add('hidden');
                    }
                }

                // Reset upload status
                if (type === 'profile') {
                    profileImageUploaded = false;
                } else if (type === 'front_id') {
                    frontIdUploaded = false;
                } else if (type === 'back_id') {
                    backIdUploaded = false;
                }

                uploadedDocuments = Math.max(0, uploadedDocuments - 1);
                updateApplicantProgress();
                updateDocumentPreviews();
                updateUploadAreaVisibility();
            };

            console.log('Applicant form initialized');
            updateApplicantProgress();
            updateUploadAreaVisibility();
        });
    </script>
</body>
</html>