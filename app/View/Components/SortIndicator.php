<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortIndicator extends Component
{
    public $field, $sortField, $sortDirection;

    /**
     * Create a new component instance.
     */
    public function __construct($field, $sortField, $sortDirection)
    {
        $this->field = $field;
        $this->sortField = $sortField;
        $this->sortDirection = $sortDirection;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-indicator');
    }
}
