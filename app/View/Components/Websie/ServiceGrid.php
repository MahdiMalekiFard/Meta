<?php

namespace App\View\Components\Websie;

use App\Models\Service;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceGrid extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public readonly Service $service)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.websie.service-grid');
    }
}
