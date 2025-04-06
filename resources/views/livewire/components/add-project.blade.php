<div class="space-y-8 max-w-5xl mx-auto">
    <!-- Enhanced Header Section with Gradient and Drop Shadow -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0 bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Add New Project</h1>
                        <p class="text-blue-100 mt-1 text-sm">Create a new project with all necessary details</p>
                    </div>
                </div>
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    New Project
                </span>
            </div>
        </div>
    </div>

    <!-- Main Form Section -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <form wire:submit.prevent="save" class="space-y-6 p-8">
            <!-- Project Information Section -->
            <div class="pb-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Project Details</h3>
                        <p class="mt-1 text-sm text-gray-500">Enter the essential information about your project</p>
                    </div>
                </div>
            </div>

            <!-- Project Fields Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Project Name -->
                <div class="relative group">
                    <x-label for="project_name" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Project Name <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <x-input id="project_name" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                            wire:model.defer="project_name" placeholder="Project Phoenix" />
                    </div>
                    <x-input-error for="project_name" class="mt-2" />
                </div>

                <!-- Project Location -->
                <div class="relative group">
                    <x-label for="location" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Project Location <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <x-input id="location" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                            wire:model.defer="location" placeholder="123 Main St, Cityville" />
                    </div>
                    <x-input-error for="location" class="mt-2" />
                </div>
            </div>

            <!-- Project Type -->
            <div class="relative group">
                <x-label for="project_type_id" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                    Project Type <span class="text-red-500">*</span>
                </x-label>
                <div class="flex items-center">
                    <div class="relative flex-grow rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <select wire:model="project_type_id" id="project_type_id"
                            class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg">
                            <option value="">-- Select Project Type --</option>
                            @foreach($projectTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" wire:click="openModal"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Type
                    </button>
                </div>
                <x-input-error for="project_type_id" class="mt-2" />
            </div>

            <!-- Project Description -->
            <div>
                <label for="project_description" class="block text-sm font-medium text-gray-900">
                    Project Description <span class="text-red-500">*</span>
                </label>
                <!-- Hidden Input for Livewire Binding -->
                <input id="project_description" type="hidden" wire:model="project_description">
                <!-- Trix Editor -->
                <div wire:ignore>
                    <trix-editor
                        input="project_description"
                        class="trix-content block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                        x-data
                        x-init="
                            const trixEditor = $el;
                            trixEditor.addEventListener('trix-change', function(event) {
                                @this.set('project_description', trixEditor.value);
                            });
                        ">
                    </trix-editor>
                </div>
                <x-input-error for="project_description" />
            </div>

            <!-- Dates Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Date -->
                <div class="relative group">
                    <x-label for="start_date" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Project Start Date <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input id="start_date" type="date" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                            wire:model.defer="start_date" />
                    </div>
                    <x-input-error for="start_date" class="mt-2" />
                </div>

                <!-- End Date -->
                <div class="relative group">
                    <x-label for="end_date" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Estimated Project End Date
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input id="end_date" type="date" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                            wire:model.defer="end_date" />
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-lg mt-8">
                <x-secondary-button wire:click="$set('showForm', false)" class="px-5 py-2.5 text-sm shadow-sm border border-gray-300 hover:bg-gray-100 transition duration-200">
                    Cancel
                </x-secondary-button>
                <x-button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 shadow-md transition duration-200 text-sm" wire:loading.attr="disabled">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Create Project</span>
                </x-button>
            </div>
        </form>
    </div>

    <!-- Modal for Adding New Project Type -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Add New Project Type
                                </h3>
                                <div class="mt-4">
                                    <form wire:submit.prevent="addProjectType">
                                        <div class="relative group">
                                            <x-label for="new_project_type" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                                                Project Type Name <span class="text-red-500">*</span>
                                            </x-label>
                                            <x-input id="new_project_type" type="text" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                                                wire:model.defer="new_project_type" placeholder="e.g., Construction, Renovation" />
                                            <x-input-error for="new_project_type" class="mt-2" />
                                        </div>
                                        
                                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                            <x-button type="submit" class="w-full inline-flex justify-center sm:col-start-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                                Add Project Type
                                            </x-button>
                                            <x-secondary-button type="button" class="mt-3 w-full inline-flex justify-center sm:mt-0 sm:col-start-1 px-4 py-2" wire:click="closeModal">
                                                Cancel
                                            </x-secondary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>