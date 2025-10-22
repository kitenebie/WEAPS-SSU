<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Resume</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'soft-maroon': '#8B3A3A',
                        'deep-maroon': '#6B2737',
                        'warm-gold': '#D4A574',
                        'light-gold': '#E8D5B7',
                        'cream': '#FFF8F0'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream min-h-screen">
    <div class="container mx-auto max-w-6xl p-4">
        <!-- Back Button -->
        <div class="mb-4">
            <button onclick="history.back()" class="inline-flex items-center px-4 py-2 bg-deep-maroon text-white rounded-lg hover:bg-soft-maroon transition-colors duration-200 shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </button>
        </div>
        <!-- Header Section -->
        <header class="bg-gradient-to-r from-soft-maroon to-deep-maroon rounded-md shadow-lg p-8 text-white">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="w-32 h-32 bg-warm-gold rounded-full flex items-center justify-center shadow-xl">
                    @if($cv->profile_picture)
                        <img src="{{ $cv->profile_picture }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover">
                    @else
                        <span class="text-4xl text-white font-bold">{{ substr($cv->first_name ?? '', 0, 1) }}{{ substr($cv->last_name ?? '', 0, 1) }}</span>
                    @endif
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-2">{{ $cv->fullname ?? 'Full Name' }}</h1>
                    <p class="text-light-gold text-xl mb-4">{{ $cv->job_title ?? 'Job Title' }}</p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start text-sm">
                        @if($cv->email)
                            <span class="bg-white/20 px-3 py-1 rounded-full">📧 {{ $cv->email }}</span>
                        @endif
                        @if($cv->phone)
                            <span class="bg-white/20 px-3 py-1 rounded-full">📱 {{ $cv->phone }}</span>
                        @endif
                        @if($cv->address)
                            <span class="bg-white/20 px-3 py-1 rounded-full">📍 {{ $cv->address }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="bg-white shadow-lg rounded-b-2xl">
            <div class="grid md:grid-cols-3 gap-6 p-8">
                <!-- Left Column -->
                <div class="md:col-span-1 space-y-6">
                    <!-- About Section -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-3 pb-2 border-b-2 border-warm-gold">About Me</h2>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $cv->summary ?? 'No summary provided.' }}</p>
                    </section>

                    <!-- Skills Section -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-3 pb-2 border-b-2 border-warm-gold">Skills</h2>
                        <div class="space-y-2">
                            @if($cv->skills && is_array($cv->skills))
                                @foreach($cv->skills as $skill)
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-gray-700">{{ $skill['name'] ?? $skill }}</span>
                                            <span class="text-warm-gold">{{ $skill['level'] ?? 0 }}%</span>
                                        </div>
                                        <div class="bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-warm-gold to-deep-maroon h-2 rounded-full" style="width: {{ $skill['level'] ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-700 text-sm">No skills listed.</p>
                            @endif
                        </div>
                    </section>

                    <!-- Languages -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-3 pb-2 border-b-2 border-warm-gold">Languages</h2>
                        <div class="space-y-2 text-sm">
                            @if($cv->languages && is_array($cv->languages))
                                @foreach($cv->languages as $lang)
                                    <div class="flex justify-between">
                                        <span class="text-gray-700">{{ $lang['name'] ?? $lang }}</span>
                                        <span class="text-warm-gold">{{ $lang['proficiency'] ?? '' }}</span>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-700">No languages listed.</p>
                            @endif
                        </div>
                    </section>
                </div>

                <!-- Right Column -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Experience Section -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-4 pb-2 border-b-2 border-warm-gold">Experience</h2>
                        <div class="space-y-4">
                            @if($cv->work_experience && is_array($cv->work_experience))
                                @foreach($cv->work_experience as $exp)
                                    <div class="relative pl-6 border-l-2 border-light-gold">
                                        <div class="absolute -left-2 top-0 w-4 h-4 bg-warm-gold rounded-full"></div>
                                        <h3 class="font-semibold text-soft-maroon">{{ $exp['title'] ?? 'Job Title' }}</h3>
                                        <p class="text-sm text-warm-gold mb-1">{{ $exp['company'] ?? 'Company' }} | {{ $exp['dates'] ?? 'Dates' }}</p>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            @if(isset($exp['description']) && is_array($exp['description']))
                                                @foreach($exp['description'] as $desc)
                                                    <li>• {{ $desc }}</li>
                                                @endforeach
                                            @elseif(isset($exp['description']))
                                                <li>• {{ $exp['description'] }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-700 text-sm">No work experience listed.</p>
                            @endif
                        </div>
                    </section>

                    <!-- Education Section -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-4 pb-2 border-b-2 border-warm-gold">Education</h2>
                        <div class="space-y-3">
                            @if($cv->education && is_array($cv->education))
                                @foreach($cv->education as $edu)
                                    <div class="bg-gradient-to-r from-cream to-white p-4 rounded-lg border-l-4 border-warm-gold">
                                        <h3 class="font-semibold text-soft-maroon">{{ $edu['degree'] ?? 'Degree' }}</h3>
                                        <p class="text-sm text-warm-gold">{{ $edu['institution'] ?? 'Institution' }} | {{ $edu['dates'] ?? 'Dates' }}</p>
                                        <p class="text-sm text-gray-700 mt-1">GPA: {{ $edu['gpa'] ?? 'N/A' }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-700 text-sm">No education listed.</p>
                            @endif
                        </div>
                    </section>

                    <!-- Projects Section -->
                    <section>
                        <h2 class="text-deep-maroon text-xl font-bold mb-4 pb-2 border-b-2 border-warm-gold">Key Projects</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            @if($cv->projects && is_array($cv->projects))
                                @foreach($cv->projects as $proj)
                                    <div class="bg-gradient-to-br from-white to-cream p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        <h3 class="font-semibold text-soft-maroon mb-2">{{ $proj['title'] ?? 'Project Title' }}</h3>
                                        <p class="text-sm text-gray-700 mb-2">{{ $proj['description'] ?? 'Project description.' }}</p>
                                        <div class="flex flex-wrap gap-1">
                                            @if(isset($proj['technologies']) && is_array($proj['technologies']))
                                                @foreach($proj['technologies'] as $tech)
                                                    <span class="text-xs bg-light-gold text-deep-maroon px-2 py-1 rounded">{{ $tech }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-700 text-sm">No projects listed.</p>
                            @endif
                        </div>
                    </section>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gradient-to-r from-light-gold to-cream p-6 rounded-b-2xl">
                <div class="flex flex-wrap justify-center gap-6 text-deep-maroon">
                    @if($cv->linkedin_url)
                        <a href="{{ $cv->linkedin_url }}" class="hover:text-soft-maroon transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    @endif
                    @if($cv->github_url)
                        <a href="{{ $cv->github_url }}" class="hover:text-soft-maroon transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    @endif
                    @if($cv->facebook_url)
                        <a href="{{ $cv->facebook_url }}" class="hover:text-soft-maroon transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </footer>
        </div>
    </div>
</body>
</html>