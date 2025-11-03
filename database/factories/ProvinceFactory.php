<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Province>
 */
class ProvinceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_id' => Country::first()?->id ?? Country::factory()->create(),
            'published'  => true,
        ];
    }
    
    public function configure(): static
    {
        return $this->afterMaking(function (Province $province) {
            // ...
        })->afterCreating(function (Province $province) {
            $province->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->word,
                ],
            ]);
        });
    }
}
