<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Verification Status</title>
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
                        <h1 class="text-xl font-semibold text-slate-900">Alumni Verification Status</h1>
                        <p class="text-sm text-slate-600">Track your verification progress</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-emerald-100 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-emerald-700 font-medium">Verification in Progress</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm bg-blue-100 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-blue-700 font-medium">AI Processing</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-emerald-50">
        <div class="container-full mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-slate-900 mb-4">Verification in Progress</h1>
                    <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                        Your alumni registration is being verified by our AI system. This process typically takes 1-3 minutes.
                    </p>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8 mb-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-slate-900">Verification Progress</h2>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-emerald-600 mb-1" id="overall-progress">0%</div>
                            <div class="text-sm text-slate-500">Complete</div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden mb-8">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-4 rounded-full transition-all duration-1000 ease-out" id="overall-progress-bar" style="width: 0%"></div>
                    </div>

                    <!-- Step Indicators -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Step 1: Registering -->
                        <div class="text-center" id="step-1">
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
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Registration Complete</h3>
                            <p class="text-sm text-slate-600">Your application has been submitted successfully</p>
                        </div>

                        <!-- Step 2: AI Verification -->
                        <div class="text-center" id="step-2">
                            <div class="relative mb-4">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4 animate-pulse">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        <rect x="8" y="9" width="8" height="6" rx="1"/>
                                        <circle cx="10" cy="11" r="0.5"/>
                                        <circle cx="14" cy="11" r="0.5"/>
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
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">AI Verification</h3>
                            <p class="text-sm text-slate-600">Analyzing your documents and information</p>
                            <div class="mt-2">
                                <div class="text-xs text-blue-600 animate-pulse">Processing ID documents...</div>
                            </div>
                        </div>

                        <!-- Step 3: Verification Result -->
                        <div class="text-center" id="step-3">
                            <div class="relative mb-4">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Verification Result</h3>
                            <p class="text-sm text-slate-600">Pending AI analysis</p>
                        </div>

                        <!-- Step 4: Admin Review -->
                        <div class="text-center" id="step-4">
                            <div class="relative mb-4">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Admin Review</h3>
                            <p class="text-sm text-slate-600">Final approval pending</p>
                        </div>
                    </div>
                </div>

                <!-- Current Status Details -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Current Status</h2>

                    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 mb-6">
                        <div class="flex">
                            <svg class="w-6 h-6 text-blue-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="text-blue-900 font-semibold mb-1">AI Verification in Progress</h3>
                                <p class="text-blue-800 text-sm leading-relaxed">
                                    Our AI system is currently analyzing your School ID documents, profile photo, and personal information.
                                    This automated process verifies your alumni status and ensures all details match your official records.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-green-900">What's Being Verified</span>
                            </div>
                            <ul class="text-sm text-green-800 space-y-1 ml-7">
                                <li>• School ID authenticity and validity</li>
                                <li>• Personal information accuracy</li>
                                <li>• Profile photo quality</li>
                                <li>• Alumni status confirmation</li>
                            </ul>
                        </div>

                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-amber-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold text-amber-900">Estimated Time</span>
                            </div>
                            <p class="text-sm text-amber-800 ml-7">
                                AI verification typically takes <strong>1-3 minutes</strong>.
                                ID document verification may require additional processing time.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">What Happens Next?</h2>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="inline-flex items-center justify-center w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full mr-4 flex-shrink-0">1</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">AI Analysis Complete</h3>
                                <p class="text-slate-600 text-sm">Our AI system will finish analyzing your ID documents and provide an initial verification result.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-400 font-bold rounded-full mr-4 flex-shrink-0">2</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Admin Review (if needed)</h3>
                                <p class="text-slate-600 text-sm">If AI verification is successful, your application moves to final admin approval. If additional review is needed, our team will contact you.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-400 font-bold rounded-full mr-4 flex-shrink-0">3</div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Verification Complete</h3>
                                <p class="text-slate-600 text-sm">Once approved, you'll receive email confirmation and can begin applying for job opportunities on our platform.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Refresh Button -->
                <div class="text-center mt-8">
                    <button onclick="refreshStatus()"
                            class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-400 text-white font-semibold rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh Status
                    </button>
                    <p class="text-xs text-slate-500 mt-2">Last updated: <span id="last-updated">Just now</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulate verification progress
        let currentProgress = 0;
        let verificationStage = 'ai_processing';

        function updateProgress() {
            const progressElement = document.getElementById('overall-progress');
            const progressBar = document.getElementById('overall-progress-bar');
            const lastUpdated = document.getElementById('last-updated');

            if (currentProgress < 30) {
                currentProgress += Math.random() * 8;
            }

            if (currentProgress > 30 && currentProgress < 80) {
                currentProgress += Math.random() * 4;
            }

            if (currentProgress >= 80 && verificationStage === 'ai_processing') {
                verificationStage = 'ai_complete';
                completeAIVerification();
            }

            progressElement.textContent = Math.round(currentProgress) + '%';
            progressBar.style.width = currentProgress + '%';
            lastUpdated.textContent = new Date().toLocaleTimeString();

            if (currentProgress < 26) { //100
                setTimeout(updateProgress, 1500 + Math.random() * 2500);
            }
        }

        function completeAIVerification() {
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
                <h3 class="text-lg font-semibold text-slate-900 mb-2">AI Verification Complete</h3>
                <p class="text-sm text-slate-600">Documents analyzed successfully</p>
            `;

            // Update step 3 based on verification result (simulate random result)
            const step3 = document.getElementById('step-3');
            const isVerified = Math.random() > 0.2; // 80% success rate for alumni

            if (isVerified) {
                step3.innerHTML = `
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
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Verified</h3>
                    <p class="text-sm text-slate-600">AI verification successful</p>
                `;

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
                step3.innerHTML = `
                    <div class="relative mb-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 right-0">
                            <div class="inline-flex items-center justify-center w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full">!</div>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Needs Review</h3>
                    <p class="text-sm text-slate-600">Manual review required</p>
                `;

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
            button.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Refreshing...';

            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = originalText;
                document.getElementById('last-updated').textContent = new Date().toLocaleTimeString();
            }, 1500);
        }

        // Start the progress simulation
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(updateProgress, 1000);
        });
    </script>
</body>
</html>