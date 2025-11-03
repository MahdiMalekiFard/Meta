<?php

namespace Database\Factories;

use App\Enums\OpinionPartEnum;
use App\Models\Opinion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opinion>
 */
class OpinionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug'      => fake()->slug,
            'user_id'   => User::factory(),
            'published' => true,
            'part'      => fake()->randomElement(OpinionPartEnum::values()),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Opinion $opinion) {
            $opinion->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->userName,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'company',
                    'value'  => fake()->company,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'body',
                    'value'  => fake()->text,
                ],
            ]);
        });
    }
}
