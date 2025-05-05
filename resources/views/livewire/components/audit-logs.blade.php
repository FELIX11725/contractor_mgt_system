<div>
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-3 md:space-y-0">
            <h2 class="text-2xl font-bold text-gray-800">
                <span class="inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Audit Logs
                </span>
            </h2>
            
            <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Search logs..." 
                        class="pl-10 input w-full md:w-64 bg-white border-2 border-gray-200 rounded-full py-2 px-4 shadow-sm hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                    >
                </div>
                
                <div class="relative">
                    <select wire:model.live="actionFilter" class="appearance-none w-full md:w-auto bg-white border-2 border-gray-200 rounded-full py-2 pl-4 pr-10 shadow-sm hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}">{{ ucfirst($action) }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                
                <div class="relative">
                    <select wire:model.live="userFilter" class="appearance-none w-full md:w-auto bg-white border-2 border-gray-200 rounded-full py-2 pl-4 pr-10 shadow-sm hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row md:space-x-3 mb-6 space-y-3 md:space-y-0">
            <div class="relative bg-white rounded-full shadow-sm border-2 border-gray-200 hover:border-indigo-300 transition-all duration-200 p-1 flex items-center">
                <div class="flex items-center space-x-2 text-indigo-600 bg-indigo-50 rounded-full px-3 py-1 ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">From:</span>
                </div>
                <input 
                    type="date" 
                    wire:model.live="dateFrom" 
                    class="border-none bg-transparent focus:outline-none focus:ring-0 pl-2 pr-1 py-1 w-full md:w-auto"
                >
            </div>
            
            <div class="relative bg-white rounded-full shadow-sm border-2 border-gray-200 hover:border-indigo-300 transition-all duration-200 p-1 flex items-center">
                <div class="flex items-center space-x-2 text-indigo-600 bg-indigo-50 rounded-full px-3 py-1 ml-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">To:</span>
                </div>
                <input 
                    type="date" 
                    wire:model.live="dateTo" 
                    class="border-none bg-transparent focus:outline-none focus:ring-0 pl-2 pr-1 py-1 w-full md:w-auto"
                >
            </div>
            
            <div class="ml-auto md:flex items-center space-x-2 hidden">
                <button 
                wire:click="export" 
                wire:loading.attr="disabled"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-full px-4 py-2 flex items-center space-x-2 transition-all duration-200 shadow-md hover:shadow-lg"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span wire:loading.remove>Export</span>
                <span wire:loading>Exporting...</span>
            </button>
            </div>
        </div>
        
        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
            <table class="table w-full">
                <thead>
                    <tr class="bg-gray-50 text-gray-700">
                        <th class="px-4 py-3 font-semibold text-left text-sm tracking-wider">Date/Time</th>
                        <th class="px-4 py-3 font-semibold text-left text-sm tracking-wider">User</th>
                        <th class="px-4 py-3 font-semibold text-left text-sm tracking-wider">Action</th>
                        <th class="px-4 py-3 font-semibold text-left text-sm tracking-wider">Description</th>
                        <th class="px-4 py-3 font-semibold text-left text-sm tracking-wider">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                            <td class="px-4 py-3 text-sm text-gray-700">
                                <div class="font-medium">{{ $log->created_at->format('Y-m-d') }}</div>
                                <div class="text-gray-500 text-xs">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-700">
                                        @if($log->user)
                                            {{ substr($log->user->name, 0, 1) }}
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $log->user?->name ?? 'System' }}</div>
                                        @if($log->ip_address)
                                            <div class="text-xs text-gray-500">{{ $log->ip_address }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($log->action == 'created')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Created
                                    </span>
                                @elseif($log->action == 'updated')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Updated
                                    </span>
                                @elseif($log->action == 'deleted')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Deleted
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $log->description }}</td>
                            <td class="px-4 py-3 text-sm">
                                <button 
                                    class="px-3 py-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-md text-xs font-medium transition-colors duration-150 ease-in-out flex items-center space-x-1"
                                    onclick="document.getElementById('log_details_{{ $log->id }}').showModal()"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>Details</span>
                                </button>
                                
                                <dialog id="log_details_{{ $log->id }}" class="modal">
                                    <div class="modal-box bg-white max-w-2xl">
                                        <h3 class="font-bold text-xl text-gray-800 mb-2">Audit Log Details</h3>
                                        <div class="py-4 space-y-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500">Action</p>
                                                    <p class="text-base font-medium text-gray-800 mt-1">{{ ucfirst($log->action) }}</p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500">User</p>
                                                    <p class="text-base font-medium text-gray-800 mt-1">{{ $log->user?->name ?? 'System' }}</p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500">Date</p>
                                                    <p class="text-base font-medium text-gray-800 mt-1">{{ $log->created_at->format('Y-m-d H:i:s') }}</p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg">
                                                    <p class="text-sm font-medium text-gray-500">IP Address</p>
                                                    <p class="text-base font-medium text-gray-800 mt-1">{{ $log->ip_address }}</p>
                                                </div>
                                            </div>
                                            
                                            @if($log->old_values)
                                                <div class="mt-6">
                                                    <h4 class="font-bold text-gray-700 mb-2 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                        Old Values:
                                                    </h4>
                                                    <pre class="bg-gray-50 p-4 rounded-lg text-sm text-gray-700 overflow-x-auto">{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            @endif
                                            
                                            @if($log->new_values)
                                                <div class="mt-4">
                                                    <h4 class="font-bold text-gray-700 mb-2 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        New Values:
                                                    </h4>
                                                    <pre class="bg-gray-50 p-4 rounded-lg text-sm text-gray-700 overflow-x-auto">{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <button class="btn btn-sm bg-indigo-600 hover:bg-indigo-700 text-white">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-medium">No audit logs found</p>
                                    <p class="text-sm">Try adjusting your search or filter criteria</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $logs->links() }}
        </div>
    </div>
    
    @script
    <script>
        // Add method to component for action colors
        Livewire.on('getActionColor', (action) => {
            switch(action) {
                case 'created': return 'green';
                case 'updated': return 'blue';
                case 'deleted': return 'red';
                default: return 'yellow';
            }
        });
    </script>
    @endscript
</div>