<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Dashboard actions -->
        {{-- <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Contractors</h2>
            </div>

           
        </div> --}}

        <!-- Contractors Table -->
        <section class="container px-4 mx-auto">
            <div class="flex justify-between items-center">
                <!-- Left Section: Header and Count -->
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Milestones</h2>
                    <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
                        {{ $milestones->total() }} Milestones
                    </span>
                </div>
            
                <!-- Right Section: Search and Add Button -->
                <div class="flex items-center gap-2">
                   <!-- Search Form -->
<form wire:submit.prevent="search" class="relative">
    <label for="action-search" class="sr-only">Search</label>
    <input id="action-search" wire:model="searchQuery" class="form-input pl-9 bg-white dark:bg-gray-800" type="search"
        placeholder="Search…" />
    <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
        <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-400 ml-3 mr-2"
            width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
            <path
                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
        </svg>
    </button>
</form>
            
                    <!-- Add New Button -->
                    <div x-data="{ modalOpen: @entangle('showModal') }">
                        <button wire:click="openModal('add')" class="btn bg-gray-900 text-white">
                            Add New
                        </button>
            
                        <!-- Modal for Adding/Editing/Viewing Contractors -->
                        <div class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-show="modalOpen" x-cloak>
                            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="modalOpen = false">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
            
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <div class="border-b border-gray-200 pb-2 mb-4 px-4 pt-4">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-medium text-gray-900" id="modal-headline">
                                                @if($modalType === 'edit') Edit Milestone
                                                @elseif($modalType === 'view') View Milestone 
                                                @else Add Milestone 
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
                                    <div class="px-4 pb-4">  {{-- Container for view mode --}}
                                        <div class="mt-2">
                                            <label for="milestone_name" class="block text-sm font-medium text-gray-700">Milestone Name:</label>
                                            <span id="milestone_name" class="block text-sm text-gray-900">{{ $milestone_name }}</span>
                                        </div>
                                        <div class="mt-2">
                                            <label for="due_date" class="block text-sm font-medium text-gray-700">Due date:</label>
                                            <span id="due_date" class="block text-sm text-gray-900"> {{\Carbon\Carbon::parse($due_date)->format('M j, Y') }}</span>
                                        </div>
                
                                        <div class="mt-2">
                                            <label for="project_id" class="block text-sm font-medium text-gray-700">Project:</label>
                                            <span id="project_id" class="block text-sm text-gray-900">
                                                {{ $projects->find($project_id)->project_name ?? 'N/A' }} </span>                        
                                        </div>
                                        <div class="mt-2">
                                            <label for="description" class="block text-sm font-medium text-gray-700">Milestone Description:</label>
                                            <div id="description" class="block text-sm text-gray-900 trix-content">{!! $description !!}</div> </div>
                                           
                                           
                
                
                
                
                                        <div class="mt-4 border-t border-gray-200 pt-4">
                                            <div class="flex justify-end">
                                                <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="modalOpen = false">Close</button>
                                            </div>
                                        </div>
                
                
                                    </div>
                                    @else
                                   <form wire:submit.prevent="{{ $modalType === 'edit' ? 'update' : 'save' }}" class="px-4 pb-4">

                                        @csrf
                                        <div class="mt-2">
                                            <label for="milestone_name" class="block text-sm font-medium text-gray-700">Milestone Name <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <input type="text" wire:model="milestone_name" id="milestone_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <x-input-error for="milestone_name" />
                                        </div>
                                        
                                        <div class="mt-2">
                                            <label for="project_type" class="block text-sm font-medium text-gray-900">
                                                Project<span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center">
                                                <select wire:model="project_id" id="project_id"
                                                    class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                                    <option value="">--Select Project--</option>
                                                    @foreach($projects as $project)
                                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <button type="button" wire:click="openModal"
                                                    class="ml-2 px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                    +
                                                </button> --}}
                                            </div>
                                            <x-input-error for="project_id" />
                                        </div>
                                        <div class="mt-2">
                                            <label for="description" class="block text-sm font-medium text-gray-900">
                                                Milestone Description <span class="text-red-500">*</span>
                                            </label>
                                            <!-- Hidden Input for Livewire Binding -->
                                            <input id="description" type="hidden" wire:model="description">
                                            <!-- Trix Editor -->
                                            <div wire:ignore>
                                                <trix-editor
                                                    input="description"
                                                    class="trix-content block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
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
                                        <div class="mt-2">
                                            <label for="due_date" class="block text-sm font-medium text-gray-900">
                                                Due Date <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" wire:model="due_date" id="due_date"
                                                class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                            <x-input-error for="due_date" />
                                        </div>
                                       
            
                                        <div class="mt-4 border-t border-gray-200 pt-4">
                                            <div class="flex justify-end">
                                                <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="modalOpen = false">Cancel</button>
                                                @if($modalType !== 'view')
                                                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                        @if($modalType === 'edit') Update @else Submit @endif
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
                </div>
            </div>
            
            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center gap-x-3">
                                                <input type="checkbox" wire:model="selectAll" class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                                <span>Milestone Name</span>
                                            </div>
                                        </th>
                                        {{-- <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"> Name</th> --}}
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Project</th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Due date</th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">status</th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach($milestones as $milestone)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                <div class="inline-flex items-center gap-x-3">
                                                    <input type="checkbox" wire:model="selectedMilestones" value="{{ $milestone->id }}" class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                                    <div class="flex items-center gap-x-2">
                                                        <h2 class="font-medium text-gray-800 dark:text-white">{{ $milestone->milestone_name }}</h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">{{ $milestone->project->project_name }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap"> {{ \Carbon\Carbon::parse($milestone->due_date)->format('M j, Y') }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    <x-status :status="$milestone->milestone_status" />
                                                   
                                                </div>
                                            </td>
                                            
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <div class="flex items-center gap-x-6">
                                                    <button wire:click="openStatusModal({{ $milestone->id }})" class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2"> <path d="M6 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path> <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path> <path d="M6 12v-2a6 6 0 1 1 12 0v2"></path> <path d="M15 9l3 3l3 -3"></path> </svg> 
                                                    </button>
                                                    <button wire:click="openViewModal({{ $milestone->id }})" class="text-gray-500 transition-colors duration-200 dark:hover:text-green-500 dark:text-gray-300 hover:text-green-500 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </button>
                                                    <button wire:click="openModal('edit',{{ $milestone->id }})" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </button>
                                                   <!-- Delete Confirmation Modal -->
<div x-data="{ deleteModalOpen: false, milestoneIdToDelete: null }">
    <!-- Delete Button -->
    <div class="flex items-center gap-x-6">
    <button 
        @click="deleteModalOpen = true; milestoneIdToDelete = {{ $milestone->id }}"
        class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
        </svg>
    </button>

    <!-- Confirmation Modal -->
    <div 
    x-show="deleteModalOpen" 
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    @click.away="deleteModalOpen = false"
>
    <div 
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md"
        @click.stop
    >
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Confirm Deletion</h3>
        <p class="mt-2 text-gray-600 dark:text-gray-400 break-words">
            Are you sure you want to delete this milestone? 
        </p>
        <div class="mt-6 flex justify-end space-x-4">
            <button 
                @click="deleteModalOpen = false" 
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none"
            >
                Cancel
            </button>
            <button 
                wire:click="delete(contractorIdToDelete)"
                @click="deleteModalOpen = false"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none"
            >
                Delete
            </button>
        </div>
    </div>
</div>

</div>
<div x-data="{ statusModalOpen: @entangle('showStatusModal') }">
    <div x-show="statusModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Status</h3>
            <form wire:submit.prevent="updateStatus">
                <div class="mt-4">
                    <label for="updatedStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select wire:model="updatedStatus" id="updatedStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="pending">Pending</option>
                        <option value="overdue">Overdue</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button @click="statusModalOpen = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <a href="#" wire:click="previousPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Previous</span>
                </a>
                <div class="items-center hidden lg:flex gap-x-3">
                    @for ($i = 1; $i <= $milestones->lastPage(); $i++)
                        <a href="#" wire:click="gotoPage({{ $i }})" class="px-2 py-1 text-sm {{ $i === $milestones->currentPage() ? 'text-blue-500 bg-blue-100/60' : 'text-gray-500' }} rounded-md hover:bg-gray-100">{{ $i }}</a>
                    @endfor
                </div>
                <a href="#" wire:click="nextPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>

        
    </div>
</div>





