{{-- Top card with project details --}}
<div class="p-6">
    <div class="px-8 py-8 w-full bg-white border border-gray-200 rounded-xl shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-all duration-300 hover:shadow-lg">
        <!-- Project Title with improved styling -->
        <div class="flex flex-wrap justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-6">
            <h5 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                <span class="mr-3">Project:</span> 
                <span class="text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-lg">{{ $project->project_name }}</span>
            </h5>
        </div>
    
        <!-- Project Details with improved card design -->
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                    </svg>
                    Project Code:
                </h5>
                <p class="mt-2 text-gray-600 dark:text-gray-400 font-medium"> #0077{{ $project->id }}</p>
            </div>
    
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Location:
                </h5>
                <p class="mt-2 text-gray-600 dark:text-gray-400 font-medium">{{ $project->location }}</p>
            </div>
    
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Type:
                </h5>
                <p class="mt-2 text-gray-600 dark:text-gray-400 font-medium">{{ $project->project_type?->name }}</p>
            </div>
    
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    Status:
                </h5>
                <div class="mt-2">
                    <x-status :status="$project->project_status" class="text-sm font-medium py-1 px-3" />
                </div>
            </div>
    
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Start Date:
                </h5>
                <p class="mt-2 text-gray-600 dark:text-gray-400 font-medium">{{ $project->start_date }}</p>
            </div>
    
            <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-xl shadow-md border border-gray-100 dark:border-gray-800 transition-all duration-300 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    End Date:
                </h5>
                <p class="mt-2 text-gray-600 dark:text-gray-400 font-medium">{{ $project->end_date }}</p>
            </div>
        </div>
    
        <hr class="my-8 border-gray-200 dark:border-gray-700">
    
        <!-- Tab Navigation with enhanced styling -->
        <div class="flex flex-wrap gap-4">
            @php
                $tabs = [
                    // 'ProfileTab' => [
                    //     'name' => 'Profile',
                    //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>'
                    // ],
                    'PlansTab' => [
                        'name' => 'Phase & Milestones',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>'
                    ],
                    // 'BudjetTab' => [
                    //     'name' => 'Budget',
                    //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                    // ],
                    'ProjectProgressTab' => [
                        'name' => 'Project Progress',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>'
                    ],
                ];
            @endphp
    
            @foreach ($tabs as $key => $tab)
                <div wire:click="$set('activeTab', '{{ $key }}')"
                    class="cursor-pointer px-5 py-3 text-base font-semibold rounded-lg transition-all duration-300 flex items-center 
                    {{ $activeTab == $key ? 'bg-blue-600 text-white shadow-md scale-105' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-blue-500' }}">
                    {!! $tab['icon'] !!}
                    {{ $tab['name'] }}
                </div>
            @endforeach
        </div>
    </div>
    

    {{-- Main page data based on activeTab with enhanced styling --}}
    <div class="mt-6 p-8 w-full bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 transition-all duration-300">
        @if ($activeTab == 'ProfileTab')
        {{-- <div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 border-l-4 border-blue-500 pl-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Project Profile
            </h2>
            
            <!-- Project Description with improved styling -->
            <div class="mb-8 p-8 bg-gray-50 rounded-xl shadow-md dark:bg-gray-700 border border-gray-100 dark:border-gray-600">
                <h5 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Project Description
                </h5>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                    {{ $project->project_description }}
                </p>
            </div>
    
            <!-- Additional Information with improved card design -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contractors Details -->
                <div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-md dark:from-gray-800 dark:to-blue-900/20 border border-blue-100 dark:border-blue-900">
                    <h5 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Contractors
                    </h5>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">Add contractors details here.</p>
                    <button class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 flex items-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Contractors
                    </button>
                </div>
    
                <!-- Edit Project Information -->
                <div class="p-8 bg-gradient-to-br from-green-50 to-teal-50 rounded-xl shadow-md dark:from-gray-800 dark:to-green-900/20 border border-green-100 dark:border-green-900">
                    <h5 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Project
                    </h5>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">Update project details here.</p>
                    <button class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 flex items-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Project
                    </button>
                </div>
            </div>
        </div> --}}
    
        @elseif ($activeTab == 'PlansTab')
        <div class="p-6">
            <x-section-title class="mb-6">
                <x-slot name="title">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Phases & Milestones
                    </span>
                </x-slot>
                <x-slot name="description">
                    <span class="text-gray-600 dark:text-gray-400 text-lg">Manage Project Phases & Milestones</span>
                </x-slot>
                <x-slot name="aside">
                    <div class="flex gap-4 mb-4">
                        <button wire:click="openPhaseModal" class="px-5 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 shadow-md flex items-center font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Phase
                        </button>
                        <button wire:click="openMilestoneModal" class="px-5 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 shadow-md flex items-center font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Milestone
                        </button>
                    </div>
                </x-slot>
            </x-section-title>

            <!-- Forms Modals (kept the same as original) -->
            <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Phase Modal -->
                <x-dialog-modal wire:model="showPhaseForm">
                    <x-slot name="title">New Phase</x-slot>
                    <x-slot name="content">
                        <!-- Phase Form Content -->
                        {{-- <form wire:submit.prevent="createPhase"> --}}
                            <div class="mb-4">
                                <label for="phase_name" class="block text-sm font-medium text-gray-700">Phase Name <span class="text-red-500">*</span></label>
                                <input type="text" wire:model="phase_name" id="phase_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Phase Name">
                                <x-input-error for="phase_name" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                                <input type="date" wire:model="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <x-input-error for="start_date" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                                <input type="date" wire:model="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <x-input-error for="end_date" class="mt-2" />
                            </div>
                        {{-- </form> --}}
                    </x-slot>
                    <x-slot name="footer">
                        <button wire:click="closePhaseModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
                        <button wire:click="createPhase" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save Phase</button>
                    </x-slot>
                </x-dialog-modal>

                <!-- Milestone Modal -->
                <x-dialog-modal wire:model="showMilestoneForm">
                    <x-slot name="title">New Milestone</x-slot>
                    <x-slot name="content">
                        <!-- Milestone Form Content -->
                        <div class="mb-4">
                            <label for="milestone_name" class="block text-sm font-medium text-gray-700">Milestone Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="milestone_name" id="milestone_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Milestone Name">
                            <x-input-error for="milestone_name" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <label for="milestoneType" class="block text-sm font-medium text-gray-700">Add Milestone To: <span class="text-red-500">*</span></label>
                            <select wire:model.live="milestoneType" id="milestoneType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="project">Project</option>
                                <option value="phase">Phase</option>
                            </select>
                            <x-input-error for="milestoneType" class="mt-2" />
                        </div>
                        
                        @if ($milestoneType === 'phase')
                        <div class="mb-4">
                            <label for="phase_id" class="block text-sm font-medium text-gray-700">Select Phase: <span class="text-red-500">*</span></label>
                            <select wire:model="phase_id" id="phase_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Phase</option>
                                @foreach ($project->phases as $phase)
                                    <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="phase_id" class="mt-2" />
                        </div>
                        @endif
                    </x-slot>
                    <x-slot name="footer">
                        <button wire:click="closeMilestoneModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
                        <button wire:click="createMilestone" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Save Milestone</button>
                    </x-slot>
                </x-dialog-modal>
            </div>

      <!-- Enhanced Timeline View -->
  <div class="mt-8 space-y-10">
    <!-- Project Header -->
    <div class="relative pl-10 pb-8 border-l-3 border-blue-300 dark:border-blue-700">
        <div class="absolute -left-2.5 top-0 w-5 h-5 bg-blue-600 rounded-full border-4 border-white dark:border-gray-900 shadow-md"></div>
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-lg transition-all hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-start flex-wrap md:flex-nowrap gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        {{ $project->project_name }}
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">Project</span>
                    </h3>
                    <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                        {{ $project->project_description }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center justify-end gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }} - 
                        {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
                    </span>
                    <div class="mt-2">
                        <x-status :status="$project->project_status" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Phases List -->
        @foreach($project->phases as $phase)
            <div class="relative pl-10 mt-8 border-l-3 border-purple-300 dark:border-purple-700">
                <div class="absolute -left-2.5 top-0 w-5 h-5 bg-purple-600 rounded-full border-4 border-white dark:border-gray-900 shadow-md"></div>
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-lg transition-all hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-start flex-wrap md:flex-nowrap gap-4">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                {{ $phase->name }}
                                <span class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-purple-900 dark:text-purple-300">Phase</span>
                            </h4>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                                {{ $phase->description ?? 'No description available' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center justify-end gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($phase->start_date)->format('M d, Y') }} - 
                                {{ \Carbon\Carbon::parse($phase->end_date)->format('M d, Y') }}
                            </span>
                            <div class="mt-2">
                                <span class="text-xs font-medium px-3 py-1 rounded-full 
                                    {{ $phase->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                       ($phase->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                       'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                    {{ ucfirst(str_replace('_', ' ', $phase->status)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Milestones for this Phase -->
                    @if($phase->milestones->count() > 0)
                        <div class="mt-6 space-y-4">
                            @foreach($phase->milestones as $milestone)
                                <div class="relative pl-8 pt-4">
                                    <div class="absolute left-0 top-6 w-3 h-3 bg-green-500 rounded-full ring-2 ring-green-200 dark:ring-green-800"></div>
                                    <div class="p-5 bg-gray-50 border border-gray-200 rounded-lg transition-all hover:shadow-md dark:bg-gray-700 dark:border-gray-600">
                                        <div class="flex justify-between items-center flex-wrap md:flex-nowrap gap-2">
                                            <h5 class="text-lg font-medium text-gray-800 dark:text-gray-200 flex items-center gap-2">
                                                {{ $milestone->name }}
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-green-900 dark:text-green-300">Milestone</span>
                                            </h5>
                                            <div class="flex items-center gap-3">
                                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    Due: {{ \Carbon\Carbon::parse($milestone->due_date)->format('M d, Y') }}
                                                </span>
                                                <span class="text-xs font-medium px-2.5 py-1 rounded-full 
                                                    {{ $milestone->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                       ($milestone->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                       'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $milestone->description ?? 'No description available' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg text-center text-sm text-gray-500 dark:bg-gray-700 dark:text-gray-400 border border-dashed border-gray-300 dark:border-gray-600">
                            No milestones added to this phase yet.
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Project-level Milestones (not associated with any phase) -->
        @if($project->milestones->whereNull('phase_id')->count() > 0)
            <div class="relative pl-10 mt-8 border-l-3 border-green-300 dark:border-green-700">
                <div class="absolute -left-2.5 top-0 w-5 h-5 bg-green-600 rounded-full border-4 border-white dark:border-gray-900 shadow-md"></div>
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-lg transition-all hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-5">
                        Project Milestones
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-green-900 dark:text-green-300">Standalone</span>
                    </h4>

                    <div class="space-y-4">
                        @foreach($project->milestones->whereNull('phase_id') as $milestone)
                            <div class="relative pl-8 pt-4">
                                <div class="absolute left-0 top-6 w-3 h-3 bg-green-500 rounded-full ring-2 ring-green-200 dark:ring-green-800"></div>
                                <div class="p-5 bg-gray-50 border border-gray-200 rounded-lg transition-all hover:shadow-md dark:bg-gray-700 dark:border-gray-600">
                                    <div class="flex justify-between items-center flex-wrap md:flex-nowrap gap-2">
                                        <h5 class="text-lg font-medium text-gray-800 dark:text-gray-200 flex items-center gap-2">
                                            {{ $milestone->name }}
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-green-900 dark:text-green-300">Milestone</span>
                                        </h5>
                                        <div class="flex items-center gap-3">
                                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Due: {{ \Carbon\Carbon::parse($milestone->due_date)->format('M d, Y') }}
                                            </span>
                                            <span class="text-xs font-medium px-2.5 py-1 rounded-full 
                                                {{ $milestone->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                   ($milestone->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                   'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                                {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $milestone->description ?? 'No description available' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</div>
{{-- @endif --}}
{{-- @elseif ($activeTab == 'BudjetTab')
<div class="mt-4 p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
<h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    Budget Management
</h2>

<!-- New Budget Button -->
<button wire:click="$set('newBudgetModal_isOpen', true)" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 mb-6 flex items-center gap-2 font-medium shadow-md hover:shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
    New Budget
</button>
<x-dialog-modal wire:model="newBudgetModal_isOpen">
    <x-slot name="title"></x-slot>
    <x-slot name="content">
        <x-form-section>
            <x-slot name="submit">saveBudget</x-slot>
            <x-slot name="title">New Budget</x-slot>
            <x-slot name="description">Fill in the details for the new budget.</x-slot>

            <x-slot name="form">
                <!-- Select Phase -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="budgetPhaseId" value="Phase" /> 
                    <select id="budgetPhaseId"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        wire:model.defer="budgetPhaseId">
                        <option value="">Select Phase</option>
                        @foreach ($project->phases as $phase)
                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="budgetPhaseId" class="mt-2" />
                </div>

                <!-- Budget Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="budgetName" value="Budget Name / Title" />
                    <x-input id="budgetName" type="text" class="mt-1 block w-full"
                        wire:model.defer="budgetName" required />
                    <x-input-error for="budgetName" class="mt-2" />
                </div>

                <!-- Budget Description -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="budgetDescription" value="Description" />
                    <textarea id="budgetDescription" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        wire:model.defer="budgetDescription" rows="3"></textarea>
                    <x-input-error for="budgetDescription" class="mt-2" />
                </div>
            </x-slot>
        </x-form-section>
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="closeNewBudgetModal">Close</x-button>
        <x-button class="ml-2" wire:click="saveBudget">Save Budget</x-button>
    </x-slot>
</x-dialog-modal>

<!-- Budgets Table -->
<div class="overflow-x-auto rounded-lg shadow">
    <table class="min-w-full bg-white dark:bg-gray-700 border dark:border-gray-600">
        <thead class="bg-gray-100 dark:bg-gray-600">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-white">Budget Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-white">Phase</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-white">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
            @foreach ($budgets as $budget)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-300">
                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $budget->budget_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $budget->phase ? $budget->phase->name : 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('budgets.details', $budget) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Details
                        </a>
                        <button wire:click="approveBudget({{ $budget->id }})" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 ml-2 inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Approve
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div> --}}
@elseif ($activeTab == 'ProjectProgressTab')
<div>
<div class="p-6 bg-white rounded-xl shadow-lg dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Project Progress
    </h2>

    <div class="space-y-6">
        @foreach ($milestones as $milestone)
            <!-- Milestone Progress Card -->
            <div class="p-5 border border-gray-200 rounded-xl bg-gray-50 shadow-sm transition-all hover:shadow-md dark:bg-gray-700 dark:border-gray-600">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ $milestone['name'] }}</h3>
                    <div class="py-1 px-3 bg-blue-100 text-blue-700 text-sm font-medium rounded-full dark:bg-blue-800/40 dark:text-blue-400">
                        {{ $milestone['progress'] }}% Complete
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="relative pt-1">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full 
                                {{ $milestone['progress'] < 30 ? 'text-red-600 bg-red-200 dark:bg-red-900/30 dark:text-red-400' : 
                                ($milestone['progress'] < 70 ? 'text-yellow-600 bg-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                                'text-green-600 bg-green-200 dark:bg-green-900/30 dark:text-green-400') }}">
                                {{ $milestone['progress'] < 30 ? 'Starting' : ($milestone['progress'] < 70 ? 'In Progress' : 'Near Complete') }}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-blue-600 dark:text-blue-400">
                                Due: {{ \Carbon\Carbon::parse($milestone['due_date'])->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-gray-200 dark:bg-gray-600">
                        <div style="width: {{ $milestone['progress'] }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                            {{ $milestone['progress'] < 30 ? 'bg-red-500' : 
                            ($milestone['progress'] < 70 ? 'bg-yellow-500' : 
                            'bg-green-500') }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Milestone Progress Card -->
        @endforeach

        <!-- Overall Project Progress -->
        <div class="mt-10 p-6 border-2 border-blue-200 rounded-xl bg-blue-50 shadow-lg dark:bg-blue-900/20 dark:border-blue-800">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Overall Project Progress
            </h3>
            
            <div class="mb-2 flex justify-between items-center">
                <div class="font-medium text-gray-700 dark:text-gray-300">Project Completion</div>
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $overallProgress }}%</div>
            </div>
            
            <div class="relative pt-1">
                <div class="overflow-hidden h-6 mb-4 text-xs flex rounded-full bg-gray-200 dark:bg-gray-600">
                    <div style="width: {{ $overallProgress }}%" class="shadow-md flex flex-col text-center whitespace-nowrap text-white justify-center rounded-full bg-gradient-to-r from-blue-500 to-green-500 transition-all duration-500">
                        <span class="font-bold text-xs">{{ $overallProgress }}%</span>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-400 mt-2">
                <div>Started</div>
                <div>In Progress</div>
                <div>Complete</div>
            </div>
            <div class="grid grid-cols-3 gap-2 mt-4">
                <div class="text-center p-3 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    {{-- <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ count(array_filter($milestones, function($m) { return $m['progress'] > 0; })) }}</div> --}}
                    <div class="text-xs text-gray-500 dark:text-gray-400">Tasks Started</div>
                </div>
                <div class="text-center p-3 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    {{-- <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ count(array_filter($milestones, function($m) { return $m['progress'] > 0 && $m['progress'] < 100; })) }}</div> --}}
                    <div class="text-xs text-gray-500 dark:text-gray-400">In Progress</div>
                </div>
                <div class="text-center p-3 bg-white rounded-lg border border-gray-200 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    {{-- <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ count(array_filter($milestones, function($m) { return $m['progress'] == 100; })) }}</div> --}}
                    <div class="text-xs text-gray-500 dark:text-gray-400">Completed</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
</div>
</div>