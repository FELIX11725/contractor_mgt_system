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
            <div>
                <div>
                    <!-- Header Section -->
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
                    </div>

                    <!-- Forms (Hidden Initially) -->
                    <div class="my-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Add Phase Form -->
                        @if ($showPhaseForm)
                            <div class="p-4 border rounded shadow bg-white">
                                <h3 class="text-md font-bold mb-2">New Phase</h3>
                                <input type="text" wire:model="phase_name" class="w-full p-2 border rounded"
                                    placeholder="Phase Name">
                                <button wire:click="createPhase"
                                    class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Save Phase</button>
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

                    <!-- Displaying Phases & Milestones -->
                    <div class="mt-6">
                        <h2 class="text-lg font-bold mb-2">Project Timeline</h2>

                        @foreach ($phases as $phase)
                            <div class="p-4 border-l-4 border-blue-500 bg-gray-100 rounded shadow mb-4">
                                <h3 class="text-md font-semibold">{{ $phase->name }}</h3>
                                <p class="text-sm text-gray-600">Start: {{ $phase->start_date }} | End:
                                    {{ $phase->end_date }}</p>

                                <!-- Milestones under this Phase -->
                                <div class="ml-4 mt-2">
                                    @foreach ($phase->milestones as $milestone)
                                        <div class="p-2 border rounded bg-white shadow-sm mb-2">
                                            <span class="font-medium">{{ $milestone->milestone_name }}</span>
                                            <p class="text-sm text-gray-500">{{ $milestone->due_date }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

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
