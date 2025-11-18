<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Company Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Header with Back Button -->
    <header class="bg-red-900 shadow-sm border-b border-slate-200">
        <div class="container-full mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()"
                            class="inline-flex items-center px-4 py-2 bg-red-800 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </button>
                    <div>
                        <h1 class="text-xl font-semibold text-white">Company Registration</h1>
                        <p class="text-sm text-white">Complete your company profile</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-red-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-red-700 font-medium">Secure Registration</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-red-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 font-medium">Verified Process</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gradient-to-br from-rose-50 to-red-50">
        <div class="container-full mx-auto px-4 py-8">
            <div class="max-w-full mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-red-600 to-red-900 rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-slate-900 mb-4">Company Registration</h1>
                    <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                        Complete your company profile to start posting job opportunities and connecting with talented professionals.
                    </p>
                </div>

                <div class="w-full grid grid-cols-1 lg:grid-cols-9 gap-2">
                    <!-- Left Side Instruction Panel -->
                    <div class="lg:col-span-2">
                        <div class="bg-gray-50 rounded-2xl shadow-xl border border-red-900 p-6 sticky top-6">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-red-700 to-pink-900 rounded-xl mb-3 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-900">Registration Guide</h2>
                                <p class="text-sm text-slate-600 mt-1">Follow these steps</p>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="flex items-start group">
                                    <div class="bg-gradient-to-r from-red-700 to-red-900 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200">1</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Company Details</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Enter your official company information</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-2">2</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Contact Information</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Provide current contact details</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-3">3</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Company Logo</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Upload high-quality branding</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-4">4</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Business Permits</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Upload required documentation</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-red-50 rounded-lg">
                                <h3 class="font-semibold text-red-900 mb-2 text-sm">Requirements:</h3>
                                <ul class="text-xs text-red-800 space-y-1">
                                    <li>• Official company registration</li>
                                    <li>• Valid contact information</li>
                                    <li>• High-resolution logo</li>
                                    <li>• Up-to-date business permits</li>
                                    <li>• Accurate industry classification</li>
                                </ul>
                            </div>

                            <div class="mt-4 p-4 bg-red-50 rounded-lg">
                                <h3 class="font-semibold text-red-900 mb-2 flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Permit Guidelines:
                                </h3>
                                <ul class="text-xs text-red-800 space-y-1">
                                    <li>• Current and valid permits</li>
                                    <li>• Clearly legible details</li>
                                    <li>• Matching company name</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Form Content -->
                    <div class="lg:col-span-5">
                        <div class="bg-gray-50 rounded-2xl shadow-xl border border-red-900/60 p-8">
                            <!-- Progress Header -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Complete Your Profile</h2>
                                        <p class="text-slate-600">Fill in your company details below</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-red-800 mb-1" id="progress-percentage">0%</div>
                                        <div class="text-sm text-slate-500">Complete</div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-red-600 to-pink-900 h-3 rounded-full transition-all duration-500 ease-out" id="progress-bar" style="width: 0%"></div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('company.form.store') }}" enctype="multipart/form-data" onsubmit="return validateCompanyForm()">
                                @csrf

                                <!-- Error Alert -->
                                @if ($errors->any())
                                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <h3 class="text-red-800 font-semibold mb-1">Please fix the following errors:</h3>
                                                <ul class="text-red-700 text-sm list-disc list-inside space-y-1">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="text-red-400 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                <!-- Session Error Alert -->
                                @if (session('error'))
                                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                                            </div>
                                            <button type="button" onclick="this.parentElement.parentElement.style.display='none'" class="text-red-400 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                <!-- Success Alert -->
                                @if (session('success'))
                                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-800 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-red-800 font-medium">{{ session('success') }}</p>
                                            </div>
                                            <button type="button" onclick="this.parentElement.parentElement.style.display='none'" class="text-red-100 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <!-- Company Information Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex items-center">
                                            <div class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-600 to-red-800 rounded-xl mr-4 shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-slate-900">Company Information</h3>
                                                <p class="text-slate-600">Basic details about your organization</p>
                                            </div>
                                        </div>
                                        <div class="hidden md:flex items-center space-x-2 text-sm bg-slate-100 px-4 py-2 rounded-full">
                                            <span class="text-slate-600">Step</span>
                                            <span class="font-bold text-red-800" id="current-step">1</span>
                                            <span class="text-slate-600">of 4</span>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-red-100 to-red-200 border border-red-200 rounded-2xl p-6 mb-8">
                                        <div class="flex items-start">
                                            <div class="inline-flex items-center justify-center w-8 h-8 bg-red-800 rounded-lg mr-4 flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-red-900 font-semibold mb-1">Verification Requirements</p>
                                                <p class="text-red-800 text-sm leading-relaxed">All company information will be verified for accuracy and authenticity. Please ensure all details match your official business registration.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="md:col-span-2">
                                            <label for="name" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Company Name *
                                                <span class="text-xs font-normal text-slate-600">(Official registered name)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="name" name="name" required
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50"
                                                       placeholder="Enter your official company name" value="{{ old('name') }}">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="industry" class="block text-sm font-semibold text-slate-800 mb-3">Industry *</label>
                                            <div class="relative">
                                                <select id="industry" name="industry" required
                                                        class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50 appearance-none">
                                                    <option value="">Select Industry</option>
                                                    <option value="Technology" {{ old('industry') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                                    <option value="Healthcare" {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                                    <option value="Finance" {{ old('industry') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                    <option value="Education" {{ old('industry') == 'Education' ? 'selected' : '' }}>Education</option>
                                                    <option value="Manufacturing" {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                                    <option value="Retail" {{ old('industry') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                                    <option value="Consulting" {{ old('industry') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                                    <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="company_size" class="block text-sm font-semibold text-slate-800 mb-3">Company Size *</label>
                                            <div class="relative">
                                                <select id="company_size" name="company_size" required
                                                        class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50 appearance-none">
                                                    <option value="">Select Size</option>
                                                    <option value="1-10" {{ old('company_size') == '1-10' ? 'selected' : '' }}>1-10 employees</option>
                                                    <option value="11-50" {{ old('company_size') == '11-50' ? 'selected' : '' }}>11-50 employees</option>
                                                    <option value="51-200" {{ old('company_size') == '51-200' ? 'selected' : '' }}>51-200 employees</option>
                                                    <option value="201-500" {{ old('company_size') == '201-500' ? 'selected' : '' }}>201-500 employees</option>
                                                    <option value="501-1000" {{ old('company_size') == '501-1000' ? 'selected' : '' }}>501-1000 employees</option>
                                                    <option value="1000+" {{ old('company_size') == '1000+' ? 'selected' : '' }}>1000+ employees</option>
                                                </select>
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="location" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Location *
                                                <span class="text-xs font-normal text-slate-600">(City, Province)</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="location" name="location" required
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50"
                                                       placeholder="Manila, Metro Manila" value="{{ old('location') }}">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="website" class="block text-sm font-semibold text-slate-800 mb-3">Website</label>
                                            <div class="relative">
                                                <input type="url" id="website" name="website"
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50"
                                                       placeholder="https://yourcompany.com" value="{{ old('website') }}">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="phone" class="block text-sm font-semibold text-slate-800 mb-3">Phone</label>
                                            <div class="relative">
                                                <input type="tel" id="phone" name="phone"
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50"
                                                       placeholder="+63 912 345 6789" value="{{ old('phone') }}">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="md:col-span-2">
                                            <label for="description" class="block text-sm font-semibold text-slate-800 mb-3">Company Description</label>
                                            <div class="relative">
                                                <textarea id="description" name="description" rows="5"
                                                          class="w-full pl-12 pr-4 py-4 border-2 border-red-900 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-50 resize-none"
                                                          placeholder="Describe your company's mission, values, and what makes you unique...">{{ old('description') }}</textarea>
                                                <div class="absolute top-4 left-4 pointer-events-none">
                                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-xs text-slate-500 mt-2">Brief description of your company (max 500 characters)</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Logo Upload Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-xl font-semibold text-slate-900 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Company Logo
                                        </h2>
                                        <div class="text-sm text-slate-500">
                                            <span id="company-logo-uploaded">0</span> of 1 logo uploaded
                                        </div>
                                    </div>

                                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-red-800 font-medium">Logo Requirements</p>
                                                <p class="text-red-700 text-sm">Logo must be high-resolution, professional, and clearly represent your company brand.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-center">
                                        <div class="w-full max-w-md">
                                            <div class="relative">
                                                <input type="file" id="logo" name="logo" accept="image/*" required
                                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewCompanyLogo(this)">
                                                <div class="w-full h-48 border-2 border-dashed border-red-900 rounded-xl flex items-center justify-center bg-slate-50 hover:bg-slate-100 transition-colors relative">
                                                    <div class="text-center" id="logo-upload-area">
                                                        <svg class="w-12 h-12 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span class="text-sm text-black">Click to upload company logo</span>
                                                        <p class="text-xs text-slate-400 mt-1">PNG, JPG up to 5MB</p>
                                                    </div>
                                                    <img id="logo-preview" class="w-full h-full object-contain rounded-xl p-4 hidden" alt="Company logo preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Permits Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-xl font-semibold text-slate-900 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Business Permits & Documents
                                        </h2>
                                        <div class="text-sm text-slate-500">
                                            <span id="permits-uploaded-count">0</span> permits uploaded
                                        </div>
                                    </div>

                                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-red-800 font-medium">Document Requirements</p>
                                                <p class="text-red-700 text-sm">Upload clear, high-resolution images of all required business permits and licenses.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Multiple Permits Upload Area -->
                                    <div class="border-2 border-dashed border-red-900 rounded-xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-colors">
                                        <input type="file" id="business_permits" name="business_permits[]" accept="image/*,application/pdf" multiple
                                               class="hidden" onchange="handleMultipleFiles(this)">
                                        <label for="business_permits" class="cursor-pointer block">
                                            <svg class="w-12 h-12 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="text-lg font-medium text-slate-800 mb-2">Upload Business Permits</p>
                                            <p class="text-slate-500 mb-4">Click here or drag and drop multiple permit files</p>
                                            <div class="flex flex-wrap justify-center gap-2 text-xs text-slate-600">
                                                <span>• Business Permit</span>
                                                <span>• Mayor's Permit</span>
                                                <span>• BIR Certificate</span>
                                                <span>• DTI Registration</span>
                                            </div>
                                            <p class="text-xs text-slate-400 mt-2">Supported: JPG, PNG, PDF (Max 5MB each)</p>
                                        </label>
                                    </div>

                                    <!-- Uploaded Permits List -->
                                    <div class="mt-6 hidden" id="uploaded-permits-section">
                                        <h3 class="text-md font-semibold text-slate-900 mb-3">Uploaded Permits</h3>
                                        <div class="space-y-2" id="permits-files-container">
                                            <!-- Uploaded files will appear here -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-center pt-6 border-t border-slate-200">
                                    <button type="submit"
                                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-red-600 to-red-900 hover:from-red-600 hover:to-red-800 disabled:from-slate-400 disabled:to-slate-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-all duration-200 text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                            id="company-submit-btn"
                                            disabled>
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span id="company-submit-text">Complete Form (0%)</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right Side Preview Panel -->
                    <div class="lg:col-span-2">
                        <div class="bg-gray-50 rounded-2xl shadow-xl border border-red-900/60 p-6 sticky top-6">
                            <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Document Preview
                            </h2>

                            <!-- Logo Preview -->
                            <div class="mb-6">
                                <h3 class="text-sm font-semibold text-slate-700 mb-3">Company Logo</h3>
                                <div class="bg-red-50  border border-red-900 rounded-lg p-6 text-center min-h-[120px] flex items-center justify-center" id="preview-logo-container">
                                    <div>
                                        <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-xs text-slate-500">Logo preview will appear here</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Permits Preview -->
                            <div>
                                <h3 class="text-sm font-semibold text-slate-700 mb-3">Business Permits</h3>
                                <div class="space-y-3 border border-red-900 max-h-96 overflow-y-auto" id="preview-permits-container">
                                    <div class="bg-red-50 rounded-lg p-4 text-center">
                                        <svg class="w-6 h-6 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-xs text-slate-500">Permit previews will appear here</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-3 bg-blue-50 rounded-lg">
                                <p class="text-xs text-blue-800">
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
        let companyLogoUploaded = false;
        let uploadedPermits = [];

        function previewCompanyLogo(input) {
            const file = input.files[0];
            const preview = document.getElementById('logo-preview');
            const uploadArea = document.getElementById('logo-upload-area');

            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                    companyLogoUploaded = true;
                    updateCompanyProgress();
                    updateLogoPreview(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }

        function handleMultipleFiles(input) {
            const files = Array.from(input.files);

            for (let file of files) {
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" is too large. Maximum size is 5MB.`);
                    input.value = '';
                    return;
                }

                if (!file.type.startsWith('image/') && file.type !== 'application/pdf') {
                    alert(`File "${file.name}" is not supported. Please upload images (JPG, PNG) or PDF files.`);
                    input.value = '';
                    return;
                }
            }

            uploadedPermits = files;
            displayUploadedPermits(files);
            updatePermitsPreview(files);
            updateCompanyProgress();
        }

        function displayUploadedPermits(files) {
            const container = document.getElementById('permits-files-container');
            const section = document.getElementById('uploaded-permits-section');
            
            if (files.length > 0) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }

            container.innerHTML = '';

            files.forEach((file, index) => {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'flex items-center justify-between bg-slate-50 rounded-lg p-3 border border-slate-200';

                const fileInfo = document.createElement('div');
                fileInfo.className = 'flex items-center flex-1';

                const fileIcon = document.createElement('div');
                fileIcon.className = 'w-10 h-10 mr-3 flex items-center justify-center rounded-lg bg-slate-200';

                if (file.type.startsWith('image/')) {
                    fileIcon.innerHTML = '<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>';
                } else {
                    fileIcon.innerHTML = '<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
                }

                const fileDetails = document.createElement('div');
                fileDetails.className = 'min-w-0 flex-1';
                fileDetails.innerHTML = `
                    <p class="text-sm font-medium text-slate-700 truncate">${file.name}</p>
                    <p class="text-xs text-slate-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                `;

                fileInfo.appendChild(fileIcon);
                fileInfo.appendChild(fileDetails);

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'ml-3 text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors';
                removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                removeBtn.onclick = function() {
                    removePermit(index);
                };

                fileDiv.appendChild(fileInfo);
                fileDiv.appendChild(removeBtn);
                container.appendChild(fileDiv);
            });

            document.getElementById('permits-uploaded-count').textContent = files.length;
        }

        function removePermit(index) {
            uploadedPermits.splice(index, 1);
            displayUploadedPermits(uploadedPermits);
            updatePermitsPreview(uploadedPermits);
            updateCompanyProgress();

            const input = document.getElementById('business_permits');
            const dt = new DataTransfer();
            uploadedPermits.forEach(file => dt.items.add(file));
            input.files = dt.files;
        }

        function updateCompanyProgress() {
            const name = document.getElementById('name').value.trim();
            const industry = document.getElementById('industry').value;
            const companySize = document.getElementById('company_size').value;
            const location = document.getElementById('location').value.trim();
            const description = document.getElementById('description').value.trim();
            const website = document.getElementById('website').value.trim();
            const phone = document.getElementById('phone').value.trim();

            let progress = 0;
            let currentStep = 1;

            // Company information (40%)
            if (name) progress += 10;
            if (industry) progress += 10;
            if (companySize) progress += 10;
            if (location) progress += 10;

            // Optional fields (20%)
            if (description) progress += 10;
            if (website) progress += 5;
            if (phone) progress += 5;

            if (progress >= 30) currentStep = 2;

            // Logo (20%)
            if (companyLogoUploaded) {
                progress += 20;
                currentStep = 3;
            }

            // Permits (20%)
            if (uploadedPermits.length > 0) {
                progress += 20;
                currentStep = 4;
            }

            // Update UI
            document.getElementById('progress-percentage').textContent = Math.round(progress) + '%';
            document.getElementById('progress-bar').style.width = progress + '%';
            document.getElementById('current-step').textContent = currentStep;
            document.getElementById('company-logo-uploaded').textContent = companyLogoUploaded ? 1 : 0;

            // Update guide step indicators
            for (let i = 2; i <= 5; i++) {
                const stepEl = document.getElementById('guide-step-' + i);
                if (stepEl) {
                    if (i <= currentStep) {
                        stepEl.classList.remove('bg-slate-300');
                        stepEl.classList.add('bg-gradient-to-r', 'from-red-500', 'to-pink-600');
                    } else {
                        stepEl.classList.add('bg-slate-300');
                        stepEl.classList.remove('bg-gradient-to-r', 'from-red-500', 'to-pink-600');
                    }
                }
            }

            // Update submit button
            const submitBtn = document.getElementById('company-submit-btn');
            const submitText = document.getElementById('company-submit-text');
            
            if (progress >= 80 && name && industry && companySize && location && companyLogoUploaded && uploadedPermits.length > 0) {
                submitBtn.disabled = false;
                submitText.textContent = 'Register Company';
            } else {
                submitBtn.disabled = true;
                submitText.textContent = `Complete Form (${Math.round(progress)}%)`;
            }
        }

        function updateLogoPreview(imageSrc) {
            const previewContainer = document.getElementById('preview-logo-container');
            
            if (imageSrc) {
                previewContainer.innerHTML = `<img src="${imageSrc}" class="w-full h-32 object-contain rounded-lg" alt="Company Logo">`;
            } else {
                previewContainer.innerHTML = `
                    <div>
                        <svg class="w-8 h-8 mx-auto text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs text-slate-500">Logo preview will appear here</p>
                    </div>
                `;
            }
        }

        function updatePermitsPreview(files) {
            const previewContainer = document.getElementById('preview-permits-container');
            
            if (!files || files.length === 0) {
                previewContainer.innerHTML = `
                    <div class="bg-slate-100 rounded-lg p-4 text-center">
                        <svg class="w-6 h-6 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-xs text-slate-500">Permit previews will appear here</p>
                    </div>
                `;
                return;
            }

            previewContainer.innerHTML = '';

            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'bg-slate-100 rounded-lg p-2 text-center';
                        imgDiv.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-24 object-cover rounded mb-1" alt="Permit ${index + 1}">
                            <p class="text-xs text-slate-600 truncate px-1">${file.name}</p>
                        `;
                        previewContainer.appendChild(imgDiv);
                    };
                    reader.readAsDataURL(file);
                } else {
                    const pdfDiv = document.createElement('div');
                    pdfDiv.className = 'bg-slate-100 rounded-lg p-3 text-center';
                    pdfDiv.innerHTML = `
                        <svg class="w-8 h-8 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-xs text-slate-600 truncate px-1">${file.name}</p>
                        <p class="text-xs text-slate-400 mt-1">PDF Document</p>
                    `;
                    previewContainer.appendChild(pdfDiv);
                }
            }); 
        }

        function validateCompanyForm() {
            const name = document.getElementById('name').value.trim();
            const industry = document.getElementById('industry').value;
            const companySize = document.getElementById('company_size').value;
            const location = document.getElementById('location').value.trim();

            if (!name || !industry || !companySize || !location) {
                alert('Please fill in all required company information fields.');
                return false;
            }

            if (!companyLogoUploaded) {
                alert('Please upload your company logo.');
                return false;
            }

            if (uploadedPermits.length === 0) {
                alert('Please upload at least one business permit.');
                return false;
            }

            document.getElementById('company-submit-text').textContent = 'Processing...';
            document.getElementById('company-submit-btn').disabled = true;

            return true;
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['name', 'industry', 'company_size', 'location', 'description', 'website', 'phone'];
            inputs.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', updateCompanyProgress);
                    element.addEventListener('change', updateCompanyProgress);
                }
            });

            updateCompanyProgress();
        });
    </script>
</body>
</html>