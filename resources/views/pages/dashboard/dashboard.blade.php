<x-app-layout>
    <div class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">

        {{-- Dashboard Header --}}
        <div class="mb-8 sm:flex sm:justify-between sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-gray-100">Dashboard Overview</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Welcome back! Here's what's happening today</p>
            </div>
            <div class="grid justify-start grid-flow-col gap-2 sm:auto-cols-max sm:justify-end mt-4 sm:mt-0">
                <x-dropdown-filter align="right" />
                <livewire:components.date-range-picker />
            </div>
        </div>

        {{-- Summary Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
           
           {{-- Staff Card --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
    <div class="p-6 flex items-start justify-between">
        <div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/50 mb-4">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Staff</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalStaff) }}</p>
            <p class="text-sm {{ $staffPercentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $staffPercentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                </svg>
                {{ $newStaffThisMonth }} new this month ({{ abs($staffPercentageChange) }}%)
            </p>
        </div>
        <div class="text-blue-600 dark:text-blue-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>
</div>

            {{-- Projects Card --}}
          
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
    <div class="p-6 flex items-start justify-between">
        <div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/50 mb-4">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Active Projects</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($activeProjectsCount,"0","",",") }}</p>
            <p class="text-sm {{ $percentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $percentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                </svg>
                {{ $newProjectsThisWeek }} new this week ({{ $percentageChange }}%)
            </p>
        </div>
        <div class="text-purple-600 dark:text-purple-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>
</div>

            {{-- Contractors Card --}}
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
    <div class="p-6 flex items-start justify-between">
        <div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/50 mb-4">
                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Contractors</h3>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalContractors,"0","",",") }}</p>
            <p class="text-sm {{ $contractorPercentageChange >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $contractorPercentageChange >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                </svg>
                {{ $availableContractors }} available now ({{ $contractorPercentageChange }}%)
            </p>
        </div>
        <div class="text-green-600 dark:text-green-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>
</div>

            {{-- Beneficiaries Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-6 flex items-start justify-between">
                    <div>
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900/50 mb-4">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Beneficiaries</h3>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">2,450</p>
                        <p class="text-sm text-red-600 dark:text-red-400 mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            5% decrease this quarter
                        </p>
                    </div>
                    <div class="text-orange-600 dark:text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Financial Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          {{-- Budget Card --}}
<div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden text-white">
    <div class="p-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-medium uppercase tracking-wider">Total Budgets Expense</h3>
                <p class="text-3xl font-bold mt-2">UGX {{ number_format($totalBudget, 0, '.', ',') }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="h-2 bg-blue-300 rounded-full overflow-hidden">
                <div class="h-full bg-white/80 rounded-full" style="width: {{ $budgetUtilization }}%"></div>
            </div>
            <p class="text-sm mt-2">
                @if($budgetUtilization > 0)
                    {{ $budgetUtilization }}% of budget allocated
                @else
                    No budget allocations yet
                @endif
            </p>
        </div>
    </div>
</div>

           {{-- Expenses Card --}}
<div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden text-white">
    <div class="p-6">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-medium uppercase tracking-wider">Total Expenses</h3>
                <p class="text-3xl font-bold mt-2">UGX {{ number_format($currentMonthExpenses, 0, '.', ',') }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="h-2 bg-purple-300 rounded-full overflow-hidden">
             
                <div class="h-full bg-white/80 rounded-full" style="width: {{ $budgetPercentage }}%"></div>
            </div>
            <p class="text-sm mt-2">
                @if($expensePercentageChange >= 0)
                    <span class="font-medium">{{ abs($expensePercentageChange) }}% increase</span> from last month
                @else
                    <span class="font-medium">{{ abs($expensePercentageChange) }}% decrease</span> from last month
                @endif
            </p>
        </div>
    </div>
</div>

            {{-- Profit Card --}}
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg overflow-hidden text-white">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium uppercase tracking-wider">Projected Profit</h3>
                            <p class="text-3xl font-bold mt-2">UGX {{ number_format(3500000, 0, '.', ',') }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 bg-green-300 rounded-full overflow-hidden">
                            <div class="h-full bg-white/80 rounded-full" style="width: 78%"></div>
                        </div>
                        <p class="text-sm mt-2">22% higher than target</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts Section --}}
        <div class="w-full mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <livewire:components.monthly-income-chart />
                <livewire:components.monthly-expenditure-chart />
            </div>
        </div>

        {{-- Recent Activity Section --}}
        <div class="mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white">Recent Activity</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach(range(1, 5) as $i)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Project update submitted</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Phase {{ $i }} completed by Contractor #{{ $i }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $i }} hour{{ $i > 1 ? 's' : '' }} ago</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">View all activity</a>
                </div>
            </div>
        </div>
    </div>
    
    @livewireScripts
    @livewireChartsScripts
</x-app-layout>