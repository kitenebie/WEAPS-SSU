<div style="padding: 2rem 8rem" class="w-full min-h-screen">
    <div class="max-w-7xl mx-auto mt-6 px-4">
        <!-- Cover Photo Section -->
        <div class="relative">
            <!-- Cover Photo -->
            <div class="h-80 rounded-t-lg relative overflow-hidden">
                <img src="https://i.ytimg.com/vi/648DbEgy7Oo/maxresdefault.jpg" alt="Cover Photo"
                    class="w-full h-full object-cover" />

                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-red-700 bg-opacity-50"></div>

                <!-- Company Name + Tagline -->
                <div class="absolute bottom-4 left-52 text-white">
                    <h2 class="text-3xl font-bold">TechCorp Solutions</h2>
                    <p class="text-lg">Innovation • Excellence • Growth</p>
                </div>

                <!-- Update Cover Button -->
                <button type="button" wire:click='OpenUpdateCoverPhontoModal'
                    class="absolute top-4 right-4 bg-red-900 hover:border hover:border-yellow-400 text-white px-4 py-2 rounded-lg transition-all">
                    Update Cover
                </button>
                <x-filament::modal id="edit-campany-cover-photo" icon="heroicon-o-exclamation-triangle" icon-color="danger">
                    <x-slot name="heading">
                        Modal heading
                    </x-slot>

                    {{-- Modal content --}}
                </x-filament::modal>
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
                            <img src="https://image.mono.ipros.com/public/company/logo/cd3/2084355/IPROS70908366485135546252.png?w=200&h=200"
                                alt="Company Logo" class="w-full h-full object-cover" />
                        </div>

                        <!-- Update Logo Button -->
                        <button onclick="updateLogo()"
                            class="absolute border-yellow-600 border-2 bottom-2 right-2 bg-gray-200 hover:bg-gray-300 p-2 rounded-full transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 5a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.414-1.414A1 1 0 0012.586 3H7.414a1 1 0 00-.707.293L5.293 4.707A1 1 0 014.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-1">
                        <!-- <h1 id="companyName" class="text-3xl font-bold text-gray-900 mb-2">TechCorp Solutions</h1> Leading Technology Solutions -->
                        <p id="companyType" class="text-lg text-gray-600 mb-2">
                            Technology Consulting & Software Development
                        </p>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <span id="location">📍 Makati City, Metro Manila</span>
                            <span id="founded">🏢 Founded in 2015</span>
                            <span id="employees">👥 500+ employees</span>
                        </div>
                    </div>

                    <button onclick="openEditModal()"
                        class=" bg-red-900 hover:border hover:border-yellow-400 text-white px-4 py-2 rounded-lg transition-all">
                        Update Profile
                    </button>
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
                            TechCorp Solutions is a leading technology consulting firm
                            specializing in digital transformation, custom software
                            development, and enterprise solutions. We help businesses
                            leverage cutting-edge technology to drive growth and innovation.
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-900-700 mb-2">Industry</h4>
                                <p id="industry" class="text-gray-600">
                                    Information Technology
                                </p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-red-900-700 mb-2">
                                    Company Size
                                </h4>
                                <p id="companySize" class="text-gray-600">
                                    500-1000 employees
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-red-900-700 mb-2">Specialties</h4>
                            <div id="specialties" class="flex flex-wrap gap-2">
                                <span class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">Cloud
                                    Computing</span>
                                <span class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">Web
                                    Development</span>
                                <span class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">Mobile
                                    Apps</span>
                                <span
                                    class="bg-red-900-100 text-red-900-700 px-3 py-1 rounded-full text-sm">AI/ML</span>
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
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        Senior Software Engineer
                                    </h4>
                                    <p class="text-gray-600 mb-2">Full-time • Makati City</p>
                                    <p class="text-gray-700 text-sm">
                                        Join our development team to build scalable web
                                        applications using React, Node.js, and cloud technologies.
                                    </p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">React</span>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Node.js</span>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">AWS</span>
                                    </div>
                                </div>
                                <button
                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all">
                                    Apply Now
                                </button>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        UX/UI Designer
                                    </h4>
                                    <p class="text-gray-600 mb-2">Full-time • BGC, Taguig</p>
                                    <p class="text-gray-700 text-sm">
                                        Create intuitive and beautiful user experiences for our
                                        client projects and internal products.
                                    </p>
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
                                    Apply Now
                                </button>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg text-gray-900">
                                        Digital Marketing Manager
                                    </h4>
                                    <p class="text-gray-600 mb-2">>Full-time • Remote</p>
                                    <p class="text-gray-700 text-sm">
                                        Lead our digital marketing initiatives and help grow our
                                        brand presence across multiple channels.
                                    </p>
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
                                    class="bg-red-900 hover:bg-red-900-700 text-white px-4 py-2 rounded-lg text-sm transition-all mt-4">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Posts Section -->
                <div id="posts-section" class="tab-content bg-white rounded-lg shadow-md p-6 hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Updates</h3>
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start space-x-3">
                                <div class="w-12 h-12 bg-red-900 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">TC</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h4 class="font-semibold">TechCorp Solutions</h4>
                                        <span class="text-gray-500 text-sm">• 2 days ago</span>
                                    </div>
                                    <p class="text-gray-700 mb-3">
                                        Excited to announce our new partnership with leading cloud
                                        providers! This collaboration will enable us to deliver
                                        even more robust solutions to our clients. 🚀
                                    </p>
                                    <div class="flex space-x-4 text-gray-500 text-sm">
                                        <!-- <button class="hover:text-red-900">
                        👍 Like (24)
                      </button>
                      <button class="hover:text-red-900">
                        💬 Comment (5)
                      </button>
                      <button class="hover:text-red-900">📤 Share</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start space-x-3">
                                <div class="w-12 h-12 bg-red-900 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">TC</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h4 class="font-semibold">TechCorp Solutions</h4>
                                        <span class="text-gray-500 text-sm">• 1 week ago</span>
                                    </div>
                                    <p class="text-gray-700 mb-3">
                                        Our team successfully completed a major digital
                                        transformation project for a Fortune 500 client. Proud of
                                        our talented developers and consultants! 💪
                                    </p>
                                    <div class="flex space-x-4 text-gray-500 text-sm">
                                        <!-- <button class="hover:text-red-900">
                        👍 Like (47)
                      </button>
                      <button class="hover:text-red-900">
                        💬 Comment (12)
                      </button>
                      <button class="hover:text-red-900">📤 Share</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <a href="#" class="text-red-900 hover:underline">techcorp.ph</a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Industry:</span>
                            <span class="text-gray-900">IT Services</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phone:</span>
                            <span class="text-gray-900">+63 2 8123 4567</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="text-gray-900">info@techcorp.ph</span>
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

    <!-- Edit Profile Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900">
                        Update Company Profile
                    </h2>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <form id="profileForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" id="editCompanyName"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Type</label>
                        <input type="text" id="editCompanyType"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="editLocation"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Founded Year</label>
                        <input type="text" id="editFounded"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Number of Employees</label>
                        <input type="text" id="editEmployees"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                        <textarea id="editDescription" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                        <select id="editIndustry"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent">
                            <option value="Information Technology">
                                Information Technology
                            </option>
                            <option value="Financial Services">Financial Services</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Retail">Retail</option>
                            <option value="Education">Education</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Size</label>
                        <select id="editCompanySize"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-900-500 focus:border-transparent">
                            <option value="1-10 employees">1-10 employees</option>
                            <option value="11-50 employees">11-50 employees</option>
                            <option value="51-200 employees">51-200 employees</option>
                            <option value="201-500 employees">201-500 employees</option>
                            <option value="500-1000 employees">500-1000 employees</option>
                            <option value="1000+ employees">1000+ employees</option>
                        </select>
                    </div>
                </form>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeEditModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button onclick="saveProfile()"
                        class="px-6 py-2 bg-red-900-700 hover:bg-red-900-800 text-white rounded-lg font-semibold transition-all">
                        Save Changes
                    </button>
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
