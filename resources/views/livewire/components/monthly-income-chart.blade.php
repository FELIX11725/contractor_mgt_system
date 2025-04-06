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
        
        <div class="mt-3 sm:mt-0">
            <select class="bg-gray-50 border border-gray-200 text-gray-700 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="year">Past Year</option>
                <option value="6months">Past 6 Months</option>
                <option value="3months" selected>Past 3 Months</option>
                <option value="month">This Month</option>
            </select>
        </div>
    </div>
    
    <div class="h-80">
        <livewire:livewire-line-chart
            key="{{ $chartModel->reactiveKey() }}"
            :line-chart-model="$chartModel"
        />
    </div>
    
    <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-emerald-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Total Income</p>
            <p class="text-xl font-bold text-emerald-700">${{ number_format($totalIncome ?? 0) }}</p>
        </div>
        <div class="bg-blue-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Average</p>
            <p class="text-xl font-bold text-blue-700">${{ number_format($avgIncome ?? 0) }}</p>
        </div>
        <div class="bg-purple-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Highest</p>
            <p class="text-xl font-bold text-purple-700">${{ number_format($maxIncome ?? 0) }}</p>
        </div>
        <div class="bg-amber-50 rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">Growth</p>
            <p class="text-xl font-bold {{ ($growthPercent ?? 0) >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                {{ ($growthPercent ?? 0) >= 0 ? '+' : '' }}{{ number_format($growthPercent ?? 0, 1) }}%
            </p>
        </div>
    </div>
</div>