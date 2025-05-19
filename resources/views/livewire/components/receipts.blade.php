<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                </svg>
                Receipts Management
            </h1>
            <div class="text-sm text-gray-500">
                <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md">Today: {{ date('d M Y') }}</span>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Receipts</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($receipts) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Amount</p>
                        <p class="text-2xl font-bold text-gray-900">
                            @php
                                $totalAmount = $receipts->sum('amount');
                                echo number_format($totalAmount, 0, '.', ',') . ' UGX';
                            @endphp
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="rounded-full bg-purple-100 p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Active Projects</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($projects) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Receipt Entry Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create New Receipt
                        </h2>
                    </div>
                    <div class="p-6">
                        <form wire:submit.prevent="saveReceipt" class="space-y-6">
                            <!-- Project Selection -->
                            <div>
                                <label for="project" class="block text-sm font-medium text-gray-700 mb-1">Project <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select 
                                        wire:model="selectedProject" 
                                        id="project" 
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-lg shadow-sm"
                                        required
                                    >
                                        <option value="">Select a project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Amount -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (UGX) <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">shs. </span>
                                    </div>
                                    <input 
                                        type="text" 
                                        wire:model="amount" 
                                        id="amount" 
                                        class="pl-8 block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 py-2.5"
                                        placeholder="E.g. 1,000,000"
                                        required
                                    >
                                </div>
                            </div>
                            
                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                                <textarea 
                                    wire:model="description" 
                                    id="description" 
                                    rows="3"
                                    class="shadow-sm block w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Enter receipt details here..."
                                    required
                                ></textarea>
                            </div>
                            
                            <!-- Receipt Photo -->
                            <div>
                                <label for="receipt_photo" class="block text-sm font-medium text-gray-700 mb-1">Receipt Photo <span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="receipt_photo" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input 
                                                    type="file" 
                                                    wire:model="receipt_photo" 
                                                    id="receipt_photo"
                                                    class="sr-only"
                                                    accept="image/*"
                                                >
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <button 
                                    type="submit" 
                                    class="w-full flex justify-center items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 border border-transparent rounded-lg font-medium text-white shadow-sm hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    Save Receipt
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Receipts Table -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Recent Receipts
                        </h2>
                        
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input 
                                type="text" 
                                placeholder="Search receipts..." 
                                class="rounded-full bg-white/20 text-white placeholder-white/80 border-0 focus:ring-2 focus:ring-white py-1 pl-10 pr-4 text-sm"
                            >
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Receipt No.</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Project</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount (UGX)</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($receipts as $receipt)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 flex-shrink-0 mr-3">
                                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100">
                                                        <span class="text-xs font-medium text-blue-700">
                                                            {{ substr($receipt->receipt_number, -2) }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <div>{{ $receipt->receipt_number }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="px-2 py-1 text-xs rounded-md bg-green-50 text-green-800">
                                                {{ $receipt->created_at->format('d/m/Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-700">
                                            {{ $receipt->project->project_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ number_format($receipt->amount, 0, '.', ',') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button 
                                                    wire:click.prevent="viewReceipt({{ $receipt->id }})" 
                                                    class="text-blue-600 hover:text-blue-900 inline-flex items-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </button>
                                                <button 
                                                       wire:click.prevent="downloadReceipt({{ $receipt->id }})" 
                                                       class="text-green-600 hover:text-green-900 inline-flex items-center"
                                                   >
                                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                       </svg>
                                                       Download
                                                   </button>

                                                <button 
                                                    wire:click.prevent="deleteReceipt({{ $receipt->id }})" 
                                                    class="text-red-600 hover:text-red-900 inline-flex items-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($receipts) == 0)
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">No receipts yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new receipt.</p>
                    </div>
                    @endif
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-gray-50">
                        {{ $receipts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Receipt Modal -->
    @if($viewingReceipt)
        <div class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
            <div class="fixed inset-0 transform transition-all" wire:click="closeModal">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <div class="bg-white rounded-xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-2xl sm:mx-auto">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Receipt #{{ $currentReceipt->receipt_number }}
                    </h3>
                    <button wire:click="closeModal" class="rounded-full p-1 text-white hover:bg-white/20 focus:outline-none transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="px-6 py-4">
                    <div class="flex flex-col sm:flex-row bg-indigo-50 p-4 rounded-lg mb-6">
                        <div class="flex items-center mb-3 sm:mb-0 sm:mr-8">
                            <div class="h-10 w-10 flex-shrink-0 mr-3">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-100">
                                    <span class="font-medium text-indigo-800">₵</span>
                                </span>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-indigo-900 uppercase">Amount</div>
                                <div class="text-lg font-bold text-indigo-900">{{ number_format($currentReceipt->amount, 0, '.', ',') }} UGX</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 mr-3">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                    <span class="font-medium text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-blue-900 uppercase">Date</div>
                                <div class="text-lg font-bold text-blue-900">{{ $currentReceipt->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="bg-gray-50 px-4 py-2 rounded-t-lg">
                                <p class="text-xs font-semibold text-gray-500 uppercase">Project</p>
                            </div>
                            <div class="px-4 py-3 border border-gray-100 rounded-b-lg bg-white">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-purple-100 text-purple-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                    </svg>
                                    {{ $currentReceipt->project->project_name }}
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="bg-gray-50 px-4 py-2 rounded-t-lg">
                                <p class="text-xs font-semibold text-gray-500 uppercase">Time</p>
                            </div>
                            <div class="px-4 py-3 border border-gray-100 rounded-b-lg bg-white">
                                <div class="text-sm text-gray-900">
                                    {{ $currentReceipt->created_at->format('h:i A') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="md:col-span-2">
                            <div class="bg-gray-50 px-4 py-2 rounded-t-lg">
                                <p class="text-xs font-semibold text-gray-500 uppercase">Description</p>
                            </div>
                            <div class="px-4 py-3 border border-gray-100 rounded-b-lg bg-white">
                                <p class="text-sm text-gray-900">{{ $currentReceipt->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <div class="bg-gray-50 px-4 py-2 rounded-t-lg">
                            <p class="text-xs font-semibold text-gray-500 uppercase">Receipt Image</p>
                        </div>
                        <div class="border border-gray-100 rounded-b-lg bg-white p-4">
                            @if($currentReceipt->photo_path)
                                <div class="flex justify-center">
                                    <div class="relative group">
                                        <img 
                                            src="{{ asset('storage/' . $currentReceipt->photo_path) }}" 
                                            alt="Receipt photo for {{ $currentReceipt->receipt_number }}"
                                            class="max-w-full h-auto rounded-lg border border-gray-200 shadow-sm"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-end justify-center">
                                            <div class="p-3 text-white">
                                                <button class="bg-white/30 hover:bg-white/50 rounded-full p-2 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500">No photo uploaded for this receipt</p>
                                </div>
                            @endif

                            @endif
</div>