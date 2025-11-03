<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = Faker::create('fa_IR');
        return [
            'name'           => fake()->name(),
            'email'          => fake()->unique()->safeEmail(),
            'mobile'         => rand(90000000000, 99999999999),
            'status'         => fake()->boolean,
            'password'       => 'password',
            'remember_token' => Str::random(10),
            'city_id'        => City::inRandomOrder()->first()?->id ?? City::factory()->create(),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->profile()->create([
                'user_id' => $user->id,
            ]);
        });
    }
    
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
