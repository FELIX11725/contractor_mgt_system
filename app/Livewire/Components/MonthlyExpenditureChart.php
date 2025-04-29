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
    public $selectedFilter = 'year';
    public $chartData = [];
    public $totalExpenses = 0;
    public $avgExpenses = 0;
    public $highestMonth = null;
    public $highestMonthAmount = 0;
    public $changePercent = null;
    
    protected $listeners = [
        'dateRangeSelected' => 'updateDateRange'
    ];
    
    public function mount()
    {
        $this->applyFilter();
    }
    
    public function applyFilter()
    {
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
                $this->endDate = $now->format('Y-m-d');
                break;
            case 'custom':
                // Keep existing custom dates
                break;
            default:
                $this->startDate = $now->copy()->subMonths(3)->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->format('Y-m-d');
        }
    }
    
    public function updateDateRange($params)
    {
        $this->startDate = $params['startDate'];
        $this->endDate = $params['endDate'];
        $this->selectedFilter = 'custom';
    }
    
    public function updatedSelectedFilter()
    {
        $this->applyFilter();
    }
    
    protected function generateChart()
    {
        // Get current period expenses by month
        $expenses = Expense::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount_paid) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        // Generate all months in the date range for complete data
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        $monthsInRange = [];
        
        $period = Carbon::parse($this->startDate)->startOfMonth();
        $periodEnd = Carbon::parse($this->endDate)->endOfMonth();
        
        while ($period->lte($periodEnd)) {
            $key = $period->format('Y-m');
            $monthsInRange[$key] = [
                'name' => $period->format('M Y'),
                'month' => $period->month,
                'year' => $period->year,
                'value' => 0
            ];
            $period->addMonth();
        }
        
        // Fill in actual expense data
        foreach ($expenses as $expense) {
            $key = sprintf('%d-%02d', $expense->year, $expense->month);
            if (isset($monthsInRange[$key])) {
                $monthsInRange[$key]['value'] = $expense->total;
            }
        }
        
        // Convert to array for chart
        $this->chartData = array_values($monthsInRange);
        
        // Calculate metrics
        $this->totalExpenses = array_sum(array_column($this->chartData, 'value'));
        $monthCount = count($this->chartData) ?: 1;
        $this->avgExpenses = $this->totalExpenses / $monthCount;
        
        // Find highest month
        if (!empty($this->chartData)) {
            $highestMonthData = $this->chartData[0];
            foreach ($this->chartData as $monthData) {
                if ($monthData['value'] > $highestMonthData['value']) {
                    $highestMonthData = $monthData;
                }
            }
            $this->highestMonth = $highestMonthData['name'];
            $this->highestMonthAmount = $highestMonthData['value'];
        }
        
        // Calculate period-over-period change
        $this->calculatePeriodChange();
        
        // Create area chart
        $chart = LivewireCharts::areaChartModel()
            ->setTitle('Monthly Expenditure')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#EF4444'])
            ->setXAxisCategories(array_column($this->chartData, 'name'));
           
            
        // Add data points
        foreach ($this->chartData as $monthData) {
            $chart->addPoint(
                $monthData['name'],
                $monthData['value'],
                [
                    'formatted' => '$' . number_format($monthData['value'], 2, '.', ',')
                ]
            );
        }
        
        return $chart;
    }
    
    protected function calculatePeriodChange()
    {
        // Calculate period-over-period change percentage
        $currentPeriodLength = Carbon::parse($this->endDate)->diffInDays(Carbon::parse($this->startDate)) + 1;
        
        // Create a comparable previous period of the same length
        $previousPeriodEnd = Carbon::parse($this->startDate)->subDay();
        $previousPeriodStart = $previousPeriodEnd->copy()->subDays($currentPeriodLength - 1);
        
        // Get previous period total
        $previousPeriodTotal = Expense::whereBetween('created_at', [
                $previousPeriodStart->format('Y-m-d'),
                $previousPeriodEnd->format('Y-m-d')
            ])
            ->sum('amount_paid');
            
        // Calculate percentage change
        if ($previousPeriodTotal > 0) {
            $this->changePercent = (($this->totalExpenses - $previousPeriodTotal) / $previousPeriodTotal) * 100;
        } else {
            $this->changePercent = $this->totalExpenses > 0 ? 100 : 0;
        }
    }
    
    public function render()
    {
        $chartModel = $this->generateChart();
        
        return view('livewire.components.monthly-expenditure-chart', [
            'chartModel' => $chartModel,
            'totalExpenses' => $this->totalExpenses,
            'avgExpenses' => $this->avgExpenses,
            'highestMonth' => $this->highestMonth,
            'highestMonthAmount' => $this->highestMonthAmount,
            'changePercent' => $this->changePercent,
            'chartData' => $this->chartData
        ]);
    }
}