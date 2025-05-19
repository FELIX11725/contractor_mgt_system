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
                <div>

                  <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Project: {{ $projects->project_name }}</h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Started: {{ $projects->start_date }}</p>
                </div>
                <div class="flex items-center gap-3">
                  <span class="px-3 py-1 text-xs font-medium text-white bg-{{ $projects->status_color }}-600 rounded-full">{{ $projects->project_status }}</span>

                  <span class="px-3 py-1 text-xs font-medium {{ $projects->is_on_schedule ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400' }} rounded-full">{{ $projects->is_on_schedule ? 'On Schedule' : 'Delayed' }}</span>
                </div>
              </div>
              
              <!-- Project Progress Chart -->
              <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="rounded-2xl bg-gray-100 dark:bg-white/[0.03] border border-gray-200 dark:border-gray-800">
                  <div class="shadow-default rounded-2xl bg-white px-5 pb-8 pt-5 dark:bg-gray-900 sm:px-6 sm:pt-6">
                    <div class="flex justify-between">
                      <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                          Project Progress
                        </h3>
                        <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                          Completion target for {{ $projects->end_date }}
                        </p>
                      </div>
                      <div x-data="{openDropDown: false}" class="relative h-fit">
                        <button
                          @click="openDropDown = !openDropDown"
                          :class="openDropDown ? 'text-gray-700 dark:text-white' : 'text-gray-400 hover:text-gray-700 dark:hover:text-white'"
                        >
                          <svg
                            class="fill-current"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                              fill=""
                            />
                          </svg>
                        </button>
                        <div
                          x-show="openDropDown"
                          @click.outside="openDropDown = false"
                          class="absolute right-0 top-full z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark"
                        >
                          <button
                            class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
                          >
                            View Details
                          </button>
                          <button
                            class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
                          >
                            Export Report
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="relative max-h-[195px]">
                      <div id="project{{ $projects->id }}Chart" class="h-full"></div>
                      <span
                        class="absolute left-1/2 top-[85%] -translate-x-1/2 -translate-y-[85%] rounded-full {{ $projects->progress_trend > 0 ? 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' : 'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-500' }} px-3 py-1 text-xs font-medium"

                        >{{ $projects->progress_trend > 0 ? '+' : '' }}{{ $projects->progress_trend }} %</span>

                    </div>
                    <p
                      class="mx-auto mt-1.5 w-full max-w-[380px] text-center text-sm text-gray-500 sm:text-base"
                    >
                      {{ $projects->progress_message }}
                    </p>
                  </div>
          
                  <div
                    class="flex items-center justify-center gap-5 px-6 py-3.5 sm:gap-8 sm:py-5"
                  >
                    <div>
                      <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm"
                      >
                        Target
                      </p>
                      <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg"
                      >
                        {{ $projects->completion_target }}%
                        @if($projects->target_trend < 0)
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.26816 13.6632C7.4056 13.8192 7.60686 13.9176 7.8311 13.9176C7.83148 13.9176 7.83187 13.9176 7.83226 13.9176C8.02445 13.9178 8.21671 13.8447 8.36339 13.6981L12.3635 9.70076C12.6565 9.40797 12.6567 8.9331 12.3639 8.6401C12.0711 8.34711 11.5962 8.34694 11.3032 8.63973L8.5811 11.36L8.5811 2.5C8.5811 2.08579 8.24531 1.75 7.8311 1.75C7.41688 1.75 7.0811 2.08579 7.0811 2.5L7.0811 11.3556L4.36354 8.63975C4.07055 8.34695 3.59568 8.3471 3.30288 8.64009C3.01008 8.93307 3.01023 9.40794 3.30321 9.70075L7.26816 13.6632Z"
                            fill="#D92D20"
                          />
                        </svg>
                        @else
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                            fill="#039855"
                          />
                        </svg>
                        @endif
                      </p>
                    </div>
          
                    <div class="h-7 w-px bg-gray-200 dark:bg-gray-800"></div>
          
                    <div>
                      <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm"
                      >
                        Current
                      </p>
                      <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg"
                      >
                        {{ $projects->current_completion }}%
                        @if($projects->current_trend < 0)
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.26816 13.6632C7.4056 13.8192 7.60686 13.9176 7.8311 13.9176C7.83148 13.9176 7.83187 13.9176 7.83226 13.9176C8.02445 13.9178 8.21671 13.8447 8.36339 13.6981L12.3635 9.70076C12.6565 9.40797 12.6567 8.9331 12.3639 8.6401C12.0711 8.34711 11.5962 8.34694 11.3032 8.63973L8.5811 11.36L8.5811 2.5C8.5811 2.08579 8.24531 1.75 7.8311 1.75C7.41688 1.75 7.0811 2.08579 7.0811 2.5L7.0811 11.3556L4.36354 8.63975C4.07055 8.34695 3.59568 8.3471 3.30288 8.64009C3.01008 8.93307 3.01023 9.40794 3.30321 9.70075L7.26816 13.6632Z"
                            fill="#D92D20"
                          />
                        </svg>
                        @else
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                            fill="#039855"
                          />
                        </svg>
                        @endif
                      </p>
                    </div>
          
                    <div class="h-7 w-px bg-gray-200 dark:bg-gray-800"></div>
          
                    <div>
                      <p
                        class="mb-1 text-center text-theme-xs text-gray-500 dark:text-gray-400 sm:text-sm"
                      >
                        This Week
                      </p>
                      <p
                        class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 dark:text-white/90 sm:text-lg"
                      >
                        {{ $projects->weekly_progress }}%
                        @if($projects->weekly_trend < 0)
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.26816 13.6632C7.4056 13.8192 7.60686 13.9176 7.8311 13.9176C7.83148 13.9176 7.83187 13.9176 7.83226 13.9176C8.02445 13.9178 8.21671 13.8447 8.36339 13.6981L12.3635 9.70076C12.6565 9.40797 12.6567 8.9331 12.3639 8.6401C12.0711 8.34711 11.5962 8.34694 11.3032 8.63973L8.5811 11.36L8.5811 2.5C8.5811 2.08579 8.24531 1.75 7.8311 1.75C7.41688 1.75 7.0811 2.08579 7.0811 2.5L7.0811 11.3556L4.36354 8.63975C4.07055 8.34695 3.59568 8.3471 3.30288 8.64009C3.01008 8.93307 3.01023 9.40794 3.30321 9.70075L7.26816 13.6632Z"
                            fill="#D92D20"
                          />
                        </svg>
                        @else
                        <svg
                          width="16"
                          height="16"
                          viewBox="0 0 16 16"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.60141 2.33683C7.73885 2.18084 7.9401 2.08243 8.16435 2.08243C8.16475 2.08243 8.16516 2.08243 8.16556 2.08243C8.35773 2.08219 8.54998 2.15535 8.69664 2.30191L12.6968 6.29924C12.9898 6.59203 12.9899 7.0669 12.6971 7.3599C12.4044 7.6529 11.9295 7.65306 11.6365 7.36027L8.91435 4.64004L8.91435 13.5C8.91435 13.9142 8.57856 14.25 8.16435 14.25C7.75013 14.25 7.41435 13.9142 7.41435 13.5L7.41435 4.64442L4.69679 7.36025C4.4038 7.65305 3.92893 7.6529 3.63613 7.35992C3.34333 7.06693 3.34348 6.59206 3.63646 6.29926L7.60141 2.33683Z"
                            fill="#039855"
                          />
                        </svg>
                        @endif
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Project Milestones -->
              <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($projects->milestones as $milestone)
                <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                  <div class="flex items-start">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-{{ $milestone->status_color }}-100 dark:bg-{{ $milestone->status_color }}-900/50 flex items-center justify-center shadow-md">
                      <svg class="h-6 w-6 text-{{ $milestone->status_color }}-600 dark:text-{{ $milestone->status_color }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        @if($milestone->milestone_status === 'Completed')
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        @elseif($milestone->milestone_status === 'In Progress')
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        @elseif($milestone->milestone_status === 'Delayed')

                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        @else
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        @endif
                      </svg>
                    </div>
                    <div class="ml-4 flex-1">
                      <div class="flex justify-between items-center">
                        <p class="text-base font-medium text-gray-900 dark:text-white">{{ $milestone->name }}</p>
                        <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                          @if($milestone->status === 'Completed')
                            Completed {{ $milestone->completion_date->diffForHumans() }}
                          @elseif($milestone->status === 'In Progress')
                            Started {{ $milestone->start_date->diffForHumans() }}
                          @elseif($milestone->status === 'Delayed')
                            Delayed by {{ $milestone->delay_days }} days
                          @else
                            {{-- Due {{ $milestone->due_date->diffForHumans() }} --}}
                          @endif
                        </span>
                      </div>
                      <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $milestone->description }}</p>
                      <div class="mt-2 flex items-center">
                        <div class="bg-{{ $milestone->status_color }}-100 dark:bg-{{ $milestone->status_color }}-900/30 text-{{ $milestone->status_color }}-800 dark:text-{{ $milestone->status_color }}-400 text-xs px-2 py-0.5 rounded">{{ $milestone->status }}</div>
                        <div class="mx-2 h-1 w-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Assigned to: {{ $milestone->assigned_to }}</div>
                        @if($milestone->completion_percentage < 100)
                          <div class="mx-2 h-1 w-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                          <div class="text-xs text-gray-500 dark:text-gray-400">{{ $milestone->completion_percentage }}% complete</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              
              <div class="p-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/80 text-center">
                <a href="{{ route('projects.show', $projects->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                  <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  View Project Details
                </a>
              </div>
            </div>
          </div>
    </div>
    
    @livewireScripts
    @livewireChartsScripts
</x-app-layout>