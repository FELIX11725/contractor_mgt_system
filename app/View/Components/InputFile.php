<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFile extends Component
{
    public $label;
    public $type;
    public $wireModel;
    public $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct($label = null, $type = 'text', $wireModel = null, $placeholder = null)
    {
         $this->label = $label;
        $this->type = $type;
        $this->wireModel = $wireModel;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-file');
    }
}
