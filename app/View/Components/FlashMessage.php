<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FlashMessage extends Component
{
    public $type, $message, $icon, $color;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $message, $icon, $color)
    {
        $this->type = $type;
        $this->message = $message;
        $this->icon = $icon;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.flash-message');
    }
}
