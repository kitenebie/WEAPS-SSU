<div class="my-application-container" style="width: 100%; display: flex; justify-content: center;" x-data="myApplication()">
    <div style="width: 100rem !important" class="mt-2">
        <!-- Tab Navigation for Mobile/Small Screens -->
        <div class="block lg:hidden mb-6 bg-gray-900 py-4 px-6">
            <div class="">
                <nav class="-mb-px flex space-x-8">
                    <button wire:click="setActiveTab('saved')"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-lg {{ $this->activeTab == 'saved'
                            ? 'border-white text-white'
                            : 'border-transparent text-gray-300 hover:text-white hover:border-white' }}">
                        Saved Careers
                    </button>
                    <button wire:click="setActiveTab('applied')" :class=""
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-lg {{ $this->activeTab == 'applied'
                            ? 'border-white text-white'
                            : 'border-transparent text-gray-300 hover:text-white hover:border-white' }}">
                        Applications Applied
                    </button>
                </nav>
            </div>
        </div>

        <!-- Mobile/Tablet Layout (below lg) -->
        <div class="block lg:hidden">
            <!-- Saved Careers Tab Content -->
            @if ($this->activeTab == 'saved')
                <div>
                    <div class="saved-careers">
                        <div class="bg-white rounded-lg shadow-md">
                            <h2 class="py-6 px-6 text-3xl font-bold bg-red-900 text-gray-100 mb-4">Saved Careers</h2>

                            <!-- Search Bar for Saved Careers -->
                            <div class="mb-4 px-4">
                                <input type="text" wire:model.live.debounce.300ms="savedSearch"
                                    placeholder="Search saved careers..."
                                    class="w-full px-6 py-4 text-xl border-2 border-gray-700 rounded-sm focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                            </div>

                            <!-- Saved Careers List -->
                            <div class="p-6">
                                @if ($savedCareers->count() > 0)
                                    <div class="bg-white divide-y divide-gray-200">
                                        @foreach ($savedCareers as $savedCareer)
                                            <div class="p-4 border-b-2">
                                                <div class="font-bold text-2xl text-gray-900">{{ $savedCareer->career->title }}</div>
                                                <div class="text-lg text-gray-700">{{ $savedCareer->career->company->name ?? 'N/A' }}</div>
                                                <div class="mt-4">
                                                    <button wire:click="viewSavedCareer({{ $savedCareer->career->id }})"
                                                        class="text-white px-4 py-2 bg-blue-600 hover:bg-blue-900 mr-3">
                                                        View Details
                                                    </button>
                                                    <button wire:click="removeSavedCareer({{ $savedCareer->id }})"
                                                        class="text-white px-4 py-2 bg-red-600 hover:bg-red-900"
                                                        wire:confirm="Are you sure you want to remove this saved career?">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination for Saved Careers -->
                                    <div class="mt-4">
                                        {{ $savedCareers->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <p class="text-gray-500">No saved careers found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Applications Applied Tab Content -->
            @if ($this->activeTab == 'applied')
                <div>
                    <div class="applications-applied">
                        <div class="bg-white rounded-lg shadow-md pb-6">
                            <h2 class="py-6 px-6 text-3xl font-bold bg-red-900 text-gray-100 mb-4">Applications Applied</h2>

                            <!-- Search Bar for Applied Careers -->
                            <div class="mb-4 px-4">
                                <input type="text" wire:model.live.debounce.300ms="appliedSearch"
                                    placeholder="Search applied careers..."
                                    class="w-full px-6 py-4 text-xl border-2 border-gray-700 rounded-sm focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                            </div>

                            <!-- Applied Careers List -->
                            <div class="px-6">
                                @if ($appliedCareers->count() > 0)
                                    <div class="bg-white divide-y divide-gray-800">
                                        @foreach ($appliedCareers as $application)
                                            <div class="p-4">
                                                <div class="font-medium text-xl text-gray-900">{{ $application->career->title }}</div>
                                                <div class="text-lg text-gray-700">{{ $application->career->company->name ?? 'N/A' }}</div>
                                                <div class="mt-1">
                                                    <span class="px-4 py-2 inline-flex text-md leading-5 font-semibold rounded-full
                                                        @if ($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($application->status === 'approved') bg-green-100 text-green-800
                                                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800 @endif">
                                                        {{ ucfirst($application->status) }}
                                                    </span>
                                                    <span class="text-lg text-gray-700 ml-2">{{ $application->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="mt-2">
                                                    <button wire:click="viewAppliedCareer({{ $application->career->id }})"
                                                        class="text-white px-4 py-2 bg-blue-600 hover:bg-blue-900 mr-3">
                                                        View Details
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination for Applied Careers -->
                                    <div class="mt-4">
                                        {{ $appliedCareers->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <p class="text-gray-500">No applications found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Desktop Layout (lg and above) -->
        <div class="hidden lg:grid lg:grid-cols-2 gap-6">
            <!-- Saved Careers Column -->
            <div class="saved-careers">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Saved Careers</h2>

                    <!-- Search Bar for Saved Careers -->
                    <div class="mb-4">
                        <input type="text" wire:model.live.debounce.300ms="savedSearch"
                            placeholder="Search saved careers..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                    </div>

                    <!-- Saved Careers Table -->
                    <div class="overflow-x-auto">
                        @if ($savedCareers->count() > 0)
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($savedCareers as $savedCareer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900">
                                                {{ $savedCareer->career->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-500">
                                                {{ $savedCareer->career->company->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium">
                                                <button wire:click="viewSavedCareer({{ $savedCareer->career->id }})"
                                                    class="text-maroon-600 hover:text-maroon-900 mr-3">
                                                    View Details
                                                </button>
                                                <button wire:click="removeSavedCareer({{ $savedCareer->id }})"
                                                    class="text-amber-600 hover:text-amber-900"
                                                    wire:confirm="Are you sure you want to remove this saved career?">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination for Saved Careers -->
                            <div class="mt-4">
                                {{ $savedCareers->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-800 text-xl">No saved careers found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Applications Applied Column -->
            <div class="applications-applied">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Applications Applied</h2>

                    <!-- Search Bar for Applied Careers -->
                    <div class="mb-4">
                        <input type="text" wire:model.live.debounce.300ms="appliedSearch"
                            placeholder="Search applied careers..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500">
                    </div>

                    <!-- Applied Careers Table -->
                    <div class="overflow-x-auto">
                        @if ($appliedCareers->count() > 0)
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applied Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($appliedCareers as $application)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900">
                                                {{ $application->career->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg text-gray-500">
                                                {{ $application->career->company->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 mt-2 inline-flex text-xs leading-5 font-semibold rounded-sm
                                                @if ($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($application->status === 'approved') bg-green-100 text-green-800
                                                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>
                                            <td class="absolute px-6 py-4 whitespace-nowrap text-lg text-gray-500">
                                                {{ $application->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium">
                                                <button wire:click="viewAppliedCareer({{ $application->career->id }})"
                                                    class="text-maroon-600 hover:text-maroon-900">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination for Applied Careers -->
                            <div class="mt-4">
                                {{ $appliedCareers->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-800 text-xl">No applications found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
    </div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('myApplication', () => ({
            activeTab: 'saved',
        }));
    });
</script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('myApplication', () => ({
            activeTab: 'saved',
        }));
    });
</script>
</div>
