<div>
    <div class="container mx-auto p-4 pt-10">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Project Plan</h2>
                <p class="text-lg text-gray-600 mb-6">Please fill out the form below to create your project plan.</p>

                <form class="space-y-6" wire:submit.prevent="submit">
                    <!-- Project Selection -->
                    <div>
                        <label class="block text-gray-800 font-semibold mb-2" for="selectedProject">
                            Choose Project
                        </label>
                        <div class="relative">
                            <select class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out appearance-none" id="selectedProject" wire:model="selectedProject">
                                <option value="">-- Select a Project --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error for="selectedProject" class="mt-2 text-red-600 text-sm font-medium" />
                    </div>

                    <!-- Plan Method Selection -->
                    <div>
                        <label class="block text-gray-800 font-semibold mb-2" for="planMethod">
                            Plan Method
                        </label>
                        <div class="relative">
                            <select class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out appearance-none" wire:model="planMethod">
                                <option value="">-- Select Plan Method --</option>
                                <option value="milestones">Milestones</option>
                                <option value="phases">Phases</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        {{-- <x-input-error for="planMethod" class="mt-2 text-red-600 text-sm font-medium" /> --}}
                    </div>

                    <!-- Number of Items -->
                    @if($planMethod)
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2" for="numberOfItems">
                                Number of {{ ucfirst($planMethod) }}
                            </label>
                            <input class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" type="number" wire:model="numberOfItems" min="1">
                            <x-input-error for="numberOfItems" class="mt-2 text-red-600 text-sm font-medium" />
                        </div>
                    @endif

                    <!-- Item Names -->
                    @if($numberOfItems > 0)
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2" for="itemNames">
                                Names of {{ ucfirst($planMethod) }}
                            </label>
                            @for($i = 0; $i < $numberOfItems; $i++)
                                <input class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out mb-3" type="text" wire:model="itemNames.{{ $i }}" placeholder="{{ ucfirst($planMethod) }} {{ $i + 1 }}">
                            @endfor
                            <x-input-error for="itemNames" class="mt-2 text-red-600 text-sm font-medium" />
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>