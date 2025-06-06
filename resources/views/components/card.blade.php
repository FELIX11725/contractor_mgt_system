<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 rounded-lg shadow']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/20 rounded-b-lg">
            {{ $footer }}
        </div>
    @endif
</div>