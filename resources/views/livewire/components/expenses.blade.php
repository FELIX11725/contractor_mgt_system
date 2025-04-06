<div class="p-4 space-y-6">
    {{-- Enhanced Header with Gradient and Icon --}}
    <div class="w-full bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-xl shadow-xl overflow-hidden">
        <div class="px-6 py-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-white/10 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="32" height="32" stroke-width="2" class="text-white"> 
                        <path d="M4 4h6v6h-6z"></path> 
                        <path d="M14 4h6v6h-6z"></path> 
                        <path d="M4 14h6v6h-6z"></path> 
                        <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path> 
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-white">Expense Categories</h2>
                    <p class="text-blue-100 mt-1">Manage your expense categories and classifications</p>
                </div>
            </div>
            {{-- <div class="hidden md:block">
                <div class="bg-white/10 px-4 py-2 rounded-lg">
                    <span class="text-white text-sm">{{ now()->format('F j, Y') }}</span>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- Enhanced Content Area --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            {{-- Action Bar --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">All Categories</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage and organize your expense classifications</p>
                </div>
                <x-button 
                    wire:click="openNewCategoryModal" 
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300 flex items-center gap-2 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Category
                </x-button>
            </div>

            {{-- Search and Filter (Optional) --}}
            <div class="mb-6 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" wire:model.debounce.300ms="search" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search categories...">
                    </div>
                    <div>
                        <select wire:model="perPage" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Enhanced Table --}}
            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="py-4 px-6 text-sm font-semibold text-left text-gray-700 dark:text-gray-300">
                                <div class="flex items-center gap-x-2">
                                    <span>Name</span>
                                    <button wire:click="sortBy('name')" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-semibold text-left text-gray-700 dark:text-gray-300">Description</th>
                            <th scope="col" class="px-6 py-4 text-sm font-semibold text-right text-gray-700 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($expenseCategories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/70 transition duration-200">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-3">
                                        {{ substr($category->name, 0, 1) }}
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                <div class="line-clamp-2">{{ $category->description }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="viewDetails({{ $category->id }})" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-800/50 transition duration-300 focus:outline-none flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Details
                                    </button>
                                    <button wire:click="openEditModal({{ $category->id }})" class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition duration-300 focus:outline-none flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                        </svg>
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Enhanced Pagination --}}
            <div class="mt-6">
                {{ $expenseCategories->links() }}
            </div>
        </div>
    </div>

    {{-- Enhanced New Category Modal --}}
    <x-dialog-modal wire:model="showNewCategoryModal" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span>Create New Expense Category</span>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="newCategoryName" id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Enter category name">
                    <x-input-error for="newCategoryName" class="mt-2" />
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea wire:model.defer="newCategoryDescription" id="description" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Provide a description for this category"></textarea>
                    <x-input-error for="newCategoryDescription" class="mt-2" />
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-blue-700 dark:text-blue-300">Creating clear categories helps maintain organized financial records.</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-3">
                <button wire:click="closeNewCategoryModal" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition duration-300">Cancel</button>
                <button wire:click="saveNewCategory" type="button" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-300">Save Category</button>
            </div>
        </x-slot>
    </x-dialog-modal>

    {{-- Enhanced Edit Category Modal --}}
    <x-dialog-modal wire:model="showEditModal" maxWidth="md">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <span>Edit Expense Category</span>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="space-y-6">
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.defer="editCategoryName" id="editName" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <x-input-error for="editCategoryName" class="mt-2" />
                </div>
                <div>
                    <label for="editDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea wire:model.defer="editCategoryDescription" id="editDescription" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    <x-input-error for="editCategoryDescription" class="mt-2" />
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">Changes to this category will affect all associated expense records.</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-3">
                <button wire:click="closeEditModal" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition duration-300">Cancel</button>
                <button wire:click="updateCategory" type="button" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-300">Update Category</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>