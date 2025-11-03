<?php

namespace App\View\Components\Website;

use App\Models\Banner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroStart extends Component
{
    public $banners;
    public $bannera_image = [];
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->banners = Banner::latest()->limit(5)->get();
        $this->banners->each(function (Banner $banner, int $key) {
           $this->bannera_image[] = $banner->getFirstMediaUrl('image','1080');
        });
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.hero-start');
    }
}
