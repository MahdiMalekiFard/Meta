<?php

namespace App\Livewire\Admin\Pages\Plan;

use App\Models\Plan;
use App\Rules\Plan\PriceGreaterThanSpecialPriceRule;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class PlanPricingTable extends Component
{
    public           $prices = [];
    public Plan|null $plan   = null;
    
    protected $listeners = ['priceUpdatedEvent' => 'priceUpdatedEvent'];
    
    public function boot(): void
    {
    }
    
    public function mount(): void
    {
        if ($this->plan) {
            foreach ($this->plan->pricings as $pricing) {
                $this->prices[$pricing->month][$pricing->type->value] = [
                    'price'         => $pricing->price,
                    'price_special' => $pricing->price_special,
                ];
            }
        }
    }
    
    public function priceUpdatedEvent(): void
    {
        $validationsRule = [];
        foreach ($this->prices as $month => $types) {
            foreach ($types as $type => $prices) {
                $validationsRule["prices.$month.$type.price"] = ['required', 'numeric', 'min:0', "gte:prices.$month.$type.price_special"];
                $validationsRule["prices.$month.$type.price_special"] = [ 'numeric', 'min:0'];
            }
        }
        $this->validate($validationsRule);
        
        // Fill price special with price if it is empty or smaller than price.
        foreach ($this->prices as $month => $types) {
            foreach ($types as $type => $prices) {
                if (empty($prices['price_special']) || $prices['price_special'] < $prices['price']) {
                    $this->prices[$month][$type]['price_special'] = $prices['price'];
                }
            }
        }
    }
    
    public function render(): View
    {
        return view('livewire.admin.pages.plan.plan-pricing-table');
    }
}
