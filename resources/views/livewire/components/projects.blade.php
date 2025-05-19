<div>
    <div wire:poll class="p-5 bg-gray-50 min-h-screen">
        <div class="bg-white overflow-hidden shadow-xl rounded-lg">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Projects Management
                        </h2>
                        <p class="text-sm text-indigo-100 mt-1">View and manage all construction projects</p>
                    </div>

                    <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
                        <div class="flex items-center bg-white/10 rounded-lg p-1">
                            <div class="relative">
                                <input wire:model.live.debounce="searchQuery" type="text" placeholder="Search projects..." 
                                    class="pl-8 pr-3 py-2 bg-white/20 border-0 rounded-lg text-white placeholder-white/70 focus:ring-white/30 focus:border-0 text-sm w-full" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-2.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <x-button onclick="window.location.href='{{ route('addproject') }}'" class="bg-white/20 hover:bg-white/30 text-white border-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Project
                        </x-button>
                    </div>
                </div>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-6 bg-gray-50 border-b border-gray-200">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Projects</p>
                        <p class="text-xl font-bold">{{ $projects->total() }}</p>
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
                        <p class="text-xl font-bold">{{ $projects->where('project_status', 'active')->count() }}</p>
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
                        <p class="text-xl font-bold">{{ $projects->where('project_status', 'pending')->count() }}</p>
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
                        <p class="text-xl font-bold">{{ $projects->where('project_status', 'completed')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                {{-- @if($selectedContractors && count($selectedContractors) > 0)
                <div class="bg-blue-50 p-3 rounded-lg mb-4 flex justify-between items-center">
                    <span class="text-blue-700 font-medium">{{ count($selectedContractors) }} projects selected</span>
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
                                <th scope="col" wire:click="sortBy('project_name')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Project Name
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('location')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Location
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortBy('project_type_id')" 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                    <div class="flex items-center">
                                        Project Type
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($projects->isEmpty())
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-500 text-lg font-medium">No projects found</span>
                                            <p class="text-gray-400 mt-1">Try adjusting your search criteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($projects as $project)
                                    <tr wire:key="{{ 'project-' . $project->id }}" class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            <input type="checkbox" wire:model="selectedContractors" value="{{ $project->id }}" 
                                                class="rounded text-blue-600 focus:ring-blue-500" />
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $project->project_name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $project->location }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $project->project_type->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($project->start_date)->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                @if($project->end_date)
                                                    {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($project->project_status === 'active')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @elseif($project->project_status === 'pending')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($project->project_status === 'in_progress')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Progress
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 flex space-x-2">
                                            <a href="{{ route('projects.show', $project->id) }}" 
                                                class="bg-green-500 text-white px-3 py-1 rounded-md text-xs hover:bg-green-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            
                                            <button wire:click="openModal('edit', {{ $project->id }})"
                                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs hover:bg-blue-600 transition-colors flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            
                                            <button wire:click="openconfirmDelete({{ $project->id }})"
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
                    {{ $projects->links() }}
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
                                    Edit Project
                                @elseif($modalType === 'view')
                                    View Project
                                @else
                                    Add Project
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
                                <label class="block text-sm font-medium text-gray-700">Project Name:</label>
                                <span class="block text-sm text-gray-900">{{ $project_name }}</span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Project Location:</label>
                                <span class="block text-sm text-gray-900">{{ $location }}</span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Project Type:</label>
                                <span class="block text-sm text-gray-900">
                                    {{ $projectTypes->find($project_type_id)->name ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Project Description:</label>
                                <div class="block text-sm text-gray-900 trix-content">
                                    {!! $project_description !!}
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Project Start Date:</label>
                                <span class="block text-sm text-gray-900">{{ \Carbon\Carbon::parse($start_date)->format('M j, Y') }}</span>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700">Estimated Project End Date:</label>
                                <span class="block text-sm text-gray-900">
                                    @if($end_date)
                                        {{ \Carbon\Carbon::parse($end_date)->format('M j, Y') }}
                                    @else
                                        N/A
                                    @endif
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
                                <label for="project_name" class="block text-sm font-medium text-gray-700">
                                    Project Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="project_name" id="project_name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                <x-input-error for="project_name" />
                            </div>
                            <div class="mt-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">
                                    Project location <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="location" id="location"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                                <x-input-error for="location" />
                            </div>
                            <div class="mt-2">
                                <label for="project_type" class="block text-sm font-medium text-gray-900">
                                    Project Type <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center">
                                    <select wire:model="project_type_id" id="project_type_id"
                                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                        <option value="">--Select Project Type--</option>
                                        @foreach ($projectTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error for="project_type_id" />
                            </div>
                            <div class="mt-2">
                                <label for="project_description" class="block text-sm font-medium text-gray-900">
                                    Project Description <span class="text-red-500">*</span>
                                </label>
                                <input id="project_description" type="hidden" wire:model="project_description">
                                <div wire:ignore>
                                    <trix-editor input="project_description"
                                        class="trix-content block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                                        x-data x-init="const trixEditor = $el;
                                        trixEditor.addEventListener('trix-change', function(event) {
                                            @this.set('project_description', trixEditor.value);
                                        });">
                                    </trix-editor>
                                </div>
                                <x-input-error for="project_description" />
                            </div>
                            <div class="mt-2">
                                <label for="start_date" class="block text-sm font-medium text-gray-900">
                                    Project Start Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="start_date" id="start_date"
                                    class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                <x-input-error for="start_date" />
                            </div>
                            <div class="mt-2">
                                <label for="end_date" class="block text-sm font-medium text-gray-900">
                                    Estimated Project End Date
                                </label>
                                <input type="date" wire:model="end_date" id="end_date"
                                    class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                <x-input-error for="end_date" />
                            </div>

                            <div class="mt-4 border-t border-gray-200 pt-4">
                                <div class="flex justify-end">
                                    <button type="button" @click="modalOpen = false"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        @if ($modalType === 'edit')
                                            Update
                                        @else
                                            Submit
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-confirmation-modal wire:model="showconfirmDelete">
        <x-slot name="title">
            Delete Project
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this project? This action cannot be undone.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showconfirmDelete', false)" class="mr-2">
                Cancel
            </x-secondary-button>
            <x-danger-button wire:click="delete">
                Delete
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>