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
        </div>
    </div>

    {{-- Stats Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 flex items-center">
            <div class="rounded-full bg-blue-100 dark:bg-blue-900/50 p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Expense Categories</p>
                <p class="text-xl font-bold dark:text-white">{{ $expenseCategories->total() }}</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 flex items-center">
            <div class="rounded-full bg-green-100 dark:bg-green-900/50 p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Expense Items</p>
                <p class="text-xl font-bold dark:text-white">{{ $expenseCategories->sum('items_count') }}</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 flex items-center">
            <div class="rounded-full bg-purple-100 dark:bg-purple-900/50 p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Countable Items</p>
                <p class="text-xl font-bold dark:text-white">
                    {{ $expenseCategoryItems->where('has_quantity', 1)->count() }}
                </p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 flex items-center">
            <div class="rounded-full bg-orange-100 dark:bg-orange-900/50 p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Uncountable Items</p>
                <p class="text-xl font-bold dark:text-white">
                    {{ $expenseCategoryItems->where('has_quantity', 0)->count() }}
                </p>
            </div>
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

            {{-- Search and Filter --}}
            <div class="mb-4 bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                <div class="flex items-center gap-3">
                    <!-- Search field (left) -->
                    <div class="relative flex-grow max-w-md">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" wire:model.debounce.300ms="search" class="block w-full p-2 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search categories...">
                    </div>
                    
                    <!-- Filter dropdown (right) -->
                    {{-- <div class="w-auto">
                        <select wire:model="perPage" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                        </select>
                    </div> --}}
                </div>
            </div>

            {{-- Enhanced Table --}}
            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <input type="checkbox" wire:model="selectAll" class="rounded text-blue-600 focus:ring-blue-500" />
                                </div>
                            </th>
                            <th scope="col" wire:click="sortBy('name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer group">
                                <div class="flex items-center">
                                    Name
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                            {{-- <th scope="col" wire:click="sortBy('description')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer group">
                                <div class="flex items-center">
                                    Description
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th> --}}
                            {{-- <th scope="col" wire:click="sortBy('items_count')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer group">
                                <div class="flex items-center">
                                    Items Count
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th> --}}
                            {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th> --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                        @if ($expenseCategories->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="text-gray-500 text-lg font-medium">No categories found</span>
                                        <p class="text-gray-400 mt-1">Try adjusting your search criteria</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($expenseCategories as $category)
                                <tr wire:key="{{ 'category-' . $category->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700/70 transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" 
                                            class="rounded text-blue-600 focus:ring-blue-500" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            {{-- <div class="h-8 w-8 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-3">
                                                {{ substr($category->name, 0, 1) }}
                                            </div> --}}
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $category->name }}</div>
                                        </div>
                                    </td>
                                   
                                    <td class="px-6 py-4 flex space-x-2">
                                        {{-- <x-button wire:click="viewDetails({{ $category->id }})" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white border-0 text-xs py-1 px-3">
                                            Details
                                        </x-button> --}}
                                        <x-button wire:click="openEditModal({{ $category->id }})" 
                                            class="bg-gray-600 hover:bg-gray-700 text-white border-0 text-xs py-1 px-3">
                                            Edit
                                        </x-button>
                                        {{-- @if($category->is_active)
                                            <x-danger-button wire:click="deactivateCategory({{ $category->id }})"
                                                class="text-xs py-1 px-3">
                                                Deactivate
                                            </x-danger-button>
                                        @else
                                            <x-button wire:click="activateCategory({{ $category->id }})" 
                                                class="bg-green-600 hover:bg-green-700 text-white border-0 text-xs py-1 px-3">
                                                Activate
                                            </x-button>
                                        @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            @if($selectedCategories && count($selectedCategories) > 0)
            <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg mt-4 flex justify-between items-center">
                <span class="text-blue-700 dark:text-blue-300 font-medium">{{ count($selectedCategories) }} items selected</span>
                <div>
                    <x-button wire:click="activateSelected" class="bg-green-600 hover:bg-green-700">
                        Activate Selected
                    </x-button>
                    <x-danger-button wire:click="deactivateSelected" class="ml-2">
                        Deactivate Selected
                    </x-danger-button>
                </div>
            </div>
            @endif

            <div class="mt-4">
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