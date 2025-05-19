{{-- resources/views/components/input.blade.php --}}
<div class="w-full">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif
    
    <input 
        type="{{ $type }}" 
        @if($wireModel) wire:model="{{ $wireModel }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    >
    
    @error($wireModel)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>