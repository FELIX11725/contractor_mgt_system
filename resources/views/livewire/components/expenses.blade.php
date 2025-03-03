<div>
    <section class="container px-6 mx-auto">
        <div class="flex items-center justify-between pt-10">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Expenses</h2>
            <div>
                <label for="projectFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Project:</label>
                <select
                    id="projectFilter"
                    wire:model="selectedProjectId"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
                    <option value="">All Projects</option>
                    @foreach($budgets->unique('project.id')->pluck('project') as $project)
                        @if($project) {{-- Check if project is not null --}}
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-4 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-300 dark:border-gray-700 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="py-4 px-6 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Project</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Milestones/Phases</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Expense Item</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Estimated Amount</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Amount Paid</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Difference</th>
                                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @php
                                    $totalEstimated = 0;
                                    $totalPaid = 0;
                                @endphp

                                @foreach($budgets->groupBy('project.id') as $projectId => $projectBudgets)
                                    @php $project = $projectBudgets->first()->project; @endphp
                                    <tr class="bg-gray-50 dark:bg-gray-800">
                                        <td class="py-4 px-6 font-medium text-gray-700 dark:text-gray-200" rowspan="{{ $projectBudgets->groupBy('project_plan_item_name')->count() + 1 }}">
                                            {{ $project->project_name ?? 'No Project Assigned' }}
                                        </td>
                                    </tr>
                                    @foreach ($projectBudgets->groupBy('project_plan_item_name') as $milestone => $milestoneBudgets)
                                        <tr>
                                            <td class="py-4 px-6 text-gray-700 dark:text-gray-300">{{ $milestone ?? 'N/A' }}</td>
                                            <td class="py-4 px-6">
                                                <ul>
                                                    @foreach ($milestoneBudgets as $budget)
                                                        <li class="mb-1">{{ $budget->expense_item ?? 'N/A' }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="py-4 px-6">
                                                <ul>
                                                    @foreach ($milestoneBudgets as $budget)
                                                        <li class="mb-1">
                                                            {{ number_format($budget->estimated_amount, 0, ".", ",") ?? 'N/A' }}
                                                        </li>
                                                        @php $totalEstimated += $budget->estimated_amount; @endphp
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="py-4 px-6">
                                                <ul>
                                                    @foreach($milestoneBudgets as $budget)
                                                        @php $amountPaid = $budget->expenses->amount_paid ?? 0; @endphp
                                                        <li class="mb-1">
                                                            {{ number_format($amountPaid, 0, ".", ",") }}
                                                        </li>
                                                        @php $totalPaid += $amountPaid; @endphp
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="py-4 px-6">
                                                <ul>
                                                    @foreach ($milestoneBudgets as $budget)
                                                        <li class="mb-1">
                                                            {{ number_format(abs($budget->estimated_amount - ($budget->expenses->amount_paid ?? 0)), 0, ".", ",") }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="py-4 px-6">
                                                <ul>
                                                    @foreach($milestoneBudgets as $budget)
                                                        @php $amountPaid = $budget->expenses->amount_paid ?? 0; @endphp
                                                        @if($amountPaid == 0) {{-- Show "Pay" button only if amount paid is 0 --}}
                                                            <li class="mb-1">
                                                                <button wire:click="openPayModal({{ $budget->id }})" class="px-3 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                                    Pay
                                                                </button>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                {{-- Totals Row --}}
                                <tr class="bg-gray-200 dark:bg-gray-700 font-semibold">
                                    <td colspan="3" class="py-4 px-6 text-right text-gray-800 dark:text-gray-300">Total:</td>
                                    <td class="py-4 px-6">{{ number_format($totalEstimated, 0, ".", ",") }}</td>
                                    <td class="py-4 px-6">{{ number_format($totalPaid, 0, ".", ",") }}</td>
                                    <td class="py-4 px-6">{{ number_format($totalEstimated - $totalPaid, 0, ".", ",") }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal wire:model="showPayModal">
            <x-slot name="title">Enter Amount Paid</x-slot>
            <x-slot name="content">
                <input type="number" wire:model.defer="modalAmountPaid" class="w-full px-3 py-2 border rounded">
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('showPayModal', false)">Cancel</x-secondary-button>
                <x-button wire:click="submitModalAmountPaid">Submit</x-button>
            </x-slot>
        </x-modal>
    </section>
</div>