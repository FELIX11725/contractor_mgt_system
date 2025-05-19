<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateTimePicker extends Component
{
     public $label;
    public $model;
    public $withoutTime;
    public $parseFormat;
    public $displayFormat;
    /**
     * Create a new component instance.
     */
    public function __construct(  $label = null, 
        $model = null, 
        $withoutTime = false,
        $parseFormat = 'YYYY-MM-DD',
        $displayFormat = 'MMM D, YYYY')
    {
       $this->label = $label;
        $this->model = $model;
        $this->withoutTime = $withoutTime;
        $this->parseFormat = $parseFormat;
        $this->displayFormat = $displayFormat;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.date-time-picker');
    }
}
