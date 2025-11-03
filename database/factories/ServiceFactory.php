<?php

namespace Database\Factories;

use App\Models\Estate;
use App\Models\Property;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'             => $this->faker->uuid,
            'key'             =>    $this->faker->randomKey,
            'languages'        => [app()->getLocale()],
            'extra_attributes' => [],
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Service $service) {
            $service->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => $this->faker->sentence,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => fake()->realText(200),
                ],
            ]);
        });
    }
}
