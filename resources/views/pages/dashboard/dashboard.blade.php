<x-app-layout>
    <div class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">

        {{-- Dashboard actions (Filter, Datepicker, Add View) --}}
        <div class="mb-8 sm:flex sm:justify-between sm:items-center">
            <h1 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-gray-100 mb-4 sm:mb-0">Dashboard</h1>
            <div class="grid justify-start grid-flow-col gap-2 sm:auto-cols-max sm:justify-end">
                <x-dropdown-filter align="right" />
                <x-datepicker />
                <button class="btn text-gray-100 bg-gray-900 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"/>
                    </svg>
                    <span class="max-xs:sr-only">Add View</span>
                </button>
            </div>
        </div>

        <div class="flex flex-wrap">

            {{-- Active Projects --}}
            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-4">
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 relative overflow-hidden">
                    <h5 class="text-white uppercase font-bold text-sm mb-2">Active Projects</h5>
                    <span class="text-3xl font-bold text-white">{{ $activeProjectsCount }}</span>
                    <div class="absolute bottom-0 left-0 w-full h-2 bg-blue-300">
                        {{-- <div class="h-full bg-blue-600" style="width: {{ $projectCompletionPercentage }}%;"></div> --}}
                    </div>
                    <div class="mt-4 text-white text-sm">
                       {{-- @foreach ($recentProjects as $project)  
                          <p>{{ Str::limit($project->name, 15) }}</p> 
                       @endforeach --}}
                     </div>
                </div>
            </div>

            {{-- Financial Health --}}
            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-4">
                <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow-lg p-6">
                   <h5 class="text-white uppercase font-bold text-sm mb-2">Expenses</h5>
                    <div class="flex items-center text-white">
                        <span class="text-3xl font-bold mr-2">UGX {{ number_format($totalExpenses,"0",".",",") }}</span>
                    </div>
                    <div class="w-full bg-green-300 rounded-full h-2.5 mt-4 overflow-hidden">
                        {{-- <div class="bg-green-600 h-full" style="width: {{ $budgetPercentage }}%;"></div> --}}
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-4">
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 rounded-lg shadow-lg p-6">
                   <h5 class="text-white uppercase font-bold text-sm mb-2">Budget Costs</h5>
                    <div class="flex items-center text-white">
                        <span class="text-3xl font-bold mr-2">UGX {{ number_format($totalBudget,"0",".",",") }}</span> 
                    </div>
                    <div class="w-full bg-yellow-300 rounded-full h-2.5 mt-4 overflow-hidden">
                        {{-- <div class="bg-green-600 h-full" style="width: {{ $budgetPercentage }}%;"></div> --}}
                    </div>
                </div>
            </div>

            {{-- Contractor Performance --}}
            <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-4 relative">  {{-- Added relative for positioning --}}
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 rounded-lg shadow-lg p-6 overflow-hidden"> {{-- Overflow hidden for carousel --}}
                    <h5 class="text-white uppercase font-bold text-sm mb-2">Contractors</h5>
                    <div id="contractor-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                           @foreach ($topContractors as $contractor)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="text-white">
                                        <p class="font-bold">{{ $contractor->first_name }} {{ $contractor->last_name }}</p>
                                        <p>Experience: {{ $contractor->work_experience }}years</p>
                                    </div>
                                </div>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Custom Reports --}}
            {{-- <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mb-4 transition-transform duration-300 hover:scale-105">
                 <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg shadow-lg p-6">
                    <h5 class="text-white uppercase font-bold text-sm mb-4">Reports</h5>
                    {{-- <a href="{{ route('reports') }}" class="btn bg-white text-yellow-600 hover:bg-gray-100">Generate Report</a> --}}
                </div>
            </div>

            <div class="mt-8 p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
                    <!-- Monthly Expenses vs Revenues Line Chart -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h5 class="text-gray-700 font-bold text-lg mb-4">Monthly Expenses vs. Revenues</h5>
                        <div class="h-[350px]"> <!-- Set height -->
                            <canvas id="expensesRevenuesChart"></canvas>
                        </div>
                    </div>
            
                    <!-- Quarterly Profits and Losses Bar Chart -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h5 class="text-gray-700 font-bold text-lg mb-4">Quarterly Profits and Losses</h5>
                        <div class="h-[350px]"> <!-- Set height -->
                            <canvas id="profitsLossesChart"></canvas>
                        </div>
                    </div>
            
                </div>
            </div>
            

            {{-- Project Progress --}}
            {{-- <div class="w-full mt-8 p-10">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <h5 class="text-gray-700 dark:text-gray-100 font-bold text-lg mb-4">Project Progress</h5>
                    @foreach ($projects as $project)
                        @php
                            $gradient = 'from-red-500 to-red-700';
                            if ($project->progress >= 50 && $project->progress < 100) {
                                $gradient = 'from-blue-500 to-blue-700';
                            } elseif ($project->progress == 100) {
                                $gradient = 'from-green-500 to-green-700';
                            }
                        @endphp
                        <div class="mb-6">
                            <p class="text-gray-800 dark:text-white font-medium">{{ $project->project_name }}</p>
                            <div class="relative w-full bg-gray-300 dark:bg-gray-700 rounded-full h-2 shadow-inner overflow-hidden">
                                <div class="h-full bg-gradient-to-r {{ $gradient }} rounded-full transition-all duration-700 ease-in-out"
                                    style="width: {{ $project->progress }}%;">
                                </div>
                                <span class="absolute top-[-1.8rem] left-[calc({{ $project->progress }}% - 15px)] bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded-md opacity-80 shadow-md">
                                    {{ number_format($project->progress, 2) }}%
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
            

        </div>  {{-- End flex-wrap --}}

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Monthly Expenses vs Revenues Chart
            var ctx1 = document.getElementById("expensesRevenuesChart").getContext("2d");
            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: @json($months),
                    datasets: [
                        {
                            label: "Expenses",
                            data: @json($expensesData),
                            borderColor: "red",
                            backgroundColor: "rgba(255, 0, 0, 0.2)",
                            fill: true,
                        },
                        {
                            label: "Revenues",
                            data: @json($revenuesData),
                            borderColor: "green",
                            backgroundColor: "rgba(0, 255, 0, 0.2)",
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
    
            // Quarterly Profits and Losses Chart
            var ctx2 = document.getElementById("profitsLossesChart").getContext("2d");
            new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: ["Q1", "Q2", "Q3", "Q4"],
                    datasets: [
                        {
                            label: "Profits",
                            data: @json($quarterlyProfits),
                            backgroundColor: "blue",
                        },
                        {
                            label: "Losses",
                            data: @json($quarterlyLosses),
                            backgroundColor: "orange",
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</x-app-layout>