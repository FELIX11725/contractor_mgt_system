<div>
    <div wire:poll class="p-5 bg-gray-50 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                            Expense Approvals
                        </h2>
                        <p class="text-sm text-indigo-100 mt-1">Manage and approve pending expense requests</p>
                    </div>

                    <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
                        <div class="flex items-center bg-white/10 rounded-lg p-1">
                            <select wire:model.live.debounce="searchColumn" class="bg-transparent text-white border-0 focus:ring-0 text-sm">
                                <option value="description" class="text-gray-800">Description</option>
                                <option value="transaction_id" class="text-gray-800">Transaction ID</option>
                            </select>
                            
                            <div class="relative">
                                <input wire:model.live.debounce="search" type="text" placeholder="Search..." 
                                    class="pl-8 pr-3 py-2 bg-white/20 border-0 rounded-lg text-white placeholder-white/70 focus:ring-white/30 focus:border-0 text-sm" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-2.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <x-button wire:click="openFiltersModal" class="bg-white/20 hover:bg-white/30 text-white border-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                            </svg>
                            <span class="ml-2">Filters</span>
                        </x-button>
                    </div>
                </div>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-gray-50 border-b border-gray-200">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Expenses</p>
                        <p class="text-xl font-bold">{{ $expenses->total() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Approved</p>
                        <p class="text-xl font-bold">{{ $expenses->filter(function($expense) { return $expense->approvals->isNotEmpty() && $expense->approvals->first()->is_approved; })->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-red-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Declined</p>
                        <p class="text-xl font-bold">{{ $expenses->filter(function($expense) { return $expense->approvals->isNotEmpty() && !$expense->approvals->first()->is_approved; })->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-yellow-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-xl font-bold">{{ $expenses->filter(function($expense) { return $expense->approvals->isEmpty(); })->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                @if($selectedReqs && count($selectedReqs) > 0)
                <div class="bg-blue-50 p-3 rounded-lg mb-4 flex justify-between items-center">
                    <span class="text-blue-700 font-medium">{{ count($selectedReqs) }} items selected</span>
                    <div>
                        <x-button wire:click="approveSelected" class="bg-green-600 hover:bg-green-700">
                            Approve All Selected
                        </x-button>
                        <x-danger-button wire:click="declineSelected" class="ml-2">
                            Decline All Selected
                        </x-danger-button>
                    </div>
                </div>
                @endif

                <div class="overflow-hidden border border-gray-200 sm:rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-3 text-left">
                                    <input type="checkbox" wire:model="selectAll" class="rounded text-blue-600 focus:ring-blue-500" />
                                </th>
                                <th scope="col" wire:click="sortBy('budget_items_id')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Expense Item
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('description')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Description
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('amount_paid')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Amount
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('date_of_pay')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Date
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($expenses->isEmpty())
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-gray-500 text-lg font-medium">No expenses found</span>
                                            <p class="text-gray-400 mt-1">Try adjusting your search or filter criteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($expenses as $expense)
                                    <tr wire:key="{{ 'expense-' . $expense->id }}" class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" wire:model="selectedReqs" value="{{ $expense->id }}" 
                                                class="rounded text-blue-600 focus:ring-blue-500" />
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $expense->category->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 font-medium">{{ $expense->description }}</div>
                                            @if($expense->transaction_id)
                                            <div class="text-xs text-gray-500 mt-1">ID: {{ $expense->transaction_id }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold {{ $expense->amount_paid > 1000 ? 'text-red-600' : 'text-gray-900' }}">
                                                shs.{{ number_format($expense->amount_paid, 2) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($expense->date_of_pay)->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($expense->date_of_pay)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($expense->approvals->isNotEmpty())
                                                @if ($expense->approvals->first()->is_approved)
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                        Declined
                                                    </span>
                                                @endif
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2">
                                            @if ($expense->approvals->isEmpty())
                                                <!-- Pending - Show both Approve and Decline buttons -->
                                                <x-button wire:click="approveExpense({{ $expense->id }})" 
                                                    class="bg-green-600 hover:bg-green-700 text-white border-0 text-xs py-1 px-3">
                                                    Approve
                                                </x-button>
                                                <x-danger-button wire:click="declineExpense({{ $expense->id }})"
                                                    class="text-xs py-1 px-3">
                                                    Decline
                                                </x-danger-button>
                                           <!-- Remove the entire View Invoice Modal section -->

<!-- In the actions column of the table, replace the View Invoice button with: -->
@elseif ($expense->approvals->isNotEmpty() && $expense->approvals->first()->is_approved)
<x-button wire:click="downloadInvoice({{ $expense->id }})" 
    class="bg-blue-600 hover:bg-blue-700 text-white border-0 text-xs py-1 px-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
    </svg>
    Download Invoice
</x-button>
@endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <x-dialog-modal wire:model="filtersModal_isOpen">
        <x-slot name="title">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Expenses
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 md:col-span-6">
                    <x-label for="from_date" value="From Date" class="font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input type="date" id="from_date" wire:model.live="from_date" 
                            class="pl-10 focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>
                </div>
                
                <div class="col-span-12 md:col-span-6">
                    <x-label for="to_date" value="To Date" class="font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input type="date" id="to_date" wire:model.live="to_date" 
                            class="pl-10 focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-label for="category" value="Expense Item" class="font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <select wire:model.live="category"
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">All Expense Items</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <x-label for="perPage" value="Items Per Page" class="font-medium text-gray-700" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </div>
                        <select wire:model.live="perPage"
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="10">10 per page</option>
                            <option value="20">20 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                            <option value="200">200 per page</option>
                            <option value="500">500 per page</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12">
                    <x-label for="status" value="Status" class="font-medium text-gray-700" />
                    <div class="mt-2 flex flex-wrap gap-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="status_pending" class="rounded text-indigo-600" />
                            <span class="ml-2 text-gray-700">Pending</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="status_approved" class="rounded text-indigo-600" />
                            <span class="ml-2 text-gray-700">Approved</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.live="status_declined" class="rounded text-indigo-600" />
                            <span class="ml-2 text-gray-700">Declined</span>
                        </label>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between">
                <x-secondary-button wire:click="resetFilters" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </x-secondary-button>
                <div>
                    <x-secondary-button wire:click="closeFiltersModal" class="mr-2">
                        Cancel
                    </x-secondary-button>
                    <x-button wire:click="applyFilters" class="bg-indigo-600 hover:bg-indigo-700">
                        Apply Filters
                    </x-button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
    
    <!-- View Invoice Modal -->
 
</div>