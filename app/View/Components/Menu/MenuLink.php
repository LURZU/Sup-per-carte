<?php

namespace App\View\Components\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuLink extends Component
{

    public string $route;
    public string $active;
    public string $label;
    public string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($route, $active, $label, $icon)
    {
        $this->route = $route;
        $this->active = $active;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.menu-link');
    }
}
