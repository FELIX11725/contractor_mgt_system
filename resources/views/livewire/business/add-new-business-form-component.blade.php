<div class="space-y-8 max-w-5xl mx-auto">
    <!-- Enhanced Header Section with Gradient and Drop Shadow -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="flex-shrink-0 bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Add New Business</h1>
                        <p class="text-blue-100 mt-1 text-sm">Register a new business and its primary staff member</p>
                    </div>
                </div>
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    New Registration
                </span>
            </div>
        </div>
    </div>

    <!-- Main Form Section with Enhanced Styling -->
    <x-form-section submit="createBusiness">
        <!-- Form Fields -->
        <x-slot name="form">
            <!-- Business Profile Section -->
            <div class="col-span-6">
                <div class="pb-5 mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-10 w-10 rounded-md bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Business Profile</h3>
                            <p class="mt-1 text-sm text-gray-500">Enter the essential details about the business you want to register</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Fields with Enhanced Styling -->
            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="business_name" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Name <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <x-input id="business_name" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="business_name" placeholder="Acme Corporation" />
                    </div>
                    <x-input-error for="business_name" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="business_email" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Email <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input id="business_email" type="email" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="business_email" placeholder="info@acmecorp.com" />
                    </div>
                    <x-input-error for="business_email" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6">
                <div class="relative group">
                    <x-label for="business_address" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Address <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <textarea id="business_address" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="business_address" rows="3" placeholder="123 Business Ave, Suite 101&#10;Cityville, State 12345"></textarea>
                    </div>
                    <x-input-error for="business_address" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="business_phone" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Phone <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <x-input id="business_phone" type="tel" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="business_phone" placeholder="(555) 123-4567" />
                    </div>
                    <x-input-error for="business_phone" class="mt-2" />
                </div>
            </div>
            
            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="business_location" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Business Location (City) <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <x-input id="business_location" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="business_location" placeholder="San Francisco" />
                    </div>
                    <x-input-error for="business_location" class="mt-2" />
                </div>
            </div>

            <!-- Elegant Divider -->
            <div class="col-span-6 relative py-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-gray-500 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Staff Information
                    </span>
                </div>
            </div>

            <!-- Staff Profile Section -->
            <div class="col-span-6">
                <div class="pb-5 mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-10 w-10 rounded-md bg-indigo-100 text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Primary Staff Member</h3>
                            <p class="mt-1 text-sm text-gray-500">Information about the main contact person for this business</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Fields -->
            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="staff_name" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Staff Name <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <x-input id="staff_name" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="staff_name" placeholder="John Doe" />
                    </div>
                    <x-input-error for="staff_name" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="staff_email" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Staff Email <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input id="staff_email" type="email" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="staff_email" placeholder="john.doe@acmecorp.com" />
                    </div>
                    <x-input-error for="staff_email" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="staff_phone" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Staff Phone <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <x-input id="staff_phone" type="tel" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="staff_phone" placeholder="(555) 987-6543" />
                    </div>
                    <x-input-error for="staff_phone" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div class="relative group">
                    <x-label for="staff_position" class="text-sm font-medium text-gray-700 mb-1 group-focus-within:text-blue-600 transition-colors">
                        Position <span class="text-red-500">*</span>
                    </x-label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-input id="staff_position" type="text" class="pl-10 block w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg" wire:model.defer="staff_position" placeholder="Manager" />
                    </div>
                    <x-input-error for="staff_position" class="mt-2" />
                </div>
            </div>
            
            <!-- Terms and Conditions Checkbox -->
            {{-- <div class="col-span-6 mt-4">
                <div class="relative flex items-start py-4">
                    <div class="mr-3 flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" wire:model.defer="terms_accepted">
                    </div>
                    <div class="min-w-0 flex-1 text-sm">
                        <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms and Conditions</a> and <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a></label>
                    </div>
                </div>
                <x-input-error for="terms_accepted" class="mt-2" />
            </div> --}}
        </x-slot>

        <!-- Form Actions with Enhanced Styling -->
        <x-slot name="actions"> 
            <div class="flex items-center justify-end space-x-4 px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-lg"> 
                <x-secondary-button wire:click="$set('showForm', false)" class="px-5 py-2.5 text-sm shadow-sm border border-gray-300 hover:bg-gray-100 transition duration-200">
                    Cancel
                </x-secondary-button>
                <x-button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 shadow-md transition duration-200 text-sm" wire:loading.attr="disabled">
                    <svg wire:loading wire:target="createBusiness" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Create Business</span>
                </x-button>
            </div>
        </x-slot>
    </x-form-section>
    
    <!-- Progress Indicator -->
    {{-- <div class="max-w-5xl mx-auto px-4 py-4">
        <div class="flex justify-center">
            <ol class="flex items-center w-full">
                <li class="flex items-center text-blue-600 dark:text-blue-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block">
                    <span class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                        <svg class="w-5 h-5 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 5.757v8.486M5.757 10h8.486"/>
                        </svg>
                    </span>
                </li>
              
              
            </ol>
        </div>
        
    </div> --}}
</div>