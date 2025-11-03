<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'      => '+98',
            'published' => true,
        ];
    }
    
    public function configure(): static
    {
        return $this->afterMaking(function (Country $country) {
            // ...
        })->afterCreating(function (Country $country) {
            $country->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->country,
                ],
            ]);
        });
    }
}
