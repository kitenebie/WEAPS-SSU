<div style="padding: 2rem 8rem" class="w-full min-h-screen">
    <div class="max-w-7xl mx-auto mt-6 px-4">
        {{-- if $company has a null value --}}
        @if (!$this->isAllCompanyInformationNotNUll())
            <div class="w-100 mb-2 h-12 text-center flex items-center justify-center border-2 border-red-400"
                style="background-color: #fecaca">
                <p class=" text-2xl text-rose-800">Complete your company profile to access all features.</p>
            </div>
            <br>
        @endif
        <!-- Cover Photo Section -->
        <div class="relative">
            <!-- Cover Photo -->
            <div class="h-80 rounded-t-lg relative overflow-hidden">
                {{-- <img src="https://i.ytimg.com/vi/648DbEgy7Oo/maxresdefault.jpg" alt="Cover Photo"
                    class="w-full h-full object-cover" /> --}}

                @if ($company->cover_photo)
                    @php
                        $coverPhotoPath = storage_path('app/private/' . $company->cover_photo);
                        $coverPhotoData = file_exists($coverPhotoPath)
                            ? base64_encode(file_get_contents($coverPhotoPath))
                            : null;
                        $coverPhotoMime = $coverPhotoData ? mime_content_type($coverPhotoPath) : null;
                    @endphp
                    @if ($coverPhotoData)
                        <img src="data:{{ $coverPhotoMime }};base64,{{ $coverPhotoData }}" alt="Company Logo"
                            class="w-full h-full object-cover" />
                    @endif
                @else
                    <img src="https://ionic.io/blog/wp-content/uploads/2018/03/skeleton.gif" alt="Company Logo"
                        class="w-full h-full object-cover" />

                @endif
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-red-700 bg-opacity-50"></div>

                <!-- Company Name + Tagline -->
                <div class="absolute px-3 py-2 bottom-4 left-52 text-white" style="background-color: #2C2B2B54">
                    <h2 class="text-3xl font-bold">{{ $company->name ?? '' }}</h2>
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
                                    $logoData = file_exists($logoPath)
                                        ? base64_encode(file_get_contents($logoPath))
                                        : null;
                                    $logoMime = $logoData ? mime_content_type($logoPath) : null;
                                @endphp
                                @if ($logoData)
                                    <img src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="Company Logo"
                                        class="w-full h-full object-cover" />
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
                    @if (
                        !\Illuminate\Support\Facades\Session::get('company_id') ||
                            \Illuminate\Support\Facades\Auth::user()->hasRole('super_admin'))
                        <a href="/Company%20Settings/{{ $company->id }}/edit"
                            class=" bg-red-900 hover:border hover:border-yellow-400 text-white px-4 py-2 rounded-lg transition-all">
                            Update Profile
                        </a>
                    @endif
                </div>
            </div>

            @if ($this->isAllCompanyInformationNotNUll())
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
                            @if (
                                !\Illuminate\Support\Facades\Session::get('company_id') ||
                                    \Illuminate\Support\Facades\Auth::user()->hasRole('super_admin'))
                                <button onclick="showTab('Applicants')"
                                    class="tab-btn py-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900">
                                    Applicants
                                </button>
                            @endif
                        </nav>
                    </div>
                </div>
            @endif
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
                                @if ($company->specialties && count($company->specialties) > 0)
                                    @foreach ($company->specialties as $specialty)
                                        <span
                                            class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">{{ $specialty }}</span>
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

                        @if ($careers->count() > 0)
                            @foreach ($careers as $career)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-lg text-gray-900">
                                                {{ $career->title ?? 'Untitled Position' }}
                                            </h4>
                                            <p class="text-gray-600 mb-2">{{ $career->role_type ?? 'Not specified' }} •
                                                {{ $career->location ?? 'Location not specified' }}</p>
                                            @if ($career->min_salary || $career->max_salary)
                                                <div
                                                    class="flex items-center text-sm text-emerald-600 font-semibold mb-2">
                                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                                        </path>
                                                    </svg>
                                                    @if ($career->min_salary && $career->max_salary)
                                                        ₱{{ number_format($career->min_salary) }} -
                                                        ₱{{ number_format($career->max_salary) }}
                                                    @elseif($career->min_salary)
                                                        ₱{{ number_format($career->min_salary) }}+
                                                    @elseif($career->max_salary)
                                                        Up to ₱{{ number_format($career->max_salary) }}
                                                    @endif
                                                </div>
                                            @endif
                                            <p class="text-gray-700 text-sm">
                                                {{ Str::limit($career->description ?? 'No description provided.', 150) }}
                                            </p>
                                            @if ($career->tags && count($career->tags) > 0)
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    @foreach ($career->tags as $tag)
                                                        <span
                                                            class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        @if (!$this->isMe)
                                        <div class="flex space-x-2">
                                            @php
                                                $userId = auth()->id();
                                                $careerAlreadySaved = $userId
                                                    ? App\Models\SaveCareer::where('user_id', $userId)
                                                        ->where('career_id', $career->id)
                                                        ->exists()
                                                    : false;
                                                $careerAlreadyApplied = $userId
                                                    ? App\Models\Applicant::where('user_id', $userId)
                                                        ->where('career_id', $career->id)
                                                        ->exists()
                                                    : false;
                                            @endphp

                                            @if ($careerAlreadySaved)
                                                <button
                                                    class="bg-green-100 text-green-800 font-medium py-2 px-3 rounded-lg cursor-not-allowed text-sm"
                                                    disabled>
                                                    ✓ Saved
                                                </button>
                                            @else
                                                <button onclick="saveJob({{ $career->id }})"
                                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-3 rounded-lg transition-colors duration-200 text-sm">
                                                    Save Job
                                                </button>
                                            @endif

                                            @if ($careerAlreadyApplied)
                                                <button
                                                    class="bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg cursor-not-allowed text-sm"
                                                    disabled>
                                                    ✓ Applied
                                                </button>
                                            @else
                                                <button onclick="applyNow({{ $career->id }})"
                                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                                    Apply Now
                                                </button>
                                            @endif
                                        </div>
                                        @endif
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

                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-12 h-12 bg-red-900 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-white font-bold">{{ substr($company->name ?? 'CO', 0, 2) }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h4 class="font-semibold">{{ $company->name ?? 'Company' }}</h4>
                                                <span class="text-gray-500 text-sm">•
                                                    {{ $post->created_at ? $post->created_at->diffForHumans() : 'Recently' }}</span>
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
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Company Reviews</h3>
                    @if (!$this->isMe)
                        <!-- Review Form (only show if user hasn't reviewed yet) -->
                        <div id="review-form-container" class="mb-8">
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Share Your Experience</h4>

                                <!-- Rating Stars -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                    <div class="star-rating-container">
                                        <input type="hidden" id="rating-value" value="5">
                                        <div class="star-rating">
                                            <span class="star" data-rating="1" title="Poor">☆</span>
                                            <span class="star" data-rating="2" title="Fair">☆</span>
                                            <span class="star" data-rating="3" title="Good">☆</span>
                                            <span class="star" data-rating="4" title="Very Good">☆</span>
                                            <span class="star" data-rating="5" title="Excellent">☆</span>
                                        </div>
                                        <span id="rating-text" class="ml-3 text-sm text-gray-600 font-medium">5 Stars
                                            -
                                            Excellent</span>
                                    </div>
                                </div>

                                <!-- Review Text -->
                                <div class="mb-4">
                                    <label for="review-text" class="block text-sm font-medium text-gray-700 mb-2">Your
                                        Review</label>
                                    <textarea id="review-text" rows="4"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                        placeholder="Share your experience working with this company..."></textarea>
                                </div>

                                <!-- Anonymous Option -->
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" id="is-anonymous"
                                            class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                        <span class="ml-2 text-sm text-gray-700">Submit anonymously</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button id="submit-review-btn" onclick="submitReview({{ $company->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                    Submit Review
                                </button>
                            </div>
                        </div>
                    @endif
                    <!-- Reviews Display -->
                    <div id="reviews-container">
                        <!-- Reviews will be loaded here -->
                    </div>

                    <!-- Load More Button (for pagination) -->
                    <div id="load-more-container" class="text-center mt-6 hidden">
                        <button id="load-more-btn" onclick="loadMoreReviews({{ $company->id }})"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                            Load More Reviews
                        </button>
                    </div>
                </div>

                <!-- Applicant Section -->
                <div id="Applicants-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Applicants</h3>
                    </div>
                    <div class="space-y-4">
                        @php
                            $applicants = App\Models\Applicant::where('company_id', $company->id)
                                ->with(['user', 'career'])
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp

                        @if ($applicants->count() > 0)
                            @foreach ($applicants as $applicant)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-lg text-gray-900">
                                                {{ $applicant->user->first_name ?? 'Unknown' }}
                                                {{ $applicant->user->last_name ?? 'User' }}
                                            </h4>
                                            <p class="text-gray-600 mb-2">
                                                Applying for • {{ $applicant->career->title ?? 'Unknown Position' }}
                                            </p>
                                            <p class="text-gray-700 text-sm">
                                                Applied {{ $applicant->created_at->diffForHumans() }}
                                            </p>
                                            <div class="mt-2">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if ($applicant->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($applicant->status === 'approved') bg-green-100 text-green-800
                                                    @elseif($applicant->status === 'rejected') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($applicant->status ?? 'pending') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="viewApplicant({{ $applicant->user_id }})"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                                View Profile
                                            </button>
                                            @if ($applicant->status === 'pending')
                                                <button
                                                    onclick="updateApplicationStatus({{ $applicant->id }}, 'approved')"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm transition-all">
                                                    View
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <p class="text-lg mb-2">No applicants yet</p>
                                <p class="text-sm">Applications for your job postings will appear here.</p>
                            </div>
                        @endif
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
                {{-- <div class="bg-white rounded-lg shadow-md p-6">
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
                </div> --}}

                @if (
                    !\Illuminate\Support\Facades\Session::get('company_id') ||
                        \Illuminate\Support\Facades\Auth::user()->hasRole('super_admin'))
                    <!-- Recent vistors -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            Recent Visitors
                        </h3>
                        <div class="space-y-3 text-sm">
                            @php
                                $recentVisitors = \App\Models\RecentVisitor::getTopRecentVisitors($company->user_id, 3);
                            @endphp
                            @if ($recentVisitors->count() > 0)
                                @foreach ($recentVisitors as $visitor)
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">
                                                {{ substr($visitor->visitor->first_name ?? ($visitor->visitor->name ?? 'U'), 0, 1) }}{{ substr($visitor->visitor->last_name ?? $visitor->visitor->name ? '' : 'U', 0, 1) }}
                                            </span>
                                        </div>
                                        <span
                                            class="text-gray-700">{{ $visitor->visitor->first_name ?? ($visitor->visitor->name ?? 'Unknown') }}
                                            {{ $visitor->visitor->last_name ?? $visitor->visitor->name ? '' : 'User' }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4 text-gray-500">
                                    <p class="text-sm">No recent visitors</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeStarRating();
            loadReviews({{ $company->id }});
        });
    </script>

</div>
