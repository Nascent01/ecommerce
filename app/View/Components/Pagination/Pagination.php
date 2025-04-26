<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $items, $position;

    /**
     * Create a new component instance.
     */
    public function __construct($items, $position)
    {
        $this->items = $items;
        $this->position = $position;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination.pagination');
    }
}
