<div class="m-10">
    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-8">
            <x-form-section submit="">
                <x-slot name="title">
                    {{ __('New Expense Voucher') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Create new expenses under a single voucher.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-validation-errors class="mb-4" />
                            </div>

                            <div class="col-span-12">
                                <x-label for="date_of_pay"> {{ __('Date of Payment') }} <span
                                        class="text-rose-500">*</span>
                                </x-label>
                                <x-input id="date_of_pay" type="date" class="w-full" wire:model="date_of_pay" />
                                <x-input-error for="date_of_pay" class="mt-2" />
                            </div>

                            <div class="col-span-12 mt-4">
                                <h3 class="text-lg font-semibold">Added Expenses</h3>
                            </div>

                            <div class="col-span-12 overflow-x-auto">
                                <table class="min-w-full border-collapse border border-gray-200 dark:border-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-800">
                                        <tr>
                                            <th class="p-2 border border-gray-200 dark:border-gray-700 text-left">
                                                {{ __('Expense Item') }}</th>
                                            <th class="p-2 border border-gray-200 dark:border-gray-700 text-left">
                                                {{ __('Amount') }}</th>
                                            <th class="p-2 border border-gray-200 dark:border-gray-700 text-left">
                                                {{ __('Narration') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expenses as $index => $expense)
                                            <tr class="bg-white dark:bg-gray-900 even:bg-gray-50 dark:even:bg-gray-800">
                                                <td class="p-2 border border-gray-200 dark:border-gray-700">
                                                    {{ $financialCategories->find($expense['category_id'])->name }}
                                                </td>
                                                <td class="p-2 border border-gray-200 dark:border-gray-700">
                                                    {{ number_format($expense['amount'], 2) }}
                                                </td>
                                                <td class="p-2 border border-gray-200 dark:border-gray-700">
                                                    {{ $expense['description'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="actions">
                    @if (!empty($expenses))
                        <x-button wire:click="createExpense" class="mr-3" wire:loading.attr="disabled">Save All
                            Expenses</x-button>
                    @endif
                    <x-secondary-button wire:click="closeNewExpenseModal"
                        wire:loading.attr="disabled">Cancel</x-secondary-button>
                </x-slot>
            </x-form-section>
        </div>

        <!-- Add Expense Form -->
        <div class="col-span-4">
            <x-form-section submit="">
                <x-slot name="title">
                    {{ __('Add Expense Item') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add new expense item to the voucher.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <x-validation-errors class="mb-4" />
                    </div>

                    <div class="col-span-6">
                        <x-label for="category_id"> {{ __('Expense Item') }} <span class="text-rose-500">*</span>
                        </x-label>
                        <div class="w-full" wire:ignore>
                            <select id="select_category_id"
                                class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
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
                        <x-label for="description"> {{ __('Narration') }} <span class="text-rose-500">*</span>
                        </x-label>
                        <x-input id="description" type="text" class="w-full" wire:model="description" />
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    @script
                    <script>
                        document.addEventListener('livewire:init', () => {
                            // Initialize Select2 when Livewire is ready
                            $('#select_category_id').select2();

                            // Update Livewire state when Select2 value changes
                            $('#select_category_id').on('change', function (e) {
                                @this.set('category_id', $(this).val());
                            });

                            // Reinitialize Select2 when Livewire updates the DOM
                            Livewire.hook('element.updated', (el) => {
                                $('#select_category_id').select2();
                            });
                        });
                    </script>
                    @endscript
                </x-slot>

                <x-slot name="actions">
                    <x-button wire:click="addExpense" class="mr-3">+ Add Expense</x-button>
                </x-slot>
            </x-form-section>
        </div>
    </div>
</div>