<div class="p-4">
    {{-- Top card with project details --}}
    <div
        class="px-5 pt-5 pb-0 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Project Name:
                {{ $project->project_name }}</h5>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Code:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->project_code }}</p>
            </div>
            {{-- <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Description:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->project_description }}</p>
            </div> --}}
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Location:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->location }}</p>
            </div>
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Type:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->project_type?->name }}</p>
            </div>
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Status:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->project_status }}</p>
            </div>
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Start Date:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->start_date }}</p>
            </div>
            <div>
                <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">End Date:</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->end_date }}</p>
            </div>
        </div>

        <hr>
        {{-- Row with the nav tabs --}}
        <div class="flex space-x-4 mb-4">
            <div wire:click="$set('activeTab' , 'ProfileTab')"
                class="cursor-pointer py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 {{ $activeTab == 'ProfileTab' ? 'bg-gray-300 dark:bg-gray-600' : 'bg-gray-100 dark:bg-gray-900' }}">
                Profile
            </div>
            <div wire:click="$set('activeTab' , 'PlansTab')"
                class="cursor-pointer py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 {{ $activeTab == 'PlansTab' ? 'bg-gray-300 dark:bg-gray-600' : 'bg-gray-100 dark:bg-gray-900' }}">
                Phase & Milestones
            </div>
            <div wire:click="$set('activeTab' , 'BudjetTab')"
                class="cursor-pointer py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 {{ $activeTab == 'BudjetTab' ? 'bg-gray-300 dark:bg-gray-600' : 'bg-gray-100 dark:bg-gray-900' }}">
                Budget
            </div>
            <div wire:click="$set('activeTab' , 'ExpensesTab')"
                class="cursor-pointer py-2 px-4 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 {{ $activeTab == 'ExpensesTab' ? 'bg-gray-300 dark:bg-gray-600' : 'bg-gray-100 dark:bg-gray-900' }}">
                Expenses
            </div>
        </div>
    </div>

    {{-- Main page data based on activeTab --}}
    <div
        class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if ($activeTab == 'ProfileTab')
            <div>
                <!-- Profiles tab content -->
                Profiles tab component <br>
                ------------------------------ <br>
                <div class="mb-4">
                    <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">Project Description:</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $project->project_description }}</p>
                </div>
                -add any information that doesnt fit or look nice being in the top banner<br>
                - add edit <br>
                - add contractors details <br>
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
                                <button wire:click="$toggle('showPhaseForm')"
                                    class="px-4 py-2 bg-blue-500 text-white rounded">
                                    Add Phase
                                </button>
                                <button wire:click="$toggle('showMilestoneForm')"
                                    class="px-4 py-2 bg-green-500 text-white rounded">
                                    Add Milestone
                                </button>
                            </div>
                        </x-slot>
                    </x-section-title>

                    <!-- Forms (Hidden Initially) -->
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Add Phase Form -->
                        @if ($showPhaseForm)
                            <div class="p-4 border rounded shadow bg-white">
                                <h3 class="text-md font-bold mb-2">New Phase</h3>

                                <!-- Form Starts Here -->
                                <form wire:submit.prevent="createPhase">
                                    <!-- Phase Name Input -->
                                    <input type="text" wire:model="phase_name" class="w-full p-2 border rounded mb-2"
                                        placeholder="Phase Name">

                                    <!-- Start Date Input -->
                                    <input type="date" wire:model="start_date" class="w-full p-2 border rounded mb-2"
                                        placeholder="Start Date">

                                    <!-- End Date Input -->
                                    <input type="date" wire:model="end_date" class="w-full p-2 border rounded mb-2"
                                        placeholder="End Date">

                                    <!-- Save Button -->
                                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
                                        Save Phase
                                    </button>
                                </form>
                                <!-- Form Ends Here -->
                            </div>
                        @endif


                        <!-- Add Milestone Form -->
                        @if ($showMilestoneForm)
                            <div class="p-4 border rounded shadow bg-white">
                                <h3 class="text-md font-bold mb-2">New Milestone</h3>
                                <input type="text" wire:model="milestone_name" class="w-full p-2 border rounded"
                                    placeholder="Milestone Name">
                                <button wire:click="createMilestone"
                                    class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Save Milestone</button>
                            </div>
                        @endif
                    </div>

                    <ol class="relative border-s border-gray-200 dark:border-gray-700">
                        @foreach($timelineItems as $item)
                            <li class="mb-10 ms-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $item['name'] }}
                                    @if($item['type'] === 'phase')
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-3">Phase</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300 ms-3">Milestone</span>
                                    @endif
                                </h3>
                                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                    Start: {{ \Carbon\Carbon::parse($item['start_date'])->format('M d, Y') }} - Due: {{ \Carbon\Carbon::parse($item['due_date'])->format('M d, Y') }}
                                </time>
                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $item['details'] }}</p>
                            </li>
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
            <div>
                <!-- Budget tab content -->
                <div>
                    <div>
                        Manage Budgets
                    </div>
                    <div>
                        <x-button wire:click="$set('newBudgetModal_isOpen', true)">New Budget</x-button>

                        <x-dialog-modal wire:model="newBudgetModal_isOpen">
                            <x-slot name="title">New Budget</x-slot>
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
                                                {{-- @foreach ($project->phases as $phase)
                                                    <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                                @endforeach --}}
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
                    </div>




                </div>
            </div>
        @elseif ($activeTab == 'ExpensesTab')
            <div>
                <!-- Expenses tab content -->
                Expenses tab component
            </div>
        @endif
    </div>

</div>
