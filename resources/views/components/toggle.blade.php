<div class="flex items-center justify-between">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mr-3">{{ $label }}</label>
    @endif
    <button 
        type="button"
        @if($model) wire:model="{{ $model }}" @endif
        @if($value) value="{{ $value }}" @endif
        class="{{ $attributes->get('value') ? 'bg-indigo-600' : 'bg-gray-200 dark:bg-gray-700' }} relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        role="switch"
        aria-checked="false"
    >
        <span class="sr-only">{{ $label }}</span>
        <span 
            aria-hidden="true"
            class="{{ $attributes->get('value') ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
        ></span>
    </button>
</div>