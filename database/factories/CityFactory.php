<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'province_id' => Province::first()?->id ?? Province::factory()->create(),
            'published'   => true,
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (City $city) {
            $city->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->city,
                ],
            ]);
            
            $images = ['commercial', 'industrial', 'investment', 'land', 'residential'];
//            $imageUrl = "/images/property/" . fake()->randomElement($images) . ".jpg";
//            $city->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
        });
    }
}
