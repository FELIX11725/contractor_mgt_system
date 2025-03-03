@props(['type' => 'button', 'wire' => null])

<button 
    {{ $attributes->merge(['class' => 'px-2 py-1 text-sm bg-gray-900 text-white rounded-md shadow-sm hover:bg-gray-800 focus:ring-2 focus:ring-gray-700 focus:outline-none']) }} 
    type="{{ $type }}"
    @if($wire) wire:click="{{ $wire }}" @endif
>
    {{ $slot }}
</button>
