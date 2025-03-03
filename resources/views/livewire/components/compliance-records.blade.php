<div>
    <section class="container px-4 mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="mb-4 sm:mb-0">
                    <h1 class="text md:text-2x1 text-gray-800 dark:text-gray-100 font-bold">Contractor Compliance Documents</h1>
                </div>
    
            </div>
    
            <div class="flex items-center mt-4 gap-x-3">
                {{-- <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_3098_154395)">
                        <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_3098_154395">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
    
                    <span>Import</span>
                </button> --}}
    
                 <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <div x-data="{ modalOpen: @entangle('showModal') }">
                    <button
                        class="btn bg-gray-900 text-white"
                        @click="modalOpen = true"
                        aria-controls="project-modal">
                        Add New
                    </button>

                    <div class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-show="modalOpen" x-cloak>
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="modalOpen = false">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                            <div  class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="border-b border-gray-200 pb-2 mb-4 px-4 pt-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900" id="modal-headline">
                                            @if($modalType === 'edit') Edit Contractor @else Add Contractor @endif
                                        </h3>
                                        <button class="text-gray-400 hover:text-gray-500" @click="modalOpen = false">
                                            <span class="sr-only">Close</span>
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <form wire:submit.prevent="{{ $modalType === 'edit' ? 'update' : 'save' }}" class="px-4 pb-4">
                                    @csrf
                                    <div class="mt-2">
                                        {{--contractor from contractors table  --}}
                                        <label for="contractor_name" class="block text-sm font-medium text-gray-700">Contractor/Owner<span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <select wire:model="contractor_id" id="contractor_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">--Select Contractor/Owner--</option>
                                            @foreach ($contractors as $contractor)
                                                <option value="{{ $contractor->id }}">{{ $contractor->first_name }} {{ $contractor->last_name }}</option>
                                            @endforeach 
                                        </select>
                                        <x-input-error for="contractor_id" />
                                        </div>
                                        <div class="mt-2">
                                            <label for="document_name" class="block text-sm font-medium text-gray-700">Document Name <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                            <div class="mt-1">
                                                <label class="inline-flex items-center">
                                                    <input type="radio" wire:model="document_name" value="licence" class="form-radio text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                    <span class="ml-2">Licence</span>
                                                </label>
                                                <label class="inline-flex items-center ml-4">
                                                    <input type="radio" wire:model="document_name" value="insurance" class="form-radio text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                    <span class="ml-2">Insurance</span>
                                                </label>
                                                <label class="inline-flex items-center ml-4">
                                                    <input type="radio" wire:model="document_name" value="certification" class="form-radio text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                    <span class="ml-2">Certification</span>
                                                </label>
                                               
                                            </div>
                                            <div class="mt-2">
                                                <label for="document_name" class="block text-sm font-medium text-gray-700">Specify Document Name (optional)</label>
                                                <input type="text" wire:model="document_name" id="document_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <x-input-error for="document_name" />
                                            </div>
                                        </div>
                                    <div class="mt-2">
                                        {{--document of type file  --}}
                                        <label for="document_path" class="block text-sm font-medium text-gray-700">Document File <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <input type="file" wire:model="document_path" id="document_path" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required accept="application/pdf">
                                        <x-input-error for="document_path" />
                                    </div>
                                    <div class="mt-2">
                                        <label for="issue_date" class="block text-sm font-medium text-gray-700"> date of issue <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <input type="date" wire:model="issue_date" id="issue_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <x-input-error for="issue_date" />
                                    </div>
                                    

                                    <div class="mt-2">
                                        <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry date <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <input type="date" wire:model="expiry_date" id="expiry_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <x-input-error for="expiry_date" />
                                    </div>


                                    <div class="mt-2">
                                        <label for="submitted_date" class="block text-sm font-medium text-gray-700">Date submitted <span class="inline-block h-5 w-5 text-red-500">*</span></label>
                                        <input type="date" wire:model="submitted_date" id="submitted_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        <x-input-error for="submitted_date" />
                                    </div>

                                   

                                    <div class="mt-4 border-t border-gray-200 pt-4">
                                        <div class="flex justify-end">
                                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="modalOpen = false">Cancel</button>
                                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                @if($modalType === 'edit') Update @else Submit @endif
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    
        <div class="mt-6 md:flex md:items-center md:justify-between">
            {{-- <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                    View all
                </button>
    
                <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Monitored
                </button>
    
                <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    Unmonitored
                </button>
            </div> --}}
    
            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
    
                <input type="text" placeholder="Search" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>
    
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-3 focus:outline-none">
                                            <span>Contractor</span>
    
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </th>
    
                                    <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        document name
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        document status
                                    </th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">expiry date</th>
    
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Submitted date</th>
    
                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @forelse ($compliancerecords as $compliancerecord)
                                <tr wire:key="{{ $compliancerecord->id }}">
                                    <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <div>
                                            {{ $compliancerecord->contractor->first_name }} {{ $compliancerecord->contractor->last_name }}
                                        </div>
                                    </td>
                                    <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                        {{ $compliancerecord->document_name }}
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <x-status :status="$compliancerecord->doc_status" />
                                            <button wire:click.prevent="openStatusModal({{ $compliancerecord->id }})" class="px-2 py-1 text-blue-500 transition-colors duration-200 rounded-lg dark:text-blue-300 hover:bg-blue-100 flex items-center">
                                                Update Status
                                            </button>
                                        </div>
                                    </td>
                                    
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center">
                                            
                                            {{ \Carbon\Carbon::parse($compliancerecord->expiry_date)->format('M j, Y') }}
                                        </div>
                                    </td>
    
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center">
                                           {{ \Carbon\Carbon::parse($compliancerecord->submitted_date )->format('M j, Y') }}
                                        </div>
                                    </td>
    
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button wire:click.prevent="openEditModal({{ $compliancerecord->id }})" 
                                                class="px-2 py-1 text-blue-500 transition-colors duration-200 rounded-lg dark:text-blue-300 hover:bg-blue-100 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 2.487a2.25 2.25 0 113.182 3.182L7.129 18.586a4.5 4.5 0 01-1.691 1.065l-3.256 1.086 1.086-3.256a4.5 4.5 0 011.065-1.691L16.862 2.487z" />
                                                </svg> Edit
                                            </button>
                                    
                                            <button wire:click.prevent="delete({{ $compliancerecord->id }})" 
                                                wire:confirm="Are you sure you want to delete this compliance document?" 
                                                class="px-2 py-1 text-red-500 transition-colors duration-200 rounded-lg dark:text-red-300 hover:bg-red-100 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg> Delete
                                            </button>
                                    
                                            <a href="#" wire:click.prevent="download({{ $compliancerecord->id }})" 
                                                class="px-2 py-1 text-green-500 transition-colors duration-200 rounded-lg dark:text-green-300 hover:bg-green-100 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg> Download
                                            </a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No compliance records found.</td>
                                </tr>
                            @endforelse 
    
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div x-data="{ statusModalOpen: @entangle('showStatusModal') }">
            <div class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-show="statusModalOpen" x-cloak>
                 <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    {{-- ... Similar modal structure as the main modal --}}
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="border-b border-gray-200 pb-2 mb-4 px-4 pt-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Update Status</h3>
                            <button @click="statusModalOpen = false" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            </div>
                        </div>
                        <form wire:submit.prevent="updateStatus" class="px-4 pb-4">
                            <div class="mt-2">
                                <label for="updatedStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                <select wire:model="updatedStatus" id="updatedStatus" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="pending review">pending review</option>
                                    <option value="expired">expired</option>
                                    <option value="valid">valid</option>
                                </select>
                                <x-input-error for="updatedStatus" />
                            </div>

                            <div class="mt-4 border-t border-gray-200 pt-4 flex justify-end">
                                <button type="button" @click="statusModalOpen = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Update</button>
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    
        <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span> 
            </div>
    
            <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
    
                    <span>
                        previous
                    </span>
                </a>
    
                <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                    <span>
                        Next
                    </span>
    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>











