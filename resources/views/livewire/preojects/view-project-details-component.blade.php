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
        <x-section-title>
            <x-slot name="title">Phases & Milestones</x-slot>
            <x-slot name="description">Manage Project Phases & Milestones</x-slot>
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

        <!-- Forms Modals (same as before) -->
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
    {{-- input error --}}
    <x-input-error for="phase_name" class="mt-2" />
</div>

<!-- Start Date Input -->
<div class="mb-4">
    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
    <input type="date" wire:model="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    <x-input-error for="start_date" class="mt-2" />
</div>

<!-- End Date Input -->
<div class="mb-4">
    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
    <input type="date" wire:model="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    <x-input-error for="end_date" class="mt-2" />
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
<x-input-error for="milestone_name" class="mt-2" />
</div>

<!-- Milestone Type Selection -->
<div class="mb-4">
<label for="milestoneType" class="block text-sm font-medium text-gray-700">Add Milestone To: <span class="text-red-500">*</span></label>
<select wire:model.live="milestoneType" id="milestoneType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    <option value="project">Project</option>
    <option value="phase">Phase</option>
</select>
<x-input-error for="milestoneType" class="mt-2" />
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
    <x-input-error for="phase_id" class="mt-2" />
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

        <!-- Enhanced Timeline View -->
        <div class="mt-8 space-y-8">
            <!-- Project Header -->
            <div class="relative pl-8 pb-8 border-l-2 border-blue-200 dark:border-blue-800">
                <div class="absolute -left-1.5 top-0 w-3 h-3 bg-blue-600 rounded-full border-2 border-white dark:border-gray-900"></div>
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $project->project_name }}
                                <span class="ml-2 bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Project</span>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ $project->project_description }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }} - 
                                {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
                            </span>
                            <div class="mt-1">
                                <x-status :status="$project->project_status" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phases List -->
                @foreach($project->phases as $phase)
                    <div class="relative pl-8 mt-6 border-l-2 border-purple-200 dark:border-purple-800">
                        <div class="absolute -left-1.5 top-0 w-3 h-3 bg-purple-600 rounded-full border-2 border-white dark:border-gray-900"></div>
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $phase->name }}
                                        <span class="ml-2 bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Phase</span>
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $phase->description ?? 'No description available' }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($phase->start_date)->format('M d, Y') }} - 
                                        {{ \Carbon\Carbon::parse($phase->end_date)->format('M d, Y') }}
                                    </span>
                                    <div class="mt-1">
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded 
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
                                <div class="mt-4 space-y-3">
                                    @foreach($phase->milestones as $milestone)
                                        <div class="relative pl-6 pt-4">
                                            <div class="absolute left-0 top-6 w-2 h-2 bg-green-500 rounded-full"></div>
                                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-600 dark:border-gray-500">
                                                <div class="flex justify-between items-center">
                                                    <h5 class="text-md font-medium text-gray-800 dark:text-gray-200">
                                                        {{ $milestone->name }}
                                                        <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Milestone</span>
                                                    </h5>
                                                    <div class="flex items-center">
                                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 mr-3">
                                                            Due: {{ \Carbon\Carbon::parse($milestone->due_date)->format('M d, Y') }}
                                                        </span>
                                                        <span class="text-xs font-medium px-2 py-0.5 rounded 
                                                            {{ $milestone->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                               ($milestone->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                               'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                                            {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $milestone->description ?? 'No description available' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-4 p-3 bg-gray-50 rounded-lg text-center text-sm text-gray-500 dark:bg-gray-600 dark:text-gray-400">
                                    No milestones added to this phase yet.
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Project-level Milestones (not associated with any phase) -->
                @if($project->milestones->whereNull('phase_id')->count() > 0)
                    <div class="relative pl-8 mt-6 border-l-2 border-green-200 dark:border-green-800">
                        <div class="absolute -left-1.5 top-0 w-3 h-3 bg-green-600 rounded-full border-2 border-white dark:border-gray-900"></div>
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Project Milestones
                                <span class="ml-2 bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Standalone</span>
                            </h4>

                            <div class="space-y-3">
                                @foreach($project->milestones->whereNull('phase_id') as $milestone)
                                    <div class="relative pl-6 pt-4">
                                        <div class="absolute left-0 top-6 w-2 h-2 bg-green-500 rounded-full"></div>
                                        <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-600 dark:border-gray-500">
                                            <div class="flex justify-between items-center">
                                                <h5 class="text-md font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $milestone->name }}
                                                    <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Milestone</span>
                                                </h5>
                                                <div class="flex items-center">
                                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 mr-3">
                                                        Due: {{ \Carbon\Carbon::parse($milestone->due_date)->format('M d, Y') }}
                                                    </span>
                                                    <span class="text-xs font-medium px-2 py-0.5 rounded 
                                                        {{ $milestone->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                           ($milestone->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                           'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
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
        
                    <div class="space-y-3">
                        @foreach ($milestones as $milestone)
                            <!-- Milestone Progress -->
                            <div>
                                <div class="inline-block mb-2 ms-[calc({{ $milestone['progress'] }}%-20px)] py-0.5 px-1.5 bg-blue-50 border border-blue-200 text-xs font-medium text-blue-600 rounded-lg dark:bg-blue-800/30 dark:border-blue-800 dark:text-blue-500">
                                    {{ $milestone['progress'] }}%
                                </div>
                                <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar" 
                                     aria-valuenow="{{ $milestone['progress'] }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500" 
                                         style="width: {{ $milestone['progress'] }}%">
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $milestone['name'] }} - {{ ucfirst($milestone['progress']) }}
                                    <br>
                                    Due Date: {{ \Carbon\Carbon::parse($milestone['due_date'])->format('M d, Y') }}
                                </div>
                            </div>
                            <!-- End Milestone Progress -->
                        @endforeach
        
                        <!-- Overall Project Progress -->
                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Overall Project Progress</h3>
                            <div>
                                <div class="inline-block mb-2 ms-[calc({{ $overallProgress }}%-20px)] py-0.5 px-1.5 bg-blue-50 border border-blue-200 text-xs font-medium text-blue-600 rounded-lg dark:bg-blue-800/30 dark:border-blue-800 dark:text-blue-500">
                                    {{ $overallProgress }}%
                                </div>
                                <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar" 
                                     aria-valuenow="{{ $overallProgress }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="flex flex-col justify-center rounded-full overflow-hidden bg-gradient-to-r from-blue-500 to-green-500 text-xs text-white text-center whitespace-nowrap transition duration-500" 
                                         style="width: {{ $overallProgress }}%">
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Overall Progress: {{ $overallProgress }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
    </div>

</div>
