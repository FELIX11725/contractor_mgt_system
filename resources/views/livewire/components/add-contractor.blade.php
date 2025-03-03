<div>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-10" x-data="{ descriptionIsEmpty: true }">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Add a Contractor</h2>
            <form class="space-y-6" wire:submit.prevent="save">
                <!-- Compulsory Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-900">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="first_name" id="first_name"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="first_name" />
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-900">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="last_name" id="last_name"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="last_name" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="contractor_email" class="block text-sm font-medium text-gray-900">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" wire:model="contractor_email" id="contractor_email"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="contractor_email" />
                    </div>
                    <div>
                        <label for="contractor_phone" class="block text-sm font-medium text-gray-900">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="contractor_phone" id="contractor_phone"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        <x-input-error for="contractor_phone" />
                    </div>
                </div>

                <div>
                    <label for="contractor_address" class="block text-sm font-medium text-gray-900">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="contractor_address" id="contractor_address"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                    <x-input-error for="contractor_address" />
                </div>

                <!-- Optional Biodata Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-900">
                            Date of Birth
                        </label>
                        <input type="date" wire:model="date_of_birth" id="date_of_birth"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-900">
                            Gender
                        </label>
                        <select wire:model="gender" id="gender"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-900">
                            Nationality
                        </label>
                        <input type="text" wire:model="nationality" id="nationality"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                    </div>
                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-gray-900">
                            Marital Status
                        </label>
                        <select wire:model="marital_status" id="marital_status"
                            class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                            <option value="">Select Marital Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="education_level" class="block text-sm font-medium text-gray-900">
                        Education Level
                    </label>
                    <input type="text" wire:model="education_level" id="education_level"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                </div>

                <div>
                    <label for="work_experience" class="block text-sm font-medium text-gray-900">
                        Work Experience (Years)
                    </label>
                    <input type="number" wire:model="work_experience" id="work_experience"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-x-4">
                    <button type="submit"
                        class="bg-gray-900 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-800 focus:ring-2 focus:ring-gray-700 focus:outline-none">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>