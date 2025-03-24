<div class="p-4">
    {{-- Top card with project details --}}
    <div class="px-6 py-6 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <!-- Project Title -->
        <div class="flex flex-wrap justify-between items-center border-b pb-4">
            <h5 class="text-3xl font-bold text-gray-900 dark:text-white">
                Project Name: <span class="text-blue-600 dark:text-blue-400">{{ $project->project_name }}</span>
            </h5>
        </div>
    
        <!-- Project Details -->
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Project Code:</h5>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->project_code }}</p>
            </div>
    
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Location:</h5>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->location }}</p>
            </div>
    
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Type:</h5>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->project_type?->name }}</p>
            </div>
    
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Status:</h5>
                <p class="text-gray-600 dark:text-gray-400"><x-status :status="$project->project_status" /></p>
            </div>
    
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Start Date:</h5>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->start_date }}</p>
            </div>
    
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">End Date:</h5>
                <p class="text-gray-600 dark:text-gray-400">{{ $project->end_date }}</p>
            </div>
        </div>
    
        <hr class="my-6 border-gray-300 dark:border-gray-600">
    
        <!-- Tab Navigation -->
        <div class="flex flex-wrap gap-3">
            @php
                $tabs = [
                    'ProfileTab' => 'Profile',
                    'PlansTab' => 'Phase & Milestones',
                    'BudjetTab' => 'Budget',
                    'ProjectProgressTab' => 'Project Progress',
                ];
            @endphp
    
            @foreach ($tabs as $key => $label)
                <div wire:click="$set('activeTab', '{{ $key }}')"
                    class="cursor-pointer px-5 py-2 text-lg font-semibold rounded-lg transition 
                    {{ $activeTab == $key ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} 
                    hover:bg-blue-500 hover:text-white dark:hover:bg-blue-500">
                    {{ $label }}
                </div>
            @endforeach
        </div>
    </div>
    

    {{-- Main page data based on activeTab --}}
    <div
        class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if ($activeTab == 'ProfileTab')
        <div class="mt-4 p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Project Profile</h2>
            
            <!-- Project Description -->
            <div class="mb-6 p-6 bg-gray-50 rounded-lg dark:bg-gray-700">
                <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Project Description</h5>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ $project->project_description }}
                </p>
            </div>
    
            <!-- Additional Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Contractors Details -->
                <div class="p-6 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Contractors</h5>
                    <p class="text-gray-700 dark:text-gray-300">Add contractors details here.</p>
                    <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                        Edit Contractors
                    </button>
                </div>
    
                <!-- Edit Project Information -->
                <div class="p-6 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <h5 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Edit Project</h5>
                    <p class="text-gray-700 dark:text-gray-300">Update project details here.</p>
                    <button class="mt-4 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                        Edit Project
                    </button>
                </div>
            </div>
        </div>
    
        @elseif ($activeTab == 'PlansTab')
            <div class="p-6">
                <div>
                    {{-- <!-- Header Section -->
                    <div class="text-lg font-semibold mb-4">Phase & Milestones</div>

                    <!-- Buttons to Show Forms -->
                    <div class="flex gap-4 mb-4">
                        <button wire:click="$toggle('showPhaseForm')" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Add Phase
                        </button>
                        <button wire:click="$toggle('showMilestoneForm')"
                            class="px-4 py-2 bg-green-500 text-white rounded">
                            Add Milestone
                        </button>
                    </div> --}}
                    <x-section-title>
                        <x-slot name="title">Phases & Milestones</x-slot>
                        <x-slot name="description">Mange Project Phases & Milestones</x-slot>
                        <x-slot name="aside">
                            <div class="flex gap-4 mb-4">
                                <button wire:click="openPhaseModal" class="px-4 py-2 bg-blue-500 text-white rounded">
                                    Add New Phase
                                </button>
                                <button wire:click="openMilestoneModal" class="px-4 py-2 bg-green-500 text-white rounded">
                                    Add New Milestone
                                </button>
                            </div>
                        </x-slot>
                    </x-section-title>

                    <!-- Forms (Hidden Initially) -->
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Add Phase Form -->
                       <!-- Phase Modal -->
