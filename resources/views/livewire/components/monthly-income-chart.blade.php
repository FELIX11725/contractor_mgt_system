<!-- resources/views/livewire/monthly-income-chart.blade.php -->
<div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h5 class="text-slate-800 font-bold text-xl mb-1">Monthly Income</h5>
            <p class="text-sm text-emerald-600 font-medium">
                {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - 
                {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
            </p>
        </div>
        
        <div class="mt-3 sm:mt-0 flex space-x-2 items-center">
            <select 
                wire:model.live="selectedFilter"
                class="bg-gray-50 border border-gray-200 text-gray-700 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
                <option value="year">Past Year</option>
                <option value="6months">Past 6 Months</option>
                <option value="3months">Past 3 Months</option>
                <option value="month">This Month</option>
                <option value="custom" {{ $selectedFilter === 'custom' ? 'selected' : '' }}>Custom Range</option>
            </select>
            
            @if($selectedFilter === 'custom')
            <button 
                wire:click="$dispatch('openIncomeDateRangePicker')" 
                class="bg-emerald-50 hover:bg-emerald-100 text-emerald-600 text-sm font-medium rounded-lg px-3 py-1.5 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Select Dates
            </button>
            @endif
        </div>
    </div>
    
    <div class="h-80 relative">
        @if(count($chartData) > 0)
            <livewire:livewire-line-chart
                key="{{ $chartModel->reactiveKey() }}"
                :line-chart-model="$chartModel"
            />
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <p class="mt-2 text-gray-500 font-medium">No income data available for this period</p>
                </div>
            </div>
        @endif
    </div>
    
    <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-emerald-50 rounded-lg p-3 transform transition-transform hover:scale-105">
            <p class="text-sm text-gray-500 mb-1">Total Income</p>
            <p class="text-xl font-bold text-emerald-700">${{ number_format($totalIncome ?? 0, 2) }}</p>
        </div>
        <div class="bg-blue-50 rounded-lg p-3 transform transition-transform hover:scale-105">
            <p class="text-sm text-gray-500 mb-1">Monthly Average</p>
            <p class="text-xl font-bold text-blue-700">${{ number_format($avgIncome ?? 0, 2) }}</p>
        </div>
        <div class="bg-purple-50 rounded-lg p-3 transform transition-transform hover:scale-105">
            <p class="text-sm text-gray-500 mb-1">Highest Month</p>
            <p class="text-xl font-bold text-purple-700">{{ $highestMonth ?? 'N/A' }}</p>
            @if(isset($maxIncome))
                <p class="text-sm text-purple-600">${{ number_format($maxIncome, 2) }}</p>
            @endif
        </div>
        <div class="bg-amber-50 rounded-lg p-3 transform transition-transform hover:scale-105">
            <p class="text-sm text-gray-500 mb-1">Growth</p>
            <div class="flex items-center mt-1">
                @if(isset($growthPercent))
                    @if($growthPercent >= 0)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-700 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <p class="text-xl font-bold text-emerald-700">+{{ number_format($growthPercent, 1) }}%</p>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                        </svg>
                        <p class="text-xl font-bold text-red-700">{{ number_format($growthPercent, 1) }}%</p>
                    @endif
                @else
                    <p class="text-xl font-bold text-gray-500">N/A</p>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function() {
            // Format numbers with $ for Y-axis labels
            Livewire.hook('message.processed', (message, component) => {
                if (component.el.querySelector('.apexcharts-canvas')) {
                    // Format Y-axis labels
                    const yAxisLabels = component.el.querySelectorAll('.apexcharts-yaxis-label tspan');
                    yAxisLabels.forEach(label => {
                        const value = parseFloat(label.textContent.replace(/,/g, ''));
                        if (!isNaN(value)) {
                            label.textContent = '$' + value.toLocaleString('en-US');
                        }
                    });
                    
                    // Add dollar sign to tooltip values
                    const tooltips = component.el.querySelectorAll('.apexcharts-tooltip-y-group');
                    tooltips.forEach(tooltip => {
                        const valueEl = tooltip.querySelector('.apexcharts-tooltip-text-y-value');
                        if (valueEl) {
                            const value = parseFloat(valueEl.textContent.replace(/,/g, ''));
                            if (!isNaN(value)) {
                                valueEl.textContent = '$' + value.toLocaleString('en-US');
                            }
                        }
                    });
                }
            });

            // Listen for custom date range picker events
            window.addEventListener('openIncomeDateRangePicker', () => {
                // Initialize date range picker (using a library like flatpickr)
                const datePicker = flatpickr('#incomeDateRangePicker', {
                    mode: 'range',
                    dateFormat: 'Y-m-d',
                    onClose: function(selectedDates) {
                        if (selectedDates.length === 2) {
                            const start = selectedDates[0].toISOString().split('T')[0];
                            const end = selectedDates[1].toISOString().split('T')[0];
                            Livewire.dispatch('dateRangeSelected', { startDate: start, endDate: end });
                        }
                    }
                });
                datePicker.open();
            });
        });
    </script>
    
    <style>
        .apexcharts-tooltip {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1) !important;
            border: none !important;
            border-radius: 0.75rem !important;
        }
        
        .apexcharts-tooltip-title {
            font-weight: 600 !important;
            background-color: #f9fafb !important;
            border-bottom: 1px solid #f0f0f0 !important;
            padding: 0.75rem 1rem !important;
        }
        
        .apexcharts-tooltip-y-group {
            padding: 0.5rem 1rem !important;
        }
        
        .apexcharts-xaxistooltip {
            border-radius: 0.375rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            border: none !important;
        }
        
        .apexcharts-grid-borders line {
            stroke-opacity: 0.1 !important;
        }
        
        .apexcharts-legend-text {
            font-weight: 500 !important;
        }
        
        .apexcharts-yaxis-label {
            font-weight: 500 !important;
        }
        
        /* Enhanced chart styles */
        .apexcharts-line-series .apexcharts-series-markers circle {
            stroke-width: 2px !important;
            r: 4 !important;
        }
        
        .apexcharts-line-series .apexcharts-series path {
            stroke-width: 3px !important;
        }
        
        .apexcharts-gridline {
            stroke-dasharray: 5 !important;
        }
    </style>

    <!-- Hidden date picker input element for flatpickr -->
    <input type="text" id="incomeDateRangePicker" class="hidden" />
</div>