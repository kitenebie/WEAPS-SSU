<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Applicant Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <style>
        #faceContainer {
            position: relative;
            display: inline-block;
            margin: 20px 0;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
        }

        #profileImagePreview {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #faceVideoContainer {
            position: relative;
            display: inline-block;
        }

        #faceOverlay {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        #faceStatus {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        #faceInstructions {
            display: none;
            margin-top: 10px;
        }

        #faceInstructions ul {
            list-style: none;
            padding: 0;
        }

        #faceInstructions li {
            margin: 5px 0;
        }

        .permission-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .permission-modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            text-align: center;
        }

        .permission-modal button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Header with Back Button -->
    <header class="bg-red-50 shadow-sm border-b border-slate-200">
        <div class="container-full mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()"
                            class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-slate-700 font-medium rounded-lg transition-colors duration-200">
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
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-red-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-red-800 rounded-full animate-pulse"></div>
                        <span class="text-red-700 font-medium">Secure Registration</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-red-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 font-medium">AI Verification</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-red-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-700 font-medium">Face Live Detection</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Camera Access Alert Modal -->
    <div id="cameraAlertModal" class="permission-modal" style="display: none;">
        <div class="permission-modal-content">
            <h3>📷 Camera Access Required</h3>
            <p><strong>This website wants to access your camera</strong></p>
            <p>We need camera access to:</p>
            <ul style="text-align: left; margin: 10px 0;">
                <li>📸 Capture your profile picture</li>
                <li>👤 Perform face detection for verification</li>
                <li>🎯 Ensure photo quality and proper positioning</li>
            </ul>
            <p style="font-size: 14px; color: #666; margin: 10px 0;">
                Your privacy is important. The camera will only be used during registration and no images are stored without your consent.
            </p>
            <div>
                <button id="proceedToCameraBtn" style="background: #4CAF50; color: white;">Continue to Camera</button>
                <button id="cancelCameraBtn" style="background: #f44336; color: white;">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Permission Modal -->
    <div id="permissionModal" class="permission-modal" style="display: none;">
        <div class="permission-modal-content">
            <h3>Camera Access Required</h3>
            <p id="permissionMessage">To capture your profile picture, we need access to your camera. Please allow camera access when prompted by your browser.</p>
            <div>
                <button id="allowCameraBtn" style="background: #4CAF50; color: white;">Allow Camera Access</button>
                <button id="skipCameraBtn" style="background: #f44336; color: white;">Skip Camera</button>
                <button id="tryAgainBtn" style="background: #2196F3; color: white; display: none;">Try Again</button>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-red-50">
        <div class="container-full mx-auto px-4 py-8">
            <div class="max-w-full mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-red-800 to-red-900 rounded-full mb-6 shadow-lg">
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
                        <div class="bg-gray-100 rounded-2xl shadow-xl border border-slate-200/60 p-6 sticky top-6">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-red-800 to-red-900 rounded-xl mb-3 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-slate-900">Registration Guide</h2>
                                <p class="text-sm text-slate-600 mt-1">Follow these steps</p>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div class="flex items-start group">
                                    <div class="bg-gradient-to-r from-red-800 to-red-900 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200">1</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Personal Details</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Enter your legal information</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="bg-slate-300 text-white rounded-xl w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 shadow-lg group-hover:scale-110 transition-transform duration-200" id="guide-step-2">2</div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-slate-800">Profile Photo</p>
                                        <p class="text-slate-600 text-xs leading-relaxed">Capture your profile photo using face detection</p>
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

                            <div class="mt-6 p-4 bg-red-50 rounded-lg">
                                <h3 class="font-semibold text-red-900 mb-2 text-sm">Document Requirements:</h3>
                                <ul class="text-xs text-red-800 space-y-1">
                                    <li>• Current School-issued ID</li>
                                    <li>• Recent professional photo</li>
                                    <li>• Clear, high-resolution images</li>
                                    <li>• All details must match exactly</li>
                                    <li>• AI verification required</li>
                                </ul>
                            </div>

                            <div class="mt-4 p-4 bg-red-50 rounded-lg">
                                <h3 class="font-semibold text-red-900 mb-2 flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Quality Guidelines:
                                </h3>
                                <ul class="text-xs text-red-800 space-y-1">
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
                        <div class="bg-gray-100 rounded-2xl shadow-xl border border-slate-200/60 p-8">
                            <!-- Progress Header -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Complete Your Profile</h2>
                                        <p class="text-slate-600">Fill in your details and upload documents below</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-red-600 mb-1" id="progress-percentage">0%</div>
                                        <div class="text-sm text-slate-500">Complete</div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-red-800 to-red-900 h-3 rounded-full transition-all duration-500 ease-out" id="progress-bar" style="width: 0%"></div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('verification.update-role', 'applicant') }}" enctype="multipart/form-data" onsubmit="return validateApplicantForm()">
                                @csrf

                                <!-- Personal Information Section -->
                                <div class="mb-10">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex items-center">
                                            <div class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-800 to-red-900 rounded-xl mr-4 shadow-lg">
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
                                            <span class="font-bold text-red-600" id="current-step">1</span>
                                            <span class="text-slate-600">of 4</span>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 mb-8">
                                        <div class="flex items-start">
                                            <div class="inline-flex items-center justify-center w-8 h-8 bg-red-500 rounded-lg mr-4 flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-red-900 font-semibold mb-1">Verification Requirements</p>
                                                <p class="text-red-800 text-sm leading-relaxed">All personal information must exactly match your School-issued ID. AI verification will cross-check all details for accuracy and consistency.</p>
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
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-100"
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
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-100"
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
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-100"
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
                                                   class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200 bg-slate-50 focus:bg-gray-100"
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
                                            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                                    <div class="flex w-full items-center justify-center">
                                        <!-- Profile Image with Face Detection -->
                                        <div>
                                            <label for="profile_image" class="block text-sm font-semibold text-slate-800 mb-3">
                                                Profile Image *
                                                <span class="text-xs font-normal text-slate-600">(Face detection capture)</span>
                                            </label>
                                            <div class="relative">
                                                <!-- Face Detection Section -->
                                                <div id="faceContainer">
                                                    <h3 class="text-lg font-semibold mb-2">Profile Picture Capture</h3>

                                                    <div id="faceVideoContainer">
                                                        <video id="faceVideo" style="width: 100% !important;" height="240" autoplay muted playsinline></video>
                                                        <canvas id="faceOverlay"></canvas>
                                                        <!-- Profile Picture Preview Overlay -->
                                                        <div id="profileImagePreview">
                                                            <p class="text-xs font-medium text-gray-700 mb-1">Profile Picture:</p>
                                                            <img id="capturedImage" class="hidden" style="width: 100% !important; height: 240px !important;" height="240" src="" alt="Captured Profile Picture">
                                                        </div>
                                                    </div>

                                                    <div id="faceStatus">💡 Click "Start Face Detection" to begin, or "Test Camera" to check camera access first.</div>
                                                    <div id="faceInstructions">
                                                        <p class="font-medium">Follow these steps in order:</p>
                                                        <ul>
                                                            <li id="faceStep1">Step 1: Keep only one face in view</li>
                                                            <li id="faceStep2">Step 2: Smile (required before blinking)</li>
                                                            <li id="faceStep3">Step 3: Blink your eyes (after smiling)</li>
                                                        </ul>
                                                    </div>

                                                    <div class="flex gap-2 flex-wrap">
                                                        <button type="button" id="startFaceButton"
                                                            class="mt-2 px-4 py-2 bg-red-800 text-white rounded hover:bg-red-900 text-sm">Start Face
                                                            Detection</button>
                                                    </div>
                                                </div>

                                                <!-- Hidden Profile Image Input -->
                                                <input type="hidden" name="profile_image_data" id="profileImageData">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-red-800 to-red-900 hover:from-red-900 hover:to-red-900 disabled:from-slate-400 disabled:to-slate-400 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-all duration-200 text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
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
                        <div class="bg-gray-100 rounded-2xl shadow-xl border border-slate-200/60 p-6 sticky top-6">
                            <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                            <div class="mt-6 p-3 bg-red-50 rounded-lg">
                                <p class="text-xs text-red-800">
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
        // Enhanced camera permission and access management
        console.log('🚀 Enhanced face detection script loaded at:', new Date().toISOString());

        // Global variables
        const faceVideo = document.getElementById('faceVideo');
        const faceOverlay = document.getElementById('faceOverlay');
        const faceStatus = document.getElementById('faceStatus');
        const faceStep1 = document.getElementById('faceStep1');
        const faceStep2 = document.getElementById('faceStep2');
        const faceStep3 = document.getElementById('faceStep3');
        const startFaceButton = document.getElementById('startFaceButton');
        const faceInstructions = document.getElementById('faceInstructions');
        const profileImagePreview = document.getElementById('profileImagePreview');
        const capturedImage = document.getElementById('capturedImage');
        const profileImageData = document.getElementById('profileImageData');
        const permissionModal = document.getElementById('permissionModal');
        const permissionMessage = document.getElementById('permissionMessage');

        let blinkDetected = false;
        let smileDetected = false;
        let singleFaceDetected = false;
        let validationCount = 0;
        let photoCaptured = false;
        let stream = null;
        let currentPermissionState = 'unknown';

        // Enhanced blink detection variables
        let blinkHistory = [];
        let lastBlinkTime = 0;
        let blinkCalibrationFrames = 0;
        let baselineEAR = null;
        let earThreshold = 0.25;
        let consecutiveBlinkFrames = 0;
        let requiredConsecutiveFrames = 1; // Make it easier to detect

        // Speech synthesis for instructions
        function speak(text) {
            if ('speechSynthesis' in window) {
                // Cancel any ongoing speech
                speechSynthesis.cancel();

                const utterance = new SpeechSynthesisUtterance(text);
                utterance.rate = 0.8; // Slightly slower for clarity
                utterance.pitch = 1;
                utterance.volume = 0.8;

                speechSynthesis.speak(utterance);
            } else {
                console.log('Speech synthesis not supported in this browser');
            }
        }

        // Enhanced camera permission manager
        class CameraPermissionManager {
            static async checkPermissionStatus() {
                try {
                    if (!navigator.permissions) {
                        return 'unavailable';
                    }

                    const result = await navigator.permissions.query({ name: 'camera' });
                    console.log('Camera permission status:', result.state);
                    return result.state; // 'granted', 'denied', or 'prompt'
                } catch (error) {
                    console.log('Permission API not available, will check via getUserMedia');
                    return 'unavailable';
                }
            }

            static showPermissionModal(message, showTryAgain = false) {
                permissionMessage.textContent = message;
                document.getElementById('tryAgainBtn').style.display = showTryAgain ? 'inline-block' : 'none';
                permissionModal.style.display = 'flex';
            }

            static hidePermissionModal() {
                permissionModal.style.display = 'none';
            }

            static async requestCameraAccess(constraints = null) {
                const defaultConstraints = {
                    video: {
                        width: { ideal: 640 },
                        height: { ideal: 480 },
                        facingMode: 'user'
                    }
                };

                try {
                    console.log('Requesting camera access...');
                    const stream = await navigator.mediaDevices.getUserMedia(constraints || defaultConstraints);
                    console.log('✅ Camera access granted');
                    currentPermissionState = 'granted';
                    return stream;
                } catch (error) {
                    console.error('❌ Camera access failed:', error);
                    currentPermissionState = 'denied';
                    this.handleCameraError(error);
                    throw error;
                }
            }

            static handleCameraError(error) {
                let title = 'Camera Access Issue';
                let message = '';
                let showTryAgain = false;

                switch (error.name) {
                    case 'NotAllowedError':
                        title = 'Camera Permission Denied';
                        message = 'Camera access was denied. To use the camera feature:\n\n' +
                                  '1. Click the camera icon in your browser\'s address bar\n' +
                                  '2. Select "Allow" for camera access\n' +
                                  '3. Refresh the page and try again\n\n' +
                                  'Or you can skip camera and upload a photo instead.';
                        showTryAgain = true;
                        break;

                    case 'NotFoundError':
                        title = 'No Camera Found';
                        message = 'No camera device was found on your device. Please connect a camera and try again, or upload a photo instead.';
                        break;

                    case 'NotReadableError':
                        title = 'Camera In Use';
                        message = 'Your camera is currently being used by another application. Please close other apps using the camera and try again.';
                        showTryAgain = true;
                        break;

                    case 'OverconstrainedError':
                        title = 'Camera Quality Issue';
                        message = 'Your camera doesn\'t support the requested video quality. We\'ll try with lower settings.';
                        showTryAgain = true;
                        break;

                    case 'SecurityError':
                        title = 'Security Restriction';
                        message = 'Camera access is blocked due to security settings. Please check your browser security settings.';
                        break;

                    default:
                        title = 'Camera Error';
                        message = `An unexpected error occurred: ${error.message || 'Unknown error'}. Please try again or upload a photo instead.`;
                        showTryAgain = true;
                }

                this.showPermissionModal(`${title}\n\n${message}`, showTryAgain);

                // Update status in the main interface
                faceStatus.textContent = `❌ ${title}: ${error.message || 'Please see the popup for details'}`;
                faceStatus.style.color = 'red';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', async function() {
            console.log('DOM loaded, initializing enhanced face detection');

            // Check browser compatibility
            if (!checkBrowserCompatibility()) return;

            // Check HTTPS requirement
            if (!checkHTTPSRequirement()) return;

            // Check initial permission status
            const permissionStatus = await CameraPermissionManager.checkPermissionStatus();
            console.log('Initial permission status:', permissionStatus);

            // Check if face-api.js loads properly
            checkFaceApiLoading();

            // Auto-show manual upload after 10 seconds if no action taken
            setTimeout(() => {
                if (!stream && !photoCaptured) {
                    console.log('⏰ Auto-showing manual upload option after timeout');
                    showManualUpload();
                    faceStatus.textContent = '💡 Taking too long? Try the manual upload option below.';
                    faceStatus.style.color = '#666';
                }
            }, 10000);
        });

        function checkBrowserCompatibility() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                faceStatus.textContent = '❌ Your browser does not support camera access. Please use a modern browser like Chrome, Firefox, or Edge.';
                faceStatus.style.color = 'red';
                startFaceButton.disabled = true;
                showManualUpload();
                return false;
            }
            return true;
        }

        function checkHTTPSRequirement() {
            if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
                faceStatus.textContent = '⚠️ Camera access requires HTTPS. Please use HTTPS or localhost.';
                faceStatus.style.color = 'red';
                startFaceButton.disabled = true;
                showManualUpload();
                return false;
            }
            return true;
        }

        function checkFaceApiLoading() {
            setTimeout(function() {
                try {
                    if (typeof faceapi !== 'undefined') {
                        console.log('✅ face-api.js loaded successfully');
                    } else {
                        console.error('❌ face-api.js failed to load');
                        faceStatus.textContent = '❌ Face detection library failed to load. Internet connection issue.';
                        faceStatus.style.color = 'red';
                        showManualUpload();
                    }
                } catch (error) {
                    console.error('❌ Error checking face-api.js:', error);
                }
            }, 2000);
        }

        function showManualUpload() {
            document.getElementById('manualUploadSection').style.display = 'block';
        }

        // Show camera alert modal first
        function showCameraAlertModal(callback) {
            document.getElementById('cameraAlertModal').style.display = 'flex';

            // Handle proceed button
            document.getElementById('proceedToCameraBtn').onclick = function() {
                document.getElementById('cameraAlertModal').style.display = 'none';
                callback();
            };

            // Handle cancel button
            document.getElementById('cancelCameraBtn').onclick = function() {
                document.getElementById('cameraAlertModal').style.display = 'none';
                faceStatus.textContent = '❌ Camera access cancelled by user.';
                faceStatus.style.color = 'orange';
            };
        }

        // Start face detection with enhanced permission handling
        startFaceButton.addEventListener('click', async () => {
            console.log('🚀 Start face detection button clicked');
            console.log('📋 Current browser info:', navigator.userAgent);
            console.log('🔒 Current protocol:', location.protocol);
            console.log('🌐 Current hostname:', location.hostname);

            // Check basic requirements first
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                console.error('❌ getUserMedia not supported');
                faceStatus.textContent = '❌ Your browser does not support camera access. Please use a modern browser like Chrome, Firefox, or Edge.';
                faceStatus.style.color = 'red';
                return;
            }

            if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
                console.error('❌ HTTPS required for camera access');
                faceStatus.textContent = '❌ Camera access requires HTTPS. Please use HTTPS or localhost.';
                faceStatus.style.color = 'red';
                return;
            }

            showCameraAlertModal(async () => {
                startFaceButton.disabled = true;
                faceStatus.textContent = '🔄 Starting face detection...';
                faceStatus.style.color = '#666';

                try {
                    console.log('🔄 Calling startFaceDetection...');
                    await startFaceDetection();
                    console.log('✅ startFaceDetection completed');
                } catch (error) {
                    console.error('❌ Error starting face detection:', error);
                    faceStatus.textContent = '❌ Error: ' + error.message;
                    faceStatus.style.color = 'red';
                    startFaceButton.disabled = false;
                }
            });
        });

        // Permission modal event listeners
        document.getElementById('allowCameraBtn').addEventListener('click', async () => {
            CameraPermissionManager.hidePermissionModal();

            // Show camera alert before requesting permission
            showCameraAlertModal(async () => {
                try {
                    const stream = await CameraPermissionManager.requestCameraAccess();
                    // If successful, continue with face detection
                    if (stream) {
                        continueWithFaceDetection(stream);
                    }
                } catch (error) {
                    // Error already handled in CameraPermissionManager
                }
            });
        });

        document.getElementById('tryAgainBtn').addEventListener('click', async () => {
            CameraPermissionManager.hidePermissionModal();

            // Try with lower constraints if previous attempt failed
            const fallbackConstraints = {
                video: {
                    width: { ideal: 320 },
                    height: { ideal: 240 },
                    facingMode: 'user'
                }
            };

            try {
                const stream = await CameraPermissionManager.requestCameraAccess(fallbackConstraints);
                if (stream) {
                    continueWithFaceDetection(stream);
                }
            } catch (error) {
                // If still fails, show manual upload
                showManualUpload();
            }
        });

        function hideAllCameraButtons() {
            document.getElementById('startFaceButton').style.display = 'none';
        }

        async function startFaceDetection() {
            try {
                console.log('🚀 Starting face detection initialization');

                // Check if face-api.js is loaded
                if (typeof faceapi === 'undefined') {
                    throw new Error('face-api.js library not loaded. Please check your internet connection.');
                }

                // Check permission status first
                const permissionStatus = await CameraPermissionManager.checkPermissionStatus();
                console.log('📋 Permission status:', permissionStatus);

                if (permissionStatus === 'denied') {
                    CameraPermissionManager.showPermissionModal(
                        'Camera access was previously denied. Please allow camera access in your browser settings and refresh the page.',
                        true
                    );
                    return;
                }

                faceStatus.textContent = '📚 Loading face detection models...';
                console.log('📥 Loading face-api models...');

                // Load models with progress updates
                try {
                    await faceapi.nets.tinyFaceDetector.loadFromUri(
                        'https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js/weights/');
                    console.log('✅ TinyFaceDetector loaded');
                    faceStatus.textContent = '📚 Loading models... 33%';

                    await faceapi.nets.faceLandmark68Net.loadFromUri(
                        'https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js/weights/');
                    console.log('✅ FaceLandmark68Net loaded');
                    faceStatus.textContent = '📚 Loading models... 66%';

                    await faceapi.nets.faceExpressionNet.loadFromUri(
                        'https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js/weights/');
                    console.log('✅ FaceExpressionNet loaded');
                    faceStatus.textContent = '📚 Models loaded successfully!';

                } catch (modelError) {
                    console.error('❌ Error loading models:', modelError);
                    throw new Error('Failed to load face detection models. Please check your internet connection.');
                }

                console.log('✅ All models loaded successfully');
                faceStatus.textContent = '📹 Requesting camera access...';

                // Request camera access
                console.log('📷 Requesting camera access...');
                stream = await CameraPermissionManager.requestCameraAccess();
                console.log('✅ Camera access granted');

                continueWithFaceDetection(stream);

            } catch (error) {
                console.error('❌ Error in startFaceDetection:', error);
                faceStatus.textContent = '❌ Error: ' + error.message;
                faceStatus.style.color = 'red';
                startFaceButton.disabled = false;

                // Show manual upload option on error
                setTimeout(() => {
                    showManualUpload();
                }, 2000);
            }
        }

        async function continueWithFaceDetection(cameraStream) {
            try {
                stream = cameraStream;
                console.log('✅ Camera access granted, setting up video stream');
                faceVideo.srcObject = stream;

                // Wait for video to be ready
                await new Promise((resolve) => {
                    faceVideo.addEventListener('loadedmetadata', () => {
                        console.log('📺 Video metadata loaded, dimensions:', faceVideo.videoWidth, 'x', faceVideo.videoHeight);
                        resolve();
                    });
                });

                faceStatus.textContent = '🎯 Camera ready. Keep your face in view, smile first, then blink to complete validation!';
                faceStatus.style.color = 'red';
                faceInstructions.style.display = 'block';

                // Speak initial instruction - Step 1
                speak('Step 1: Keep only one face in view');

                // Start face detection
                detectFaces();

            } catch (error) {
                console.error('❌ Error in continueWithFaceDetection:', error);
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
                startFaceButton.disabled = false;
            }
        }

        // Euclidean distance calculation
        function euclideanDistance(p1, p2) {
            return Math.sqrt(Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2));
        }

        // Enhanced eye aspect ratio calculation for blink detection
        function getEyeAspectRatio(eye) {
            if (!eye || eye.length < 6) {
                return 1.0; // Return open eye ratio if landmarks are invalid
            }

            try {
                const A = euclideanDistance(eye[1], eye[5]);
                const B = euclideanDistance(eye[2], eye[4]);
                const C = euclideanDistance(eye[0], eye[3]);

                if (C === 0) return 1.0; // Prevent division by zero

                const ear = (A + B) / (2.0 * C);

                // Validate EAR is within reasonable bounds
                if (ear < 0 || ear > 1 || isNaN(ear)) {
                    return 1.0;
                }

                return ear;
            } catch (error) {
                console.warn('Error calculating EAR:', error);
                return 1.0;
            }
        }

        // Enhanced blink detection with calibration and temporal consistency
        function detectBlink(leftEye, rightEye) {
            const leftEAR = getEyeAspectRatio(leftEye);
            const rightEAR = getEyeAspectRatio(rightEye);
            const avgEAR = (leftEAR + rightEAR) / 2.0;

            // Log EAR values for debugging
            console.log(`👁️ EAR Values - Left: ${leftEAR.toFixed(3)}, Right: ${rightEAR.toFixed(3)}, Avg: ${avgEAR.toFixed(3)}`);

            // Calibration phase - collect baseline EAR for first 30 frames
            if (blinkCalibrationFrames < 30) {
                blinkHistory.push(avgEAR);
                blinkCalibrationFrames++;

                console.log(`📊 Calibration Frame ${blinkCalibrationFrames}/30 - EAR: ${avgEAR.toFixed(3)}`);

                if (blinkCalibrationFrames === 30) {
                    // Calculate baseline EAR (average of collected frames)
                    baselineEAR = blinkHistory.reduce((sum, ear) => sum + ear, 0) / blinkHistory.length;

                    // Set dynamic threshold based on baseline (25% below baseline for maximum sensitivity)
                    earThreshold = Math.max(0.08, baselineEAR * 0.75);

                    console.log(`🔍 Blink calibration complete. Baseline EAR: ${baselineEAR.toFixed(3)}, Threshold: ${earThreshold.toFixed(3)}`);
                    console.log(`📊 EAR History: [${blinkHistory.map(ear => ear.toFixed(3)).join(', ')}]`);

                    // Update status to show calibration is complete
                    faceStatus.textContent = `🎯 Blink detection calibrated! Baseline: ${baselineEAR.toFixed(3)}, Threshold: ${earThreshold.toFixed(3)}. Now blink your eyes!`;
                    faceStatus.style.color = 'green';

                    // Add visual indicator that blink detection is ready
                    faceStep1.innerHTML = 'Step 1: Blink your eyes (Ready!)';
                    faceStep1.style.color = 'red';

                    // Show manual blink button as fallback
                    document.getElementById('manualBlinkBtn').style.display = 'inline-block';
                } else if (blinkCalibrationFrames % 10 === 0) {
                    // Show calibration progress
                    const progress = Math.round((blinkCalibrationFrames / 30) * 100);
                    faceStatus.textContent = `🔄 Calibrating blink detection... ${progress}% (Current EAR: ${avgEAR.toFixed(3)})`;
                }
                return false;
            }

            // Check for blink using dynamic threshold
            const isBlinking = avgEAR < earThreshold;

            console.log(`🎯 Blink Check - EAR: ${avgEAR.toFixed(3)}, Threshold: ${earThreshold.toFixed(3)}, Is Blinking: ${isBlinking}, Consecutive: ${consecutiveBlinkFrames}`);

            if (isBlinking) {
                consecutiveBlinkFrames++;

                console.log(`⚡ Blink detected! Consecutive frames: ${consecutiveBlinkFrames}/${requiredConsecutiveFrames}`);

                // Require multiple consecutive frames to confirm blink
                if (consecutiveBlinkFrames >= requiredConsecutiveFrames) {
                    // Check timing to prevent rapid repeated detections
                    const currentTime = Date.now();
                    if (currentTime - lastBlinkTime > 1000) { // Minimum 1 second between blinks
                        console.log(`✅ BLINK CONFIRMED! Time since last blink: ${(currentTime - lastBlinkTime)}ms`);
                        lastBlinkTime = currentTime;
                        consecutiveBlinkFrames = 0;
                        return true;
                    } else {
                        console.log(`⏳ Blink too soon (${currentTime - lastBlinkTime}ms < 1000ms), ignoring`);
                    }
                }
            } else {
                if (consecutiveBlinkFrames > 0) {
                    console.log(`❌ Blink sequence broken, resetting counter`);
                }
                consecutiveBlinkFrames = 0;
            }

            return false;
        }

        // Reset blink detection state
        function resetBlinkDetection() {
            blinkHistory = [];
            blinkCalibrationFrames = 0;
            baselineEAR = null;
            earThreshold = 0.25;
            consecutiveBlinkFrames = 0;
            lastBlinkTime = 0;
        }

        async function detectFaces() {
            const canvas = faceOverlay;
            const displaySize = {
                width: faceVideo.videoWidth,
                height: faceVideo.videoHeight
            };
            faceapi.matchDimensions(canvas, displaySize);

            const detectionInterval = setInterval(async () => {
                try {
                    const detections = await faceapi.detectAllFaces(faceVideo, new faceapi.TinyFaceDetectorOptions())
                        .withFaceLandmarks()
                        .withFaceExpressions();

                    const resizedDetections = faceapi.resizeResults(detections, displaySize);
                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                    // Remove overlay drawing - no visual overlay needed
                    // faceapi.draw.drawDetections(canvas, resizedDetections);
                    // faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);

                    if (detections.length === 1) {
                        const detection = detections[0];
                        const landmarks = detection.landmarks;
                        const expressions = detection.expressions;

                        // Check single face
                        if (!singleFaceDetected) {
                            singleFaceDetected = true;
                            faceStep1.innerHTML = 'Step 1: Keep only one face in view ✅';
                            speak('Step 1 completed. Now smile first, then blink your eyes to complete validation');
                        }

                        // Check eye blink (only after smile is detected)
                        const leftEye = landmarks.getLeftEye();
                        const rightEye = landmarks.getRightEye();
                        const leftEAR = getEyeAspectRatio(leftEye);
                        const rightEAR = getEyeAspectRatio(rightEye);
                        const ear = (leftEAR + rightEAR) / 2.0;

                        if (ear < 0.25) {
                            if (smileDetected) {
                                if (!blinkDetected) {
                                    blinkDetected = true;
                                    faceStep3.innerHTML = 'Step 3: Blink your eyes ✅';
                                    speak('Blink detected. All validations complete');
                                    console.log('👁️ Blink detected with EAR:', ear.toFixed(3));
                                }
                            } else {
                                // User tried to blink before smiling
                                if (!blinkDetected) {
                                    faceStatus.textContent = '😊 Please smile first before blinking your eyes!';
                                    speak('Please smile first');
                                    console.log('👁️ Blink attempted before smile - rejected');
                                }
                            }
                        }

                        // Check smile
                        if (expressions.happy > 0.7) {
                            if (!smileDetected) {
                                smileDetected = true;
                                if (blinkDetected) {
                                    faceStep2.innerHTML = 'Step 2: Smile ✅';
                                    speak('Smile detected. All validations complete');
                                } else {
                                    faceStep2.innerHTML = 'Step 2: Smile ✅ (waiting for blink)';
                                }
                            }
                        }

                        // Face detected successfully - no visual overlay needed

                        // Check if all validations passed
                        if (blinkDetected && smileDetected && singleFaceDetected && !photoCaptured) {
                            validationCount++;
                            if (validationCount === 1) {
                                speak('Validation in progress');
                            }
                            faceStatus.textContent = `🎯 Validating... ${validationCount}/5`;
                            if (validationCount >= 5) {
                                clearInterval(detectionInterval);
                                faceStatus.textContent = '✅ Validation completed! All steps successful.';
                                faceStatus.style.color = 'green';
                                speak('All steps completed successfully. Capturing your profile photo now');
                                setTimeout(() => {
                                    capturePhoto();
                                }, 1000); // Brief pause to show completion message
                                photoCaptured = true;
                            }
                        } else {
                            validationCount = 0;
                            // Reset status if validation is broken
                            if (blinkDetected || smileDetected || singleFaceDetected) {
                                faceStatus.textContent = '⏳ Validation in progress...';
                                faceStatus.style.color = '#666';
                            }
                        }
                    } else if (detections.length === 0) {
                        faceStatus.textContent = '👤 No face detected. Please position your face in the camera view.';
                        if (!singleFaceDetected) {
                            speak('No face detected. Please position your face in the camera view');
                        }
                        resetValidations();
                    } else {
                        faceStatus.textContent = `👥 Multiple faces detected (${detections.length}). Please ensure only one person is in view.`;
                        speak('Multiple faces detected. Please ensure only one person is in view');
                        resetValidations();
                    }
                } catch (error) {
                    console.error('Error in face detection:', error);
                    clearInterval(detectionInterval);
                    faceStatus.textContent = '❌ Face detection error. Please try again.';
                    faceStatus.style.color = 'red';
                    startFaceButton.disabled = false;
                }
            }, 100);
        }

        function resetValidations() {
            blinkDetected = false;
            smileDetected = false;
            singleFaceDetected = false;
            validationCount = 0;
            faceStep1.innerHTML = 'Step 1: Keep only one face in view';
            faceStep2.innerHTML = 'Step 2: Smile';
            faceStep3.innerHTML = 'Step 3: Blink your eyes';

            // Reset enhanced blink detection
            resetBlinkDetection();
        }

        async function capturePhoto() {
            try {
                console.log('📷 Capturing photo');

                if (!faceVideo.videoWidth || !faceVideo.videoHeight) {
                    throw new Error('Video dimensions not available');
                }

                const canvas = document.createElement('canvas');
                canvas.width = faceVideo.videoWidth;
                canvas.height = faceVideo.videoHeight;
                const ctx = canvas.getContext('2d');

                if (!ctx) {
                    throw new Error('Could not get canvas context');
                }

                ctx.drawImage(faceVideo, 0, 0);
                const dataURL = canvas.toDataURL('image/png');
                console.log('✅ Photo captured, data URL length:', dataURL.length);

                profileImageData.value = dataURL;
                capturedImage.src = dataURL;
                capturedImage.classList.remove('hidden');
                profileImagePreview.style.display = 'block';
                speak('Your profile picture has been captured and is now displayed');

                // Hide the video element after capturing
                faceVideo.style.display = 'none';

                faceStatus.textContent = '🎉 Profile picture captured successfully!';
                faceStatus.style.color = 'green';
                speak('Profile picture captured successfully');
                hideAllCameraButtons();

                stopCamera();

                // Mark profile image as uploaded for progress tracking
                profileImageUploaded = true;
                updateApplicantProgress();
                updateDocumentPreviews();

            } catch (error) {
                console.error('❌ Error capturing photo:', error);
                faceStatus.textContent = '❌ Failed to capture photo: ' + error.message;
                faceStatus.style.color = 'red';
                startFaceButton.disabled = false;
            }
        }

        function stopCamera() {
            console.log('📹 Stopping camera');
            if (stream) {
                stream.getTracks().forEach(track => {
                    track.stop();
                    console.log('Camera track stopped');
                });
                stream = null;
            }
            faceVideo.srcObject = null;
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            console.log('🔄 Page unloading, cleaning up camera resources');
            stopCamera();
        });

        // Handle browser back/forward navigation
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                console.log('📄 Page restored from cache');
            }
        });

        // Auto-hide modals if user clicks outside
        document.getElementById('cameraAlertModal').addEventListener('click', function(e) {
            if (e.target === document.getElementById('cameraAlertModal')) {
                // Don't auto-hide for camera alerts - user should make a conscious choice
                console.log('🖱️ User clicked outside camera alert modal - requires explicit choice');
            }
        });

        permissionModal.addEventListener('click', function(e) {
            if (e.target === permissionModal) {
                // Don't auto-hide for camera permissions - user should make a conscious choice
                console.log('🖱️ User clicked outside modal - camera permissions require explicit choice');
            }
        });

        // Keyboard accessibility for both modals
        document.addEventListener('keydown', function(e) {
            // Handle camera alert modal
            if (document.getElementById('cameraAlertModal').style.display === 'flex') {
                if (e.key === 'Escape') {
                    // ESC key acts like "Cancel"
                    document.getElementById('cancelCameraBtn').click();
                } else if (e.key === 'Enter') {
                    // Enter key acts like "Continue to Camera"
                    document.getElementById('proceedToCameraBtn').click();
                }
            }
            // Handle permission modal
            else if (permissionModal.style.display === 'flex') {
                if (e.key === 'Escape') {
                    // ESC key acts like "Skip Camera"
                    document.getElementById('skipCameraBtn').click();
                } else if (e.key === 'Enter') {
                    // Enter key acts like "Allow Camera"
                    document.getElementById('allowCameraBtn').click();
                }
            }
        });

        let uploadedDocuments = 0;
        let profileImageUploaded = false;
        let frontIdUploaded = false;
        let backIdUploaded = false;

        function previewApplicantImage(input, type) {
            const file = input.files[0];
            let previewId = '';

            // Map the type to correct preview ID
            if (type === 'profile') {
                // For profile, we now use face detection, so skip file upload handling
                return;
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
                    if (type === 'front_id') {
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

            // Profile image (20%) - now handled by face detection
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
                        stepEl.classList.add('bg-gradient-to-r', 'from-red-800', 'to-red-900');
                    } else {
                        stepEl.classList.add('bg-slate-300');
                        stepEl.classList.remove('bg-gradient-to-r', 'from-red-800', 'to-red-900');
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
            // Update profile preview - now using face detection captured image
            const capturedImage = document.getElementById('capturedImage');
            const profileContainer = document.getElementById('preview-profile-container');

            if (capturedImage && profileContainer) {
                if (capturedImage.src && capturedImage.src !== '' && profileImageUploaded) {
                    profileContainer.innerHTML = `<img src="${capturedImage.src}" class="w-full h-32 object-cover rounded-lg" alt="Profile Image">`;
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
                alert('Please complete face detection to capture your profile image.');
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
                if (type === 'profile') {
                    // For profile, restart face detection instead of file upload
                    faceVideo.style.display = 'block';
                    profileImagePreview.style.display = 'none';
                    capturedImage.src = '';
                    profileImageData.value = '';
                    startFaceButton.style.display = 'inline-block';
                    faceStatus.textContent = '💡 Click "Start Face Detection" to begin, or "Test Camera" to check camera access first.';
                    faceStatus.style.color = '#666';
                    profileImageUploaded = false;
                    resetValidations();
                    updateApplicantProgress();
                    updateDocumentPreviews();
                    return;
                }

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
                }

                // Reset upload status
                if (type === 'front_id') {
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