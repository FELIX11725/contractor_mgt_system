@props(['submit','title','description' => null])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    {{-- Centered Form Section --}}
    <div class="mt-4 md:mt-0 md:col-span-3 flex justify-center">
        <div class="w-full max-w-4xl"> {{-- Adjust max-w-* for size control --}}
            <form wire:submit="{{ $submit }}">
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-7 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                    <div class="grid grid-cols-4 gap-6">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-700/20 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        {{ $actions }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
