<?php

namespace App\View\Components\Website;

use App\Enums\CategoryTypeEnum;
use App\Helpers\Constants;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Estate\EstateRepositoryInterface;
use App\Services\AdvancedSearchFields\AColumnBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceSearch extends Component
{
    public $categories;
    public $cities;
    
    /**
     * Create a new component instance.
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, EstateRepositoryInterface $estateRepository, CityRepositoryInterface $cityRepository)
    {
        $this->categories = cache()->remember('web:category:service', Constants::CACHE_TIME_30, function () use ($categoryRepository) {
            return $categoryRepository->query([
                'active'=>true,
                'with_active_service' => true,
                'a_search' => [
                    AColumnBuilder::new('type', CategoryTypeEnum::SERVICE->value)
                                  ->setOperator('=')
                                  ->generate(),
                ],
            ])->get();
        });
        
        $this->cities = cache()->remember('web:cities:with_active_service', Constants::CACHE_TIME_30, function () use ($cityRepository) {
            return $cityRepository->query([
                'with_active_service' => true,
            ])->get();
        });
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.service-search');
    }
}
