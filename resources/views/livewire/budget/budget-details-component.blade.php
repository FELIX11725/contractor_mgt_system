<div>
    <div class="p-4">
        <div
            class="w-full bg-white border border-gray-200 rounded-xl shadow-xl dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
            <div
                class="flex flex-wrap justify-between items-center border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-white dark:from-gray-800 dark:to-gray-900 px-8 py-6">
                <h5 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Budget Name: <span class="text-blue-600 dark:text-blue-400">{{ $budget->budget_name }}</span>
                </h5>
            </div>

            <div class="p-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Project -->
                <div
                    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-5 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                        Project:
                    </h5>
                    <p class="text-gray-600 dark:text-gray-400 font-medium pl-7">
                        {{ $budget->phase->project->project_name }}</p>
                </div>

                <!-- Phase -->
                <div
                    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-5 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Phase:
                    </h5>
                    <p class="text-gray-600 dark:text-gray-400 font-medium pl-7">{{ $budget->phase->name }}</p>
                </div>

                <!-- Description -->
                <div
                    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-5 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 col-span-1 sm:col-span-2 lg:col-span-2 hover:shadow-lg transition-shadow duration-300">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300 flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        Description:
                    </h5>
                    <p class="text-gray-600 dark:text-gray-400 font-medium pl-7">{{ $budget->description }}</p>
                </div>
            </div>
        </div>


        {{-- Expense Items Table --}}
        <div
            class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <section class="container px-4 mx-auto">

                <div
                    class="px-8 py-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-white dark:from-gray-800 dark:to-gray-900 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Budget Items
                    </h3>

                    <div class="flex items-center gap-3">
                        <button wire:click="exportToPdf"
                            class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 rounded-lg hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 dark:from-green-600 dark:to-green-700 dark:hover:from-green-700 dark:hover:to-green-800 dark:focus:ring-green-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Export PDF
                        </button>

                        <button wire:click="openNewBudgetItemModal"
                            class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:from-blue-600 dark:to-blue-700 dark:hover:from-blue-700 dark:hover:to-blue-800 dark:focus:ring-blue-600 transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            New Budget Item
                        </button>
                    </div>
                </div>



                <div class="px-6 py-6">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div
                                class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-xl shadow-md">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="py-4 px-6 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center gap-x-3">
                                                    <input type="checkbox"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                                    <span>Budget Item</span>
                                                </div>
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center gap-x-2">
                                                    <span>Quantity</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 text-gray-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                    </svg>
                                                </div>
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Rate
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Estimated Amount
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider relative"
                                                x-data="{ showTooltip: false }">
                                                <div class="flex items-center">
                                                    <span>Forecast Amount</span>
                                                    <span class="ml-1 text-gray-500 cursor-pointer"
                                                        @mouseover="showTooltip = true"
                                                        @mouseleave="showTooltip = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                        </svg>
                                                    </span>
                                                </div>

                                                <!-- Tooltip -->
                                                <div x-show="showTooltip"
                                                    class="absolute left-0 mt-2 w-64 p-3 text-xs text-white bg-gray-900 rounded-lg shadow-lg z-10"
                                                    style="display: none;">
                                                    The Forecast Amount is the total amount if all requested expenses
                                                    were fully approved.
                                                </div>
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Total Spent
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @forelse($budgetItems as $item)
                                                                            <tr
                                                                                class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200">
                                                                                <td
                                                                                    class="px-6 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                                                                    <div class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">

                                                                                        <div>
                                                                                            <h2 class="font-semibold text-gray-800 dark:text-white">
                                                                                                {{ $item->expenseCategoryItem?->name ?? 'NaN' }}
                                                                                            </h2>
                                                                                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                                                                Phase: {{ $item->budget->phase->name }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <td
                                                                                    class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap font-medium">
                                                                                    {{ $item->quantity }}
                                                                                </td>

                                                                                <td
                                                                                    class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap font-medium">
                                                                                    {{ $item->rate }}
                                                                                </td>

                                                                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                                                    <div class="font-medium text-gray-700 dark:text-gray-200">
                                                                                        {{ number_format($item->estimated_amount, 0, '.', ',') }}
                                                                                    </div>
                                                                                </td>

                                                                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                                                    <div class="font-medium text-blue-600 dark:text-blue-400">
                                                                                        {{ number_format($item->expenses_sum_amount_paid ?? 0, 0, '.', ',') }}
                                                                                    </div>
                                                                                </td>

                                                                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                                                    @php
                                                                                        $totalSpent = $item->approved_expenses_sum_amount_paid ?? 0;
                                                                                        $estimatedAmount = $item->estimated_amount;
                                                                                    @endphp
                                                                                    <div class="font-medium 
                                            @if($totalSpent > $estimatedAmount) 
                                                text-red-600 dark:text-red-400
                                            @elseif($totalSpent < $estimatedAmount)
                                                text-green-600 dark:text-green-400
                                            @else
                                                text-blue-600 dark:text-blue-400
                                            @endif">
                                                                                        {{ number_format($totalSpent, 0, '.', ',') }}
                                                                                        @if($totalSpent > $estimatedAmount)
                                                                                            <span
                                                                                                class="text-xs text-red-500 dark:text-red-400 ml-1">(Overrun)</span>
                                                                                        @elseif($totalSpent < $estimatedAmount)
                                                                                            <span
                                                                                                class="text-xs text-green-500 dark:text-green-400 ml-1">(Underrun)</span>
                                                                                        @else
                                                                                            <span class="text-xs text-blue-500 dark:text-blue-400 ml-1">(On
                                                                                                Budget)</span>
                                                                                        @endif
                                                                                    </div>
                                                                                </td>

                                                                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                                                                    <div class="flex items-center gap-x-3">
                                                                                        <!-- Edit Button -->
                                                                                        <button wire:click="openEditBudgetItemModal({{ $item->id }})"
                                                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                                                class="w-4 h-4 mr-1">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                            Edit
                                                                                        </button>

                                                                                        <!-- Delete Button -->
                                                                                        <button wire:click="openDeleteBudgetItemModal({{ $item->id }})"
                                                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                                                class="w-4 h-4 mr-1">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                            Delete
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-6 py-8 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-12 w-12 text-gray-400 mb-3" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No
                                                            budget items found</p>
                                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Click "New
                                                            Budget Item" to add one</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <!-- Previous Button -->
                        <button wire:click="previousPage"
                            class="flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg gap-x-2 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>
                            <span>Previous</span>
                        </button>

                        <!-- Pagination Links -->
                        <div class="items-center hidden lg:flex gap-x-2">
                            @if ($budgetItems->lastPage() > 1)
                                @for ($i = 1; $i <= $budgetItems->lastPage(); $i++)
                                                    <button wire:click="gotoPage({{ $i }})"
                                                        class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium rounded-lg transition-colors duration-200
                                                          {{ $i == $budgetItems->currentPage()
                                    ? 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700'
                                    : 'text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700' }}">
                                                        {{ $i }}
                                                    </button>
                                @endfor
                            @endif
                        </div>

                        <!-- Next Button -->
                        <button wire:click="nextPage"
                            class="flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg gap-x-2 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <span>Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </button>
                    </div>
            </section>

            <x-dialog-modal wire:model="showNewBudgetItemModal">
                <x-slot name="title">
                    <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Budget Item
                    </div>
                </x-slot>

                <x-slot name="content">
                    <p><strong>Project Name:</strong> {{ $budget->phase->project->project_name }}</p>
                    <p><strong>Phase Name:</strong> {{ $budget->phase->name }}</p>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Expense Item -->
                        <div>
                            <label for="expense_category" class="block text-sm font-medium text-gray-700">Expense
                                Category item <span class="text-red-500">*</span></label>
                            <select wire:model="selectedExpenseCategory" id="expense_category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white py-2 px-3 text-gray-700">
                                <option value="" selected class="text-gray-400">--Select an expense category--
                                </option>
                                @foreach ($expenseCategoryItems as $categoryitem)
                                    <option value="{{ $categoryitem->id }}">{{ $categoryitem->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="selectedExpenseCategory" />
                        </div>


                        <!-- Rate -->
                        <div>
                            <label for="rate" class="block text-sm font-medium text-gray-700">Rate <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="newCategoryRate" id="rate"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="newCategoryRate" />
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="newCategoryQuantity" id="quantity"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="newCategoryQuantity" />
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model="newCategoryAmount" id="amount"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="newCategoryAmount" />
                        </div>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <button wire:click="closeNewBudgetItemModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
                    <button wire:click="saveNewBudgetItem"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
                </x-slot>
            </x-dialog-modal>

            {{-- edit modal --}}
            <x-dialog-modal wire:model="showEditBudgetItemModal">
                <x-slot name="title">Edit Budget Item</x-slot>
                <x-slot name="content">
                    <p><strong>Project Name:</strong> {{ $budget->phase->project->project_name }}</p>
                    <p><strong>Phase Name:</strong> {{ $budget->phase->name }}</p>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Expense Item -->
                        <div>
                            <label for="edit_expense_category" class="block text-sm font-medium text-gray-700">Expense
                                Category item <span class="text-red-500">*</span></label>
                            <select wire:model="selectedEditExpenseCategory" id="edit_expense_category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white py-2 px-3 text-gray-700">
                                <option value="" selected class="text-gray-400">--Select an expense category--
                                </option>
                                @foreach ($expenseCategoryItems as $categoryitem)
                                    <option value="{{ $categoryitem->id }}">{{ $categoryitem->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="selectedEditExpenseCategory" />
                        </div>
                        <!-- Rate -->
                        <div>
                            <label for="edit_rate" class="block text-sm font-medium text-gray-700">Rate <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="editCategoryRate" id="edit_rate"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="editCategoryRate" />
                        </div>
                        <!-- Quantity -->
                        <div>
                            <label for="edit_quantity" class="block text-sm font-medium text-gray-700">Quantity <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="editCategoryQuantity" id="edit_quantity"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="editCategoryQuantity" />
                        </div>
                        <!-- Amount -->
                        <div>
                            <label for="edit_amount" class="block text-sm font-medium text-gray-700">Amount <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model="editCategoryAmount" id="edit_amount"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <x-input-error for="editCategoryAmount" />
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <button wire:click="closeEditBudgetItemModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
                    <button wire:click="updateBudgetItem"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Update</button>
                </x-slot>
            </x-dialog-modal>
            <!-- Delete modal -->
            <x-dialog-modal wire:model="showDeleteBudgetItemModal">
                <x-slot name="title">Delete Budget Item</x-slot>
                <x-slot name="content">
                    {{-- confirmation --}}
                    <p>Are you sure you want to delete this budget item?</p>
                    <p>This action cannot be undone.</p>

                </x-slot>
                <x-slot name="footer">
                    <button wire:click="closeDeleteBudgetItemModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
                    <button wire:click="deleteBudgetItem"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Delete</button>
                </x-slot>
            </x-dialog-modal>
        </div>

    </div>
</div>