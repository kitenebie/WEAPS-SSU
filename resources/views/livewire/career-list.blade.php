<div style="width: 100%; display: flex; justify-content: center;">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="/src/outStyle.css">
    <div style="width: 95rem !important" class="mt-8">

        <!-- Search and Filter Section -->
        <div class="mb-8 min-w-full border border-red-900 bg-red-900 shadow-xs p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search Bar -->
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-50 mb-3 pr-4">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search Careers
                    </label>
                    <div class="relative flex">
                        <input type="text" id="search" wire:model.live.debounce.300ms="search"
                            placeholder="Search by job title, company..."
                            class="w-full  p-2 pl-4 pr-4 py-4 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                        <div class="absolute inset-y-0 right-2  pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Location Filter -->
                <div>
                    <label for="location_filter" class="block text-sm font-semibold text-gray-50 mb-3 pr-4">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Location
                    </label>
                    <input type="text" id="location_filter" wire:model.live.debounce.300ms="location_filter"
                        placeholder="Enter location..."
                        class="w-full px-4 py-4 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                </div>

                <!-- Role Type Filter -->
                <div>
                    <label for="role_type_filter" class="block text-sm font-semibold text-gray-50 mb-3 pr-4">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6">
                            </path>
                        </svg>
                        Job Type
                    </label>
                    <select id="role_type_filter" wire:model.live="role_type_filter"
                        class="w-full px-4 py-4 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                        <option value="">All Job Types</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>

                <!-- Salary Range Filter -->
                <div>
                    <label for="salary_range_filter" class="block text-sm font-semibold text-gray-50 mb-3 pr-4">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                        Salary Range (₱)
                    </label>
                    <select id="salary_range_filter" wire:model.live="salary_range_filter"
                        class="w-full px-4 py-4 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                        <option value="">All Salary Ranges</option>
                        <option value="5k-10k">₱5,000 - ₱10,000</option>
                        <option value="11k-15k">₱11,000 - ₱15,000</option>
                        <option value="16k-20k">₱16,000 - ₱20,000</option>
                        <option value="21k-25k">₱21,000 - ₱25,000</option>
                        <option value="26k-30k">₱26,000 - ₱30,000</option>
                        <option value="31k-35k">₱31,000 - ₱35,000</option>
                        <option value="36k-40k">₱36,000 - ₱40,000</option>
                        <option value="41k-45k">₱41,000 - ₱45,000</option>
                        <option value="46k-50k">₱46,000 - ₱50,000</option>
                        <option value="51k-60k">₱51,000 - ₱60,000</option>
                        <option value="61k-70k">₱61,000 - ₱70,000</option>
                        <option value="71k-80k">₱71,000 - ₱80,000</option>
                        <option value="81k-90k">₱81,000 - ₱90,000</option>
                        <option value="91k-100k">₱91,000 - ₱100,000</option>
                        <option value="101k-125k">₱101,000 - ₱125,000</option>
                        <option value="126k-150k">₱126,000 - ₱150,000</option>
                        <option value="151k-500k">₱151,000 - ₱500,000</option>
                    </select>
                </div>
            </div>

            <!-- Active Filters & Clear Button -->
            @if ($search || $location_filter || $role_type_filter)
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap gap-2">
                            @if ($search)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    "{{ $search }}"
                                </span>
                            @endif
                            @if ($location_filter)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $location_filter }}
                                </span>
                            @endif
                            @if ($role_type_filter)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-maroon-100 text-gray-50">
                                    {{ $role_type_filter }}
                                </span>
                            @endif
                            @if ($salary_range_filter)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    @switch($salary_range_filter)
                                        @case('5k-10k')
                                            ₱5K-10K
                                        @break

                                        @case('11k-15k')
                                            ₱11K-15K
                                        @break

                                        @case('16k-20k')
                                            ₱16K-20K
                                        @break

                                        @case('21k-25k')
                                            ₱21K-25K
                                        @break

                                        @case('26k-30k')
                                            ₱26K-30K
                                        @break

                                        @case('31k-35k')
                                            ₱31K-35K
                                        @break

                                        @case('36k-40k')
                                            ₱36K-40K
                                        @break

                                        @case('41k-45k')
                                            ₱41K-45K
                                        @break

                                        @case('46k-50k')
                                            ₱46K-50K
                                        @break

                                        @case('51k-60k')
                                            ₱51K-60K
                                        @break

                                        @case('61k-70k')
                                            ₱61K-70K
                                        @break

                                        @case('71k-80k')
                                            ₱71K-80K
                                        @break

                                        @case('81k-90k')
                                            ₱81K-90K
                                        @break

                                        @case('91k-100k')
                                            ₱91K-100K
                                        @break

                                        @case('101k-125k')
                                            ₱101K-125K
                                        @break

                                        @case('126k-150k')
                                            ₱126K-150K
                                        @break

                                        @case('151k-500k')
                                            ₱151K-500K
                                        @break
                                    @endswitch
                                </span>
                            @endif
                        </div>

                        <button wire:click="clearFilters"
                            class="inline-flex mt-2 items-center px-4 py-2 bg-white border-2 border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-maroon-50 hover:border-slate-400 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear All
                        </button>
                    </div>
                </div>
            @endif
        </div>

        @if ($careers->count() > 0)
            <!-- Results Counter -->
            <div class="mb-6">
                <p class="text-lg text-gray-600">
                    Showing {{ $careers->count() }} career{{ $careers->count() !== 1 ? 's' : '' }}
                    @if ($search || $location_filter || $role_type_filter)
                        matching your search criteria
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($careers as $career)
                    <div
                        class="bg-red-50 rounded-lg relative shadow-md border pt-4 border-gray-200 p-6 hover:shadow-lg hover:border-slate-300 transition-all duration-200">
                        <div class="w-full h-4 bg-maroon-600 absolute rounded-t-lg top-0 left-0"></div>
                        @if(isset($career->is_saved) && $career->is_saved)
                            <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                Saved
                            </div>
                        @endif
                        @if(isset($career->is_applied) && $career->is_applied)
                            <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                Applied
                            </div>
                        @endif
                        <div class="mb-4" >
                            <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $career->title }}</h3>
                            @if ($career->company->name)
                                <p class="text-lg font-semibold text-gray-700 mb-2">
                                    <span class="text-gray-500">Company:</span>
                                    {{ $career->company->name ?? 'N/A' }}
                                </p>
                            @endif

                            @if ($career->min_salary || $career->max_salary)
                                <div class="flex px-4 py-2 items-center text-lg border-2 text-red-900 font-semibold mb-2">
                                    {{-- <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg> --}}
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

                        </div>

                        <div class="mb-4">
                            <p class="text-gray-900 text-md line-clamp-3">{{ Str::limit($career->description, 150) }}
                            </p>
                        </div>

                        <div class="space-y-2 mb-4">
                            @if ($career->role_type)
                                <div class="flex items-center text-sm text-gray-900">
                                    <svg class="w-4 h-4 mr-2 text-gray-900" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6">
                                        </path>
                                    </svg>
                                    {{ $career->role_type }}
                                </div>
                            @endif

                            @if ($career->location)
                                <div class="flex items-center text-sm text-gray-900">
                                    <svg class="w-4 h-4 mr-2 text-gray-900" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $career->location }}
                                </div>
                            @endif

                            {{-- @if ($career->min_salary || $career->max_salary)
                                <div class="flex items-center text-sm text-gray-50">
                                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                            @endif --}}
                        </div>

                        @if ($career->tags && count($career->tags) > 0)
                            <div class="mb-4 mt-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($career->tags as $tag)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-maroon-500 text-gray-50">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-4 flex gap-2">
                            <button wire:click="openCareer({{ $career->id }})"
                                class="w-1/2 bg-maroon-600 hover:bg-maroon-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                View Details
                            </button>
                            <button wire:click="openCampany({{ $career->company_id }})"
                                class="w-1/2 bg-blue-400 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                View Compay
                            </button>
                        </div>

                        <div class="pt-4 border-t border-slate-200">
                            <div class="flex items-center justify-between text-sm text-slate-500">
                                <span>{{ $career->created_at->diffForHumans() }}</span>
                                @if ($career->applicants_count ?? false)
                                    <span class="font-medium">{{ $career->applicants_count }} applicants</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-7xl text-center py-12">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900">No careers found</h3>
                <p class="mt-1 text-sm text-slate-500">No career opportunities are currently available.</p>
            </div>
        @endif
    </div>
</div>
