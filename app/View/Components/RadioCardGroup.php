<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioCardGroup extends Component
{
    public $name;
    public $columns;

    /**
     * Create a new component instance.
     */
    public function __construct($name = '', $columns = 2)
    {
        $this->name = $name;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-card-group');
    }
}
