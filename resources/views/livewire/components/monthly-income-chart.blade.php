<!-- resources/views/livewire/monthly-income-chart.blade.php -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-gray-700 font-bold text-lg">Monthly Income</h5>
        <div class="text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - 
            {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
        </div>
    </div>
    <div class="h-80">
        <livewire:livewire-line-chart
            key="{{ $chartModel->reactiveKey() }}"
            :line-chart-model="$chartModel"
        />
    </div>
</div>