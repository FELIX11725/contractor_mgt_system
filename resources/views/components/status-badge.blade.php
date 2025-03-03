<div>
    @props(['status'])

@php
    // Define the badge styles based on the status
    $badgeClasses = match(strtolower($status)) {
        'active' => 'bg-yellow-500 text-white',    // Yellow badge for Active
        'completed' => 'bg-green-500 text-white', // Green badge for Completed
        'pending' => 'bg-gray-500 text-white', 
        'overdue'=> 'bg-red-500 text-white',
        'inactive'=> 'bg-blue-500 text-white',
        'approved'=> 'bg-green-500 text-white',
        'not approved'=>'bg-red-500 text-white',
        default => 'bg-gray-500 text-white',      // Default gray badge
    };
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold $badgeClasses"]) }}>
    {{ ucfirst($status) }}
</div>

</div>