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
    
    public function updated()
    {
        $this->emit('dateRangeSelected', $this->startDate, $this->endDate);
    }
    public function render()
    {
        return view('livewire.components.date-range-picker');
    }
}
