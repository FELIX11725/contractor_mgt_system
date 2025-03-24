<div>
    <div wire:poll class="p-5">
        <div class="bg-white overflow-x-auto shadow-xl p-4 pb-0">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    <h2 class="text-xl font-bold">Expense Approvals</h2>
                    <p class="text-sm text-gray-500">List of all expenses</p>
                </div>

                <div class="col-span-1 flex justify-end space-x-2">
                    <div class="flex items-center space-x-2">
                        <!-- Dropdown for selecting the search column -->
                        <div>
                            <select wire:model.live.debounce="searchColumn" class="form-select block w-full mt-1">
                                <option value="description">Description</option>
                                <option value="transaction_id">Transaction ID</option>
                            </select>
                        </div>

                        <!-- Input field for the search query -->
                        <div>
                            <input wire:model.live.debounce="search" type="text" placeholder="Search..."
                                class="form-input block w-full shadow rounded border border-gray-300 focus:border-indigo-300 mt-1" />
                        </div>
                    </div>
                    <div>
                        <x-button wire:click="openFiltersModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-funnel" viewBox="0 0 16 16">
                                <path
                                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                            </svg> <span class="ml-2">Filters</span>
                        </x-button>

                        <x-dialog-modal wire:model="filtersModal_isOpen">
                            <x-slot name="title">
                                Filters
                            </x-slot>

                            <x-slot name="content">
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-6">
                                        <x-label for="from_date" value="From Date" />
                                        <x-input type="date" id="from_date" wire:model.live="from_date" />
                                    </div>
                                    <div class="col-span-6">
                                        <x-label for="to_date" value="To Date" />
                                        <x-input type="date" id="to_date" wire:model.live="to_date" />
                                    </div>

                                    <div class="col-span-6">
                                        <x-label for="category" value="Expense Item" />
                                        <select wire:model.live="category"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="">All Expense Items</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <x-label for="perPage" value="Per Page" />
                                        <select wire:model.live="perPage"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="500">500</option>
                                        </select>
                                    </div>
                                </div>
                            </x-slot>

                            <x-slot name="footer">
                                <x-secondary-button wire:click="closeFiltersModal">
                                    {{ __('Close') }}
                                </x-secondary-button>
                            </x-slot>
                        </x-dialog-modal>
                    </div>
                </div>
            </div>

            <x-section-border />
            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>#</th>
                            <th scope="col" wire:click="sortBy('budget_items_id')"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:cursor-pointer hover:bg-gray-100">
                                Expense Item</th>
                            <th scope="col" wire:click="sortBy('description')"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:cursor-pointer hover:bg-gray-100">
                                Description</th>
                            <th scope="col" wire:click="sortBy('amount_paid')"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:cursor-pointer hover:bg-gray-100">
                                Amount</th>
                            <th scope="col" wire:click="sortBy('date_of_pay')"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:cursor-pointer hover:bg-gray-100">
                                Date</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($expenses->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 mt-4">
                                    No expenses found.
                                </td>
                            </tr>
                        @else
                            @foreach ($expenses as $expense)
                                <tr wire:key="{{ 'expense-' . $expense->id }}" class="hover:bg-gray-100">
                                    <td>
                                        <input type="checkbox" wire:model="selectedReqs" value="{{ $expense->id }}" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $expense->category->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $expense->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ number_format($expense->amount_paid, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $expense->date_of_pay }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($expense->approvals->isNotEmpty())
                                            @if ($expense->approvals->first()->is_approved)
                                                <span class="text-green-600">Approved</span>
                                            @else
                                                <span class="text-red-600">Declined</span>
                                            @endif
                                        @else
                                            <span class="text-gray-600">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        @if ($expense->approvals->isEmpty() || !$expense->approvals->first()->is_approved)
                                            <x-button wire:click="approveExpense({{ $expense->id }})">
                                                Approve
                                            </x-button>
                                        @endif
                                        @if ($expense->approvals->isEmpty() || $expense->approvals->first()->is_approved)
                                            <x-danger-button wire:click="declineExpense({{ $expense->id }})">
                                                Decline
                                            </x-danger-button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>