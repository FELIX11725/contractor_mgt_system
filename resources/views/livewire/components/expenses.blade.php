<div class="p-4">
    <div class="px-5 pt-5 pb-0 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4 pl-20">
            <div>
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <!-- Folder Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2"> 
                        <path d="M4 4h6v6h-6z"></path> 
                        <path d="M14 4h6v6h-6z"></path> 
                        <path d="M4 14h6v6h-6z"></path> 
                        <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path> 
                    </svg> 
                    &nbsp;&nbsp;
                    Expense Categories
                </h3>
            </div>
        </div>
    </div>

    {{-- Expense Items Table --}}
    <div class="mt-4 p-5 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <section class="container px-4 mx-auto">
            <div class="flex items-center gap-x-3">
                <x-button wire:click="openNewCategoryModal" class="text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                    New Category
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
                                            <div class="flex items-center gap-x-3">
                                                <span>Name</span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Description</th>
                                        
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach($expenseCategories as $category)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $category->description }}</td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6">
                                               <x-button wire:click="openEditModal({{ $category->id }})" class="text-gray-500 transition-colors duration-200 dark:hover:text-blue-500 dark:text-gray-300 hover:text-blue-500 focus:outline-none">
                                                    Edit
                                                </x-button>
                                                <button wire:click="viewDetails({{ $category->id }})" 
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-blue-600 focus:outline-none">
                                                    Details
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

            <div class="flex items-center justify-between mt-6">
                <a href="#" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>Previous</span>
                </a>
                <div class="items-center hidden lg:flex gap-x-3">
                    @for ($i = 1; $i <= $expenseCategories->lastPage(); $i++)
                        <a href="#" wire:click="gotoPage({{ $i }})" class="px-2 py-1 text-sm {{ $i == $expenseCategories->currentPage() ? 'text-blue-500 bg-blue-100/60' : 'text-gray-500' }} rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">{{ $i }}</a>
                    @endfor
                </div>
                <a href="#" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </section>
    </div>

    <!-- New Category Modal -->
    <x-dialog-modal wire:model="showNewCategoryModal">
        <x-slot name="title">New Expense Category</x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                <input type="text" wire:model="newCategoryName" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="newCategoryDescription" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Code (Optional)</label>
                <input type="text" wire:model="newCategoryCode" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeNewCategoryModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
            <button wire:click="saveNewCategory" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Category Modal -->
    <x-dialog-modal wire:model="showEditModal">
        <x-slot name="title">Edit Expense Category</x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium text-gray-700">Category Name <span class="text-red-500">*</span></label>
                <input type="text" wire:model="editCategoryName" id="editName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea wire:model="editCategoryDescription" id="editDescription" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="editCode" class="block text-sm font-medium text-gray-700">Code (Optional)</label>
                <input type="text" wire:model="editCategoryCode" id="editCode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="closeEditModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
            <button wire:click="updateCategory" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Save</button>
        </x-slot>
    </x-dialog-modal>
</div>