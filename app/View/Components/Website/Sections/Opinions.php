<?php

namespace App\View\Components\Website\Sections;

use App\Models\Opinion;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Opinions extends Component
{
    public $opinions;
    /**
     * Create a new component instance.
     */
    public function __construct(OpinionRepositoryInterface $opinionRepository)
    {
        $this->opinions = $opinionRepository->query([
            'filter' => [
                'active' => true,
            ],
        ])->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.sections.opinions');
    }
}
