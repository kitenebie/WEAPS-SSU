<div style="padding: 2rem 8rem" class="w-full min-h-screen">
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <!-- Cover Photo Section -->
        <div class="relative">
            <!-- Cover Photo -->
            <div class="h-80 rounded-t-lg relative overflow-hidden">
                {{-- <img src="https://i.ytimg.com/vi/648DbEgy7Oo/maxresdefault.jpg" alt="Cover Photo"
                    class="w-full h-full object-cover" /> --}}

                            @if ($company->cover_photo)
                            @php
                                $coverPhotoPath = storage_path('app/private/' . $company->cover_photo);
                                $coverPhotoData = file_exists($coverPhotoPath) ? base64_encode(file_get_contents($coverPhotoPath)) : null;
                                $coverPhotoMime = $coverPhotoData ? mime_content_type($coverPhotoPath) : null;
                            @endphp
                            @if($coverPhotoData)
                            <img src="data:{{ $coverPhotoMime }};base64,{{ $coverPhotoData }}"
                                alt="Company Logo" class="w-full h-full object-cover" />
                            @endif
                            @else
                            <img src="https://img.freepik.com/free-psd/digital-marketing-agency-corporate-facebook-cover-template_106176-2261.jpg?semt=ais_hybrid&w=740&q=80"
                                alt="Company Logo" class="w-full h-full object-cover" />

                            @endif
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-red-700 bg-opacity-50"></div>

                <!-- Company Name + Tagline -->
                <div class="absolute px-3 py-2 bottom-4 left-52 text-white" style="background-color: #2C2B2B54">
                    <h2 class="text-3xl font-bold" >{{ $company->name ?? '' }}</h2>
                    <p class="text-lg text-center">{{ $company->type ?? '' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Profile Section -->
        <div class="bg-white rounded-b-lg shadow-lg">
            <!-- Company Logo and Basic Info -->
            <div class="relative px-6 pb-6">
                <div
                    class="flex flex-col md:flex-row items-start md:items-end space-y-4 md:space-y-0 md:space-x-6 -mt-20">
                    <div class="relative">
                        <!-- Logo -->
                        <div class="w-40 h-40 bg-white rounded-full border-4 border-red-900 shadow-lg overflow-hidden">
                            @if ($company->logo)
                            @php
                                $logoPath = storage_path('app/private/' . $company->logo);
                                $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
                                $logoMime = $logoData ? mime_content_type($logoPath) : null;
                            @endphp
                            @if($logoData)
                            <img src="data:{{ $logoMime }};base64,{{ $logoData }}"
                                alt="Company Logo" class="w-full h-full object-cover" />
                            @endif
                            @else
                            <img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/07/door-company-logo.jpg"
                                alt="Company Logo" class="w-full h-full object-cover" />

                            @endif
                        </div>

                        {{-- <!-- Update Logo Button -->
                        <button onclick="updateLogo()"
                            class="absolute border-yellow-600 border-2 bottom-2 right-2 bg-gray-200 hover:bg-gray-300 p-2 rounded-full transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 5a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.414-1.414A1 1 0 0012.586 3H7.414a1 1 0 00-.707.293L5.293 4.707A1 1 0 014.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>
                        </button> --}}
                    </div>

                    <div class="flex-1">
                        <!-- <h1 id="companyName" class="text-3xl font-bold text-gray-900 mb-2">TechCorp Solutions</h1> Leading Technology Solutions -->
                        <p id="companyType" class="text-lg text-gray-600 mb-2">
                            {{ $company->description ?? '' }}
                        </p>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <span id="location">📍 {{ $company->location ?? '' }}</span>
                            <span id="founded">🏢 Founded in {{ $company->founded_year ?? '' }}</span>
                            <span id="employees">👥 {{ $company->employee_count ?? '' }} employees</span>
                        </div>
                    </div>

                    <a href="/Company%20Settings/{{ auth()->user()->id }}/edit"
                        class=" bg-red-900 hover:border hover:border-yellow-400 text-white px-4 py-2 rounded-lg transition-all">
                        Update Profile
                    </a>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="border-t border-gray-200">
                <div class="px-6">
                    <nav class="flex space-x-8">
                        <button onclick="showTab('about')"
                            class="tab-btn py-4 border-b-2 border-red-900 text-red-900 font-semibold">
                            About
                        </button>
                        <button onclick="showTab('careers')"
                            class="tab-btn py-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                            Careers
                        </button>
                        <button onclick="showTab('posts')"
                            class="tab-btn py-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                            Posts
                        </button>
                        <button onclick="showTab('reviews')"
                            class="tab-btn py-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                            Reviews
                        </button>
                        <button onclick="showTab('Applicants')"
                            class="tab-btn py-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                            Applicants
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- About Section -->
                <div id="about-section" class="tab-content bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        About TechCorp Solutions
                    </h3>
                    <div class="space-y-4">
                        <p id="companyDescription" class="text-gray-700">
                            {{ $company->about ?? '' }}
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-900-700 mb-2">Industry</h4>
                                <p id="industry" class="text-gray-600">
                                   {{ $company->industry ?? '' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-900-700 mb-2">
                                    Company Size
                                </h4>
                                <p id="companySize" class="text-gray-600">
                                    {{ $company->company_size ?? '' }} employees
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-red-900-700 mb-2">Specialties</h4>
                            <div id="specialties" class="flex flex-wrap gap-2">
                                @if($company->specialties && count($company->specialties) > 0)
                                    @foreach($company->specialties as $specialty)
                                        <span class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">{{ $specialty }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-sm">No specialties listed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Careers Section -->
                <div id="careers-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Current Openings</h3>
                        <button onclick="addPosition()"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                            + Add Position
                        </button>
                    </div>
                    <div id="jobPositions" class="space-y-4">
                        @php
                            $careers = App\Models\Carrer::where('company_id', $company->id)->get();
                        @endphp

                        @if($careers->count() > 0)
                            @foreach($careers as $career)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-lg text-gray-900">
                                                {{ $career->title ?? 'Untitled Position' }}
                                            </h4>
                                            <p class="text-gray-600 mb-2">{{ $career->role_type ?? 'Not specified' }} • {{ $career->location ?? 'Location not specified' }}</p>
                                            <p class="text-gray-700 text-sm">
                                                {{ $career->description ?? 'No description provided.' }}
                                            </p>
                                            @if($career->tags && count($career->tags) > 0)
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    @foreach($career->tags as $tag)
                                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <button
                                            class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                            Apply Now
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <p class="text-lg mb-2">No job positions available</p>
                                <p class="text-sm">Check back later for new opportunities!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Posts Section -->
                <div id="posts-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Updates</h3>
                    <div class="space-y-6">
                        @php
                            $posts = App\Models\CompanyPost::where('company_id', $company->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp

                        @if($posts->count() > 0)
                            @foreach($posts as $post)
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-12 h-12 bg-red-900 rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold">{{ substr($company->name ?? 'CO', 0, 2) }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h4 class="font-semibold">{{ $company->name ?? 'Company' }}</h4>
                                                <span class="text-gray-500 text-sm">• {{ $post->created_at ? $post->created_at->diffForHumans() : 'Recently' }}</span>
                                            </div>
                                            <p class="text-gray-700 mb-3">
                                                {{ $post->content ?? 'No content available.' }}
                                            </p>
                                            <div class="flex space-x-4 text-gray-500 text-sm">
                                                <!-- <button class="hover:text-red-900">
                                                    👍 Like ({{ rand(10, 50) }})
                                                </button>
                                                <button class="hover:text-red-900">
                                                    💬 Comment ({{ rand(1, 15) }})
                                                </button>
                                                <button class="hover:text-red-900">📤 Share</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <p class="text-lg mb-2">No posts yet</p>
                                <p class="text-sm">Company updates and announcements will appear here.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Section -->
                <div id="reviews-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        Employee Reviews
                    </h3>
                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">★★★★★</div>
                                <span class="ml-2 text-sm text-gray-600">5.0 • Software Engineer</span>
                            </div>
                            <p class="text-gray-700">
                                "Great company culture and excellent growth opportunities.
                                Management is supportive and the work is challenging and
                                rewarding."
                            </p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">★★★★☆</div>
                                <span class="ml-2 text-sm text-gray-600">4.0 • Project Manager</span>
                            </div>
                            <p class="text-gray-700">
                                "Good work-life balance and competitive benefits. The company
                                invests in employee development and new technologies."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Applicant Section -->
                <div id="Applicants-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Aplicants</h3>
                    </div>
                    <div id="jobPositions" class="space-y-4">
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        John Doe
                                    </h4>
                                    <p class="text-gray-600 mb-2">
                                        Applying For • Senior Software Engineer
                                    </p>
                                    <p class="text-gray-700 text-sm">
                                        with 5 years of experience
                                    </p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">React</span>
                                        <span
                                            class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Node.js</span>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">AWS</span>
                                    </div>
                                </div>
                                <button
                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                    View
                                </button>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        Juvy Medalle
                                    </h4>
                                    <p class="text-gray-600 mb-2">
                                        Applying for • UX/UI Designer
                                    </p>
                                    <p class="text-gray-700 text-sm">with 2 years experience</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span
                                            class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs">Figma</span>
                                        <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs">Adobe
                                            Creative Suite</span>
                                        <span
                                            class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs">Prototyping</span>
                                    </div>
                                </div>
                                <button
                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                    View
                                </button>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        Anne Smith
                                    </h4>
                                    <p class="text-gray-600 mb-2">
                                        Applying for • Digital Marketing Manager
                                    </p>
                                    <p class="text-gray-700 text-sm">with 2 years experience</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span
                                            class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">SEO/SEM</span>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Social
                                            Media</span>
                                        <span
                                            class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Analytics</span>
                                    </div>
                                </div>
                                <button
                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Company Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Company Info</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Website:</span>
                            <a href="#" class="text-red-900 hover:underline">{{ $company->website ?? '' }}</a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Industry:</span>
                            <span class="text-gray-900">{{ $company->industry ?? '' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phone:</span>
                            <span class="text-gray-900">{{ $company->phone ?? '' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="text-gray-900">{{ $company->email ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Open Positions</span>
                            <span
                                class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">15</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Projects Completed</span>
                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">250+</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Client Satisfaction</span>
                            <span
                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">98%</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        Recent Activity
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-gray-700">New partnership announced</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">5 new job openings posted</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span class="text-gray-700">Team expansion in progress</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Position Modal -->
    <div id="addPositionModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-lg max-w-xl w-full">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Add New Position</h2>
                    <button onclick="closePositionModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form id="positionForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" id="jobTitle"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="jobLocation"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Employment Type</label>
                        <select id="jobType"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent">
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="jobDescription" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent"></textarea>
                    </div>
                </form>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closePositionModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button onclick="savePosition()"
                        class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition-all">
                        Save Position
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
</div>
