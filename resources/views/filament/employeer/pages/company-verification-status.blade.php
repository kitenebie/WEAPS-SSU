<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Verification Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">
    <?php
    use App\Models\Company;
    use Illuminate\Support\Facades\Auth;
    
    // Get current user's company
    $currentCompany = Company::where('user_id', Auth::id())->first();
    $isCompanyActive = $currentCompany && $currentCompany->isActive;
    ?>
    <!-- Header with Back Button -->
    <header class="bg-white shadow-sm border-b border-slate-200">
        <div class="container-full mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="history.back()"
                        class="inline-flex items-center px-4 py-2 bg-rose-100 hover:bg-rose-200 text-slate-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </button>
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">Company Verification Status</h1>
                        <p class="text-sm text-slate-600">Track your verification progress</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <?php if ($isCompanyActive): ?>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-green-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-green-700 font-medium">Verified</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-emerald-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-emerald-700 font-medium">Active Company</span>
                    </div>
                    <?php else: ?>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-rose-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></div>
                        <span class="text-rose-700 font-medium">Verification in Progress</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-blue-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-blue-700 font-medium">Admin Review</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-rose-50">
        <div class="container-full mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r <?= $isCompanyActive ? 'from-green-500 to-emerald-600' : 'from-rose-500 to-pink-600' ?> rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-slate-900 mb-4">
                        <?= $isCompanyActive ? 'Verification Complete!' : 'Verification in Progress' ?>
                    </h1>
                    <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                        <?= $isCompanyActive ? 'Your company has been successfully verified and you can now access all employer features.' : 'Your company registration is being reviewed by our admin team. This process typically takes 24-48 hours.' ?>
                    </p>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8 mb-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-slate-900">Verification Progress</h2>
                        <div class="text-right">
                            <div class="text-3xl font-bold <?= $isCompanyActive ? 'text-green-600' : 'text-rose-600' ?> mb-1"
                                id="overall-progress">
                                <?= $isCompanyActive ? '100%' : '0%' ?>
                            </div>
                            <div class="text-sm text-slate-500">Complete</div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden mb-8">
                        <div class="bg-gradient-to-r <?= $isCompanyActive ? 'from-green-500 to-emerald-600' : 'from-rose-500 to-pink-600' ?> h-4 rounded-full transition-all duration-1000 ease-out"
                            id="overall-progress-bar" style="width: <?= $isCompanyActive ? '100%' : '0%' ?>"></div>
                    </div>

                    <!-- Step Indicators -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Step 1: Registering -->
                        <div class="text-center" id="step-1">
                            <div class="relative mb-4">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="absolute top-0 right-0">
                                    <div
                                        class="inline-flex items-center justify-center w-6 h-6 bg-green-500 text-white text-xs font-bold rounded-full">
                                        ✓</div>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Registration Complete</h3>
                            <p class="text-sm text-slate-600">Your application has been submitted successfully</p>
                        </div>

                        <!-- Step 2: AI Verification -->
                        <div class="text-center" id="step-2">
                            <div class="relative mb-4">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4 animate-pulse">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        <rect x="8" y="9" width="8" height="6" rx="1" />
                                        <circle cx="10" cy="11" r="0.5" />
                                        <circle cx="14" cy="11" r="0.5" />
                                    </svg>
                                </div>
                                <div class="absolute top-0 right-0">
                                    <div
                                        class="inline-flex items-center justify-center w-6 h-6 bg-blue-500 text-white text-xs font-bold rounded-full animate-spin">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Admin Review</h3>
                            <p class="text-sm text-slate-600">Reviewing your documents and information</p>
                            <div class="mt-2">
                                <div class="text-xs text-blue-600 animate-pulse">Admin reviewing documents...</div>
                            </div>
                        </div>

                        <!-- Step 4: Admin Review -->
                        <div class="text-center" id="step-4">
                            <div class="relative mb-4">
                                <?php if ($isCompanyActive): ?>
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="absolute top-0 right-0">
                                    <div
                                        class="inline-flex items-center justify-center w-6 h-6 bg-green-500 text-white text-xs font-bold rounded-full">
                                        ✓</div>
                                </div>
                                <?php else: ?>
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                        </path>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">
                                <?= $isCompanyActive ? 'Verification Complete' : 'Admin Review' ?>
                            </h3>
                            <p class="text-sm text-slate-600">
                                <?= $isCompanyActive ? 'Your company is fully verified' : 'Final approval pending' ?>
                            </p>
                        </div>

                    </div>
                    <!-- MyAccount Button -->
                    <div class="text-center mt-8">
                        <button onclick="MyAccount()"
                            class="inline-flex items-center px-6 py-3 <?= $isCompanyActive ? 'bg-green-600 hover:bg-green-700' : 'bg-slate-400 cursor-not-allowed' ?> text-white font-semibold rounded-lg transition-colors duration-200">
                            <?= $isCompanyActive ? 'Continue to Company Account' : 'Complete Verification First' ?>
                        </button>
                    </div>
                </div>

                <!-- Current Status Details -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Current Status</h2>

                    <?php if ($isCompanyActive): ?>
                    <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-6">
                        <div class="flex">
                            <svg class="w-6 h-6 text-green-400 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="text-green-900 font-semibold mb-1">Company Verified Successfully!</h3>
                                <p class="text-green-800 text-sm leading-relaxed">
                                    Your company has been fully verified and approved. You now have access to all
                                    employer features including posting job opportunities and managing applications.
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-6">
                        <div class="flex">
                            <svg class="w-6 h-6 text-blue-400 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="text-blue-900 font-semibold mb-1">Admin Review in Progress</h3>
                                <p class="text-blue-800 text-sm leading-relaxed">
                                    Our admin team is currently reviewing your company documents, business permits, and
                                    registration information.
                                    This manual process ensures authenticity, completeness, and compliance with our
                                    verification standards.
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-green-900">What's Being Verified</span>
                            </div>
                            <ul class="text-sm text-green-800 space-y-1 ml-7">
                                <li>• Company registration documents</li>
                                <li>• Business permit authenticity</li>
                                <li>• Logo and branding materials</li>
                                <li>• Contact information accuracy</li>
                            </ul>
                        </div>

                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-amber-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-amber-900">Estimated Time</span>
                            </div>
                            <p class="text-sm text-amber-800 ml-7">
                                Admin review typically takes <strong>24-48 hours</strong>.
                                Complex applications may require additional review time.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <?php if (!$isCompanyActive): ?>
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">What Happens Next?</h2>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div
                                class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full mr-4 flex-shrink-0 animate-pulse">
                                1</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Admin Review in Progress</h3>
                                <p class="text-slate-600 text-sm">Our admin team is currently reviewing your documents
                                    and will provide a verification decision.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-400 font-bold rounded-full mr-4 flex-shrink-0">
                                2</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Final Decision</h3>
                                <p class="text-slate-600 text-sm">Once review is complete, you'll be notified of the
                                    decision via email.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-400 font-bold rounded-full mr-4 flex-shrink-0">
                                3</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Access Granted</h3>
                                <p class="text-slate-600 text-sm">Upon approval, you can immediately start posting job
                                    opportunities and accessing employer features.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Refresh Button -->
                <?php if (!$isCompanyActive): ?>
                <div class="text-center mt-8">
                    <button onclick="refreshStatus()"
                        class="inline-flex items-center px-6 py-3 bg-rose-600 hover:bg-rose-700 disabled:bg-slate-400 text-white font-semibold rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Refresh Status
                    </button>
                    <p class="text-xs text-slate-500 mt-2">Last updated: <span id="last-updated">Just now</span></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Simulate verification progress
        <?php if (!$isCompanyActive): ?>
        let currentProgress = 35;
        let verificationStage = 'admin_review';

        function updateProgress() {
            const progressElement = document.getElementById('overall-progress');
            const progressBar = document.getElementById('overall-progress-bar');
            const lastUpdated = document.getElementById('last-updated');

            if (currentProgress > 25 && currentProgress < 75) {
                currentProgress += Math.random() * 3;
            }

            if (currentProgress >= 75 && verificationStage === 'admin_review') {
                verificationStage = 'admin_complete';
                completeAdminReview();
            }

            progressElement.textContent = Math.round(currentProgress) + '%';
            progressBar.style.width = currentProgress + '%';
            lastUpdated.textContent = new Date().toLocaleTimeString();

            if (currentProgress < 100) {
                setTimeout(updateProgress, 2000 + Math.random() * 3000);
            }
        }
        <?php else: ?>

        function updateProgress() {
            // Company is already verified, no need for progress simulation
            const progressElement = document.getElementById('overall-progress');
            const progressBar = document.getElementById('overall-progress-bar');
            const lastUpdated = document.getElementById('last-updated');

            progressElement.textContent = '100%';
            progressBar.style.width = '100%';
            lastUpdated.textContent = new Date().toLocaleTimeString();
        }
        <?php endif; ?>

        function completeAdminReview() {
            // Update step 2 to completed
            const step2 = document.getElementById('step-2');
            step2.innerHTML = `
                <div class="relative mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="absolute top-0 right-0">
                        <div class="inline-flex items-center justify-center w-6 h-6 bg-green-500 text-white text-xs font-bold rounded-full">✓</div>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Admin Review Complete</h3>
                <p class="text-sm text-slate-600">Documents reviewed successfully</p>
            `;

            if (isVerified) {

                // Update step 4 to in progress
                const step4 = document.getElementById('step-4');
                step4.innerHTML = `
                    <div class="relative mb-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4 animate-pulse">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 right-0">
                            <div class="inline-flex items-center justify-center w-6 h-6 bg-blue-500 text-white text-xs font-bold rounded-full animate-spin">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Admin Review</h3>
                    <p class="text-sm text-slate-600">Final approval in progress</p>
                `;
            } else {

                // Update step 4 to admin review needed
                const step4 = document.getElementById('step-4');
                step4.innerHTML = `
                    <div class="relative mb-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 right-0">
                            <div class="inline-flex items-center justify-center w-6 h-6 bg-amber-500 text-white text-xs font-bold rounded-full">!</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Admin Attention Required</h3>
                    <p class="text-sm text-slate-600">Our team will contact you</p>
                `;
            }

            currentProgress = 100;
            progressElement.textContent = '100%';
            progressBar.style.width = '100%';
        }

        function refreshStatus() {
            // Simulate API call delay
            const button = event.target;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML =
                '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Refreshing...';

            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = originalText;
                document.getElementById('last-updated').textContent = new Date().toLocaleTimeString();
            }, 1500);
        }

        function MyAccount() {
            <?php if ($isCompanyActive): ?>
            // Simulate API call delay
            const button = event.target;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML =
                '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Redirecting...';

            setTimeout(() => {
                location.href = '/Company%20Profile';
            }, 1500);
            <?php else: ?>
            // Show message that verification is required
            alert('Please wait for admin verification before accessing your company account.');
            <?php endif; ?>
        }

        // Start the progress simulation
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!$isCompanyActive): ?>
            setTimeout(updateProgress, 1000);
            <?php else: ?>
            // Company is already verified, set final state immediately
            updateProgress();
            <?php endif; ?>
        });
    </script>
</body>

</html>
