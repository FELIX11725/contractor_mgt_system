<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DialogModals extends Component
{
    public $wireModel;
    public $id;
    public $maxWidth;
    /**
     * Create a new component instance.
     */
    public function __construct($wireModel = null, $id = null, $maxWidth = 'lg')
    {
        $this->wireModel = $wireModel;
        $this->id = $id;
        $this->maxWidth = $maxWidth;
    }
     public function maxWidthClass()
    {
        return [
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
            '3xl' => 'sm:max-w-3xl',
            '4xl' => 'sm:max-w-4xl',
            '5xl' => 'sm:max-w-5xl',
            '6xl' => 'sm:max-w-6xl',
            '7xl' => 'sm:max-w-7xl',
        ][$this->maxWidth] ?? 'sm:max-w-lg';
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dialog-modals');
    }
}
