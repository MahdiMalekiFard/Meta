<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'link'             => $this->faker->url,
            'button'           => 'Show Me',
            'gravity'          => 'center',
            'limit'            => 10,
            'published'        => true,
            'expire_at'        => now()->addDays(5),
            'languages'        => [app()->getLocale()],
            'extra_attributes' => [
            
            ],
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Banner $banner) {
            $banner->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => $this->faker->sentence,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => $this->faker->sentence,
                ],
            ]);
        });
    }
}
