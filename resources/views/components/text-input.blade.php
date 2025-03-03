@props([
    'id',
    'type' => 'text',
    'wire' => null,
    'class' => '',
])

<input 
    {{ $attributes->merge(['class' => "mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 $class"]) }}
    id="{{ $id }}" 
    type="{{ $type }}" 
    @if($wire) wire:model.defer="{{ $wire }}" @endif
/>