<x-dialog-modal wire:model="showPhaseForm">
    <x-slot name="title">New Phase</x-slot>
    <x-slot name="content">
        <!-- Form Starts Here -->
        <form wire:submit.prevent="createPhase">
            <!-- Phase Name Input -->
            <div class="mb-4">
                <label for="phase_name" class="block text-sm font-medium text-gray-700">Phase Name <span class="text-red-500">*</span></label>
                <input type="text" wire:model="phase_name" id="phase_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Phase Name">
            </div>

            <!-- Start Date Input -->
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                <input type="date" wire:model="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- End Date Input -->
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                <input type="date" wire:model="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </form>
        <!-- Form Ends Here -->
    </x-slot>
    <x-slot name="footer">
        <!-- Cancel Button -->
        <button wire:click="closePhaseModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
        <!-- Save Button -->
        <button wire:click="createPhase" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save Phase</button>
    </x-slot>
</x-dialog-modal>

                        <!-- Add Milestone Form -->
                       <!-- Milestone Modal -->
<x-dialog-modal wire:model="showMilestoneForm">
    <x-slot name="title">New Milestone</x-slot>
    <x-slot name="content">
        <!-- Milestone Name Input -->
        <div class="mb-4">
            <label for="milestone_name" class="block text-sm font-medium text-gray-700">Milestone Name <span class="text-red-500">*</span></label>
            <input type="text" wire:model="milestone_name" id="milestone_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Milestone Name">
        </div>

        <!-- Milestone Type Selection -->
        <div class="mb-4">
            <label for="milestoneType" class="block text-sm font-medium text-gray-700">Add Milestone To: <span class="text-red-500">*</span></label>
            <select wire:model.live="milestoneType" id="milestoneType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="project">Project</option>
                <option value="phase">Phase</option>
            </select>
        </div>

        <!-- Phase Selection (Conditional) -->
        @if ($milestoneType === 'phase')
            <div class="mb-4">
                <label for="phase_id" class="block text-sm font-medium text-gray-700">Select Phase: <span class="text-red-500">*</span></label>
                <select wire:model="phase_id" id="phase_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Select Phase</option>
                    @foreach ($project->phases as $phase)
                        <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <!-- Cancel Button -->
        <button wire:click="closeMilestoneModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
        <!-- Save Button -->
        <button wire:click="createMilestone" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Save Milestone</button>
    </x-slot>
