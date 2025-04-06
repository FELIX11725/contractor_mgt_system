<div class="space-y-8 max-w-5xl mx-auto">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0 bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m1-18a4 4 0 014-4h6a4 4 0 014 4v2a4 4 0 01-4 4h-2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Add New Staff</h1>
                        <p class="text-blue-100 mt-1 text-sm">Register a new staff member with personal and professional details</p>
                    </div>
                </div>
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    New Registration
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <form wire:submit.prevent="save" class="space-y-6 p-8">
            <!-- Personal Information Section -->
            <div class="pb-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">Personal Information</h3>
                        <p class="mt-1 text-sm text-gray-500">Basic details about the staff member</p>
                    </div>
                </div>
            </div>

            <!-- Name Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="relative group">
                    <x-label for="first_name" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        First Name <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="first_name" type="text" class="block w-full" 
                        wire:model.defer="first_name" placeholder="John" />
                    <x-input-error for="first_name" class="mt-2" />
                </div>

                <div class="relative group">
                    <x-label for="last_name" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Last Name <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="last_name" type="text" class="block w-full" 
                        wire:model.defer="last_name" placeholder="Doe" />
                    <x-input-error for="last_name" class="mt-2" />
                </div>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="relative group">
                    <x-label for="email" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Email <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="email" type="email" class="block w-full" 
                        wire:model.defer="email" placeholder="john.doe@example.com" />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div class="relative group">
                    <x-label for="phone" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Phone Number <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="phone" type="tel" class="block w-full" 
                        wire:model.defer="phone" placeholder="(555) 123-4567" />
                    <x-input-error for="phone" class="mt-2" />
                </div>
            </div>

            <!-- Position and Business -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="relative group">
                    <x-label for="position" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Position <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="position" type="text" class="block w-full" 
                        wire:model.defer="position" placeholder="e.g., Project Manager" />
                    <x-input-error for="position" class="mt-2" />
                </div>

                {{-- <div class="relative group">
                    <x-label for="business_id" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Unit
                    </x-label>
                    <select id="business_id" class="block w-full" 
                        wire:model.defer="business_id">
                        <option value="">Select Business Unit</option>
                        @foreach($businesses as $business)
                            <option value="{{ $business->id }}">{{ $business->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
            </div>

            <!-- Address -->
            {{-- <div class="relative group">
                <x-label for="address" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                    Address <span class="text-red-500">*</span>
                </x-label>
                <textarea id="address" class="block w-full" 
                    wire:model.defer="address" rows="3" placeholder="123 Main Street, Apt 4B&#10;Cityville, State 12345"></textarea>
                <x-input-error for="address" class="mt-2" />
            </div> --}}

            <!-- Additional Information -->
            {{-- <div class="col-span-6 relative py-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-gray-500 flex items-center">
                        Additional Information (Optional)
                    </span>
                </div>
            </div> --}}

            <!-- Optional Fields -->
            {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="relative group">
                    <x-label for="date_of_birth" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Date of Birth
                    </x-label>
                    <x-input id="date_of_birth" type="date" class="block w-full" 
                        wire:model.defer="date_of_birth" />
                </div>

                <div class="relative group">
                    <x-label for="gender" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Gender
                    </x-label>
                    <select id="gender" class="block w-full" 
                        wire:model.defer="gender">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div> --}}

            <!-- Create User Account Toggle -->
            {{-- <div class="flex items-center">
                <input id="create_user_account" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                    wire:model.defer="create_user_account">
                <label for="create_user_account" class="ml-2 block text-sm text-gray-900">
                    Create system user account
                </label>
            </div> --}}

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-lg mt-8">
                <x-secondary-button wire:click="$set('showForm', false)" class="px-5 py-2.5">
                    Cancel
                </x-secondary-button>
                <x-button type="submit" class="px-5 py-2.5" wire:loading.attr="disabled">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Add Staff</span>
                </x-button>
            </div>
        </form>
    </div>
</div>