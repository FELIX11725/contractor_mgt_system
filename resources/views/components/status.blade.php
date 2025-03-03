<div>
    @php
        $styles = [
            'paid' => 'text-emerald-500 bg-emerald-100/60',
            'cancelled' => 'text-red-500 bg-red-100/60',
            'refunded' => 'text-gray-500 bg-gray-100/60',
            'active'=> 'text-gray-500 bg-yellow-100/60',
            'completed' => 'text-emerald-500 bg-emerald-100/60',
            'pending' =>'text-red-500 bg-red-100/60',
            'overdue' => 'text-red-500 bg-red-100/60',
            'approved'=> 'text-emerald-500 bg-emerald-100/60',
            'not approved'=> 'text-red-500 bg-red-100/60',
            'pending review'=> 'text-gray-500 bg-gray-100/60',
            'valid'=>  'text-emerald-500 bg-emerald-100/60',
            'expired'=> 'text-red-500 bg-red-100/60',
        ];

        $icons = [
            'paid' => '<path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'active' => '<path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'cancelled' => '<path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'refunded' => '<path d="M4.5 7L2 4.5M2 4.5L4.5 2M2 4.5H8C8.53043 4.5 9.03914 4.71071 9.41421 5.08579C9.78929 5.46086 10 5.96957 10 6.5V10" stroke="#667085" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'completed' => '<path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'pending' =>'<path d="M4.5 7L2 4.5M2 4.5L4.5 2M2 4.5H8C8.53043 4.5 9.03914 4.71071 9.41421 5.08579C9.78929 5.46086 10 5.96957 10 6.5V10" stroke="#667085" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'approved' => '<path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'not approved' => '<path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'pending review' =>'<path d="M4.5 7L2 4.5M2 4.5L4.5 2M2 4.5H8C8.53043 4.5 9.03914 4.71071 9.41421 5.08579C9.78929 5.46086 10 5.96957 10 6.5V10" stroke="#667085" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'valid' => '<path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
            'expired' =>  '<path d="M9 3L3 9M3 3L9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        ];
    @endphp

    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 dark:bg-gray-800 {{ $styles[$status] ?? '' }}">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            {!! $icons[$status] ?? '' !!}
        </svg>

        <h2 class="text-sm font-normal capitalize">{{ $status }}</h2>
    </div>
</div>