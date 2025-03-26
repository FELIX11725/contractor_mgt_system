<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $rows;
    public $value;
    public $wireModel;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name = null,
        $label = null,
        $placeholder = null,
        $rows = 3,
        $value = null,
        $wireModel = null
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->value = $value;
        $this->wireModel = $wireModel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
