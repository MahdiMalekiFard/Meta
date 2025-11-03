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

class HeroStartSearch extends Component
{
    public $categories;
    public $cities;
    
    public $minPriceList;
    public $maxPriceList;
    
    /**
     * Create a new component instance.
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, EstateRepositoryInterface $estateRepository, CityRepositoryInterface $cityRepository)
    {
        $this->categories = cache()->remember('web:category:estate', Constants::CACHE_TIME_30, function () use ($categoryRepository) {
            return $categoryRepository->query([
                'active'             => true,
                'with_active_estate' => true,
                'a_search'           => [
                    AColumnBuilder::new('type', CategoryTypeEnum::ESTATE->value)
                                  ->setOperator('=')
                                  ->generate(),
                ],
            ])->get();
        });
        
        $this->cities = cache()->remember('web:cities:with_active_estate', Constants::CACHE_TIME_30, function () use ($cityRepository) {
            return $cityRepository->query([
                'with_active_estate' => true,
            ])->get();
        });
        
        $minPrice = $estateRepository->minPrice();
        $maxPrice = $estateRepository->maxPrice();
        
        $this->minPriceList = $this->generateMinPriceArray($minPrice, $maxPrice);
        $this->maxPriceList = $this->generateMaxPriceArray($maxPrice);
    }
    
    private function generateMinPriceArray($minValue, $maxValue): array
    {
        $maxValue /= 2;
        // Calculate the step size to distribute the range into 6 rounded records
        $step = round(($maxValue - $minValue) / 5);
        // Initialize an empty array to store the rounded price list
        $priceList = [];
        // Generate the rounded price list
        for ($i = 0; $i < 6; $i++) {
            $priceList[] = round($minValue + $i * $step, 2);
        }
        return $priceList;
    }
    
    private function generateMaxPriceArray($maxValue): array
    {
        $minValue = $maxValue / 2;
        // Calculate the step size to distribute the range into 6 rounded records
        $step = round(($maxValue - $minValue) / 5);
        // Initialize an empty array to store the rounded price list
        $priceList = [];
        // Generate the rounded price list
        for ($i = 0; $i < 6; $i++) {
            $priceList[] = round($minValue + $i * $step, 2);
        }
        return $priceList;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.hero-start-search');
    }
}
