<div>
    <div wire:poll class="p-5 bg-gray-50 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Contracts Management
                        </h2>
                        <p class="text-sm text-indigo-100 mt-1">Manage all construction contracts and agreements</p>
                    </div>

                    <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
                        <div class="flex items-center bg-white/10 rounded-lg p-1">
                            <div class="relative">
                                <input wire:model.live.debounce="searchQuery" type="text" placeholder="Search contracts..." 
                                    class="pl-8 pr-3 py-2 bg-white/20 border-0 rounded-lg text-white placeholder-white/70 focus:ring-white/30 focus:border-0 text-sm w-full" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-2.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <x-button onclick="window.location.href='{{ route('addcontracts') }}'" class="bg-white/20 hover:bg-white/30 text-white border-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Contract
                        </x-button>
                    </div>
                </div>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-gray-50 border-b border-gray-200">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Contracts</p>
                        <p class="text-xl font-bold">{{ $contracts->total() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Active</p>
                        <p class="text-xl font-bold">{{ $contracts->where('contract_status', 'active')->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-yellow-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-xl font-bold">{{ $contracts->where('contract_status', 'pending')->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-red-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Completed</p>
                        <p class="text-xl font-bold">{{ $contracts->where('contract_status', 'completed')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                {{-- @if($selectedMilestones && count($selectedMilestones) > 0)
                <div class="bg-blue-50 p-3 rounded-lg mb-4 flex justify-between items-center">
                    <span class="text-blue-700 font-medium">{{ count($selectedMilestones) }} contracts selected</span>
                    <div>
                        <x-danger-button wire:click="deleteSelected" class="ml-2">
                            Delete Selected
                        </x-danger-button>
                    </div>
                </div>
                @endif --}}

                <div class="overflow-hidden border border-gray-200 sm:rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-3 text-left">
                                    <input type="checkbox" wire:model="selectAll" class="rounded text-blue-600 focus:ring-blue-500" />
                                </th>
                                <th scope="col" wire:click="sortBy('project_id')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Project
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('start_date')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Start Date
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('end_date')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        End Date
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('contract_type_id')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Contract Type
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('total_amount')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Amount
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($contracts->isEmpty())
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-500 text-lg font-medium">No contracts found</span>
                                            <p class="text-gray-400 mt-1">Try adjusting your search criteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($contracts as $contract)
                                    <tr wire:key="{{ 'contract-' . $contract->id }}" class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" wire:model="selectedMilestones" value="{{ $contract->id }}" 
                                                class="rounded text-blue-600 focus:ring-blue-500" />
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $contract->project->project_name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($contract->start_date)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($contract->end_date)->format('M d, Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $contract->contractType->name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-gray-900">
                                                ${{ number_format($contract->total_amount, 2) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($contract->contract_status === 'active')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @elseif($contract->contract_status === 'pending')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2">
                                            <button wire:click="openStatusModal({{ $contract->id }})" 
                                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    <path d="M6 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M6 12v-2a6 6 0 1 1 12 0v2"></path>
                                                    <path d="M15 9l3 3l3 -3"></path>
                                                </svg>
                                                Status
                                            </button>
                                            
                                            <button wire:click="openViewModal({{ $contract->id }})"
                                                class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                View
                                            </button>
                                            
                                            <button wire:click="openModal('edit', {{ $contract->id }})"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-md text-xs hover:bg-yellow-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            
                                            @if($contract)
                                            <button wire:click="generatePdf({{ $contract->id }})"
                                                class="bg-indigo-500 text-white px-3 py-1 rounded-md text-xs hover:bg-indigo-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                PDF
                                            </button>
                                            @endif
                                            
                                            <button wire:click="confirmDelete({{ $contract->id }})"
                                                class="bg-red-500 text-white px-3 py-1 rounded-md text-xs hover:bg-red-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $contracts->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit/View Modal -->
    <div x-data="{ modalOpen: @entangle('showModal') }" x-cloak>
        <div class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-show="modalOpen">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="modalOpen = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="border-b border-gray-200 pb-2 mb-4 px-4 pt-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-headline">
                                @if ($modalType === 'edit')
                                    Edit Contract
                                @elseif($modalType === 'view')
                                    View Contract
                                @else
                                    Add Contract
                                @endif
                            </h3>
                            <button class="text-gray-400 hover:text-gray-500" @click="modalOpen = false">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    @if ($modalType === 'view')
                        <div class="px-4 pb-4">
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Project:</label>
                                <span class="block text-sm text-gray-900">{{ $projects->project_name }}</span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Contractor:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ $contractors->first_name }} {{ $contractors->last_name }}
                                </span>                        
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Start date:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($start_date)->format('M j, Y') }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">End date:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($end_date)->format('M j, Y') }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Contract Type:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ $contractTypes->find($contract_type_id)->name ?? 'N/A' }}
                                </span>                        
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Contract Description:</label>
                                <div class="block text-sm text-gray-900 trix-content">
                                    {!! $description !!}
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Total Amount:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ number_format($total_amount, "0",".",",") }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Contract Status:</label>
                                <span class="block text-sm text-gray-900">
                                    <x-status :status="$contract_status" />
                                </span>
                            </div>

                            <div class="mt-4 border-t border-gray-200 pt-4">
                                <div class="flex justify-end">
                                    <button type="button" @click="modalOpen = false"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="{{ $modalType === 'edit' ? 'update' : 'save' }}" class="px-4 pb-4">
                            @csrf
                            <div class="mt-2">
                                <label for="project_id" class="block text-sm font-medium text-gray-700">
                                    Project <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="project_id" id="project_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="project_id" />
                            </div>
                            
                            <div class="mt-2">
                                <label for="contractor_id" class="block text-sm font-medium text-gray-700">
                                    Contractor <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="contractor_id" id="contractor_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select Contractor</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id }}">{{ $contractor->first_name }} {{ $contractor->last_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="contractor_id" />
                            </div>
                            <div class="mt-2">
                                <label for="contract_type" class="block text-sm font-medium text-gray-700">
                                    Contract Type <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="contract_type_id" id="contract_type_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">--Select Contract Type--</option>
                                    @foreach($contractTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="contract_type_id" />
                            </div>
                            <div class="mt-2">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">
                                    Start Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="start_date" id="start_date"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-input-error for="start_date" />
                            </div>
                            <div class="mt-2">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">
                                    End Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="end_date" id="end_date"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-input-error for="end_date" />
                            </div>
                            <div class="mt-2">
                                <label for="total_amount" class="block text-sm font-medium text-gray-700">
                                    Total Amount <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model="total_amount" id="total_amount"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <x-input-error for="total_amount" />
                            </div>
                            <div class="mt-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Contract Description
                                </label>
                                <input id="description" type="hidden" wire:model="description">
                                <div wire:ignore>
                                    <trix-editor
                                        input="description"
                                        class="trix-content mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        x-data
                                        x-init="
                                            const trixEditor = $el;
                                            trixEditor.addEventListener('trix-change', function(event) {
                                                @this.set('description', trixEditor.value);
                                            });
                                        ">
                                    </trix-editor>
                                </div>
                                <x-input-error for="description" />
                            </div>

                            <div class="mt-4 border-t border-gray-200 pt-4">
                                <div class="flex justify-end">
                                    <button type="button" @click="modalOpen = false"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </button>
                                    @if($modalType !== 'view')
                                        <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            @if($modalType === 'edit')
                                                Update
                                            @else
                                                Submit
                                            @endif
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div x-data="{ statusModalOpen: @entangle('showStatusModal') }" x-cloak>
        <div class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-show="statusModalOpen">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="statusModalOpen = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Update Contract Status</h3>
                        <div class="mt-4">
                            <label for="updatedStatus" class="block text-sm font-medium text-gray-700">Status</label>
                            <select wire:model="updatedStatus" id="updatedStatus"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="updateStatus" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Update
                        </button>
                        <button @click="statusModalOpen = false" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-confirmation-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            Delete Contract
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this contract? This action cannot be undone.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingDeletion', false)" class="mr-2">
                Cancel
            </x-secondary-button>
            <x-danger-button wire:click="delete">
                Delete
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>