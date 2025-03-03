{{-- resources/views/components/table-actions.blade.php --}}

@props(['onDelete', 'selectedItems' => []])

<div class="cm3b7 c51uw ccww4 csdex cbe1i c4sak">
    <div class="table-items-action hidden" x-show="@js(count($selectedItems)) > 0">
        <div class="flex items-center">
            <div class="hidden text-sm mr-2 cq84g c3nql caf78"><span>{{ count($selectedItems) }}</span> items selected</div>
            <button wire:click="{{ $onDelete }}" class="btn bg-white border-gray-200 cc0oq cghq3 cspbm c2vpa czr3n">Delete</button>
        </div>
    </div>

    <div class="cm84d">   
        {{ $dateRange ?? '' }} {{-- Slot for the Date Range Dropdown --}}
    </div>

    {{ $filter ?? '' }} {{-- Slot for the Filter button --}}

    {{ $add ?? '' }}     {{-- Slot for the Add button --}}
</div>