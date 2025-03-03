<div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10"  x-data="{ descriptionIsEmpty: true }">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Add a Project</h2>
            <form  class="space-y-6" wire:submit.prevent="save">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="project_name" class="block text-sm font-medium text-gray-900">
                            Project Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.defer="project_name" id="project_name"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="project_name" />
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-900">
                            Project Location <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.defer="location" id="location"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="location" />
                    </div>
                </div>
            
                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-900">
                        Project Type <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center">
                        <select wire:model="project_type_id" id="project_type_id"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">--Select Project Type--</option>
                            @foreach($projectTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" wire:click="openModal"
                            class="ml-2 px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            +
                        </button>
                    </div>
                    <x-input-error for="project_type_id" />
                </div>
            
                <!-- Project Description (Tiptap - Rich Text Editor) -->
               
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
                
                
                
                
            
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-900">
                            Project Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model.defer="start_date" id="start_date"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="start_date" />
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-900">
                            Estimated Project End Date
                        </label>
                        <input type="date" wire:model.defer="end_date" id="end_date"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="end_date" />
                    </div>
                </div>
            
                <div class="flex justify-end gap-x-4">
                    <button type="submit"
                        class="bg-gray-900 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-800 focus:ring-2 focus:ring-gray-700 focus:outline-none">
                        Submit
                    </button>
                </div>
            </form>
            
            
        </div>
    </div>

    <!-- Modal for Adding New Project Type -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Add New Project Type</h2>
                <form wire:submit.prevent="addProjectType">
                    <div>
                        <label for="new_project_type" class="block text-sm font-medium text-gray-900">Project Type Name</label>
                        <input type="text" wire:model="new_project_type" id="new_project_type" class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="new_project_type" />
                    </div>
                    <div class="mt-4 flex justify-end gap-x-4">
                        <button type="button" class="btn bg-white-500 text-gray px-4 py-2 rounded-md shadow-sm hover:bg-white-600 focus:ring-2 focus:ring-white-700 focus:outline-none" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn bg-gray-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-700 focus:ring-2 focus:ring-gray-700 focus:outline-none">Add</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>