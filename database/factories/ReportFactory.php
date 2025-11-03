<?php

namespace Database\Factories;

use App\Models\ReportReason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'user_id'          => User::factory()->create(),
            'report_reason_id' => ReportReason::factory()->create(),
            'reportable_id'    => $user->id,
            'reportable_type'  => User::class,
            'message'          => fake()->text,
        ];
    }
}
