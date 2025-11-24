<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $career->title }} - Career Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50">
    <!-- Header with Back Button -->
    <header class="bg-[#7F1D1D] shadow-sm border-b border-slate-100">
        <div class="container-full mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()"
                            class="inline-flex items-center px-4 py-2 bg-[#CC5353FF] hover:bg-[#8B3030FF] text-slate-100 font-medium rounded-sm transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </button>
                    <div>
                        <h1 class="text-xl font-semibold text-slate-50">{{ $career->company->name }}</h1>
                        <p class="text-sm text-slate-100">{{ $career->title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-screen mx-auto py-8 px-4 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Left column (lg): Header + Description -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Header -->
                <div class="bg-white rounded-sm shadow-md p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $career->title }}</h1>
                            @if($career->company)
                                <p class="text-xl text-gray-600 mb-4">{{ $career->company->name }}</p>
                            @endif
                        </div>
                        <div class="lg:hidden text-right">
                            @if($alreadySaved ?? false)
                                <button class="bg-green-100 text-green-800 font-medium py-2 px-4 rounded-sm mr-2 cursor-not-allowed" disabled>
                                    ✓ Saved
                                </button>
                            @else
                                <button id="save-job-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-sm transition-colors duration-200 mr-2" onclick="saveJob({{ $career->id }})">
                                    Save Job
                                </button>
                            @endif

                            @if($alreadyApplied ?? false)
                                <button class="bg-maroon-100 text-maroon-800 font-medium py-2 px-6 rounded-sm cursor-not-allowed" disabled>
                                    ✓ Applied
                                </button>
                            @else
                                <button id="apply-now-btn" class="bg-rose-600 hover:bg-rose-700 text-white font-medium py-2 px-6 rounded-sm transition-colors duration-200" onclick="applyNow({{ $career->id }})">
                                    Apply Now
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Key Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        @if($career->role_type)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                                {{ $career->role_type }}
                            </div>
                        @endif

                        @if($career->location)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $career->location }}
                            </div>
                        @endif

                        @if($career->min_salary || $career->max_salary)
                            <div class="flex items-center font-bold text-gray-700">
                                @if($career->min_salary && $career->max_salary)
                                    ₱{{ number_format($career->min_salary) }} - ₱{{ number_format($career->max_salary) }}
                                @elseif($career->min_salary)
                                    ₱{{ number_format($career->min_salary) }}+
                                @elseif($career->max_salary)
                                    Up to ₱{{ number_format($career->max_salary) }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-sm shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Job Description</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($career->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Right column (lg): Tags + Company Information + Footer -->
            <div class="space-y-6 lg:col-span-1">
                <!-- Tags -->
                @if($career->tags && count($career->tags) > 0)
                    <div class="bg-white rounded-sm shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Skills & Technologies</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($career->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-rose-100 text-rose-800">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Company Information -->
                @if($career->company)
                    <div class="bg-white rounded-sm shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">About the Company</h2>
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $career->company->name }}</h3>
                                @if($career->company->about)
                                    <p class="text-gray-700">{{ $career->company->about }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Footer -->
                <div class="bg-white rounded-sm shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Posted {{ $career->created_at->diffForHumans() }}
                        </div>
                        <div class="flex space-x-4">
                            @if($alreadySaved ?? false)
                                <button class="bg-green-100 text-green-800 font-medium py-2 px-4 rounded-sm cursor-not-allowed" disabled>
                                    ✓ Saved
                                </button>
                            @else
                                <button id="save-job-footer-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-sm transition-colors duration-200" onclick="saveJob({{ $career->id }})">
                                    Save Job
                                </button>
                            @endif

                            @if($alreadyApplied ?? false)
                                <button class="bg-maroon-100 text-maroon-800 font-medium py-2 px-6 rounded-sm cursor-not-allowed" disabled>
                                    ✓ Applied
                                </button>
                            @else
                                <button id="apply-now-footer-btn" class="bg-rose-600 hover:bg-rose-700 text-white font-medium py-2 px-6 rounded-sm transition-colors duration-200" onclick="applyNow({{ $career->id }})">
                                    Apply Now
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let saveJobListeners = [];
        let applyNowListeners = [];

        document.addEventListener('DOMContentLoaded', function() {
            const saveJobButtons = document.querySelectorAll('#save-job-btn, #save-job-footer-btn');
            const applyNowButtons = document.querySelectorAll('#apply-now-btn, #apply-now-footer-btn');
            const careerId = {{ $career->id }};

            saveJobButtons.forEach(button => {
                const listener = function() {
                    saveJob(careerId);
                };
                button.addEventListener('click', listener);
                saveJobListeners.push({ button, listener });
            });

            applyNowButtons.forEach(button => {
                const listener = function() {
                    applyNow(careerId);
                };
                button.addEventListener('click', listener);
                applyNowListeners.push({ button, listener });
            });
        });

        function saveJob(careerId) {
            // Remove event listeners to prevent multiple clicks
            saveJobListeners.forEach(({ button, listener }) => {
                button.removeEventListener('click', listener);
                button.disabled = true;
            });

            fetch('/career/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ career_id: careerId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Job saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Failed to save job.',
                    });
                }
                // Re-add event listeners and enable buttons
                saveJobListeners.forEach(({ button, listener }) => {
                    button.addEventListener('click', listener);
                    button.disabled = false;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while saving the job.',
                });
                // Re-add event listeners and enable buttons
                saveJobListeners.forEach(({ button, listener }) => {
                    button.addEventListener('click', listener);
                    button.disabled = false;
                });
            });
        }

        function applyNow(careerId) {
            // Remove event listeners to prevent multiple clicks
            applyNowListeners.forEach(({ button, listener }) => {
                button.removeEventListener('click', listener);
                button.disabled = true;
            });

            fetch('/career/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ career_id: careerId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Application submitted successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Failed to submit application.',
                    });
                }
                // Re-add event listeners and enable buttons
                applyNowListeners.forEach(({ button, listener }) => {
                    button.addEventListener('click', listener);
                    button.disabled = false;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while submitting the application.',
                });
                // Re-add event listeners and enable buttons
                applyNowListeners.forEach(({ button, listener }) => {
                    button.addEventListener('click', listener);
                    button.disabled = false;
                });
            });
        }
    </script>
</body>
</html>