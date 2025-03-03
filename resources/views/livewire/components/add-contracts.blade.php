<div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Add a Contract</h2>
            <form class="space-y-6" wire:submit.prevent="save">
                <!-- Compulsory Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-900">
                            Project <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="project_id" id="project_id"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="project_id" />
                    </div>
                    <div>
                        <label for="contractor_id" class="block text-sm font-medium text-gray-900">
                            Contractor <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="contractor_id" id="contractor_id"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">Select Contractor</option>
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}">{{ $contractor->first_name }} {{ $contractor->last_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="contractor_id" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-900">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="start_date" id="start_date"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="start_date" />
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-900">
                            End Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="end_date" id="end_date"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="end_date" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="contract_type" class="block text-sm font-medium text-gray-900">
                            Contract Type <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center">
                            <select wire:model="contract_type_id" id="contract_type_id"
                                class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                <option value="">--Select Contract Type--</option>
                                @foreach($contractTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" wire:click="showAddContractTypeForm"
                                class="ml-2 px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                +
                            </button>
                        </div>
                        <x-input-error for="contract_type_id" />
                    </div>
                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-900">
                            Total Amount <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="total_amount" id="total_amount"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="total_amount" />
                    </div>
                </div>

                <!-- Optional Fields -->
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

                {{-- <div>
                    <label for="payment_terms" class="block text-sm font-medium text-gray-900">
                        Payment Terms
                    </label>
                    <input type="text" wire:model.defer="payment_terms" id="payment_terms"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                </div> --}}

                <!-- Submit Button -->
                <!-- Add this button near the submit button -->
<div class="flex justify-end gap-x-4">
    <!-- Submit Button -->
    <button type="submit"
        class="bg-gray-900 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-800 focus:ring-2 focus:ring-gray-700 focus:outline-none">
        Submit
    </button>
</div>
            </form>

            <!-- Add Contract Type Modal -->
            @if($showContractTypeForm)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h3 class="text-lg font-bold mb-4">Add New Contract Type</h3>
                        <form wire:submit.prevent="addContractType">
                            <div class="space-y-4">
                                <div>
                                    <label for="new_contract_type" class="block text-sm font-medium text-gray-900">
                                        Contract Type Name
                                    </label>
                                    <input type="text" wire:model="new_contract_type" id="new_contract_type"
                                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                                </div>
                                <div class="flex justify-end gap-x-4">
                                    <button type="button" wire:click="hideAddContractTypeForm"
                                        class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:outline-none">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>