<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardButton extends Component
{
    public string $link;
    public string $icon;
    public string $label;


    /**
     * Create a new component instance.
     */
    public function __construct(string $link, $icon, $label)
    {
        $this->link = $link;
        $this->icon = $icon;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.dashboard-button');
    }
}
