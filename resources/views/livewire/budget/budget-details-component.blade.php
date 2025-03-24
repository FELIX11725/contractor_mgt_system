<div>
    <div class="p-4">
        <div
            class="px-6 py-6 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-wrap justify-between items-center border-b pb-4">
                <h5 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Budget Name: <span class="text-blue-600 dark:text-blue-400">{{ $budget->budget_name }}</span>
                </h5>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Project -->
                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Project:</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ $budget->phase->project->project_name }}</p>
                </div>

                <!-- Phase -->
                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Phase:</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ $budget->phase->name }}</p>
                </div>

                <!-- Description -->
                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow col-span-1 sm:col-span-2 lg:col-span-1">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Description:</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ $budget->description }}</p>
                </div>
            </div>
        </div>


        {{-- Expense Items Table --}}
        <div
            class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4">Budget Items</h3>
            <section class="container px-4 mx-auto">

                <div class="flex items-center gap-x-3">
                    {{-- <h2 class="text-lg font-medium text-gray-800 dark:text-white">Team members</h2> --}}

                    <button wire:click="openNewBudgetItemModal"
                        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700">
                        New Budget Item
                    </button>
                </div>



                <div class="flex flex-col mt-6">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center gap-x-3">
                                                    <input type="checkbox"
                                                        class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                                    <span>Budget Item</span>
                                                </div>
                                            </th>



                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <button class="flex items-center gap-x-2">
                                                    <span>Quantity (No. of items)</span>

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                    </svg>
                                                </button>
                                            </th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Rate</th>

                                            <th scope="col"
                                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                Estimated Amount</th>

                                            <th scope="col" class="relative py-3.5 px-4">
                                                <span class="sr-only">Action</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                        @forelse($budgetItems as $item)
                                            <tr>
                                                <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                    <div class="inline-flex items-center gap-x-3">
                                                        <input type="checkbox"
                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                        <div class="flex items-center gap-x-2">

                                                            <div>
                                                                <h2 class="font-medium text-gray-800 dark:text-white ">
                                                                    {{ $item->expenseCategoryItem?->name ?? "NaN" }}
                                                                </h2>
                                                                <p
                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                    Phase: {{ $item->budget->phase->name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td
                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    {{ $item->rate }}
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-2">
                                                        {{ number_format($item->estimated_amount, 0, ".", ",") }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="flex items-center gap-x-4">
                                                        <!-- Edit Button -->
                                                      
                                                        <button wire:click="openEditBudgetItemModal({{ $item->id }})"
                                                            class="bg-blue-500 text-white px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-blue-600 focus:outline-none flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                            </svg>
                                                            Edit
                                                        </button>

                                                        <!-- Delete Button -->
                                                        <button wire:click="openDeleteBudgetItemModal({{ $item->id }})"
                                                            class="bg-red-500 text-white px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-red-600 focus:outline-none flex items-center gap-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-5 h-5">
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
                                                <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-300">No
                                                    budget items found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <!-- Previous Button -->
                    <button wire:click="previousPage"
                        class="flex items-center px-5 py-2 text-sm font-medium text-gray-700 capitalize transition-colors duration-200 bg-white border border-gray-300 rounded-lg gap-x-2 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700">
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
                                    class="px-3 py-1 text-sm font-medium rounded-lg transition-colors duration-200
                                            {{ $i == $budgetItems->currentPage() ? 'bg-blue-500 text-white hover:bg-blue-600' : 'text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600' }}">
                                    {{ $i }}
                                </button>
                            @endfor
                        @endif
                    </div>

                    <!-- Next Button -->
                    <button wire:click="nextPage"
                        class="flex items-center px-5 py-2 text-sm font-medium text-gray-700 capitalize transition-colors duration-200 bg-white border border-gray-300 rounded-lg gap-x-2 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700">
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
                <x-slot name="title">New Budget Item</x-slot>

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
                                <option value="" selected class="text-gray-400">--Select an expense category--</option>
                                @foreach($expenseCategoryItems as $categoryitem)
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
                                <option value="" selected class="text-gray-400">--Select an expense category--</option>
                                @foreach($expenseCategoryItems as $categoryitem)
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