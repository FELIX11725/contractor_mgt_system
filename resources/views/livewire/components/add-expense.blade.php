<div class="bg-gray-50 p-6 rounded-lg shadow-sm">
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Section: New Expense Voucher -->
        <div class="col-span-12 lg:col-span-8">
            <x-form-section submit="">
                <x-slot name="title">
                    <h2 class="text-xl font-bold text-gray-800">{{ __('New Expense Voucher') }}</h2>
                </x-slot>

                <x-slot name="description">
                    <p class="text-gray-600">{{ __('Create new expenses under a single voucher.') }}</p>
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 md:col-span-3">
                        <x-label for="project" class="font-medium"> 
                            {{ __('Project') }} <span class="text-rose-500">*</span> 
                        </x-label>
                        <select wire:model.live="project" id="project"
                            class="mt-1 block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none shadow-sm transition duration-150 ease-in-out">
                            <option value="">-- Select a project --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="project" />
                    </div>
                    
                    <div class="col-span-6 md:col-span-3">
                        <x-label for="budget" class="font-medium"> 
                            {{ __('Budget') }} <span class="text-rose-500">*</span> 
                        </x-label>
                        <select wire:model="budget" id="budget"
                            class="mt-1 block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none shadow-sm transition duration-150 ease-in-out">
                            <option value="">-- Select a budget --</option>
                            @if (isset($budgetProject))
                                @foreach ($budgetProject->budgets as $budget)
                                    <option value="{{ $budget->id }}">{{ $budget->budget_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error for="budget" />
                    </div>
                    
                    <div class="col-span-6">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-validation-errors class="mb-4" />
                            </div>

                            <div class="col-span-12">
                                <x-label for="date_of_pay" class="font-medium"> 
                                    {{ __('Date of Payment') }} <span class="text-rose-500">*</span>
                                </x-label>
                                <x-input id="date_of_pay" type="date" class="w-full mt-1" wire:model="date_of_pay" />
                                <x-input-error for="date_of_pay" class="mt-2" />
                            </div>

                            <div class="col-span-12 mt-6">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Added Expenses</h3>
                            </div>

                            <div class="col-span-12 overflow-x-auto bg-white rounded-lg shadow">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Expense Item') }}
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Amount') }}
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Narration') }}
                                            </th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($expenses as $index => $expense)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                                <td class="px-4 py-3 whitespace-nowrap">
                                                    {{ $financialCategories->find($expense['category_id'])->name }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                                    {{ number_format($expense['amount'], 2) }}
                                                </td>
                                                <td class="px-4 py-3 text-gray-700">
                                                    {{ $expense['description'] }}
                                                </td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                                    <button wire:click="removeExpense({{ $index }})" 
                                                        class="text-rose-600 hover:text-rose-800 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-4 py-6 text-center text-gray-500 italic">
                                                    No expenses added yet. Use the form on the right to add an expense.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="actions">
                    @if (!empty($expenses))
                        <x-button wire:click="createExpense" class="mr-3 bg-green-600 hover:bg-green-700" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Save All Expenses
                        </x-button>
                    @endif
                    <x-secondary-button wire:click="closeNewExpenseModal" wire:loading.attr="disabled">
                        Cancel
                    </x-secondary-button>
                </x-slot>
            </x-form-section>
        </div>

        <!-- Right Section: Add Expense Item -->
        <div class="col-span-12 lg:col-span-4">
            <x-form-section submit="">
                <x-slot name="title">
                    <h2 class="text-xl font-bold text-gray-800">{{ __('Add Expense Item') }}</h2>
                </x-slot>

                <x-slot name="description">
                    <p class="text-gray-600">{{ __('Add new expense item to the voucher.') }}</p>
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <x-validation-errors class="mb-4" />
                    </div>

                    <div class="col-span-6">
                        <x-label for="category_id" class="font-medium"> 
                            {{ __('Expense Item') }} <span class="text-rose-500">*</span>
                        </x-label>
                        <div class="w-full mt-1" wire:ignore>
                            <select id="select_category_id"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                wire:model="category_id">
                                <option value="">Select Expense Item</option>
                                @foreach ($financialCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error for="category_id" class="mt-2" />
                    </div>

                    <div class="col-span-6">
                        <x-label for="amount"> {{ __('Amount') }} <span class="text-rose-500">*</span>
                        </x-label>
                        <x-input id="amount" min="0" type="number" class="w-full" wire:model.live="amount" />
                        <x-input-error for="amount" class="mt-2" />
                    </div>

                    <div class="col-span-6">
                        <x-label for="description" class="font-medium"> 
                            {{ __('Narration') }} <span class="text-rose-500">*</span>
                        </x-label>
                        <x-input id="description" type="text" class="w-full mt-1" wire:model="description" />
                        <x-input-error for="description" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-button wire:click="addExpense" class="bg-indigo-600 hover:bg-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Expense
                    </x-button>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:init', () => {
        // Initialize Select2 when Livewire is ready
        $('#select_category_id').select2({
            placeholder: "Select an expense item",
            width: '100%',
            dropdownCssClass: "text-sm"
        });

        // Update Livewire state when Select2 value changes
        $('#select_category_id').on('change', function(e) {
            @this.set('category_id', $(this).val());
        });

        // Reinitialize Select2 when Livewire updates the DOM
        Livewire.hook('element.updated', (el) => {
            $('#select_category_id').select2({
                placeholder: "Select an expense item",
                width: '100%',
                dropdownCssClass: "text-sm"
            });
        });
    });
</script>
@endscript