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
                                                shs.{{ number_format($contract->total_amount, 2) }}
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
                                            
                                            <button wire:click="openModal('view',{{ $contract->id }})"
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
                                            
                                            <button wire:click="openconfirmDelete({{ $contract->id }})"
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
    <x-dialog-modal wire:model="showModal" maxWidth="2xl">
        <x-slot name="title">
            @if($modalType === 'edit')
                Edit Contract
            @elseif($modalType === 'view')
                Contract Details
            @else
                Add New Contract
            @endif
        </x-slot>
    
        <x-slot name="content">
            @if($modalType === 'view')
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Project:</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $projects->find($project_id)->project_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contractor:</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ ($contractors->find($contractor_id))->user->name ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Start Date:</label>
                            <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($start_date)->format('M j, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">End Date:</label>
                            <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($end_date)->format('M j, Y') }}</p>
                        </div>
                    </div>
    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contract Type:</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $contractTypes->find($contract_type_id)->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Amount:</label>
                            <p class="mt-1 text-sm text-gray-900">${{ number_format($total_amount, 2) }}</p>
                        </div>
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Schedule:</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $payment_schedule ?? 'N/A' }}</p>
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contract Description:</label>
                        <div class="mt-1 text-sm text-gray-900 trix-content">
                            {!! $description !!}
                        </div>
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status:</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <x-status :status="$contract_status" />
                        </p>
                    </div>
    
                    @if(count($contractDocuments) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Attached Documents:</label>
                            <div class="mt-2 space-y-2">
                                @foreach($contractDocuments as $document)
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm">{{ $document->file_name }}</span>
                                        </div>
                                        <button wire:click="downloadDocument({{ $document->id }})" class="text-blue-500 hover:text-blue-700">
                                            Download
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="project_id" value="Project" />
                                <select wire:model="project_id" id="project_id" class="mt-1 block w-full">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="project_id" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="contractor_id" value="Contractor" />
                                <select wire:model="contractor_id" id="contractor_id" class="mt-1 block w-full">
                                    <option value="">Select Contractor</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{ $contractor->id }}">
                                            @if($contractor->user)
                                                {{ $contractor->user->name }} ({{ $contractor->position }})
                                            @else
                                                {{ $contractor->first_name }} {{ $contractor->last_name }} ({{ $contractor->position }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="contractor_id" class="mt-2" />
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="start_date" value="Start Date" />
                                <x-input wire:model="start_date" id="start_date" type="date" class="mt-1 block w-full" />
                                <x-input-error for="start_date" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="end_date" value="End Date" />
                                <x-input wire:model="end_date" id="end_date" type="date" class="mt-1 block w-full" />
                                <x-input-error for="end_date" class="mt-2" />
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="contract_type_id" value="Contract Type" />
                                <div class="flex">
                                    <select wire:model="contract_type_id" id="contract_type_id" class="mt-1 block w-full">
                                        <option value="">Select Type</option>
                                        @foreach($contractTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" wire:click="openContractTypeModal" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded">
                                        +
                                    </button>
                                </div>
                                <x-input-error for="contract_type_id" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="total_amount" value="Total Amount" />
                                <x-input wire:model="total_amount" id="total_amount" type="number" step="0.01" class="mt-1 block w-full" />
                                <x-input-error for="total_amount" class="mt-2" />
                            </div>
                        </div>
    
                        <div>
                            <x-label for="payment_schedule" value="Payment Schedule" />
                            <x-input wire:model="payment_schedule" id="payment_schedule" type="text" class="mt-1 block w-full" placeholder="e.g., 30% upfront, 40% on completion" />
                            <x-input-error for="payment_schedule" class="mt-2" />
                        </div>
    
                        <div>
                            <x-label for="description" value="Description" />
                            <input id="description" type="hidden" wire:model="description">
                            <div wire:ignore>
                                <trix-editor input="description" class="trix-content mt-1 block w-full"></trix-editor>
                            </div>
                            <x-input-error for="description" class="mt-2" />
                        </div>
    
                        @if($modalType === 'edit')
                            <div>
                                <x-label for="contract_status" value="Status" />
                                <select wire:model="contract_status" id="contract_status" class="mt-1 block w-full">
                                    <option value="pending">Pending</option>
                                    <option value="active">Active</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <x-input-error for="contract_status" class="mt-2" />
                            </div>
                        @endif
    
                        <div>
                            <x-label value="Attachments (Blueprints, Checklists, etc.)" />
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Upload files</span>
                                            <input type="file" class="sr-only" wire:model="attachments" multiple>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC, XLS up to 10MB</p>
                                </div>
                            </div>
                            @if($attachments)
                                <div class="mt-2 space-y-2">
                                    @foreach($attachments as $key => $attachment)
                                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                            <div class="flex items-center">
                                                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-sm">{{ $attachment->getClientOriginalName() }}</span>
                                            </div>
                                            <button type="button" wire:click="removeAttachment({{ $key }})" class="text-red-500 hover:text-red-700">
                                                Remove
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <x-input-error for="attachments.*" class="mt-2" />
                        </div>
                    </div>
                </form>
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
    
            @if($modalType !== 'view')
                <x-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    @if($modalType === 'edit')
                        Update
                    @else
                        Create
                    @endif
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>

    <!-- Status Update Modal -->
    <x-dialog-modal wire:model="showStatusModal">
        <x-slot name="title">
            Update Contract Status
        </x-slot>
    
        <x-slot name="content">
            <div class="mt-4">
                <x-label for="updatedStatus" value="New Status" />
                <select wire:model="updatedStatus" id="updatedStatus" class="mt-1 block w-full">
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                </select>
                <x-input-error for="updatedStatus" class="mt-2" />
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showStatusModal', false)" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
            <x-button class="ml-2" wire:click="updateStatus" wire:loading.attr="disabled">
                Update Status
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Confirmation Modal -->
    <x-dialog-modal wire:model="showconfirmDelete">
        <x-slot name="title">
            Delete Contract
        </x-slot>
    
        <x-slot name="content">
            Are you sure you want to delete this contract? This action cannot be undone.
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                Delete Contract
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>