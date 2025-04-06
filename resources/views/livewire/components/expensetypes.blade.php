<div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Enhanced Header Section -->
    <div class="w-full bg-gradient-to-r from-blue-700 to-indigo-800 rounded-xl shadow-xl overflow-hidden mb-8">
        <div class="relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="smallGrid" width="20" height="20" patternUnits="userSpaceOnUse">
                            <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#smallGrid)" />
                </svg>
            </div>
            
            <div class="px-8 py-10 relative z-10">
                <div class="flex items-center gap-6">
                    <!-- Modern Folder Icon -->
                    <div class="bg-white/20 p-4 rounded-lg shadow-inner backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="48" height="48" stroke-width="1.5" class="text-white"> 
                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path> 
                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path> 
                            <path d="M9 12l.01 0"></path> 
                            <path d="M13 12l2 0"></path> 
                            <path d="M9 16l.01 0"></path> 
                            <path d="M13 16l2 0"></path>
                        </svg>
                    </div>
                    
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-white tracking-tight">Expense Category Items</h3>
                        <div class="mt-2 inline-flex items-center">
                            <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg border-l-4 border-yellow-400">
                                <p class="text-xl font-semibold text-white">{{ $category->name }}</p>
                            </div>
                            <span class="ml-3 text-blue-200 text-sm">Manage items in this category</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Decorative element -->
            <div class="absolute bottom-0 right-0 h-24 w-24 -mb-12 -mr-12 bg-blue-500 rounded-full opacity-20"></div>
            <div class="absolute top-0 left-1/2 h-16 w-16 -mt-8 bg-indigo-500 rounded-full opacity-20"></div>
        </div>
    </div>

    {{-- Expense Items Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <section class="container mx-auto">
            <!-- Table Header with Action Button -->
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/80 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Category Items</h2>
                
                <!-- New Item Button with Animation -->
                <x-button 
                    wire:click="openNewCategoryItemModal" 
                    class="text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-md hover:shadow-lg transition-all duration-300 px-5 py-2.5 rounded-lg font-medium flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Item
                </x-button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/80">
                        <tr>
                            <th scope="col" class="py-4 px-6 text-sm font-semibold text-left text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Item Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-semibold text-left text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-semibold text-left text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($items as $item)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-700/60 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $item->description }}
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <!-- Edit Button -->
                                    <button 
                                        wire:click="openEditModal({{ $item->id }})" 
                                        class="px-3.5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 flex items-center gap-2 text-sm font-medium shadow-sm"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                
                                    <!-- Delete Button -->
                                    <button 
                                        wire:click="openDeleteModal({{ $item->id }})" 
                                        class="px-3.5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 flex items-center gap-2 text-sm font-medium shadow-sm"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Empty State -->
                        @if(count($items) === 0)
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-300 dark:text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400">No items found in this category</p>
                                    <button 
                                        wire:click="openNewCategoryItemModal" 
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium transition-colors"
                                    >
                                        Add your first item
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <a 
                    href="#" 
                    wire:click="previousPage" 
                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 transition-colors duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md gap-x-2 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Previous</span>
                </a>
                <div class="items-center hidden lg:flex gap-x-1">
                    @for ($i = 1; $i <= $items->lastPage(); $i++)
                        <a 
                            href="#" 
                            wire:click="gotoPage({{ $i }})" 
                            class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors duration-200 
                                {{ $i == $items->currentPage() 
                                    ? 'text-white bg-blue-600 dark:bg-blue-700' 
                                    : 'text-gray-700 bg-white dark:bg-gray-800 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                        >
                            {{ $i }}
                        </a>
                    @endfor
                </div>
                <a 
                    href="#" 
                    wire:click="nextPage" 
                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 transition-colors duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md gap-x-2 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/50"
                >
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>
    </div>

    <!-- Enhanced New Item Modal -->
    <x-dialog-modal wire:model="showNewCategoryItemModal">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">New Expense Category Item</h3>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        wire:model="name" 
                        id="name" 
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 dark:bg-gray-700 dark:text-white transition-all duration-200"
                        placeholder="Enter item name"
                    >
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        wire:model="description" 
                        id="description" 
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 dark:bg-gray-700 dark:text-white transition-all duration-200"
                        placeholder="Enter item description"
                    ></textarea>
                    <x-input-error for="description" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-3">
                <button 
                    wire:click="closeNewCategoryModal" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/50"
                >
                    Cancel
                </button>
                <button 
                    wire:click="saveNewCategoryItem" 
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-700 rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Save Item
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

    <!-- Enhanced Edit Item Modal -->
    <x-dialog-modal wire:model="showEditModal">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Expense Category Item</h3>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="space-y-5">
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        wire:model="name" 
                        id="editName" 
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 dark:bg-gray-700 dark:text-white transition-all duration-200"
                    >
                    <x-input-error for="editName" class="mt-2" />
                </div>
                <div>
                    <label for="editDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        wire:model="description" 
                        id="editDescription" 
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500/20 dark:bg-gray-700 dark:text-white transition-all duration-200"
                    ></textarea>
                    <x-input-error for="editDescription" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-3">
                <button 
                    wire:click="closeEditModal" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/50"
                >
                    Cancel
                </button>
                <button 
                    wire:click="updateCategory" 
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-blue-700 rounded-md hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update Item
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

    <!-- Enhanced Delete Item Modal -->
    <x-dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600 dark:text-red-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Delete Item</h3>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="bg-red-50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/20 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-500 dark:text-red-400">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-200">Are you sure you want to delete this item? This action cannot be undone.</p>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end gap-3">
                <button 
                    wire:click="closeDeleteModal" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500/50"
                >
                    Cancel
                </button>
                <button 
                    wire:click="deleteCategory" 
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 dark:bg-red-700 rounded-md hover:bg-red-700 dark:hover:bg-red-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                >
                    Delete Item
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>