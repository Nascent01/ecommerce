<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $name, $label, $type, $value;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $type, $value)
    {
        $this->name = $name;
        $this->label = $label; 
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
