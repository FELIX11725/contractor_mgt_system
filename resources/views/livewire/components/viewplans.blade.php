<div>
    <section class="container px-4 mx-auto pt-10">
        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Project Planning Management</h2>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Project
                                    </th>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Completion Rate 
                                    </th>
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Milestone/Phase
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Status
                                    </th>
                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @foreach ($projectPlans as $projectPlan)
                                    @php
                                        // Calculate the completion rate for the project
                                        $totalMilestonesPhases = count($projectPlan->milestones) + count($projectPlan->phases);
                                        $completedMilestonesPhases = 0;

                                        foreach ($projectPlan->milestones as $milestone) {
                                            if ($milestone->milestone_status === 'completed') {
                                                $completedMilestonesPhases++;
                                            } elseif ($milestone->milestone_status === 'active') {
                                                $completedMilestonesPhases += 0.5; // 50% for active
                                            }
                                        }

                                        foreach ($projectPlan->phases as $phase) {
                                            if ($phase->phase_status === 'completed') {
                                                $completedMilestonesPhases++;
                                            } elseif ($phase->phase_status === 'active') {
                                                $completedMilestonesPhases += 0.5; // 50% for active
                                            }
                                        }

                                        $completionRate = ($totalMilestonesPhases > 0) ? round(($completedMilestonesPhases / $totalMilestonesPhases) * 100) : 0;
                                    @endphp

                                    <tr>
                                        <!-- Project Column -->
                                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap" rowspan="{{ count($projectPlan->milestones) + count($projectPlan->phases) + 1 }}">
                                            <p class="text-gray-800 dark:text-white">{{ $projectPlan->project->project_name }}</p>
                                        </td>

                                        <!-- Completion Rate Column -->
                                        <td class="px-4 py-4 text-sm whitespace-nowrap" rowspan="{{ count($projectPlan->milestones) + count($projectPlan->phases) + 1 }}">
                                            <div class="w-48 h-1.5 bg-blue-200 overflow-hidden rounded-full mb-2">
                                                <div class="bg-blue-500 h-1.5" style="width: {{ $completionRate }}%;"></div>
                                            </div>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $completionRate }}%</span>
                                        </td>
                                    </tr>

                                    @if($projectPlan->plan_method === 'milestones')
                                        @foreach($projectPlan->milestones as $milestone)
                                            <tr>
                                                <!-- Milestone/Phase Column -->
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <p class="text-gray-800 dark:text-white">{{ $milestone->name }}</p>
                                                </td>

                                                <!-- Status Column -->
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <x-status :status="$milestone->milestone_status" />
                                                </td>

                                                <!-- Edit Column -->
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <button wire:click="openUpdateStatusModal('{{ $milestone->id }}', 'milestone', '{{ $milestone->milestone_status }}')" class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                                        Update Status
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif($projectPlan->plan_method === 'phases')
                                        @foreach($projectPlan->phases as $phase)
                                            <tr>
                                                <!-- Milestone/Phase Column -->
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <p class="text-gray-800 dark:text-white">{{ $phase->name }}</p>
                                                </td>

                                                <!-- Status Column -->
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <x-status :status="$phase->phase_status" />
                                                </td>

                                                <!-- Edit Column -->
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <button wire:click="openUpdateStatusModal('{{ $phase->id }}', 'phase', '{{ $phase->phase_status }}')" class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                                        Update Status
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <!-- Pagination Links -->
        </div>
    </section>

    <!-- Update Status Modal -->
    <div x-data="{ isOpen: false }" x-show="isOpen" @open-modal.window="isOpen = true"  @keydown.window.escape="isOpen = false"  x-cloak class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5)">
        <div  @click.away="isOpen = false" class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modalTitle">
                            Update Status
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Current Status:  <span x-text="$wire.newStatus"></span><br>
                                Clicking Update will change the status to: <span x-text="$wire.newStatus === 'pending' ? 'Active' : ($wire.newStatus === 'active' ? 'Completed' : 'Pending')"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click="updateStatus" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update
                </button>
                <button @click="isOpen = false" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>