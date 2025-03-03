<div class="table-container">
    <div class="flex justify-between items-center mb-4">
        <input
            type="text"
            wire:model="search"
            placeholder="Search..."
            class="px-4 py-2 border rounded"
        />
        {{ $slot }}
    </div>
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($headers as $header)
                    <th class="px-4 py-2 border">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td class="px-4 py-2 border">{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
