<?php

namespace App\Livewire\Components;

use Carbon\Carbon;
use App\Models\Expense;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class MonthlyExpenditureChart extends Component
{
    public $startDate;
    public $endDate;
    public $selectedFilter = 'year'; // Default to past 3 months
    
    protected $listeners = ['dateRangeSelected' => 'updateDateRange'];
    
    public function mount()
    {
        $this->applyFilter();
    }
    
    public function applyFilter($filter = null)
    {
        if ($filter) {
            $this->selectedFilter = $filter;
        }
        
        $now = now();
        
        switch ($this->selectedFilter) {
            case 'year':
                $this->startDate = $now->copy()->subYear()->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->format('Y-m-d');
                break;
            case '6months':
                $this->startDate = $now->copy()->subMonths(6)->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->format('Y-m-d');
                break;
            case '3months':
                $this->startDate = $now->copy()->subMonths(3)->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->format('Y-m-d');
                break;
            case 'month':
                $this->startDate = $now->copy()->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->copy()->endOfMonth()->format('Y-m-d');
                break;
            default:
                $this->startDate = $now->copy()->subMonths(3)->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->format('Y-m-d');
        }
    }
    
    public function updateDateRange($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->selectedFilter = 'custom'; // Set to custom when dates are manually selected
    }
    
    public function updatedSelectedFilter()
    {
        $this->applyFilter();
    }
    
    protected function generateChart()
    {
        $expenses = Expense::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount_paid) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Calculate total expenses for the stats
        $totalExpenses = $expenses->sum('total');
        $monthCount = $expenses->count() ?: 1;
        $avgExpenses = $totalExpenses / $monthCount;
        
        // Get all months in the selected range
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        $monthsInRange = [];
        
        while ($start <= $end) {
            $monthsInRange[$start->month] = $start->format('M Y');
            $start->addMonth();
        }
        
        $expenseData = [];
        
        // Initialize with 0 for all months in range
        foreach ($monthsInRange as $monthNum => $monthName) {
            $expenseData[$monthNum] = [
                'name' => $monthName,
                'value' => 0
            ];
        }
        
        // Fill actual data
        foreach ($expenses as $expense) {
            $monthName = Carbon::create($expense->year, $expense->month)->format('M Y');
            $expenseData[$expense->month] = [
                'name' => $monthName,
                'value' => $expense->total
            ];
        }
        
        $chart = LivewireCharts::areaChartModel()
            ->setTitle('Monthly Expenditure')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#EF4444'])
            ->setXAxisCategories(array_column($expenseData, 'name'));
            
        foreach ($expenseData as $monthData) {
            $chart->addPoint(
                $monthData['name'],
                $monthData['value'],
                ['formatted' => 'UGX '.number_format($monthData['value'], 0, '.', ',')]
            );
        }
        
        return [
            'chartModel' => $chart,
            'totalExpenses' => $totalExpenses,
            'avgExpenses' => $avgExpenses,
            // You can add more stats here as needed
        ];
    }
    
    public function render()
    {
        $data = $this->generateChart();
        return view('livewire.components.monthly-expenditure-chart', $data);
    }
}