<div class="w-full min-h-screen lg:px-4 md:px-8 lg:px-16 lg:py-4" x-data="{ showAddPositionModal: @entangle('showAddPositionModal') }">
    <style>
        .fi-width-full {
            padding: 0 !important;
        }
    </style>
    <div class="lg:max-w-7xl mx-auto sm:max-w-full mt-6 px-4" x-data="{
        showAddPositionModal: @entangle('showAddPositionModal'),
        showAddPostModal: @entangle('showAddPostModal'),
        init() {
            this.$watch('showAddPositionModal', (value) => {
                if (value) {
                    showTab('careers');
                    saveTabToLocalStorage('careers');
                }
            });
            this.$watch('showAddPostModal', (value) => {
                if (value) {
                    showTab('posts');
                    saveTabToLocalStorage('posts');
                }
            });
        }
    }">
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
                <div style="background-color: #0E0E0EC4"
                    class="absolute px-3 py-2 bottom-4 left-52 sm:w-full md:left-20  text-white rounded">
                    <h2 class="text-2xl md:text-3xl font-bold">{{ $company->name ?? '' }}</h2>
                    <p class="text-base md:text-lg text-right md:text-center">{{ $company->type ?? '' }}</p>
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
                        <div class="w-40 h-40 bg-white rounded-full border-4 border-maroon-500 shadow-lg overflow-hidden">
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
                            class=" bg-maroon-500 hover:border hover:border-yellow-400 text-white px-4 py-2 rounded-lg transition-all">
                            Update Profile
                        </a>
                    @endif
                </div>
            </div>

            @if ($this->isAllCompanyInformationNotNUll())
                <!-- Navigation Tabs -->
                <div class="border-t border-gray-200">
                    <div class="px-6">
                        <nav class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-8 overflow-x-auto">
                            <button onclick="showTab('careers'); saveTabToLocalStorage('careers')"
                                class="tab-btn py-4 px-2 md:px-0 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">
                                Careers
                            </button>
                            <button onclick="showTab('posts'); saveTabToLocalStorage('posts')"
                                class="tab-btn py-4 px-2 md:px-0 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">
                                Posts
                            </button>
                            <button onclick="showTab('reviews'); saveTabToLocalStorage('reviews')"
                                class="tab-btn py-4 px-2 md:px-0 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">
                                Reviews
                            </button>
                            @if (
                                !\Illuminate\Support\Facades\Session::get('company_id') ||
                                    \Illuminate\Support\Facades\Auth::user()->hasRole('super_admin'))
                                <button onclick="showTab('Applicants'); saveTabToLocalStorage('Applicants')"
                                    class="tab-btn py-4 px-2 md:px-0 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">
                                    Applicants
                                </button>
                            @endif
                            <button onclick="showTab('about'); saveTabToLocalStorage('about')"
                                class="tab-btn py-4 px-2 md:px-0 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">
                                About
                            </button>
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
                <div id="about-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        About TechCorp Solutions
                    </h3>
                    <div class="space-y-4">
                        <p id="companyDescription" class="text-gray-700">
                            {{ $company->about ?? '' }}
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-maroon-500-700 mb-2">Industry</h4>
                                <p id="industry" class="text-gray-600">
                                    {{ $company->industry ?? '' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-maroon-500-700 mb-2">
                                    Company Size
                                </h4>
                                <p id="companySize" class="text-gray-600">
                                    {{ $company->company_size ?? '' }} employees
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-maroon-500-700 mb-2">Specialties</h4>
                            <div id="specialties" class="flex flex-wrap gap-2">
                                @if ($company->specialties && count($company->specialties) > 0)
                                    @foreach ($company->specialties as $specialty)
                                        <span
                                            class="bg-maroon-500-100 text-maroon-500-700 px-3 py-1 rounded-full text-sm">{{ $specialty }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-sm">No specialties listed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Careers Section -->
                <div id="careers-section" class="tab-content bg-white rounded-lg shadow-md p-6 ">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Current Openings</h3>
                        <button onclick="showAddPositionModal()"
                            class="bg-maroon-500 hover:bg-maroon-600 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                            + Add Position
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="mb-6">
                        <input type="text" wire:model.live.debounce.300ms="searchTerm"
                            placeholder="Search positions by title, description, location, or type..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>

                    <div id="jobPositions" class="space-y-4">
                        @if ($careers->count() > 0)
                            @foreach ($careers as $career)
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
                                <div class="border border-gray-200 hover:bg-gray-50 transition-all duration-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer"
                                     onclick="openCareerModal({{ $career->id }}, {{ $careerAlreadySaved ? 'true' : 'false' }}, {{ $careerAlreadyApplied ? 'true' : 'false' }}, {{ $this->isMe ? 'true' : 'false' }})">
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
                                                @if ($careerAlreadySaved)
                                                    <button
                                                        class="bg-green-100 text-green-800 font-medium py-2 px-3 rounded-lg cursor-not-allowed text-sm"
                                                        disabled>
                                                        ✓ Saved
                                                    </button>
                                                @else
                                                    <button onclick="event.stopPropagation(); saveJob({{ $career->id }})"
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
                                                    <button onclick="event.stopPropagation(); applyNow({{ $career->id }})"
                                                        class="bg-maroon-500 hover:bg-maroon-500-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
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
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Recent Updates</h3>
                        <button onclick="showAddPostModal(); showTab('posts'); saveTabToLocalStorage('posts')"
                            class="bg-maroon-500 hover:bg-maroon-600 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                            + Add Post
                        </button>
                    </div>
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
                                            class="w-12 h-12 bg-maroon-500 rounded-full flex items-center justify-center">
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
                                                <!-- <button class="hover:text-maroon-500">
                                                    👍 Like ({{ rand(10, 50) }})
                                                </button>
                                                <button class="hover:text-maroon-500">
                                                    💬 Comment ({{ rand(1, 15) }})
                                                </button>
                                                <button class="hover:text-maroon-500">📤 Share</button> -->
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
                                                    @if ($applicant->status === 'pending') bg-amber-100 text-amber-800
                                                    @elseif($applicant->status === 'approved') bg-green-100 text-green-800
                                                    @elseif($applicant->status === 'rejected') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($applicant->status ?? 'pending') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="viewApplicant({{ App\Models\CurriculumVitae::where('user_id', $applicant->user->id)->first()->id ?? 'null' }})"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                                View Profile
                                            </button>
                                            @if ($applicant->status === 'pending')
                                                <button
                                                    onclick="updateApplicationStatus({{ $applicant->id }}, 'approved')"
                                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg text-sm transition-all">
                                                    Approve
                                                </button>
                                                <button
                                                    onclick="updateApplicationStatus({{ $applicant->id }}, 'rejected')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm transition-all">
                                                    reject
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
                            <a href="#" class="text-maroon-500 hover:underline">{{ $company->website ?? '' }}</a>
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
    <!-- Add Post Modal -->
    <div id="addPostModal" style="background-color: #11000491; overflow-y: auto;"
        class="fixed inset-0 flex items-center justify-center p-4 z-50 hidden"
        @post-saved.window="Swal.fire({icon: 'success', title: 'Success!', text: $event.detail, timer: 2000, showConfirmButton: false}).then((result) => { showTab('posts');});">
        <div class="bg-white rounded-lg max-w-xl w-[600px]">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Add New Post</h2>
                    <button onclick="hideAddPostModal()"
                        class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Post Content</label>
                        <textarea wire:model="postContent" rows="6"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                            placeholder="Share your company's latest updates, announcements, or news..."></textarea>
                        @error('postContent')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </form>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="hideAddPostModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button wire:click="savePost"
                        class="px-6 py-2 bg-maroon-500 hover:bg-maroon-600 text-white rounded-lg font-semibold transition-all">
                        Save Post
                    </button>
                </div>

                @error('general')
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Add Position Modal -->
    <div id="addPositionModal" style="background-color: #11000491; overflow-y: auto;"
        class="fixed inset-0 flex items-center justify-center p-4 z-50 hidden"
        @position-saved.window="Swal.fire({icon: 'success', title: 'Success!', text: $event.detail, timer: 2000, showConfirmButton: false}); showTab('posts');">
        <div class="bg-white rounded-lg max-w-xl w-[600px]">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">Add New Position</h2>
                    <button onclick="hideAddPositionModal()"
                        class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" wire:model="jobTitle"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" wire:model="jobLocation"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm  font-medium text-gray-700 mb-1">Employment Type</label>
                        <select wire:model="jobType"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent">
                            <option selected value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Min Salary</label>
                        <input type="number" wire:model="minSalary"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Max Salary</label>
                        <input type="number" wire:model="maxSalary"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div class="col-span-2 px-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <div class="overflow-hidden">
                            <div class="p-3">
                                <div class="flex flex-wrap gap-2 mb-3 min-h-[2rem]">
                                    @foreach ($jobTags as $index => $tag)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-md text-sm bg-maroon-100 text-maroon-800 border">
                                            {{ $tag }}
                                            <button wire:click="removeTag({{ $index }})" type="button"
                                                class="ml-2 inline-flex items-center p-0.5 rounded-full text-maroon-400 hover:text-maroon-600 hover:bg-maroon-200 transition-colors">
                                                X
                                            </button>
                                        </span>
                                    @endforeach
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="newTag"
                                        placeholder="Type a tag and press Enter or click Add..."
                                        class="flex-1 border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        wire:keydown.enter="addTag" />
                                    <button wire:click="addTag" type="button"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded font-medium transition-colors">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" wire:model="startDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" wire:model="endDate"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-maroon-500-500 focus:border-transparent" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <!-- Editor Panel -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                            <div class="bg-gray-800 hidden text-white px-4 py-3 flex items-center justify-between">
                                <span class="hidden font-semibold">Editor</span>
                                <div class="hidden flex gap-2">
                                    <button type="button" onclick="insertMarkdown('**', '**')"
                                        class="px-2 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm"
                                        title="Bold">B</button>
                                    <button type="button" onclick="insertMarkdown('*', '*')"
                                        class="px-2 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm italic"
                                        title="Italic">I</button>
                                    <button type="button" onclick="insertMarkdown('`', '`')"
                                        class="px-2 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm font-mono"
                                        title="Code">&lt;/&gt;</button>
                                    <button type="button" onclick="insertMarkdown('[', '](url)')"
                                        class="px-2 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm"
                                        title="Link">🔗</button>
                                    <button type="button" onclick="insertMarkdown('## ', '')"
                                        class="px-2 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm"
                                        title="Heading">H</button>
                                </div>
                            </div>
                            <textarea id="markdown-input" wire:model="jobDescription"
                                class="w-full h-96  p-4 font-mono text-sm resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Type job description here..."></textarea>
                        </div>
                    </div>
                </form>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="hideAddPositionModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button wire:click="savePosition"
                        class="px-6 py-2 bg-maroon-500 hover:bg-maroon-600 text-white rounded-lg font-semibold transition-all">
                        Save Position
                    </button>
                </div>

                @error('general')
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <script>
        function showTab(tabName) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach((content) => content.classList.add('hidden'));

            const btns = document.querySelectorAll('.tab-btn');
            btns.forEach((btn) => {
                btn.classList.remove('border-maroon-500', 'text-maroon-500', 'font-semibold');
                btn.classList.add('border-transparent', 'text-gray-600');
            });

            const section = document.getElementById(tabName + '-section');
            if (section) section.classList.remove('hidden');

            // Update the active tab button styling
            const activeBtn = document.querySelector(`button[onclick*="${tabName}"]`);
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent', 'text-gray-600');
                activeBtn.classList.add('border-maroon-500', 'text-maroon-500', 'font-semibold');
            }
        }

        function saveTabToLocalStorage(tabName) {
            localStorage.setItem('companyProfileActiveTab', tabName);
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeStarRating();
            loadReviews({{ $company->id }});

            // Check URL for tab parameter
            const urlSearch = window.location.search;
            if (urlSearch.includes('?posts')) {
                showTab('posts');
                saveTabToLocalStorage('posts');
            } else if (urlSearch.includes('?careers')) {
                showTab('careers');
                saveTabToLocalStorage('careers');
            } else if (urlSearch.includes('?reviews')) {
                showTab('reviews');
                saveTabToLocalStorage('reviews');
            } else if (urlSearch.includes('?Applicants')) {
                showTab('Applicants');
                saveTabToLocalStorage('Applicants');
            } else if (urlSearch.includes('?about')) {
                showTab('about');
                saveTabToLocalStorage('about');
            } else {
                // Load saved tab from localStorage if no URL param
                const savedTab = localStorage.getItem('companyProfileActiveTab');
                if (savedTab) {
                    showTab(savedTab);
                }
            }
        });

        function setTextareaMode(mode) {
            const writeMode = document.getElementById('write-mode');
            const previewMode = document.getElementById('preview-mode');
            const writeTab = document.getElementById('write-tab');
            const previewTab = document.getElementById('preview-tab');
            const textarea = document.querySelector('textarea[wire\\:model="jobDescription"]');
            const previewContent = document.getElementById('preview-content');

            if (mode === 'write') {
                writeMode.classList.remove('hidden');
                previewMode.classList.add('hidden');
                writeTab.classList.add('active-mode');
                writeTab.classList.remove('bg-gray-50', 'hover:bg-gray-100');
                writeTab.classList.add('bg-white', 'hover:bg-gray-50');
                previewTab.classList.remove('active-mode');
                previewTab.classList.add('bg-gray-50', 'hover:bg-gray-100');
            } else {
                writeMode.classList.add('hidden');
                previewMode.classList.remove('hidden');
                previewTab.classList.add('active-mode');
                previewTab.classList.remove('bg-gray-50', 'hover:bg-gray-100');
                previewTab.classList.add('bg-white', 'hover:bg-gray-50');
                writeTab.classList.remove('active-mode');
                writeTab.classList.add('bg-gray-50', 'hover:bg-gray-100');

                // Simple markdown-like preview (basic implementation)
                const text = textarea.value;
                const html = text
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.*?)\*/g, '<em>$1</em>')
                    .replace(/\n/g, '<br>');
                previewContent.innerHTML = html;
            }
        }
    </script>

    <!-- Career Details Modal -->
    <div id="careerModal" style="background-color: #11000491; overflow-y: auto;"
         class="fixed inset-0 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-lg max-w-6xl min-w-6xl sm:w-full max-h-[90vh] overflow-y-auto">
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 id="careerModalTitle" class="text-2xl font-bold text-gray-900">Career Details</h2>
                    <button onclick="closeCareerModal()"
                            class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-6">
                    <!-- Job Title and Basic Info -->
                    <div>
                        <h3 id="careerTitle" class="text-3xl font-bold text-gray-900 mb-2"></h3>
                        <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-4">
                            <span id="careerRoleType"></span>
                            <span>•</span>
                            <span id="careerLocation"></span>
                            <span id="careerSalary" class="text-emerald-600 font-semibold"></span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span id="careerCompany" class="text-lg text-gray-700"></span>
                            <span>•</span>
                            <span id="careerPostedDate" class="text-sm text-gray-500"></span>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div id="careerTags" class="flex flex-wrap gap-2"></div>

                    <!-- Description -->
                    <div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Job Description</h4>
                        <div id="careerDescription" class="text-gray-700 leading-relaxed"></div>
                    </div>

                    <!-- Additional Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div id="careerStartDateSection" class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-900 mb-2">Start Date</h5>
                            <p id="careerStartDate" class="text-gray-700"></p>
                        </div>
                        <div id="careerEndDateSection" class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-900 mb-2">End Date</h5>
                            <p id="careerEndDate" class="text-gray-700"></p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div id="careerActions" class="flex space-x-4  pt-6 border-t border-gray-200">
                        
                        <!-- Save Job Button -->
                        <div id="saveJobContainer">
                            <!-- Button will be populated by JavaScript -->
                        </div>

                        <!-- Apply Now Button -->
                        <div id="applyNowContainer">
                            <!-- Button will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const input = document.getElementById('markdown-input');

        function insertMarkdown(before, after) {
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const text = input.value;
            const selectedText = text.substring(start, end) || 'text';

            const newText = text.substring(0, start) + before + selectedText + after + text.substring(end);
            input.value = newText;

            // Set cursor position
            const newPos = start + before.length + selectedText.length;
            input.setSelectionRange(newPos, newPos);
            input.focus();
        }

        // Handle tab key for indentation
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                const end = this.selectionEnd;
                this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        function showAddPostModal() {
            document.getElementById('addPostModal').classList.remove('hidden');
            document.getElementById('addPositionModal').classList.add('hidden');
        }

        function hideAddPostModal() {
            document.getElementById('addPostModal').classList.add('hidden');
        }

        function showAddPositionModal() {
            document.getElementById('addPositionModal').classList.remove('hidden');
            document.getElementById('addPostModal').classList.add('hidden');
        }

        function hideAddPositionModal() {
            document.getElementById('addPositionModal').classList.add('hidden');
        }

        function openCareerModal(careerId, isSaved, isApplied, isMe) {
            // Fetch career details via AJAX
            fetch(`/career/${careerId}/details`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    populateCareerModal(data.career, isSaved, isApplied, isMe);
                    document.getElementById('careerModal').classList.remove('hidden');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load career details.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while loading career details.'
                });
            });
        }

        function closeCareerModal() {
            document.getElementById('careerModal').classList.add('hidden');
        }

        function populateCareerModal(career, isSaved, isApplied, isMe) {
            // Set title
            document.getElementById('careerModalTitle').textContent = career.title || 'Untitled Position';

            // Set basic info
            document.getElementById('careerTitle').textContent = career.title || 'Untitled Position';
            document.getElementById('careerRoleType').textContent = career.role_type || 'Not specified';
            document.getElementById('careerLocation').textContent = career.location || 'Location not specified';
            document.getElementById('careerCompany').textContent = career.company?.name || 'Unknown Company';
            document.getElementById('careerPostedDate').textContent = career.created_at ?
                new Date(career.created_at).toLocaleDateString() : 'Recently posted';

            // Set salary
            const salaryEl = document.getElementById('careerSalary');
            if (career.min_salary || career.max_salary) {
                let salaryText = '';
                if (career.min_salary && career.max_salary) {
                    salaryText = `₱${number_format(career.min_salary)} - ₱${number_format(career.max_salary)}`;
                } else if (career.min_salary) {
                    salaryText = `₱${number_format(career.min_salary)}+`;
                } else if (career.max_salary) {
                    salaryText = `Up to ₱${number_format(career.max_salary)}`;
                }
                salaryEl.textContent = salaryText;
            } else {
                salaryEl.textContent = '';
            }

            // Set description
            document.getElementById('careerDescription').innerHTML = career.description || 'No description provided.';

            // Set tags
            const tagsContainer = document.getElementById('careerTags');
            if (career.tags && career.tags.length > 0) {
                tagsContainer.innerHTML = career.tags.map(tag =>
                    `<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">${tag}</span>`
                ).join('');
            } else {
                tagsContainer.innerHTML = '';
            }

            // Set dates
            const startDateEl = document.getElementById('careerStartDate');
            const endDateEl = document.getElementById('careerEndDate');
            const startDateSection = document.getElementById('careerStartDateSection');
            const endDateSection = document.getElementById('careerEndDateSection');

            if (career.start_date) {
                startDateEl.textContent = new Date(career.start_date).toLocaleDateString();
                startDateSection.style.display = 'block';
            } else {
                startDateSection.style.display = 'none';
            }

            if (career.end_date) {
                endDateEl.textContent = new Date(career.end_date).toLocaleDateString();
                endDateSection.style.display = 'block';
            } else {
                endDateSection.style.display = 'none';
            }

            // Set action buttons
            const saveJobContainer = document.getElementById('saveJobContainer');
            const applyNowContainer = document.getElementById('applyNowContainer');

            if (isMe === true || isMe === 'true') {
                // Hide action buttons for company owner
                saveJobContainer.style.display = 'none';
                applyNowContainer.style.display = 'none';
            } else {
                // Show action buttons for visitors
                saveJobContainer.style.display = 'block';
                applyNowContainer.style.display = 'block';

                if (isSaved === true || isSaved === 'true') {
                    saveJobContainer.innerHTML = `
                        <button class="bg-green-100 text-green-800 font-medium py-2 px-4 rounded-lg cursor-not-allowed text-sm" disabled>
                            ✓ Saved
                        </button>
                    `;
                } else {
                    saveJobContainer.innerHTML = `
                        <button onclick="saveJob(${career.id})" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                            Save Job
                        </button>
                    `;
                }

                if (isApplied === true || isApplied === 'true') {
                    applyNowContainer.innerHTML = `
                        <button class="bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg cursor-not-allowed text-sm" disabled>
                            ✓ Applied
                        </button>
                    `;
                } else {
                    applyNowContainer.innerHTML = `
                        <button onclick="applyNow(${career.id})" class="bg-maroon-500 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                            Apply Now
                        </button>
                    `;
                }
            }
        }

        function number_format(number) {
            return new Intl.NumberFormat().format(number);
        }
    </script>
</div>

