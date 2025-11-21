<div class="w-full flex justify-center px-4">
    <div class="w-full max-w-[1500px] mt-8">

        <!-- Search and Filter Section -->
        <div class="mb-8 w-full border border-red-900 bg-red-900 shadow-xs p-6 md:p-8 rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search Bar -->
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-50 mb-2 sm:mb-3">
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
                            class="w-full p-2 pl-4 pr-10 py-3 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
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
                    <label for="location_filter" class="block text-sm font-semibold text-gray-50 mb-2 sm:mb-3">
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
                        class="w-full px-4 py-3 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
                </div>

                <!-- Role Type Filter -->
                <div>
                    <label for="role_type_filter" class="block text-sm font-semibold text-gray-50 mb-2 sm:mb-3">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6">
                            </path>
                        </svg>
                        Job Type
                    </label>
                    <select id="role_type_filter" wire:model.live="role_type_filter"
                        class="w-full px-4 py-3 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
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
                    <label for="salary_range_filter" class="block text-sm font-semibold text-gray-50 mb-2 sm:mb-3">
                        <svg class="w-4 h-4 inline mr-2 text-gray-50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                        Salary Range (₱)
                    </label>
                    <select id="salary_range_filter" wire:model.live="salary_range_filter"
                        class="w-full px-4 py-3 text-base border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-maroon-500/20 focus:border-slate-500 bg-white shadow-sm transition-all duration-200">
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
        </div>

        <!-- Results Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($careers as $career)
                <div
                    class="bg-red-50 rounded-lg relative shadow-md border border-gray-200 p-6 hover:shadow-lg hover:border-slate-300 transition-all duration-200">
                    <div class="w-full h-2 bg-maroon-600 absolute rounded-t-lg top-0 left-0"></div>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">{{ $career->title }}</h3>
                    <p class="text-lg font-semibold text-gray-700 mb-2">{{ $career->company->name ?? 'N/A' }}</p>
                    <p class="text-gray-900 text-md line-clamp-3">{{ Str::limit($career->description, 150) }}</p>
                    <!-- Buttons -->
                    <div class="mt-4 flex flex-col sm:flex-row gap-2">
                        <button class="flex-1 bg-maroon-600 hover:bg-maroon-700 text-white py-2 rounded-lg">View Details</button>
                        <button class="flex-1 bg-blue-400 hover:bg-blue-500 text-white py-2 rounded-lg">View Company</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
