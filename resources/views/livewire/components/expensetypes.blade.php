<div class="p-4">
    <!-- Header Section -->
    <div class="px-5 pt-5 pb-0 w-full bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg">
        <div class="p-5 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4 pl-20">
            <div class="flex items-center gap-4">
                <!-- Folder Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2" class="text-white"> 
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path> 
                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path> 
                    <path d="M9 12l.01 0"></path> 
                    <path d="M13 12l2 0"></path> 
                    <path d="M9 16l.01 0"></path> 
                    <path d="M13 16l2 0"></path>
                </svg> 
                <div>
                    <h3 class="text-2xl font-semibold text-white">Expense Category Items</h3>
                    <p class="text-lg font-medium text-gray-200">{{ $category->name }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Expense Items Table --}}
       {{-- Expense Items Table --}}
       <div class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <section class="container px-4 mx-auto">
            <!-- New Item Button -->
            <div class="flex items-center gap-x-3 mb-6">
                <x-button wire:click="openNewCategoryItemModal" class="text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition duration-300">
                    New Item
                </x-button>
            </div>

            <!-- Table -->
            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg shadow">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300">
                                            Item Name
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300">Description</th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-700 dark:text-gray-300">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach($items as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $item->description }}</td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-4">
                                                <!-- Edit Button -->
                                                <button wire:click="openEditModal({{ $item->id }})" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 focus:outline-none flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </button>
                                            
                                                <!-- Delete Button -->
                                                <button wire:click="openDeleteModal({{ $item->id  }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <a href="#" wire:click="previousPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Previous</span>
                </a>
                <div class="items-center hidden lg:flex gap-x-3">
                    @for ($i = 1; $i <= $items->lastPage(); $i++)
                        <a href="#" wire:click="gotoPage({{ $i }})" class="px-2 py-1 text-sm {{ $i == $items->currentPage() ? 'text-blue-500 bg-blue-100/60' : 'text-gray-500' }} rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">{{ $i }}</a>
                    @endfor
                </div>
                <a href="#" wire:click="nextPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>
    </div>

    <!-- New Item Modal -->
    <x-dialog-modal wire:model="showNewCategoryItemModal">
        <x-slot name="title">New Expense Category Item</x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                <x-input-error for="description" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeNewCategoryModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
            <button wire:click="saveNewCategoryItem" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Item Modal -->
    <x-dialog-modal wire:model="showEditModal">
        <x-slot name="title">Edit Expense Category Item</x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                <input type="text" wire:model="name" id="editName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <x-input-error for="editName" class="mt-2" />
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="description" id="editDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                <x-input-error for="editDescription" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeEditModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
            <button wire:click="updateCategory" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Item Modal -->
    <x-dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">Delete Item</x-slot>
        <x-slot name="content">
            <p class="text-sm text-gray-700">Are you sure you want to delete this item?</p>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeDeleteModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 mr-4">Cancel</button>
            <button wire:click="deleteCategory" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Delete</button>
        </x-slot>
    </x-dialog-modal>
</div>