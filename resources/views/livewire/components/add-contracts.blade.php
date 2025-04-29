<div class="space-y-8 max-w-5xl mx-auto">
    <!-- Enhanced Header Section with Gradient and Drop Shadow -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0 bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Add New Contract</h1>
                        <p class="text-blue-100 mt-1 text-sm">Create a new contract between a project and contractor</p>
                    </div>
                </div>
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    New Agreement
                </span>
            </div>
        </div>
    </div>

    <!-- Main Form Section -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <form wire:submit.prevent="save" class="space-y-6 p-8" enctype="multipart/form-data">
            <!-- Contract Information Section -->
            <div class="pb-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Contract Details</h3>
                        <p class="mt-1 text-sm text-gray-500">Essential information about the contract agreement</p>
                    </div>
                </div>
            </div>

            <!-- Project and Contractor Selection -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Project Selection -->
                <div class="relative group">
                    <x-label for="project_id" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Project <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <select wire:model="project_id" id="project_id"
                            class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error for="project_id" class="mt-2" />
                </div>

                
<!-- Contractor Selection -->
<div class="relative group">
    <x-label for="contractor_id" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
        Contractor <span class="text-red-500">*</span>
    </x-label>
    <div class="relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <select wire:model="contractor_id" id="contractor_id"
            class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg">
            <option value="">Select Contractor</option>
            @foreach($contractors as $contractor)
                <option value="{{ $contractor->id }}">
                    {{ $contractor->first_name }} {{ $contractor->last_name }} ({{ $contractor->position }})
                </option>
            @endforeach
        </select>
    </div>
    <x-input-error for="contractor_id" class="mt-2" />
</div>
            </div>

            <!-- Dates Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Date -->
                <div class="relative group">
                    <x-label for="start_date" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Start Date <span class="text-red-500">*</span>
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
                        End Date <span class="text-red-500">*</span>
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
                    <x-input-error for="end_date" class="mt-2" />
                </div>
            </div>

            <!-- Contract Type and Amount -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Contract Type -->
                <div class="relative group">
                    <x-label for="contract_type_id" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Contract Type <span class="text-red-500">*</span>
                    </x-label>
                    <div class="flex items-center">
                        <div class="relative flex-grow rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <select wire:model="contract_type_id" id="contract_type_id"
                                class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg">
                                <option value="">--Select Contract Type--</option>
                                @foreach($contractTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" wire:click="showAddContractTypeForm"
                            class="ml-3 inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add
                        </button>
                    </div>
                    <x-input-error for="contract_type_id" class="mt-2" />
                </div>

                <!-- Total Amount -->
                <div class="relative group">
                    <x-label for="total_amount" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Total Amount <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <x-input id="total_amount" type="number" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                            wire:model.defer="total_amount" placeholder="0.00" step="0.01" />
                    </div>
                    <x-input-error for="total_amount" class="mt-2" />
                </div>
            </div>

            <!-- Payment Schedule -->
            <div class="relative group">
                <x-label for="payment_schedule" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                    Payment Schedule
                </x-label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-input id="payment_schedule" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                        wire:model.defer="payment_schedule" placeholder="e.g., 30% upfront, 40% on completion, 30% after inspection" />
                </div>
                <x-input-error for="payment_schedule" class="mt-2" />
            </div>

            <!-- Contract Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-900">
                    Contract Description 
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

            <!-- Document Attachments -->
            <div>
                <label for="attachments" class="block text-sm font-medium text-gray-700 mb-2">
                    Contract Documents (Blueprints, Checklists, etc.)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="attachments" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload files</span>
                                <input id="attachments" name="attachments" type="file" class="sr-only" wire:model="attachments" multiple>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PDF, DOC, XLS up to 10MB
                        </p>
                    </div>
                </div>
                @if($attachments)
                    <div class="mt-2">
                        @foreach($attachments as $key => $attachment)
                            <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-md mb-1">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-700">{{ $attachment->getClientOriginalName() }}</span>
                                </div>
                                <button type="button" wire:click="removeAttachment({{ $key }})" class="text-red-500 hover:text-red-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
                <x-input-error for="attachments" class="mt-2" />
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
                    <span>Create Contract</span>
                </x-button>
            </div>
        </form>
    </div>

    <!-- Add Contract Type Modal -->
    @if($showContractTypeForm)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="hideAddContractTypeForm"></div>

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
                                    Add New Contract Type
                                </h3>
                                <div class="mt-4">
                                    <form wire:submit.prevent="addContractType">
                                        <div class="relative group">
                                            <x-label for="new_contract_type" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                                                Contract Type Name
                                            </x-label>
                                            <x-input id="new_contract_type" type="text" class="block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" 
                                                wire:model.defer="new_contract_type" placeholder="e.g., Fixed Price, Time & Materials" />
                                        </div>
                                        
                                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                            <x-button type="submit" class="w-full inline-flex justify-center sm:col-start-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                                Add Contract Type
                                            </x-button>
                                            <x-secondary-button type="button" class="mt-3 w-full inline-flex justify-center sm:mt-0 sm:col-start-1 px-4 py-2" wire:click="hideAddContractTypeForm">
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