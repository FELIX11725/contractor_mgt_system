<!-- resources/views/livewire/monthly-expenditure-chart.blade.php -->
<div class="bg-white rounded-xl shadow-xl p-6 border border-gray-100">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h5 class="text-slate-800 font-bold text-xl mb-1">Monthly Expenditure</h5>
            <p class="text-sm text-red-600 font-medium">
                {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - 
                {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
            </p>
        </div>
        
        <div class="mt-3 sm:mt-0">
            <select 
            wire:model.live="selectedFilter"
            class="bg-gray-50 border border-gray-200 text-gray-700 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500"
        >
            <option value="year">Past Year</option>
            <option value="6months">Past 6 Months</option>
            <option value="3months">Past 3 Months</option>
            <option value="month">This Month</option>
        </select>
        </div>
    </div>
    
    <div class="h-80">
        <livewire:livewire-area-chart
            key="{{ $chartModel->reactiveKey() }}"
            :area-chart-model="$chartModel"
        />
    </div>
    
    <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-red-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Total Expenses</p>
            <p class="text-xl font-bold text-red-700">${{ number_format($totalExpenses ?? 0) }}</p>
        </div>
        <div class="bg-amber-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Average</p>
            <p class="text-xl font-bold text-amber-700">${{ number_format($avgExpenses ?? 0) }}</p>
        </div>
        <div class="bg-blue-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Highest Category</p>
            <p class="text-xl font-bold text-blue-700">{{ $topCategory ?? 'N/A' }}</p>
        </div>
        <div class="bg-purple-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Change</p>
            <p class="text-xl font-bold {{ ($changePercent ?? 0) <= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                {{ ($changePercent ?? 0) <= 0 ? '' : '+' }}{{ number_format($changePercent ?? 0, 1) }}%
            </p>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                // Format numbers with commas for thousands separators
                if (component.el.querySelector('.apexcharts-canvas')) {
                    const yAxisLabels = component.el.querySelectorAll('.apexcharts-yaxis-label tspan');
                    yAxisLabels.forEach(label => {
                        const value = parseFloat(label.textContent.replace(/,/g, ''));
                        if (!isNaN(value)) {
                            label.textContent = value.toLocaleString('en-US');
                        }
                    });
                    
                    // Format tooltip values with commas
                    const originalTooltipFormatter = ApexCharts.prototype.formatTooltipValues;
                    if (originalTooltipFormatter && !ApexCharts.prototype.formatTooltipValuesWithCommas) {
                        ApexCharts.prototype.formatTooltipValuesWithCommas = true;
                        ApexCharts.prototype.formatTooltipValues = function(val) {
                            const formattedVal = originalTooltipFormatter.call(this, val);
                            if (typeof formattedVal === 'string' && !isNaN(parseFloat(formattedVal.replace(/,/g, '')))) {
                                return parseFloat(formattedVal.replace(/,/g, '')).toLocaleString('en-US');
                            }
                            return formattedVal;
                        };
                    }
                }
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
    </style>
</div>