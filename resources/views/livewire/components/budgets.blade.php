<div>
    <section class="container px-4 mx-auto">
        @if ($selectedProjectId === null)  {{-- Project Selection Section --}}
        <div class="flex items-center justify-center min-h-screen">  {{-- Center the content --}}
            <div class="mt-6 w-full max-w-2xl">  {{-- Limit width for better readability --}}
                <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 text-center">Select a Project to Budget for:</h3>

                <ul class="space-y-2">  {{-- List of Projects --}}
                    @foreach ($projectsPaginator->items() as $project)
                        <li>
                            <button wire:click="selectProject({{ $project->id }})" class="w-full px-4 py-2 bg-blue-200 hover:bg-gray-300 rounded-md text-left">
                                {{ $project->project->project_name }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    {{ $projectsPaginator->links() }}  {{-- Pagination Links --}}
                </div>
            </div>
        </div>

        @elseif ($allItemsBudgeted) {{-- All Items Budgeted Section --}}

            {{-- Display the budgets table --}}
            <div class="mt-6">
                  <div class="flex items-center gap-x-3 pt-15">
                       <button wire:click="selectProject(null)" class="px-4 py-2 bg-blue-200 hover:bg-gray-300 rounded-md">Back to Project Selection</button>
                       @if (!$budgetApproved)
                           <button wire:click="approveEntireBudget" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">Approve Budget</button>
                       @endif
                  </div>

                <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Budgets for Selected Project</h3>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Milestone/Phase</th>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Expense Item</th>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Estimated Amount</th>
                            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($budgetsForSelectedProject as $item)  
                            @php
                                $rowspan = count($item['budgets']);
                            @endphp
                            @if($rowspan > 0)
                                @foreach ($item['budgets'] as $index => $budget) 
                                    <tr class="group">
                                        @if ($index === 0) 
                                            <td class="py-4 px-4 text-sm font-medium text-gray-700 whitespace-nowrap group-hover:bg-gray-50 dark:group-hover:bg-gray-800" rowspan="{{ $rowspan }}">
                                                {{ $item['item_name'] }}
                                                @if (!$budgetApproved)
                                                    <button wire:click="openAddExtraExpenseModal('{{ $item['item_name'] }}')" class="ml-2 text-blue-500 hover:text-blue-700">Add expense item</button>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $budget['expense_item'] }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ number_format($budget['estimated_amount'], 0, ".", ",") }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if (!$budgetApproved)
                                                <button wire:click="editBudget(@js($budget))" class="flex items-center space-x-1 text-blue-600 hover:text-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 2.487a2.25 2.25 0 1 1 3.182 3.182L6.75 18.964l-4.5 1.125 1.125-4.5 13.293-13.293z" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </button>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-700 whitespace-nowrap group-hover:bg-gray-50 dark:group-hover:bg-gray-800">
                                        {{ $item['item_name'] }}
                                        @if (!$budgetApproved)
                                            <button wire:click="openAddExtraExpenseModal('{{ $item['item_name'] }}')" class="ml-2 text-blue-500 hover:text-blue-700">Add Extra</button>
                                        @endif
                                    </td>
                                    <td colspan="3" class="py-4 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
                                        No expense items found.
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else  {{-- Budgeting Section (when a project is selected, but not all items are budgeted) --}}
            {{-- Rest of the code for when a project is selected --}}
            <div class="flex items-center gap-x-3">
                <button wire:click="selectProject(null)" class="px-4 py-2 bg-blue-200 hover:bg-gray-300 rounded-md">Back to Project Selection</button>

                @if ($planMethod)
                    <h3 class="text-md font-medium text-gray-800 dark:text-white">Budget for {{ ucfirst($planMethod) }}: {{ $currentItemName }}</h3>
                @endif
            </div>

            {{-- Rest of the code for budgeting --}}
            @if ($planMethod && $currentItemName)
                {{-- Budgeting Form and Navigation --}}
                @if ($allItemsBudgeted)
                <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg pt-10">
                @else
                <form wire:submit.prevent="submitBudget">
                    {{-- Budgeting Table --}}
                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                                    <div class="flex items-center gap-x-3">
                                                        <span>Expense Item</span>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                                    <span>Estimated Expense Amount</span>
                                                </th>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left text-gray-500 dark:text-gray-400">
                                                    <span>Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                            @foreach ($expenseItems as $key => $item)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <input type="text" wire:model="expenseItems.{{ $key }}.name" class="w-full px-4 py-2 border rounded-lg dark:bg-gray-800 dark:text-white" placeholder="Enter expense item" @if ($budgetApproved) disabled @endif>
                                                    @error('expenseItems.'.$key.'.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </td>
                                                <td class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <input type="text" wire:model="expenseItems.{{ $key }}.amount"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                        placeholder="Enter amount" onkeyup="formatCurrency(this)" @if ($budgetApproved) disabled @endif>
                                                    @error('expenseItems.'.$key.'.amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    @if (!$budgetApproved && $key > 0)
                                                        <button type="button" wire:click="removeExpenseItem({{ $key }})"
                                                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="px-4 py-4 text-sm whitespace-nowrap">
                                                    @if (!$budgetApproved)
                                                        <button type="button" wire:click="addExpenseItem"
                                                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                Add More
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (!$budgetApproved)
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
                            Submit Budget
                        </button>
                    @endif
                </form>
                @endif
            @endif
        @endif
    </section>

    {{-- Modal for Adding Extra Expense --}}
    @if ($showAddExtraExpenseModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                        <button wire:click="closeAddExtraExpenseModal" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add Extra Expense for {{ $currentItemName }}</h3>

                        <form wire:submit.prevent="addExtraExpense">
                            <div class="mt-2">
                                <label for="extraExpenseItem" class="block text-sm font-medium text-gray-700">Expense Item</label>
                                <input type="text" wire:model="extraExpenseItem" id="extraExpenseItem" name="extraExpenseItem" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('extraExpenseItem') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-2">
                                <label for="extraEstimatedAmount" class="block text-sm font-medium text-gray-700">Estimated Amount</label>
                                <input type="text" wire:model="extraEstimatedAmount" id="extraEstimatedAmount" name="extraEstimatedAmount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('extraEstimatedAmount') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add Expense</button>
                                <button wire:click="closeAddExtraExpenseModal" type="button" class="inline-flex justify-center px-4 py-2 ml-2 text-sm font-medium text-gray-700 bg-gray-100 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>