<?php

namespace App\View\Components\Website\Sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HowItWork extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.sections.how-it-work');
    }
}
