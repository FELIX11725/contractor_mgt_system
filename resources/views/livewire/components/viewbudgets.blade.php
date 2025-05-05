<div>
    {{-- if no project has been created display an alert instead --}}
     
@if($projects->isEmpty())
        <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 max-w-md mx-auto">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">No Projects Found</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Please create a project to manage budgets.</p>
                    </div>
                </div>
                <div class="mt-6">
                   {{-- link to project creation --}}
                    <a href="{{ route('addproject') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Create Project
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @else
    <section class="container px-4 mx-auto">
        <!-- Enhanced Header Section with Gradient Background -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg mb-8">
            <div class="absolute inset-0 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                    <path d="M10 20h80v60H10z" fill="none" stroke="currentColor" stroke-width="1" />
                    <path d="M30 80V20M50 80V20M70 80V20" fill="none" stroke="currentColor" stroke-width="0.5" />
                    <path d="M10 40h80M10 60h80" fill="none" stroke="currentColor" stroke-width="0.5" />
                </svg>
            </div>
            <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 p-6">
                <div class="text-white">
                    <h2 class="text-3xl font-bold">Project Budgets</h2>
                    <p class="mt-2 text-blue-100 max-w-md">Manage and track all project budgets in one place with comprehensive financial insights</p>
                </div>
                
                <div>
                    <button 
                        wire:click="downloadBudget"
                        class="flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>

    <!-- Simplified Project Selection Dropdown -->
    <div class="mb-6 relative" x-data="{ isOpen: false, selectedProject: '{{ $projects[$currentProjectIndex]->project_name }}' }">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Project Selection</h3>
        
        <!-- Dropdown Trigger Button -->
        <button 
            @click="isOpen = !isOpen" 
            @click.away="isOpen = false"
            class="w-full flex items-center justify-between p-3 rounded-lg
                bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200 border border-gray-300 dark:border-gray-600 shadow-sm"
        >
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span x-text="selectedProject"></span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200 text-gray-600 dark:text-gray-300" :class="{'rotate-180': isOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        <!-- Dropdown Menu -->
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700"
        >
            <div class="max-h-56 overflow-y-auto">
                <!-- Search Input -->
                <div class="sticky top-0 bg-gray-50 dark:bg-gray-700 p-2">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search projects..." 
                            class="w-full pl-8 pr-3 py-2 rounded-md bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-500"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Project List -->
                <div class="py-1">
                    @foreach($projects as $index => $project)
                        <button
                            wire:click="goToProject({{ $index }})"
                            @click="selectedProject = '{{ $project->project_name }}'; isOpen = false"
                            class="w-full text-left px-3 py-2 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-gray-700"
                        >
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-gray-800 dark:text-white {{ $currentProjectIndex == $index ? 'font-medium' : '' }}">
                                    {{ $project->project_name }}
                                </span>
                            </div>
                            
                            @if($currentProjectIndex == $index)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200">
                                    Current
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

        <!-- Improved Search and Filter Section -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    wire:model.live.debounce.300ms="search"
                    type="text" 
                    placeholder="Search budgets by name or description..." 
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-colors"
                >
            </div>
            
            <div class="flex items-center space-x-4 w-full md:w-auto">
                <div class="flex space-x-1">
                    <x-button 
                        wire:click="openCreateBudgetModal"
                        class="p-2 rounded-lg bg-blue-600 hover:bg-blue-700 border border-blue-700 text-white disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Budget
                    </x-button>
                </div>
            </div>
        </div>

        <!-- Improved Budget Table -->
        <div class="overflow-hidden bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
            @if($budgets->isEmpty())
                <div class="p-16 text-center">
                    <div class="flex justify-center">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="mt-4 text-xl font-medium text-gray-900 dark:text-white">No budgets found</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                        @if($search)
                            Your search for "<span class="font-medium text-gray-700 dark:text-gray-300">{{ $search }}</span>" didn't match any budgets. Try using different keywords or check your spelling.
                        @else
                            No budgets have been created for this project yet. When you add budgets, they'll appear here.
                        @endif
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                    Budget Name
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                    Approval Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                    Phase/Milestone
                                </th>
                                <th scope="col" class="px-6 py-4 text-right text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($budgets as $budget)
                                <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900 dark:text-white">{{ $budget->budget_name }}</div>
                                                <div class="text-gray-500 dark:text-gray-400 text-sm flex items-center">
                                                    @if($budget->estimated_amount)
                                                        <span class="font-medium text-green-600 dark:text-green-400">${{ number_format($budget->estimated_amount, 2) }}</span>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-500">Amount not set</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($budget->approved)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300 border border-green-200 dark:border-green-800">
                                                Approved
                                            </span>
                                        @else
                                            <div class="flex space-x-2">
                                                <button 
                                                    wire:click="approveBudget({{ $budget->id }})"
                                                    class="px-3 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700 transition-colors"
                                                >
                                                    Approve
                                                </button>
                                                <button 
                                                    wire:click="rejectBudget({{ $budget->id }})"
                                                    class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 transition-colors"
                                                >
                                                    Reject
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($budget->phase)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                Phase: {{ $budget->phase->name }}
                                            </span>
                                        @elseif($budget->milestone)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                Milestone: {{ $budget->milestone->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                Not assigned
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <button 
                                                wire:click="openViewModal({{ $budget->id }})"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1.5 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors"
                                                title="View Details"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                </svg>
                                            </button>
                                            <button 
                                                wire:click="openEditModal({{ $budget->id }})"
                                                class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 p-1.5 rounded-full hover:bg-amber-50 dark:hover:bg-amber-900/30 transition-colors"
                                                title="Edit Budget"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button 
                                                wire:click="confirmDelete({{ $budget->id }})"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1.5 rounded-full hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors"
                                                title="Delete Budget"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        
                                            <a href="{{ route('budgets.details', $budget->id) }}" 
                                                class="flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition duration-300 shadow-sm hover:shadow"
                                                title="View Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                                Details
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Enhanced Pagination -->
        @if(!$budgets->isEmpty())
        <div class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl mt-6 shadow-sm">
            <div class="flex-1 flex justify-between sm:hidden">
                <button 
                    wire:click="previousPage"
                    @disabled($budgets->onFirstPage())
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                    Previous
                </button>
                <button 
                    wire:click="nextPage"
                    @disabled(!$budgets->hasMorePages())
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
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
                            class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
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
                                        class="{{ $budgets->currentPage() == $page ? 'z-10 bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900/30 dark:border-blue-500 dark:text-blue-400' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600' }} relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-colors"
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
                            class="relative inline-flex items-center px-3 py-2 rounded-r-lg border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
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
        @endif
       <!-- View Modal -->
<x-modals wire:model="showViewModal" title="Budget Details" max-width="2xl">
    <x-card title="Budget Details" rounded="lg" shadow="none" class="border-0">
        @if($selectedBudget)
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-full dark:bg-blue-900/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $selectedBudget->budget_name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $selectedBudget->description }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 dark:bg-gray-800/50 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h4 class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300 mb-3">Financial Details</h4>
                        <dl class="space-y-4">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Estimated Amount</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ $selectedBudget->estimated_amount ? '$'.number_format($selectedBudget->estimated_amount, 2) : 'Not specified' }}
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Status</dt>
                                <dd>
                                    @if($selectedBudget->approved)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200">
                                            Approved
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200">
                                            Rejected
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-800/50 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                        <h4 class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300 mb-3">Project Association</h4>
                        <dl class="space-y-4">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Project</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ $currentProject->project_name }}
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Associated With</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    @if($selectedBudget->phase)
                                        <span class="flex items-center">
                                            <span class="inline-block w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                            Phase: {{ $selectedBudget->phase->name }}
                                        </span>
                                    @elseif($selectedBudget->milestone)
                                        <span class="flex items-center">
                                            <span class="inline-block w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                                            Milestone: {{ $selectedBudget->milestone->name }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">Not assigned</span>
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
                <x-button wire:click="$set('showViewModal', false)" label="Close" flat class="px-6 py-2.5 text-sm font-medium">Close</x-button>
            </div>
        </x-slot>
    </x-card>
