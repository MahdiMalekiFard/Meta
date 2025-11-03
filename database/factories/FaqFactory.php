<?php

namespace Database\Factories;

use App\Enums\OpinionPartEnum;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'part'      => OpinionPartEnum::RENT->value,
            'published' => true,
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Faq $faq) {
            $faq->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->text,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => fake()->text,
                ],
            ]);
        });
    }
}
