<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DateRangePicker extends Component
{
    public $startDate;
    public $endDate;
    
    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }
    
    public function updated($property)
    {
        if (in_array($property, ['startDate', 'endDate'])) {
            $this->dispatch('dateRangeUpdated', 
                startDate: $this->startDate,
                endDate: $this->endDate
            );
        }
    }
    
    public function setDateRange($range)
    {
        $today = now();
        
        switch ($range) {
            case 'today':
                $this->startDate = $today->format('Y-m-d');
                $this->endDate = $today->format('Y-m-d');
                break;
            case 'yesterday':
                $yesterday = $today->subDay();
                $this->startDate = $yesterday->format('Y-m-d');
                $this->endDate = $yesterday->format('Y-m-d');
                break;
            case 'last7days':
                $this->startDate = $today->subDays(6)->format('Y-m-d');
                $this->endDate = $today->format('Y-m-d');
                break;
            case 'last30days':
                $this->startDate = $today->subDays(29)->format('Y-m-d');
                $this->endDate = $today->format('Y-m-d');
                break;
            case 'thismonth':
                $this->startDate = $today->startOfMonth()->format('Y-m-d');
                $this->endDate = $today->endOfMonth()->format('Y-m-d');
                break;
            case 'lastmonth':
                $lastMonth = $today->subMonth();
                $this->startDate = $lastMonth->startOfMonth()->format('Y-m-d');
                $this->endDate = $lastMonth->endOfMonth()->format('Y-m-d');
                break;
        }
        
        $this->dispatch('dateRangeUpdated', 
            startDate: $this->startDate,
            endDate: $this->endDate
        );
    }
    
    public function render()
    {
        return view('livewire.components.date-range-picker');
    }
}