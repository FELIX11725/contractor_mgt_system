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
    protected $listeners = ['dateRangeSelected' => 'updateDateRange'];
    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }
    public function updateDateRange($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    protected function generateChart()
    {
        $expenses = Expense::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw('MONTH(created_at) as month, SUM(amount_paid) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $months = [];
        $expenseData = [];
        
        // Initialize all months with 0
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('M');
            $months[] = $monthName;
            $expenseData[$i] = 0;
        }
        
        // Fill actual data
        foreach ($expenses as $expense) {
            $expenseData[$expense->month] = $expense->total;
        }
        
        $chart = LivewireCharts::areaChartModel()
            ->setTitle('Monthly Expenditure')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#EF4444'])
            ->setXAxisCategories($months);
            
        foreach ($expenseData as $month => $amount) {
            $chart->addPoint(
                Carbon::create()->month($month)->format('M'),
                $amount,
                ['formatted' => 'UGX '.number_format($amount, 0, '.', ',')]
            );
        }
        
        return $chart;
    }
    public function render()
    {
        $chartModel = $this->generateChart();
        return view('livewire.components.monthly-expenditure-chart',[
            'chartModel' => $chartModel,
        ]);
    }
}
