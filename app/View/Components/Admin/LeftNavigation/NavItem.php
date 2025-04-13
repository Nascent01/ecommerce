<?php

namespace App\View\Components\Admin\LeftNavigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{

    public $title, $link, $image, $active;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $link, $image = null, $active = false)
    {
        $this->title = $title;
        $this->link = $link;
        $this->image = $image;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.left-navigation.nav-item');
    }
}
