<div class="bg-gray-50 py-8">
    <div wire:poll class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Header section -->
            <div class="px-6 py-6 md:px-8 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Title and description -->
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-800">Expenses</h2>
                        <p class="text-sm text-gray-600 mt-1">Comprehensive list of all approved expenses</p>
                    </div>
                    
                    <!-- Search and filter controls -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <!-- Search -->
                        <div class="flex items-center gap-2">
                            <select wire:model.live.debounce="searchColumn" class="rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="description">Narration</option>
                                <option value="voucher_number">Voucher Number</option>
                            </select>
                            
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce="search" type="text" placeholder="Search..." class="pl-10 rounded-lg border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                            </div>
                        </div>
                        
                        <!-- Filter and Export buttons -->
                        <div class="flex items-center gap-2">
                            <button wire:click="openFiltersModal" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                Filters
                            </button>
                            
                            <button wire:click="exportExcelReport" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Selected items actions - Only visible when items are selected -->
                <div x-data="{}" x-show="$wire.selectedItems.length > 0" x-cloak class="mt-4 flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-700">
                        <span class="font-medium text-indigo-700 mr-1" x-text="$wire.selectedItems.length"></span> items selected
                    </div>
                    <div class="flex items-center gap-2">
                        <button wire:click="exportSelected" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg shadow-sm text-xs font-medium bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z" />
                                <path d="M3 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L10.414 13H15v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 11h2a1 1 0 110 2h-2v-2z" />
                            </svg>
                            Export Selected
                        </button>
                        <button wire:click="clearSelection" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg shadow-sm text-xs font-medium bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Clear Selection
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Table section -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-indigo-50">
                            <!-- Select All Checkbox -->
                            <th scope="col" class="px-4 py-4 text-left w-12">
                                <div class="flex items-center">
                                    <input wire:click="toggleSelectAll" type="checkbox" 
                                        @if(count($selectedItems ?? []) === $expenses->count() && $expenses->count() > 0) checked @endif
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </th>
                            
                            <th scope="col" wire:click="sortBy('budget_items_id')" class="group px-6 py-4 text-left cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-800 uppercase tracking-wider">Expense Item</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400 opacity-0 group-hover:opacity-100 transition" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" wire:click="sortBy('description')" class="group px-6 py-4 text-left cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-800 uppercase tracking-wider">Narration</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400 opacity-0 group-hover:opacity-100 transition" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" wire:click="sortBy('amount_paid')" class="group px-6 py-4 text-left cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-800 uppercase tracking-wider">Amount</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400 opacity-0 group-hover:opacity-100 transition" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" wire:click="sortBy('date_of_pay')" class="group px-6 py-4 text-left cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-800 uppercase tracking-wider">Date</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400 opacity-0 group-hover:opacity-100 transition" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-100">
                        @if ($expenses->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-200 mb-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16a5.982 5.982 0 01-5.668-4.035v-.63c0-.197.016-.39.045-.578zm4.168 2.539V10.5a1 1 0 00-1-1H6.45a5.993 5.993 0 01-.177-1A6 6 0 0110 4c.94 0 1.83.216 2.623.602A3.993 3.993 0 0010 6a3.06 3.06 0 00-.133.01A3.982 3.982 0 006 10c0 .887.289 1.705.778 2.366A3.983 3.983 0 008.5 11.5z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-xl font-medium text-indigo-800">No expenses found</p>
                                        <p class="text-sm text-gray-500 mt-2">Try adjusting your search or filter criteria</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($expenses as $expense)
                                <tr class="hover:bg-indigo-50 transition-colors duration-150 ease-in-out">
                                    <!-- Row Checkbox -->
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <input wire:model.live="selectedItems" value="{{ $expense->id }}" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-800 truncate max-w-xs" title="{{ $expense->category->name }}">
                                            {{ $expense->category->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-700 max-w-xs" title="{{ $expense->description }}">
                                            {{ $expense->description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            <span class="font-mono">{{ number_format($expense->amount_paid, 2) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">
                                            {{ $expense->date_of_pay }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        @if (!$expenses->isEmpty())
                            Showing <span class="font-medium">{{ $expenses->firstItem() }}</span> to <span class="font-medium">{{ $expenses->lastItem() }}</span> of <span class="font-medium">{{ $expenses->total() }}</span> expenses
                        @endif
                    </div>
                    <div>
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filters Modal -->
    <x-dialog-modal wire:model="filtersModal_isOpen">
        <x-slot name="title">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-lg text-gray-800">Filter Expenses</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-2">
                <div>
                    <x-label for="from_date" value="From Date" class="font-medium text-gray-700" />
                    <x-input type="date" id="from_date" wire:model.live="from_date" class="mt-1 block w-full rounded-lg shadow-sm" />
                </div>
                <div>
                    <x-label for="to_date" value="To Date" class="font-medium text-gray-700" />
                    <x-input type="date" id="to_date" wire:model.live="to_date" class="mt-1 block w-full rounded-lg shadow-sm" />
                </div>

                <div>
                    <x-label for="category" value="Expense Item" class="font-medium text-gray-700" />
                    <select wire:model.live="category" id="category" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">All Expense Items</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label for="perPage" value="Records Per Page" class="font-medium text-gray-700" />
                    <select wire:model.live="perPage" id="perPage" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
            <div class="flex justify-end gap-3">
                <x-secondary-button wire:click="closeFiltersModal" class="bg-white hover:bg-gray-50">
                    {{ __('Close') }}
                </x-secondary-button>
                <button wire:click="applyFilters" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Apply Filters') }}
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('selectionChanged', function () {
            // Any additional UI updates you want to perform when selection changes
        });
    });
</script>
@endpush