</x-modals>

<!-- Edit Modal -->
<x-modals wire:model="showEditModal" title="Edit Budget" max-width="lg">
    <x-card title="Edit Budget" rounded="lg" shadow="none" class="border-0">
        @if($selectedBudget)
        <div class="space-y-5">
            <div class="relative">
                <x-input 
                    wire:model="selectedBudget.budget_name" 
                    label="Budget Name" 
                    placeholder="Enter budget name"
                    class="w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <div class="absolute top-0 right-3 h-full flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            
            <div>
                <x-textarea 
                    wire:model="selectedBudget.description" 
                    label="Description" 
                    placeholder="Enter a detailed description of this budget"
                    rows="4"
                    class="w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
            </div>
            
            <div class="relative">
                <x-input 
                    wire:model="selectedBudget.estimated_amount" 
                    label="Estimated Amount" 
                    placeholder="0.00" 
                    type="number" 
                    step="0.01"
                    class="w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <div class="absolute top-0 right-3 h-full flex items-center text-gray-400">
                    <span class="text-sm font-medium">$</span>
                </div>
            </div>
        </div>
        @endif

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button wire:click="$set('showEditModal', false)" label="Cancel" flat class="px-5 py-2.5 text-sm font-medium">Cancel</x-button>
                <x-button wire:click="updateBudget" label="Save Changes" spinner="updateBudget" primary class="px-5 py-2.5 text-sm font-medium bg-blue-600 hover:bg-blue-700">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update
                    </span>
                </x-button>
            </div>
        </x-slot>
    </x-card>
