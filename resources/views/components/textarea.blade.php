<div>
    @props(['label', 'name', 'placeholder' => '', 'rows' => 3])

    <div class="space-y-1">
        @if(isset($label))
            <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $label }}
            </label>
        @endif
        <textarea 
            {{ $attributes->merge(['class' => 'w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
        >{{ $slot }}</textarea>
    </div>
</div>