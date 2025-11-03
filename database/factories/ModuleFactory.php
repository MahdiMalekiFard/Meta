<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'      => $this->faker->uuid,
            'key'      => $this->faker->unique()->countryCode(),
            'languages' => [app()->getLocale()],
            'is_public' => $this->faker->boolean,
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Module $module) {
            $module->translations()->createMany([
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
