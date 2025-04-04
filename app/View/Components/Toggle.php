<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toggle extends Component
{

    public $label;
    public $model;
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($label = null, $model = null, $value = null)
    {
        $this->label = $label;
        $this->model = $model;
        $this->value = $value;
    }
   

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toggle');
    }
}
