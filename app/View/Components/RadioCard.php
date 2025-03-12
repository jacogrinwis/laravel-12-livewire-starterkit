<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioCard extends Component
{
    public $id;

    public $name;

    public $value;

    public $title;

    public $description;

    public $checked;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null, $name = '', $value = '', $title = '', $description = '', $checked = false)
    {
        $this->id = $id ?: 'radio-'.uniqid();
        $this->name = $name;
        $this->value = $value;
        $this->title = $title;
        $this->description = $description;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-card');
    }
}