</x-modals>
        <!-- Create Modal -->
        <x-dialog-modal wire:model="showCreateBudgetModal" class="max-w-2xl">
            <x-slot name="title">
                <h3 class="text-lg font-medium text-gray-900">Create New Budget</h3>
            </x-slot>
            
            <x-slot name="content">
                <x-form-section>
                    <x-slot name="submit">saveBudget</x-slot>
                    <x-slot name="title">New Budget</x-slot>
                    <x-slot name="description">
                        <p class="text-sm text-gray-600">
                            Complete the form below to create a new budget for your project.
                            All fields marked with an asterisk (*) are required.
                        </p>
                    </x-slot>
                    
                    <x-slot name="form">
            
<!-- Select Phase -->
<div class="col-span-6 sm:col-span-6">
    <x-label for="budgetPhaseId" value="Phase" class="font-medium text-gray-700" />
    <div class="relative">
        <select id="budgetPhaseId"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            wire:model.defer="budgetPhaseId">
            <option value="">Select Phase (project)</option>
            @foreach ($allPhases  as $phase)
                <option value="{{ $phase->id }}">{{ $phase->name }} ({{ $phase->project->project_name }})</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
    <x-input-error for="budgetPhaseId" class="mt-2 text-sm text-red-600" />
</div>
                        
                        <!-- Budget Name -->
                        <div class="col-span-6 sm:col-span-6 mt-4">
                            <x-label for="budgetName" value="Budget Name" class="font-medium text-gray-700" />
                            <x-input id="budgetName" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                wire:model.defer="budgetName" required placeholder="Enter budget name" />
                            <x-input-error for="budgetName" class="mt-2 text-sm text-red-600" />
                        </div>
                        
                        <!-- Budget Description -->
                        <div class="col-span-6 sm:col-span-6 mt-4">
                            <x-label for="budgetDescription" value="Description" class="font-medium text-gray-700" />
                            <textarea id="budgetDescription" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                wire:model.defer="budgetDescription" 
                                rows="4"
                                placeholder="Provide a brief description of this budget"></textarea>
                            <x-input-error for="budgetDescription" class="mt-2 text-sm text-red-600" />
                        </div>
                    </x-slot>
                </x-form-section>
            </x-slot>
            
            <x-slot name="footer">
                <div class="flex justify-end space-x-3">
                    <x-button type="button" class="bg-white text-gray-700 border-gray-300 hover:bg-gray-50" wire:click="closeNewBudgetModal">
                        Cancel
                    </x-button>
                    <x-button type="button" class="bg-indigo-600 text-white hover:bg-indigo-700" wire:click="saveBudget">
                        <span wire:loading.remove wire:target="saveBudget">Save Budget</span>
                        <span wire:loading wire:target="saveBudget" class="inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>


<!-- Delete Confirmation Modal -->
<x-modals wire:model="showDeleteModal" max-width="md" title="Delete Budget">
    <x-card title="Delete Budget" rounded="lg" shadow="none" class="border-0">
        <div class="flex flex-col items-center text-center py-4">
            <div class="h-20 w-20 rounded-full bg-red-100 flex items-center justify-center dark:bg-red-900/30 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Are you sure?</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 max-w-md">
                This will permanently delete the budget and all associated data. This action cannot be undone.
            </p>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button wire:click="$set('showDeleteModal', false)" label="Cancel" flat class="px-5 py-2.5 text-sm font-medium">Cancel</x-button>
                <x-button wire:click="deleteBudget" label="Delete Budget" spinner="deleteBudget" negative class="px-5 py-2.5 text-sm font-medium bg-red-600 hover:bg-red-700">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </span>
                </x-button>
            </div>
        </x-slot>
    </x-card>
</x-modals>
    </section>
    @endif
</div>