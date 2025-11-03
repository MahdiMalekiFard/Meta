<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid'          => $this->faker->uuid,
            'planable_id'   => 1,//fill this from Plan::factory()
            'planable_type' => Service::class,//fill this from Plan::factory()
            'languages'     => [app()->getLocale()],
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Plan $plan) {
            $plan->translations()->createMany([
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
