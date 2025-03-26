<div>
    <section class="container px-4 mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-10 pb-6 border-b border-gray-200 dark:border-gray-700">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Project Budgets</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage and track all project budgets in one place</p>
            </div>
            
            <div class="flex items-center gap-x-3">
                {{-- <span class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
                    {{ $budgets->total() }} {{ $budgets->total() === 1 ? 'Budget' : 'Budgets' }}
                </span> --}}
                <button 
                    wire:click="downloadBudget"
                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export PDF
                </button>
            </div>
        </div>

        <!-- Project Selection -->
        <div class="mt-6 mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Project</label>
            <div class="flex flex-wrap gap-2">
                @foreach($projects as $index => $project)
                    <button 
                        wire:click="goToProject({{ $index }})"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all
                            {{ $currentProjectIndex == $index ? 
                               'bg-blue-600 text-white shadow-md' : 
                               'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}"
                    >
                        {{ $project->project_name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 px-4 py-3 bg-gray-50 rounded-lg dark:bg-gray-800 mb-6">
            <div class="relative w-full md:w-80">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    wire:model.live.debounce.300ms="search"
                    type="text" 
                    placeholder="Search budgets..." 
                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
            </div>
            
            <div class="flex items-center space-x-2 w-full md:w-auto">
                <div class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                    Showing {{ $budgets->firstItem() }}-{{ $budgets->lastItem() }} of {{ $budgets->total() }}
                </div>
                <div class="flex space-x-1">
                    <button 
                        wire:click="previousPage"
                        @disabled($budgets->onFirstPage())
                        class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button 
                        wire:click="nextPage"
                        @disabled(!$budgets->hasMorePages())
                        class="px-3 py-1 rounded-md bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Budgets Table -->
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 rounded-lg">
                        @if($budgets->isEmpty())
                            <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No budgets found</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    @if($search)
                                        Try adjusting your search query
                                    @else
                                        No budgets available for the selected project
                                    @endif
                                </p>
                            </div>
                        @else
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                            Budget Name
                                        </th>
                                        <th scope="col" class="px-6 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                            Phase/Milestone
                                        </th>
                                        <th scope="col" class="relative px-6 py-3.5">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                    @foreach($budgets as $budget)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900 dark:text-white">{{ $budget->budget_name }}</div>
                                                        <div class="text-gray-500 dark:text-gray-400 text-sm">
                                                            {{ $budget->estimated_amount ? '$'.number_format($budget->estimated_amount, 2) : 'Amount not set' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-gray-900 dark:text-gray-100">{{ Str::limit($budget->description, 60) }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="flex items-center">
                                                    @if($budget->phase)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                            Phase: {{ $budget->phase->name }}
                                                        </span>
                                                    @elseif($budget->milestone)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                            Milestone: {{ $budget->milestone->name }}
                                                        </span>
                                                    @else
                                                        <span class="text-gray-500 dark:text-gray-400 text-sm">Not assigned</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <button 
                                                        wire:click="openViewModal({{ $budget->id }})"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/30"
                                                        title="View"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        </svg>
                                                    </button>
                                                    <button 
                                                        wire:click="openEditModal({{ $budget->id }})"
                                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 p-1 rounded-full hover:bg-yellow-50 dark:hover:bg-yellow-900/30"
                                                        title="Edit"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </button>
                                                    <button 
                                                        wire:click="confirmDelete({{ $budget->id }})"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1 rounded-full hover:bg-red-50 dark:hover:bg-red-900/30"
                                                        title="Delete"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                            
                                                    <!-- Details Button -->
                                                    <a href="{{ route('budgets.details', $budget->id) }}" 
                                                        class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300"
                                                        title="Details">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Details
                                                    </a>
                                                </div>
                                            </td>
                                            
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Pagination -->
        <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-b-lg">
            <div class="flex-1 flex justify-between sm:hidden">
                <button 
                    wire:click="previousPage"
                    @disabled($budgets->onFirstPage())
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Previous
                </button>
                <button 
                    wire:click="nextPage"
                    @disabled(!$budgets->hasMorePages())
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Next
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Showing <span class="font-medium">{{ $budgets->firstItem() }}</span> to <span class="font-medium">{{ $budgets->lastItem() }}</span> of <span class="font-medium">{{ $budgets->total() }}</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <!-- Previous Page Link -->
                        <button 
                            wire:click="previousPage"
                            @disabled($budgets->onFirstPage())
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Page Links -->
                        @foreach($budgets->links()['elements'] as $element)
                            @if(is_string($element))
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                    {{ $element }}
                                </span>
                            @endif

                            @if(is_array($element))
                                @foreach($element as $page => $url)
                                    <button 
                                        wire:click="gotoPage({{ $page }})"
                                        class="{{ $budgets->currentPage() == $page ? 'z-10 bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900/30 dark:border-blue-700 dark:text-blue-400' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600' }} relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    >
                                        {{ $page }}
                                    </button>
                                @endforeach
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        <button 
                            wire:click="nextPage"
                            @disabled(!$budgets->hasMorePages())
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <x-modals wire:model="showViewModal" title="Budget Details" max-width="2xl">
            <x-card title="Budget Details" rounded="lg" shadow="none" class="border-0">
                @if($selectedBudget)
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $selectedBudget->budget_name }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $selectedBudget->description }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Financial Details</h4>
                                <dl class="space-y-3">
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500 dark:text-gray-400">Estimated Amount</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $selectedBudget->estimated_amount ? '$'.number_format($selectedBudget->estimated_amount, 2) : 'Not specified' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500 dark:text-gray-400">Status</dt>
                                        <dd>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $selectedBudget->approved ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200' }}">
                                                {{ $selectedBudget->approved ? 'Approved' : 'Pending Approval' }}
                                            </span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Project Association</h4>
                                <dl class="space-y-3">
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500 dark:text-gray-400">Project</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $currentProject->project_name }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500 dark:text-gray-400">Associated With</dt>
                                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                            @if($selectedBudget->phase)
                                                Phase: {{ $selectedBudget->phase->name }}
                                            @elseif($selectedBudget->milestone)
                                                Milestone: {{ $selectedBudget->milestone->name }}
                                            @else
                                                Not assigned
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                @endif

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <x-button wire:click="$set('showViewModal', false)" label="Close" flat>Close</x-button>
                    </div>
                </x-slot>
            </x-card>
        </x-modals>

        <!-- Edit Modal -->
        <x-modals wire:model="showEditModal" title="Edit Budget" max-width="lg">
            <x-card title="Edit Budget" rounded="lg" shadow="none" class="border-0">
                @if($selectedBudget)
                <div class="space-y-4">
                    <x-input 
                        wire:model="selectedBudget.budget_name" 
                        label="Budget Name" 
                        placeholder="Enter budget name"
                        class="focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <x-textarea 
                        wire:model="selectedBudget.description" 
                        label="Description" 
                        placeholder="Enter description"
                        rows="3"
                        class="focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <x-input 
                        wire:model="selectedBudget.estimated_amount" 
                        label="Estimated Amount" 
                        placeholder="0.00" 
                        type="number" 
                        step="0.01"
                        class="focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                @endif

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button wire:click="$set('showEditModal', false)" label="Cancel" flat>Cancel</x-button>
                        <x-button wire:click="updateBudget" label="Save Changes" spinner="updateBudget" primary>Update</x-button>
                    </div>
                </x-slot>
            </x-card>
        </x-modals>

        <!-- Delete Confirmation Modal -->
        <x-modals wire:model="showDeleteModal" max-width="md" title="Delete Budget">
            <x-card title="Delete Budget" rounded="lg" shadow="none" class="border-0">
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Are you sure?</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        This will permanently delete the budget and all associated data. This action cannot be undone.
                    </p>
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button wire:click="$set('showDeleteModal', false)" label="Cancel" flat>Close</x-button>
                        <x-button wire:click="deleteBudget" label="Delete Budget" spinner="deleteBudget" negative>Delete</x-button>
                    </div>
                </x-slot>
            </x-card>
        </x-modals>
    </section>
</div>