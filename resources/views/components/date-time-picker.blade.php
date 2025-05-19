{{-- resources/views/components/datetime-picker.blade.php --}}
<div class="w-full">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif
    
    <div x-data="{
        value: @entangle($attributes->wire('model')),
        init() {
            const picker = flatpickr(this.$refs.picker, {
                enableTime: {{ $withoutTime ? 'false' : 'true' }},
                dateFormat: '{{ $withoutTime ? 'Y-m-d' : 'Y-m-d H:i' }}',
                defaultDate: this.value,
                onChange: (selectedDates, dateStr) => {
                    this.value = dateStr
                }
            });
            
            // Update the picker when the Livewire model changes
            this.$watch('value', (newValue) => {
                picker.setDate(newValue);
            });
        }
    }" wire:ignore>
        <input 
            x-ref="picker" 
            type="text" 
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            placeholder="Select date{{ $withoutTime ? '' : ' and time' }}"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
    
    @error($model)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>