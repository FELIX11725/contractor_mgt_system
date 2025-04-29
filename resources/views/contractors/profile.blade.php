<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Staff Profile: {{ $staff->first_name }} {{ $staff->last_name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-indigo-500 to-blue-600 h-2"></div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 h-24 w-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                            {{ strtoupper(substr($staff->first_name, 0, 1)) }}{{ strtoupper(substr($staff->last_name, 0, 1)) }}
                        </div>
                        
                        <!-- Name and Basic Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-200">
                                {{ $staff->first_name }} {{ $staff->last_name }}
                            </h1>
                            <p class="text-slate-600 dark:text-slate-400">{{ $staff->position }}</p>
                            
                            <!-- Status Badge -->
                            <div class="mt-2">
                                @if (!$staff->user?->trashed())
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
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <a href="{{ route('contractors') }}" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 flex items-center rounded-lg px-3 py-1.5 text-sm transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Personal Information -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Personal Details Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                            <h2 class="text-lg font-medium text-slate-800 dark:text-slate-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h2>
                        </div>
                        <div class="px-6 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">First Name</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->first_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Last Name</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->last_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Email</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Phone</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Position</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->position }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Hire Date</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                            <h2 class="text-lg font-medium text-slate-800 dark:text-slate-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Additional Information
                            </h2>
                        </div>
                        <div class="px-6 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Address</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->address ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Emergency Contact</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->emergency_contact ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Tax ID</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->tax_id ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Bank Account</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">{{ $staff->bank_account ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Account Status Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                            <h2 class="text-lg font-medium text-slate-800 dark:text-slate-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Account Status
                            </h2>
                        </div>
                        <div class="px-6 py-4">
                            @if (!$staff->user?->trashed())
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Status</p>
                                        <p class="text-green-600 dark:text-green-400 font-medium">Active</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Last Active</p>
                                        <p class="text-slate-800 dark:text-slate-200 font-medium">
                                            {{ $staff->user?->last_login_at ? $staff->user->last_login_at->diffForHumans() : 'Never' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Account Created</p>
                                    <p class="text-slate-800 dark:text-slate-200 font-medium">
                                        {{ $staff->user?->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            @else
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Status</p>
                                        <p class="text-red-600 dark:text-red-400 font-medium">Inactive</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Deactivated On</p>
                                        <p class="text-slate-800 dark:text-slate-200 font-medium">
                                            {{ $staff->user?->deleted_at?->format('M d, Y') ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Documents Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                            <h2 class="text-lg font-medium text-slate-800 dark:text-slate-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Documents
                            </h2>
                        </div>
                        <div class="px-6 py-4">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Contract.pdf</span>
                                    </div>
                                    <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">ID_Card.pdf</span>
                                    </div>
                                    <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-slate-700 dark:text-slate-300">Certification.pdf</span>
                                    </div>
                                    <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-dashed border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Upload Document
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('staffUpdated', () => {
                    window.location.reload();
                });
            });
        </script>
    @endpush
</x-app-layout>