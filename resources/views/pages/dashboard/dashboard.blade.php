<x-app-layout>
    <div class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl bg-gray-50 dark:bg-gray-900">

        {{-- Dashboard Header with improved styling --}}
        <div class="relative mb-10 sm:flex sm:justify-between sm:items-center before:absolute before:left-0 before:bottom-0 before:h-1 before:w-24 before:bg-blue-600 dark:before:bg-blue-500 pb-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 md:text-4xl dark:text-white tracking-tight">
                    Dashboard <span class="text-blue-600 dark:text-blue-400">Overview</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg font-light">Welcome back! Here's what's happening today</p>
            </div>
            <div class="grid justify-start grid-flow-col gap-3 sm:auto-cols-max sm:justify-end mt-6 sm:mt-0">
                {{-- <x-dropdown-filter align="right" class="shadow-lg" /> --}}
                <livewire:components.date-range-picker class="shadow-lg" />
            </div>
        </div>

        {{-- Summary Cards Grid with enhanced styling --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
           
            {{-- Staff Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl border-b-4 border-blue-500 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/50">
                            <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="text-blue-600 dark:text-blue-400 hover:text-blue-700 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400 mb-1">Total Staff</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ number_format($totalStaff) }}</p>
                    <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full mb-3">
                        <div class="h-1 bg-blue-500 dark:bg-blue-400 rounded-full" style="width: {{ $staffPercentageChange >= 0 ? 65 : 35 }}%"></div>
                    </div>
                    <p class="text-sm {{ $staffPercentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $staffPercentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                        </svg>
                        {{ $newStaffThisMonth }} new this month ({{ abs($staffPercentageChange) }}%)
                    </p>
                </div>
            </div>

            {{-- Projects Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl border-b-4 border-purple-500 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-purple-100 dark:bg-purple-900/50">
                            <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="text-purple-600 dark:text-purple-400 hover:text-purple-700 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400 mb-1">Active Projects</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ number_format($activeProjectsCount,"0","",",") }}</p>
                    <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full mb-3">
                        <div class="h-1 bg-purple-500 dark:bg-purple-400 rounded-full" style="width: {{ $percentageChange >= 0 ? 75 : 45 }}%"></div>
                    </div>
                    <p class="text-sm {{ $percentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $percentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                        </svg>
                        {{ $newProjectsThisWeek }} new this week ({{ $percentageChange }}%)
                    </p>
                </div>
            </div>

            {{-- Contractors Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl border-b-4 border-green-500 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-green-100 dark:bg-green-900/50">
                            <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="text-green-600 dark:text-green-400 hover:text-green-700 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400 mb-1">Contractors</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ number_format($totalContractors,"0","",",") }}</p>
                    <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full mb-3">
                        <div class="h-1 bg-green-500 dark:bg-green-400 rounded-full" style="width: {{ $contractorPercentageChange >= 0 ? 70 : 40 }}%"></div>
                    </div>
                    <p class="text-sm {{ $contractorPercentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $contractorPercentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                        </svg>
                        {{ $availableContractors }} available now ({{ $contractorPercentageChange }}%)
                    </p>
                </div>
            </div>

            {{-- Beneficiaries Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl border-b-4 border-orange-500 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-orange-100 dark:bg-orange-900/50">
                            <svg class="w-7 h-7 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-orange-600 dark:text-orange-400 hover:text-orange-700 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400 mb-1">Beneficiaries</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white mb-2">2,450</p>
                    <div class="w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full mb-3">
                        <div class="h-1 bg-orange-500 dark:bg-orange-400 rounded-full" style="width: 42%"></div>
                    </div>
                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        5% decrease this quarter
                    </p>
                </div>
            </div>
        </div>

        {{-- Financial Summary Cards with enhanced styling --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            {{-- Budget Card --}}
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-xl overflow-hidden text-white transform transition hover:scale-[1.02] duration-300">
                <div class="p-7 relative overflow-hidden">
                    <div class="absolute -bottom-12 -right-12 opacity-10">
                        <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium uppercase tracking-wider mb-1">Total Budgets Expense</h3>
                            <p class="text-4xl font-bold mt-2">UGX {{ number_format($totalBudget, 0, '.', ',') }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="h-2.5 bg-blue-300/30 rounded-full overflow-hidden backdrop-blur-sm shadow-inner">
                            <div class="h-full bg-white/80 rounded-full" style="width: {{ $budgetUtilization }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm font-medium">
                            <p>
                                @if($budgetUtilization > 0)
                                    {{ $budgetUtilization }}% allocated
                                @else
                                    No allocations yet
                                @endif
                            </p>
                            <p>100%</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Expenses Card --}}
            <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl shadow-xl overflow-hidden text-white transform transition hover:scale-[1.02] duration-300">
                <div class="p-7 relative overflow-hidden">
                    <div class="absolute -bottom-12 -right-12 opacity-10">
                        <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium uppercase tracking-wider mb-1">Total Expenses</h3>
                            <p class="text-4xl font-bold mt-2">UGX {{ number_format($currentMonthExpenses, 0, '.', ',') }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="h-2.5 bg-purple-300/30 rounded-full overflow-hidden backdrop-blur-sm shadow-inner">
                            <div class="h-full bg-white/80 rounded-full" style="width: {{ $budgetPercentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm font-medium">
                            <p>
                                @if($expensePercentageChange >= 0)
                                    <span class="font-medium">{{ abs($expensePercentageChange) }}% increase</span> from last month
                                @else
                                    <span class="font-medium">{{ abs($expensePercentageChange) }}% decrease</span> from last month
                                @endif
                            </p>
                            <p>{{ $budgetPercentage }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profit Card --}}
            <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl shadow-xl overflow-hidden text-white transform transition hover:scale-[1.02] duration-300">
                <div class="p-7 relative overflow-hidden">
                    <div class="absolute -bottom-12 -right-12 opacity-10">
                        <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium uppercase tracking-wider mb-1">Projected Profit</h3>
                            <p class="text-4xl font-bold mt-2">UGX {{ number_format(3500000, 0, '.', ',') }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="h-2.5 bg-green-300/30 rounded-full overflow-hidden backdrop-blur-sm shadow-inner">
                            <div class="h-full bg-white/80 rounded-full" style="width: 78%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm font-medium">
                            <p>22% higher than target</p>
                            <p>78%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts Section with enhanced styling --}}
        <div class="w-full mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <livewire:components.monthly-income-chart />
                <livewire:components.monthly-expenditure-chart />
            </div>
        </div>

        {{-- Recent Activity Section with enhanced styling --}}
        <div class="mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Recent Activity</h3>
                    <span class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded-full">5 new</span>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach(range(1, 5) as $i)
                    <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center shadow-md">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="text-base font-medium text-gray-900 dark:text-white">Project update submitted</p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">{{ $i }} hour{{ $i > 1 ? 's' : '' }} ago</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Phase {{ $i }} completed by Contractor #{{ $i }}</p>
                                <div class="mt-2 flex items-center">
                                    <div class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 text-xs px-2 py-0.5 rounded">Completed</div>
                                    <div class="mx-2 h-1 w-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Verified by Admin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/80 text-center">
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View all activity
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    @livewireScripts
    @livewireChartsScripts
</x-app-layout>