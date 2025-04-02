<div class="space-y-6">
    <!-- Enhanced Header Section -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Add New Business</h1>
                        <p class="text-gray-600 mt-1">Fill out the form below to create a new business and its primary staff member</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Integrated Form Title into Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <span class="text-lg font-semibold text-gray-800">Business Information</span>
                <span class="text-sm text-gray-500">|</span>
                <p class="text-sm text-gray-600">Please provide the details of the business you want to register.</p>
            </div>
        </div>
    </div>

    <!-- Main Form Section -->
    <x-form-section submit="createBusiness" title="Business Information" description="Please provide the details of the business you want to register.">
        <!-- Form Fields -->
        <x-slot name="form">
            <!-- Business Profile Section -->
            <div class="col-span-6">
                <div class="pb-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Business Profile
                        <span class="ml-2 text-xs text-gray-500">(All fields are required)</span>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Basic information about the business</p>
                </div>
            </div>

            <!-- Business Fields -->
            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="business_name">
                        Business Name <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="business_name" type="text" class="mt-1 block w-full" wire:model.defer="business_name" />
                    <x-input-error for="business_name" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="business_email">
                        Business Email <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="business_email" type="email" class="mt-1 block w-full" wire:model.defer="business_email" />
                    <x-input-error for="business_email" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6">
                <div class="relative">
                    <x-label for="business_address">
                        Business Address <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="business_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" wire:model.defer="business_address" rows="3"></x-input>
                    <x-input-error for="business_address" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="business_phone">
                        Business Phone <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="business_phone" type="tel" class="mt-1 block w-full" wire:model.defer="business_phone" />
                    <x-input-error for="business_phone" class="mt-2" />
                </div>
            </div>
            
            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="business_location">
                        Business Location (City) <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="business_location" type="text" class="mt-1 block w-full" wire:model.defer="business_location" />
                    <x-input-error for="business_location" class="mt-2" />
                </div>
            </div>

            <!-- Divider with icon -->
            <div class="col-span-6 relative py-6">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-white text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Staff Profile Section -->
            <div class="col-span-6">
                <div class="pb-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Primary Staff Member
                        <span class="ml-2 text-xs text-gray-500">(All fields are required)</span>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Information about the primary contact for this business</p>
                </div>
            </div>

            <!-- Staff Fields -->
            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="staff_name">
                        Staff Name <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="staff_name" type="text" class="mt-1 block w-full" wire:model.defer="staff_name" />
                    <x-input-error for="staff_name" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="staff_email">
                        Staff Email <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="staff_email" type="email" class="mt-1 block w-full" wire:model.defer="staff_email" />
                    <x-input-error for="staff_email" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="staff_phone">
                        Staff Phone <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="staff_phone" type="tel" class="mt-1 block w-full" wire:model.defer="staff_phone" />
                    <x-input-error for="staff_phone" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative">
                    <x-label for="staff_position">
                        Position <span class="text-red-500">*</span>
                    </x-label>
                    <x-input id="staff_position" type="text" class="mt-1 block w-full" wire:model.defer="staff_position" />
                    <x-input-error for="staff_position" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <!-- Form Actions -->
        <x-slot name="actions"> 
            <div class="flex items-center justify-between"> 
                <div class="flex items-center space-x-4">
                    <x-secondary-button wire:click="$set('showForm', false)" class="px-6 py-3">
                        Cancel
                    </x-secondary-button>
                    <x-button type="submit" class="ml-4 px-6 py-3 bg-blue-600 hover:bg-blue-700" wire:loading.attr="disabled">
                        <svg wire:loading wire:target="createBusiness" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Save Business
                    </x-button>
                </div>
            </div>
        </x-slot>
    </x-form-section>
</div>