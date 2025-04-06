<div wire:poll class="bg-slate-50 dark:bg-slate-900 min-h-screen">
    <div class="max-w-7xl mx-auto py-6">
        <!-- Header Section with Shadow and Gradient -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md mb-6 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-blue-600 h-2"></div>
            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Staff Members
                </h1>
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    <!-- Search Bar with Icon -->
                    <div class="relative flex-grow md:max-w-md">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" wire:model.live="search" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search name or email..." />
                    </div>

                    <!-- Bulk Actions Dropdown -->
                    @if (count($selectedStaff) > 0)
                        <div>
                            <select wire:model="action" wire:confirm="Are you sure?" wire:change="performAction"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="">Choose action</option>
                                <option value="deleteSelectedStaff">Delete</option>
                            </select>
                        </div>
                    @endif

                    <!-- Per Page Dropdown -->
                    <div>
                        <select wire:model.live="perPage"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="10">10 per page</option>
                            <option value="20">20 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Selection Info -->
            @if (count($selectedStaff))
                <div class="bg-indigo-50 dark:bg-indigo-900/30 px-6 py-3 text-sm flex items-center">
                    <span class="font-medium text-indigo-700 dark:text-indigo-300">{{ count($selectedStaff) }} staff selected</span>
                    <span class="mx-2 text-gray-500">|</span>
                    <button wire:click="deselectAll" type="button" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-medium transition">
                        Deselect all
                    </button>
                </div>
            @endif

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800/60 border-y border-gray-200 dark:border-gray-700">
                            <th class="px-4 py-3 text-left">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">#</span>
                            </th>
                            <th class="px-4 py-3 text-left">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</span>
                            </th>
                            <th class="px-4 py-3 text-left">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</span>
                            </th>
                            <th class="px-4 py-3 text-left">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Position</span>
                            </th>
                            <th class="px-4 py-3 text-right">
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($staff as $member)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            wire:model.live="selectedStaff" value="{{ $member->id }}">
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-medium">
                                                {{ strtoupper(substr($member->first_name, 0, 1)) }}{{ strtoupper(substr($member->last_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $member->first_name }} {{ $member->last_name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if (!$member->user?->trashed())
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                            <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">
                                            <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $member->position }}</span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end space-x-2">
                                        @if(!$member->user?->trashed())
                                            <x-danger-button wire:loading.attr="disabled"
                                                wire:target="deactivate({{ $member->id }})"
                                                wire:click="deactivate({{ $member->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white flex items-center rounded-lg px-3 py-1.5 text-sm transition-colors shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-slash" viewBox="0 0 16 16">
                                                    <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                                </svg> 
                                                <span class="ml-1 whitespace-nowrap">Deactivate</span>
                                            </x-danger-button>
                                        @else
                                            <x-button wire:loading.attr="disabled"
                                                wire:target="activate({{ $member->id }})"
                                                wire:click="activate({{ $member->id }})"
                                                class="bg-green-500 hover:bg-green-600 text-white flex items-center rounded-lg px-3 py-1.5 text-sm transition-colors shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                </svg> 
                                                <span class="ml-1 whitespace-nowrap">Activate</span>
                                            </x-button>
                                        @endif

                                        <x-button wire:loading.attr="disabled"
                                            wire:target="openStaffProfile({{ $member->id }})"
                                            wire:click="openStaffProfile({{ $member->id }})"
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white flex items-center rounded-lg px-3 py-1.5 text-sm transition-colors shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                            </svg> 
                                            <span class="ml-2 whitespace-nowrap">Profile</span>
                                        </x-button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section (Commented in original) -->
            {{-- <div class="px-6 py-4">
                {{ $staff->links() }}
            </div> --}}
        </div>
    </div>
</div>