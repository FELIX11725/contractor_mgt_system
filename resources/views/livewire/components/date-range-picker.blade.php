<!-- resources/views/livewire/date-range-picker.blade.php -->
<div class="flex space-x-2">
    <div>
        <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
        <input type="date" id="startDate" wire:model="startDate" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
    <div>
        <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
        <input type="date" id="endDate" wire:model="endDate" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
</div>