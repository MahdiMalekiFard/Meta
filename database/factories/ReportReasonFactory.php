<?php

namespace Database\Factories;

use App\Models\ReportReason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportReason>
 */
class ReportReasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'published' => true,
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (ReportReason $reportReason) {
            // ...
        })->afterCreating(function (ReportReason $reportReason) {
            $reportReason->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->text,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => fake()->sentence,
                ],
            ]);
        });
    }
}
