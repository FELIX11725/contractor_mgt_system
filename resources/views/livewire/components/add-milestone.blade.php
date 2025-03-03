<div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Add a Milestone</h2>
            <form class="space-y-6" wire:submit.prevent="save">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="project_name" class="block text-sm font-medium text-gray-900">Project <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                        {{-- choose a project --}}
                        <select wire:model="project_id" id="project_id" class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">-- Select a project --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="project_id" />
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-900">Milestone <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                        <input type="text" wire:model="milestone_name" id="milestone_name" class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="milestone_name" />
                    </div>
                </div>
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-900">Due Date <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                    <input type="date" wire:model="due_date" id="due_date" class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none" placeholder="type (Residential, Commercial, Industrial, etc)">
                    <x-input-error for="due_date" />
                </div>
                <div>
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
               
                <div class="flex justify-end gap-x-4">
                    
                    <button type="submit" class="btn bg-gray-900 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-800 focus:ring-2 focus:ring-gray-700 focus:outline-none">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
