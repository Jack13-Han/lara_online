<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{

    public $routeName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
