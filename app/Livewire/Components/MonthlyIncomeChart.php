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
        $incomes = Budget::query()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw('MONTH(created_at) as month, SUM(estimated_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $months = [];
        $incomeData = [];
        
        // Initialize all months with 0
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('M');
            $months[] = $monthName;
            $incomeData[$i] = 0;
        }
        
        // Fill actual data
        foreach ($incomes as $income) {
            $incomeData[$income->month] = $income->total;
        }
        
        $chart = LivewireCharts::lineChartModel()
            ->setTitle('Monthly Income')
            ->setAnimated(true)
            ->withDataLabels()
            ->setColors(['#10B981'])
            ->setXAxisCategories($months);
            
        foreach ($incomeData as $month => $amount) {
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
        return view('livewire.components.monthly-income-chart', [
            'chartModel' => $chartModel,
        ]);
    }
}
