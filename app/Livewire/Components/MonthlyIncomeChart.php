<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Carbon\Carbon;
use App\Models\Budget;

class MonthlyIncomeChart extends Component
{
    public $startDate;
    public $endDate;
    public $selectedFilter = '3months'; // Default to past 3 months
    public $chartData = [];
    public $totalIncome = 0;
    public $avgIncome = 0;
    public $maxIncome = 0;
    public $highestMonth = null;
    public $growthPercent = 0;
    
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
        // Get income data for the selected period
        $incomes = Budget::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(estimated_amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        // Generate all months in the date range for complete data
        $start = Carbon::parse($this->startDate)->startOfMonth();
        $end = Carbon::parse($this->endDate)->endOfMonth();
        $monthsInRange = [];
        
        $period = $start->copy();
        while ($period->lte($end)) {
            $key = $period->format('Y-m');
            $monthsInRange[$key] = [
                'name' => $period->format('M Y'),
                'month' => $period->month,
                'year' => $period->year,
                'value' => 0
            ];
            $period->addMonth();
        }
        
        // Fill in actual income data
        foreach ($incomes as $income) {
            $key = sprintf('%d-%02d', $income->year, $income->month);
            if (isset($monthsInRange[$key])) {
                $monthsInRange[$key]['value'] = $income->total;
            }
        }
        
        // Convert to array for chart
        $this->chartData = array_values($monthsInRange);
        
        // Calculate metrics
        $this->totalIncome = array_sum(array_column($this->chartData, 'value'));
        $monthCount = count($this->chartData) ?: 1;
        $this->avgIncome = $this->totalIncome / $monthCount;
        
        // Find highest month
        $this->maxIncome = 0;
        $this->highestMonth = null;
        
        if (!empty($this->chartData)) {
            $highestMonthData = $this->chartData[0];
            foreach ($this->chartData as $monthData) {
                if ($monthData['value'] > ($highestMonthData['value'] ?? 0)) {
                    $highestMonthData = $monthData;
                }
            }
            $this->highestMonth = $highestMonthData['name'];
            $this->maxIncome = $highestMonthData['value'];
        }
        
        // Calculate growth rate
        $this->calculateGrowthRate();
        
        // Create line chart model
        $chart = LivewireCharts::lineChartModel()
            ->setTitle('Monthly Income')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#10B981'])
            ->setXAxisCategories(array_column($this->chartData, 'name'))
            ->setStrokeWidth(3);
            
            
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
    
    protected function calculateGrowthRate()
    {
        // We need at least two months to calculate growth
        if (count($this->chartData) < 2) {
            $this->growthPercent = 0;
            return;
        }
        
        // Calculate month-over-month growth
        // Sort by date to ensure we're comparing the right months
        usort($this->chartData, function($a, $b) {
            $dateA = Carbon::createFromDate($a['year'], $a['month'], 1);
            $dateB = Carbon::createFromDate($b['year'], $b['month'], 1);
            return $dateA <=> $dateB;
        });
        
        // Get first and last month values
        $firstMonth = reset($this->chartData);
        $lastMonth = end($this->chartData);
        
        // Calculate growth rate if first month has any income
        if ($firstMonth['value'] > 0) {
            $this->growthPercent = (($lastMonth['value'] - $firstMonth['value']) / $firstMonth['value']) * 100;
        } elseif ($lastMonth['value'] > 0) {
            // If first month is zero but last month has value, growth is 100%
            $this->growthPercent = 100;
        } else {
            // Both are zero, no growth
            $this->growthPercent = 0;
        }
    }
    
    public function render()
    {
        $chartModel = $this->generateChart();
        
        return view('livewire.components.monthly-income-chart', [
            'chartModel' => $chartModel,
            'totalIncome' => $this->totalIncome,
            'avgIncome' => $this->avgIncome,
            'maxIncome' => $this->maxIncome,
            'highestMonth' => $this->highestMonth,
            'growthPercent' => $this->growthPercent,
            'chartData' => $this->chartData
        ]);
    }
}