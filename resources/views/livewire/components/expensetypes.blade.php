<div class="p-4">
    <div class="px-5 pt-5 pb-0 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4 pl-20">
            <div>
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2"> 
                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path> 
                        <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path> 
                        <path d="M9 12l.01 0"></path> 
                        <path d="M13 12l2 0"></path> 
                        <path d="M9 16l.01 0"></path> 
                        <path d="M13 16l2 0"></path>
                    </svg> 
                    Expense Category Items
                </h3>
                <p class="text-lg font-semibold mb-4"> {{ $category->name }}</p>
            </div>
        </div>
    </div>

    {{-- Expense Items Table --}}
    <div class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <section class="container px-4 mx-auto">
            <div class="flex items-center gap-x-3">
                <x-button wire:click="openNewCategoryItemModal" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700">
                    New Item
                </x-button>
            </div>

            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <span>Item Name</span>
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Description</th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach($items as $item)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $item->description }}</td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6">
                                                <button wire:click="openEditModal({{ $item->id }})" 
                                                    class="bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-gray-800 focus:outline-none">
                                                    Edit
                                                </button>
                                                <button wire:click="delete({{ $item->id }})" 
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-red-600 focus:outline-none">
                                                    Delete
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

            {{-- Custom Pagination Links --}}
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

    {{-- Modals for Adding/Editing Items --}}
    <!-- New Item Modal -->
    <x-dialog-modal wire:model="showNewCategoryItemModal">
        <x-slot name="title">New Expense Category Item</x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeNewCategoryModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
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
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="description" id="editDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeEditModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
            <button wire:click="updateCategory" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </x-slot>
    </x-dialog-modal>
</div>