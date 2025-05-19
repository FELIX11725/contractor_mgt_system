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
                            <button x-data @click="$dispatch('open-modal', 'edit-profile')" class="bg-indigo-600 hover:bg-indigo-700 text-white flex items-center rounded-lg px-3 py-1.5 text-sm transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Profile
                            </button>
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
                                @forelse($staff->documents as $document)
                                <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700/50 p-2 rounded">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <span class="text-slate-700 dark:text-slate-300 block">{{ $document->name }}</span>
                                            <span class="text-xs text-slate-500 dark:text-slate-400">
                                                Issued: {{ $document->issue_date->format('M d, Y') }} | 
                                                @if($document->expiry_date)
                                                    Expires: {{ $document->expiry_date->format('M d, Y') }}
                                                @else
                                                    No expiry
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('contractors.download-document', $document) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                        <button @click="$dispatch('open-modal', { id: 'confirm-document-delete', documentId: {{ $document->id }} })" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @empty
                                <p class="text-slate-500 dark:text-slate-400 text-center py-4">No documents uploaded yet</p>
                                @endforelse
                            </div>
                            <button @click="$dispatch('open-modal', 'upload-document')" class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-dashed border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
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

    <!-- Edit Profile Modal -->
    <x-dialog-modals wire:model="editProfileModal" id="edit-profile" maxWidth="7xl">
        <x-slot name="title">Edit Profile</x-slot>
        
        <x-slot name="content">
            <form id="editProfileForm" method="POST" action="{{ route('contractors.update-profile', $staff) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" id="first_name" value="{{ $staff->first_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" id="last_name" value="{{ $staff->last_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ $staff->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ $staff->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position <span class="text-red-500">*</span></label>
                        <input type="text" name="position" id="position" value="{{ $staff->position }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ $staff->address }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="emergency_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact</label>
                        <input type="text" name="emergency_contact" id="emergency_contact" value="{{ $staff->emergency_contact }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="tax_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax ID</label>
                        <input type="text" name="tax_id" id="tax_id" value="{{ $staff->tax_id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="bank_account" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bank Account</label>
                        <input type="text" name="bank_account" id="bank_account" value="{{ $staff->bank_account }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </form>
        </x-slot>
        
      <x-slot name="footer">
    <div class="flex justify-end gap-4">
        <button type="button" 
            @click="$dispatch('close-modal', 'edit-profile')" 
            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-600 dark:text-white dark:border-gray-600">
            Cancel
        </button>
        <button type="submit" form="editProfileForm" 
            class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save Changes
        </button>
    </div>
</x-slot>

    </x-dialog-modals>

    <!-- Upload Document Modal -->
   <x-dialog-modals wire:model="uploadDocumentModal" id="upload-document" maxWidth="7xl">
    <x-slot name="title">Upload Document</x-slot>
    
    <x-slot name="content">
        <form id="uploadDocumentForm" method="POST" action="{{ route('contractors.upload-document', $staff) }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="document_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Document Type <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="document_type" id="document_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="document" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Document File <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="document" id="document" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-600 dark:file:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX, JPG, PNG (Max: 2MB)</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Issue Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="issue_date" id="issue_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Expiry Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="expiry_date" id="expiry_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    
    <x-slot name="footer">
        <div class="flex justify-end gap-4">
            <button type="button" 
                @click="$dispatch('close-modal', 'upload-document')" 
                class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-600 dark:text-white dark:border-gray-600">
                Cancel
            </button>
            <button type="submit" form="uploadDocumentForm" 
                class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Upload Document
            </button>
        </div>
    </x-slot>

</x-dialog-modals>


    <!-- Delete Document Confirmation Modal -->
   <x-dialog-modals wire:model="confirmDocumentDeletion" id="confirm-document-delete">
    <x-slot name="title">Delete Document</x-slot>
    
    <x-slot name="content">
        <p class="text-gray-600 dark:text-gray-400">Are you sure you want to delete this document?</p>
        <form id="deleteDocumentForm" method="POST" action="">
            @csrf
            @method('DELETE')
        </form>
    </x-slot>
    
    <x-slot name="footer">
        <button type="button" @click="$dispatch('close-modal', 'confirm-document-delete')" class="mr-2 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-600 dark:text-white dark:border-gray-600">
            Cancel
        </button>
        <button type="submit" form="deleteDocumentForm" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Delete Document
        </button>
    </x-slot>
</x-dialog-modals>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle document deletion confirmation
                Livewire.on('open-modal', (event) => {
                    if (event.id === 'confirm-document-delete') {
                        const form = document.getElementById('deleteDocumentForm');
                        form.action = `/contractors/documents/${event.documentId}`;
                    }
                });

                // Set today as default issue date
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('issue_date').value = today;
            });
        </script>
    @endpush
</x-app-layout>