</x-dialog-modal>
                    </div>

                    <ol class="relative border-s border-gray-200 dark:border-gray-700">
                        <!-- Project -->
                        <li class="mb-10 ms-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $project->project_name }}
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-3">Project</span>
                            </h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                Start: {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }} - End: {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
                            </time>
                        </li>
                    
                        <!-- Phases and Milestones -->
                        @foreach($timelineItems as $item)
                        @if($item['type'] === 'phase')
                            <!-- Phase -->
                            <li class="mb-10 ms-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $item['name'] }}
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-3">Phase</span>
                                </h3>
                                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                    Start: {{ \Carbon\Carbon::parse($item['start_date'])->format('M d, Y') }} - Due: {{ \Carbon\Carbon::parse($item['due_date'])->format('M d, Y') }}
                                </time>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $item['details'] }} </p>
                            </li>
                    
                            <!-- Milestones under this phase -->
                            @foreach($item['milestones'] as $milestone)
                                <li class="mb-10 ms-12">
                                    <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-green-900">
                                        <svg class="w-2.5 h-2.5 text-green-800 dark:text-green-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $item['name'] }} -

                                        @if($item['type'] === 'milestone')
                                        {{ $item['name'] }}
                                        @endif

                                        {{ $milestone['name'] }}
                                        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 ms-3">Milestone</span>
                                    </h3>
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                        Due: {{ \Carbon\Carbon::parse($milestone['due_date'])->format('M d, Y') }}
                                    </time>
                                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $milestone['details'] }}</p>
                                </li>
                            @endforeach
                        @elseif($item['type'] === 'milestone' && empty($item['phase_id']))
                            <!-- Milestones under the project -->
                            <li class="mb-10 ms-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-green-900">
                                    <svg class="w-2.5 h-2.5 text-green-800 dark:text-green-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $item['name'] }}
                                    <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 ms-3">Milestone</span>
                                </h3>
                                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                    Due: {{ \Carbon\Carbon::parse($item['due_date'])->format('M d, Y') }}
                                </time>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $item['details'] }}</p>
                            </li>
                        @endif
                    @endforeach
                    </ol>
                    
                </div>

                @push('styles')
                    <style>
                        .timeline-container {
                            position: relative;
                            width: 100%;
                            padding: 20px;
                        }

                        .timeline-phase {
                            position: relative;
                            margin-bottom: 20px;
                            padding: 10px;
                            background-color: #f4f4f4;
                            border-radius: 5px;
                        }

                        .timeline-phase-title {
                            font-weight: bold;
                            font-size: 1.2rem;
                        }

                        .timeline-phase-bar {
                            height: 4px;
                            background-color: #4CAF50;
                            position: absolute;
                            top: 20px;
                        }

                        .timeline-milestone {
                            position: relative;
                            margin-top: 10px;
                        }

                        .timeline-milestone-title {
                            font-size: 1rem;
                            color: #333;
                        }

                        .timeline-milestone-dot {
                            position: absolute;
                            top: 15px;
                            width: 15px;
                            height: 15px;
                            background-color: #FF5722;
                            border-radius: 50%;
                            transform: translateX(-50%);
                        }

                        /* Independent Milestones Section */
                        .timeline-independent-milestones {
                            margin-top: 30px;
                            padding: 15px;
                            background-color: #fffbe6;
                            border-radius: 5px;
                        }

                        .timeline-independent-milestones h3 {
                            font-size: 1.2rem;
                            font-weight: bold;
                            margin-bottom: 10px;
                        }
                    </style>
                @endpush

            </div>
            @elseif ($activeTab == 'BudjetTab')
            <div class="mt-4 p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Budget Management</h2>
        
                <!-- New Budget Button -->
                <button wire:click="$set('newBudgetModal_isOpen', true)" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 mb-6">
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
                    <table class="min-w-full bg-white dark:bg-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-white">Budget Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-white">Phase</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($budgets as $budget)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-300">
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $budget->budget_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $budget->phase ? $budget->phase->name : 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('budgets.details', $budget) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">Details</a>
                                        <button wire:click="approveBudget({{ $budget->id }})" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 ml-2">Approve</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif ($activeTab == 'ProjectProgressTab')
            <div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Project Progress</h2>
        
                    <!-- Progress Bars for Phases -->
                    @foreach ($phases as $phase)
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $phase['name'] }}</h3>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ ucfirst($phase['phase_status']) }} ({{ $phase['progress'] }}%)
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                                <div
                                    class="h-3 rounded-full {{
                                        $phase['progress'] >= 100 ? 'bg-green-500' :
                                        ($phase['progress'] >= 50 ? 'bg-blue-500' :
                                        ($phase['progress'] >= 30 ? 'bg-yellow-500' : 'bg-red-500'))
                                    }}"
                                    style="width: {{ $phase['progress'] }}%; transition: width 0.5s ease;"
                                ></div>
                            </div>
                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Start Date: {{ \Carbon\Carbon::parse($phase['start_date'])->format('M d, Y') }} 
                                {{-- End Date: {{ \Carbon\Carbon::parse($phase['end_date'])->format('M d, Y') }} --}}
                            </div>
                        </div>
                    @endforeach
        
                    <!-- Overall Project Progress -->
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Overall Project Progress</h3>
                        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                            <div
                                class="h-4 rounded-full bg-gradient-to-r from-blue-500 to-green-500"
                                style="width: {{ $overallProgress }}%; transition: width 0.5s ease;">
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Overall Progress: {{ $overallProgress }}%
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

</div>
