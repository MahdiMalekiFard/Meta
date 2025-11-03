<?php

namespace App\View\Components\Admin\Shared;

use App\Models\Property;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertySelector extends Component
{
    public $properties;
    public $class      = "col-6 mb-3";
    /**
     * Create a new component instance.
     */
    public function __construct(public readonly array $checkedIds=[])
    {
        $this->properties = Property::all();
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.shared.property-selector');
    }
}
