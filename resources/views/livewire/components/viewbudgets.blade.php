<div>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="container mx-auto p-4">
            <div class="bg-white rounded-lg shadow-lg p-6 md:p-10 max-w-6xl mx-auto">
                <h1 class="text-3xl font-bold text-center mb-8">View Budget Information</h1>

                <!-- Project Dropdown -->
                <div class="mb-6">
                    <label for="project-select" class="block text-sm font-medium text-gray-700">Select Project</label>
                    <select id="project-select" wire:model="currentProjectIndex" wire:change="goToProject($event.target.value)"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        @foreach ($projects as $index => $project)
                            <option value="{{ $index }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Field -->
                {{-- <div class="mb-6">
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" id="search" wire:model.debounce.500ms="search" placeholder="Search for expense items..."
                        class="mt-1 block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div> --}}

                <!-- Download Button -->
                <div class="mb-6 flex justify-end">
                    <button wire:click="downloadBudget" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Download
                    </button>
                </div>

                <!-- Budget Information List -->
                <div class="block w-full overflow-x-auto max-w-full border rounded-lg shadow-sm p-6">
                    @forelse ($budgetData as $milestone => $items)
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ $milestone }}</h2>
                            <ul class="list-disc list-inside">
                                @foreach ($items as $item)
                                    <li class="text-sm text-gray-700 mb-2">
                                        {{ $item->expense_item }} - shs. {{ number_format($item->estimated_amount, 0, '.', ',') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        <p class="text-center text-sm text-gray-500">No budget data found.</p>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $budgetData->links() }}
                </div>
            </div>
        </div>
    </div>
</div>