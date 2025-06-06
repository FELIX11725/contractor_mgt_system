@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-1 md:gap-6']) }}>
    @if(isset($title) || isset($description))
    <x-section-title>
        @isset($title)
        <x-slot name="title">{{ $title }}</x-slot>
        @endisset
        @isset($description)
        <x-slot name="description">{{ $description }}</x-slot>
        @endisset
    </x-section-title>
    @endif

    <div class="mt-5 md:mt-0 md:col-span-1">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-4 py-5 bg-white dark:bg-slate-800 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 bg-slate-50 dark:bg-slate-700/20 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
