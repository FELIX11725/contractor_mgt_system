<!-- resources/views/livewire/date-range-picker.blade.php -->
<div class="space-y-4">
    <div class="flex items-center space-x-4">
        <!-- Start Date -->
        <div class="flex-1">
            <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">From</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="date" id="startDate" wire:model="startDate"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-2 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    placeholder="Select start date">
            </div>
        </div>

        <!-- End Date -->
        <div class="flex-1">
            <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">To</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="date" id="endDate" wire:model="endDate"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-2 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    placeholder="Select end date">
            </div>
        </div>
    </div>

    <!-- Quick Select Options -->
    <div class="flex flex-wrap gap-2">
        <button type="button" wire:click="setDateRange('today')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Today
        </button>
        <button type="button" wire:click="setDateRange('yesterday')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Yesterday
        </button>
        <button type="button" wire:click="setDateRange('last7days')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Last 7 Days
        </button>
        <button type="button" wire:click="setDateRange('last30days')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Last 30 Days
        </button>
        <button type="button" wire:click="setDateRange('thismonth')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            This Month
        </button>
        <button type="button" wire:click="setDateRange('lastmonth')" 
            class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Last Month
        </button>
    </div>

    <!-- Validation Error -->
    @error('startDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    @error('endDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>