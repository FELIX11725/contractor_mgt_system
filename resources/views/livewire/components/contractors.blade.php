<div wire:poll class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Main Card with Enhanced Shadow and Border -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-xl overflow-hidden border border-slate-200 dark:border-slate-700 transition-all duration-300 hover:shadow-lg">
            <!-- Header Section with Improved Gradient -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-500 to-blue-500 opacity-90"></div>
                <div class="relative px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <h1 class="text-2xl md:text-3xl font-bold text-white drop-shadow-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Staff Management
                        </h1>
                        
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <!-- Enhanced Search Bar with Animation -->
                            <div class="relative flex-grow md:max-w-md group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" wire:model.live="search" 
                                    class="bg-white/90 dark:bg-slate-700/90 border border-white/30 dark:border-slate-600 text-slate-800 dark:text-white text-sm rounded-lg w-full pl-11 pr-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none backdrop-blur-sm"
                                    placeholder="Search name or email..." />
                            </div>

                            <!-- Styled Bulk Actions Dropdown -->
                            @if (count($selectedStaff) > 0)
                                <div class="relative">
                                    <select wire:model="action" wire:confirm="Are you sure?" wire:change="performAction"
                                        class="appearance-none bg-white/90 dark:bg-slate-700/90 border border-white/30 dark:border-slate-600 text-slate-800 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent block w-full py-3 pl-4 pr-10 backdrop-blur-sm transition-all">
                                        <option value="">Bulk Actions</option>
                                        <option value="deleteSelectedStaff">Delete Selected</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif

                            <!-- Styled Per Page Dropdown -->
                            <div class="relative">
                                <select wire:model.live="perPage"
                                    class="appearance-none bg-white/90 dark:bg-slate-700/90 border border-white/30 dark:border-slate-600 text-slate-800 dark:text-white text-sm rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent block w-full py-3 pl-4 pr-10 backdrop-blur-sm transition-all">
                                    <option value="10">10 per page</option>
                                    <option value="20">20 per page</option>
                                    <option value="50">50 per page</option>
                                    <option value="100">100 per page</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative Wave Pattern -->
                <div class="absolute bottom-0 left-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" class="fill-white dark:fill-slate-800">
                        <path d="M0,0V60H1440V0C1360,40 1280,50 1200,50C1040,50 880,20 720,20C560,20 400,50 240,50C160,50 80,40 0,0Z"></path>
                    </svg>
                </div>
            </div>

            <!-- Selection Info with Enhanced Styling -->
            @if (count($selectedStaff))
                <div class="bg-indigo-50 dark:bg-indigo-900/30 px-6 py-4 flex items-center justify-between border-b border-indigo-100 dark:border-indigo-900/50">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center p-2 rounded-full bg-indigo-100 dark:bg-indigo-800/50 text-indigo-700 dark:text-indigo-300 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span class="font-medium text-indigo-700 dark:text-indigo-300">
                            {{ count($selectedStaff) }} staff member{{ count($selectedStaff) > 1 ? 's' : '' }} selected
                        </span>
                    </div>
                    <button wire:click="deselectAll" type="button" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Deselect all
                    </button>
                </div>
            @endif

            <!-- Table Section with Enhanced Styling -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">#</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Staff Member</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Position</span>
                            </th>
                            <th class="px-6 py-4 text-right">
                                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @foreach ($staff as $member)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="peer sr-only" 
                                                wire:model.live="selectedStaff" value="{{ $member->id }}">
                                            <div class="w-5 h-5 border border-slate-300 dark:border-slate-600 rounded transition-colors 
                                                        bg-white dark:bg-slate-700
                                                        peer-checked:bg-indigo-500 peer-checked:border-indigo-500 
                                                        peer-focus:ring-2 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800">
                                                <svg class="w-3 h-3 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 relative">
                                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 animate-pulse opacity-50 blur-sm"></div>
                                            <div class="relative h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                {{ strtoupper(substr($member->first_name, 0, 1)) }}{{ strtoupper(substr($member->last_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-base font-semibold text-slate-900 dark:text-slate-100">{{ $member->first_name }} {{ $member->last_name }}</div>
                                            <div class="text-sm text-slate-500 dark:text-slate-400 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $member->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if (!$member->user?->trashed())
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-sm">
                                            <span class="flex w-2 h-2 rounded-full bg-white mr-1.5 animate-pulse"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-500 to-rose-500 text-white shadow-sm">
                                            <span class="w-2 h-2 rounded-full bg-white mr-1.5"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $member->position }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end space-x-2">
                                        @if(!$member->user?->trashed())
                                            <button wire:loading.attr="disabled"
                                                wire:target="deactivate({{ $member->id }})"
                                                wire:click="deactivate({{ $member->id }})"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-slash" viewBox="0 0 16 16">
                                                    <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                                </svg> 
                                                <span class="ml-1.5">Deactivate</span>
                                            </button>
                                        @else
                                            <button wire:loading.attr="disabled"
                                                wire:target="activate({{ $member->id }})"
                                                wire:click="activate({{ $member->id }})"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                                </svg> 
                                                <span class="ml-1.5">Activate</span>
                                            </button>
                                        @endif

                                        <button wire:loading.attr="disabled"
                                            wire:target="openStaffProfile({{ $member->id }})"
                                            wire:click="openStaffProfile({{ $member->id }})"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                            </svg> 
                                            <span class="ml-1.5">View Profile</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer with Pagination -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        Showing <span class="font-medium">{{ count($staff) }}</span> staff members
                    </p>
                    {{-- Uncomment this to enable pagination --}}
                    {{-- <div>
                        {{ $staff->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="mt-6 bg-white dark:bg-slate-800 rounded-xl p-6 shadow-md border border-slate-200 dark:border-slate-700">
            <div class="flex items-start">
                <div class="flex-shrink-0 p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100">Staff Management Tips</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                        Use the checkboxes to select multiple staff members for bulk actions. You can search by name or email using the search bar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>